<?php

namespace SchoolsManager\AcfFields;

use AcfService\Implementations\FakeAcfService;
use PHPUnit\Framework\TestCase;
use SchoolsManager\App;
use WpService\Implementations\FakeWpService;
use WpService\Contracts\GetTransient;
use WpService\Contracts\IsWpError;
use WpService\Contracts\SetTransient;
use WpService\Contracts\WpRemoteGet;
use WpService\Contracts\WpRemoteRetrieveBody;
use WpService\Contracts\WpRemoteRetrieveHeader;
use WpService\Contracts\WpRemoteRetrieveResponseCode;

class OrganizationChoicesTest extends TestCase
{
    /** Tests that unused terms on later pages are offered by name. */
    public function testLoadsEveryPageIncludingUnusedTerms(): void
    {
        $service            = new OrganizationHttpFake();
        $service->responses = [
            1 => ['code' => 200, 'body' => '[{"id":5,"name":"Zeta"}]', 'pages' => '2'],
            2 => ['code' => 200, 'body' => '[{"id":9,"name":"Alpha","count":0}]', 'pages' => '2'],
        ];

        $choices = (new OrganizationChoices($service))->getChoices();

        self::assertSame(['Alpha' => 'Alpha', 'Zeta' => 'Zeta'], $choices);
        self::assertCount(2, $service->requests);
        self::assertStringContainsString('hide_empty=false', $service->requests[0]);
    }

    /** Tests that a complete cached response avoids further HTTP traffic. */
    public function testReusesFreshChoices(): void
    {
        $service            = new OrganizationHttpFake();
        $service->responses = [1 => ['code' => 200, 'body' => '[{"id":2,"name":"School"}]', 'pages' => '1']];
        $provider           = new OrganizationChoices($service);

        $service->transients['schools_manager_event_organizations'] = [2 => 'School'];

        $first  = $provider->getChoices();
        $second = $provider->getChoices();

        self::assertSame(['School' => 'School'], $first);
        self::assertSame($first, $second);
        self::assertCount(1, $service->requests);
    }

    /** Tests that a partial refresh cannot overwrite last-known-good choices. */
    public function testUsesFallbackIfLaterPageFails(): void
    {
        $service            = new OrganizationHttpFake();
        $service->responses = [
            1 => ['code' => 200, 'body' => '[{"id":2,"name":"School"}]', 'pages' => '1'],
        ];
        $provider           = new OrganizationChoices($service);
        $provider->getChoices();
        unset($service->transients['schools_manager_event_organizations_names']);
        $service->responses = [
            1 => ['code' => 200, 'body' => '[{"id":3,"name":"Other"}]', 'pages' => '2'],
            2 => ['code' => 503, 'body' => '', 'pages' => '2'],
        ];

        $choices = $provider->getChoices();

        self::assertSame(['School' => 'School'], $choices);
        self::assertSame(
            ['School' => 'School'],
            $service->transients['schools_manager_event_organizations_names_fallback']
        );
    }

    /** Tests that invalid JSON without a cache is reported as unavailable. */
    public function testReturnsUnavailableOnMalformedResponseWithoutCache(): void
    {
        $service            = new OrganizationHttpFake();
        $service->responses = [1 => ['code' => 200, 'body' => '{bad json', 'pages' => '1']];

        $choices = (new OrganizationChoices($service))->getChoices();

        self::assertNull($choices);
        self::assertSame([], $service->transients);
    }

    /** Tests both ACF exports expose the same multi-select field on their post type. */
    public function testBothSchoolTypesExposeAnOptionalOrganizationSelect(): void
    {
        $keys      = [];
        $postTypes = ['elementary-school-data' => 'elementary-school', 'pre-school-data' => 'pre-school'];
        foreach ($postTypes as $file => $postType) {
            $groups = json_decode(
                file_get_contents(__DIR__ . '/json/' . $file . '.json'),
                true,
                512,
                JSON_THROW_ON_ERROR
            );
            $group  = $groups[0];
            $fields = array_values(array_filter(
                $group['fields'],
                static fn (array $field) => $field['name'] === 'event_organization'
            ));

            self::assertCount(1, $fields);
            self::assertSame('select', $fields[0]['type']);
            self::assertSame(0, $fields[0]['required']);
            self::assertSame(1, $fields[0]['multiple']);
            self::assertSame([], $fields[0]['default_value']);
            self::assertSame(1, $fields[0]['allow_null']);
            self::assertSame('value', $fields[0]['return_format']);
            self::assertSame(1, $group['show_in_rest']);
            self::assertSame($postType, $group['location'][0][0]['value']);
            $keys[] = $fields[0]['key'];
        }

        self::assertCount(2, array_unique($keys));
    }

    /** Tests that selected organization names are saved as names when choices are available. */
    public function testRegisteredFieldSavesOrganizationNames(): void
    {
        $wpService = new FakeWpService([
            'addAction'                    => true,
            'addFilter'                    => true,
            'getTransient'                 => false,
            'setTransient'                 => true,
            'wpRemoteGet'                  => ['code' => 200, 'body' => '[{"name":"School"}]', 'pages' => '1'],
            'isWpError'                    => false,
            'wpRemoteRetrieveResponseCode' => 200,
            'wpRemoteRetrieveBody'         => '[{"name":"School"}]',
            'wpRemoteRetrieveHeader'       => '1',
        ]);
        new App(new FakeAcfService(), $wpService);
        $filters   = $wpService->methodCalls['addFilter'];
        $hookNames = array_column($filters, 0);
        $loadHook  = $filters[array_search('acf/load_field/name=event_organization', $hookNames, true)][1];
        $saveHook  = $filters[array_search('acf/update_value/name=event_organization', $hookNames, true)][1];
        $field     = ['name' => 'event_organization', 'instructions' => ''];

        $loaded = $loadHook($field);
        $saved  = $saveHook(['School'], 5, $field);

        self::assertSame(['School' => 'School'], $loaded['choices']);
        self::assertSame(['School'], $saved);
        self::assertCount(1, $wpService->methodCalls['wpRemoteGet']);
    }

    /** Tests that an unrelated save during an outage retains all existing term IDs. */
    public function testRegisteredFieldPreservesSavedOrganizationWhenChoicesAreUnavailable(): void
    {
        $wpService = new FakeWpService([
            'addAction'                    => true,
            'addFilter'                    => true,
            'getTransient'                 => false,
            'wpRemoteGet'                  => ['code' => 503, 'body' => '', 'pages' => ''],
            'isWpError'                    => false,
            'wpRemoteRetrieveResponseCode' => 503,
            'getPostMeta'                  => [475, 186],
        ]);
        new App(new FakeAcfService(), $wpService);
        $filters   = $wpService->methodCalls['addFilter'];
        $hookNames = array_column($filters, 0);
        $loadHook  = $filters[array_search('acf/load_field/name=event_organization', $hookNames, true)][1];
        $saveHook  = $filters[array_search('acf/update_value/name=event_organization', $hookNames, true)][1];
        $field     = ['name' => 'event_organization', 'instructions' => ''];

        $loaded = $loadHook($field);
        $saved  = $saveHook('', 5, $field);

        self::assertInstanceOf(OrganizationField::class, $loadHook[0]);
        self::assertSame($loadHook[0], $saveHook[0]);
        self::assertSame([], $loaded['choices']);
        self::assertSame(1, $loaded['disabled']);
        self::assertSame([475, 186], $saved);
        self::assertCount(1, $wpService->methodCalls['wpRemoteGet']);
    }
}
