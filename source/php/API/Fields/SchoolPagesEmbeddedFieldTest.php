<?php

namespace SchoolsManager\API\Fields;

use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\TestCase;
use WP_Post;
use WP_REST_Request;
use WpService\Contracts\ApplyFilters;
use WpService\Contracts\GetPosts;

class SchoolPagesEmbeddedFieldTest extends TestCase
{
    private function createEmptyGetPostsMock(): GetPosts&ApplyFilters
    {
        return new class implements GetPosts, ApplyFilters {
            public function getPosts(array $args = null): array
            {
                return [];
            }
            public function applyFilters(string $hookName, mixed $value, mixed ...$args): mixed
            {
                return $value;
            }
        };
    }

    private function createGetPostsMockWithIds(array $pages, int $expectedMetaValue): GetPosts&ApplyFilters
    {
        return new class ($pages, $expectedMetaValue) implements GetPosts, ApplyFilters {
            private array $pages;
            private int $expectedMetaValue;
            public function __construct(array $pages, int $expectedMetaValue)
            {
                $this->pages             = $pages;
                $this->expectedMetaValue = $expectedMetaValue;
            }
            public function getPosts(array $args = null): array
            {
                if (isset($args['meta_value']) && $args['meta_value'] === $this->expectedMetaValue) {
                    return $this->pages;
                }
                return [];
            }
            public function applyFilters(string $hookName, mixed $value, mixed ...$args): mixed
            {
                return $value;
            }
        };
    }

    #[TestDox('class can be instantiated')]
    public function testClassCanBeInstantiated(): void
    {
        $wpService = $this->createEmptyGetPostsMock();
        $field     = new SchoolPagesEmbeddedField($wpService);

        $this->assertInstanceOf(SchoolPagesEmbeddedField::class, $field);
    }

    #[TestDox('getCallback returns empty array when no posts are found')]
    public function testGetCallbackReturnsEmptyArray(): void
    {
        $wpService = $this->createEmptyGetPostsMock();
        $field     = new SchoolPagesEmbeddedField($wpService);

        $result = $field->getCallback(['id' => 123], 'pages', $this->createStub(WP_REST_Request::class));
        $this->assertSame([], $result);
    }

    #[TestDox('getCallback returns array of IDs when posts are found')]
    public function testGetCallbackReturnsArrayOfIds(): void
    {
        $expectedPage               = new WP_Post([]);
        $expectedPage->ID           = 10;
        $expectedPage->post_title   = 'Test Page';
        $expectedPage->post_content = 'This is a test page.';
        $schoolId                   = 123;
        $wpService                  = $this->createGetPostsMockWithIds([$expectedPage], $schoolId);
        $field                      = new SchoolPagesEmbeddedField($wpService);

        $result = $field->getCallback(['id' => $schoolId], 'pages', $this->createStub(WP_REST_Request::class));
        $this->assertSame([[
            'ID'           => 10,
            'post_title'   => 'Test Page',
            'post_content' => 'This is a test page.'
        ]], $result);
    }
}
