<?php

namespace SchoolsManager\Entity\API\Fields\Test;

use SchoolsManager\API\Fields\SchoolPagesField;
use SchoolsManager\PostType\School\SchoolConfiguration;
use WP_REST_Request;

class SchoolPagesFieldTest extends \WP_UnitTestCase
{
    protected string $endpoint                     = '/wp/v2/' . SchoolConfiguration::POST_TYPE_SLUG;
    protected int $schoolId                        = 0;
    protected ?SchoolPagesField $schooldPagesField = null;

    // phpcs:ignore PSR1.Methods.CamelCapsMethodName.NotCamelCaps
    public function set_up(): void
    {
        $this->schooldPagesField = new SchoolPagesField();
        $this->schooldPagesField->register();

        $this->schoolId = $this::factory()->post->create(
            array(
                'post_type' => SchoolConfiguration::POST_TYPE_SLUG,
                'post_name' => 'test'
            )
        );

        parent::set_up();
    }

    public function testFieldIsArray()
    {
        $response  = $this->makeRequest();
        $data      = $response->get_data();
        $fieldData = $data[0][$this->schooldPagesField->attribute];

        $this->assertIsArray($fieldData);
    }

    public function testFieldContainsPageIds()
    {
        $pageId    = $this->createPageAndSetParentSchool($this->schoolId);
        $response  = $this->makeRequest();
        $data      = $response->get_data();
        $fieldData = $data[0][$this->schooldPagesField->attribute];

        $this->assertContains($pageId, $fieldData);
    }

    private function makeRequest()
    {
        $request = new WP_REST_Request('GET', $this->endpoint);
        return rest_get_server()->dispatch($request);
    }

    private function createPageAndSetParentSchool($schoolId): int
    {
        $pageId = $this::factory()->post->create(
            array(
                'post_type' => 'page',
                'post_name' => 'test-page'
            )
        );

        update_field('parent_school', $schoolId, $pageId);

        return $pageId;
    }
}
