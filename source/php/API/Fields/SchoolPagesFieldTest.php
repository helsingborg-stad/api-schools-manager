<?php

namespace SchoolsManager\API\Fields;

use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\TestCase;
use WP_REST_Request;
use WpService\Contracts\GetPosts;

class SchoolPagesFieldTest extends TestCase
{
    private function createEmptyGetPostsMock(): GetPosts
    {
        return new class implements GetPosts {
            public function getPosts(array $args = null): array
            {
                return [];
            }
        };
    }

    private function createGetPostsMockWithIds(array $ids, int $expectedMetaValue): GetPosts
    {
        return new class ($ids, $expectedMetaValue) implements GetPosts {
            private array $ids;
            private int $expectedMetaValue;
            public function __construct(array $ids, int $expectedMetaValue)
            {
                $this->ids               = $ids;
                $this->expectedMetaValue = $expectedMetaValue;
            }
            public function getPosts(array $args = null): array
            {
                if (isset($args['meta_value']) && $args['meta_value'] === $this->expectedMetaValue) {
                    return $this->ids;
                }
                return [];
            }
        };
    }

    #[TestDox('class can be instantiated')]
    public function testClassCanBeInstantiated(): void
    {
        $wpService = $this->createEmptyGetPostsMock();
        $field     = new SchoolPagesField($wpService);

        $this->assertInstanceOf(SchoolPagesField::class, $field);
    }

    #[TestDox('getCallback returns empty array when no posts are found')]
    public function testGetCallbackReturnsEmptyArray(): void
    {
        $wpService = $this->createEmptyGetPostsMock();
        $field     = new SchoolPagesField($wpService);

        $result = $field->getCallback(['id' => 123], 'pages', $this->createStub(WP_REST_Request::class));
        $this->assertSame([], $result);
    }

    #[TestDox('getCallback returns array of IDs when posts are found')]
    public function testGetCallbackReturnsArrayOfIds(): void
    {
        $expectedIds = [10, 20, 30];
        $schoolId    = 123;
        $wpService   = $this->createGetPostsMockWithIds($expectedIds, $schoolId);
        $field       = new SchoolPagesField($wpService);

        $result = $field->getCallback(['id' => $schoolId], 'pages', $this->createStub(WP_REST_Request::class));
        $this->assertSame($expectedIds, $result);
    }
}
