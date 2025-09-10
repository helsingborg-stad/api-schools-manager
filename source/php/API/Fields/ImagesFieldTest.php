<?php

namespace SchoolsManager\API\Fields;

use PHPUnit\Framework\TestCase;
use AcfService\Implementations\FakeAcfService;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\TestDox;
use WP_REST_Request;
use WpService\Implementations\FakeWpService;

#[CoversClass(ImagesField::class)]
class ImagesFieldTest extends TestCase
{
    #[TestDox('class can be instantiated')]
    public function testCanBeInstantiated(): void
    {
        $field = new ImagesField(new FakeAcfService(), new FakeWpService());
        $this->assertInstanceOf(ImagesField::class, $field);
    }

    #[TestDox('getCallback returns images from gallery and facade_images ACF fields if they are set')]
    public function testGetCallbackReturnsImagesFromGalleryAndFacadeImagesIfSet(): void
    {
        $acfService = new FakeAcfService(['getField' => fn($selector, $postId) => match ($selector) {
            'gallery' => [
                ['image' => ['id' => 1]],
            ],
            'facade_images' => [
                ['image' => ['id' => 2]],
            ]
        }]);
        $wpService  = new FakeWpService([
            'wpGetAttachmentUrl' => fn($id) => "http://example.com/image/$id.jpg",
            'getPostField'       => fn($key, $id) =>  match ($key) {
                'post_title' => "Title for $id",
                'post_excerpt' => "Caption for $id",
                default => null
            },
            'getPostMeta'        => fn($id, $key) => "Alt text for $id"
        ]);

        $field      = new ImagesField($acfService, $wpService);
        $result     = $field->getCallback(['id' => 123], 'images', new WP_REST_Request([]));

        $this->assertEquals([
            [
                'ID'      => 1,
                'url'     => 'http://example.com/image/1.jpg',
                'alt'     => 'Alt text for 1',
                'name'    => 'Title for 1',
                'caption' => 'Caption for 1',
            ],
            [
                'ID'      => 2,
                'url'     => 'http://example.com/image/2.jpg',
                'alt'     => 'Alt text for 2',
                'name'    => 'Title for 2',
                'caption' => 'Caption for 2',
            ]
        ], $result);
    }

    #[TestDox('getCallback returns empty array if no images are set in gallery and facade_images ACF fields')]
    public function testGetCallbackReturnsEmptyArrayIfNoImagesAreSet(): void
    {
        $acfService = new FakeAcfService(['getField' => fn($selector, $postId) => match ($selector) {
            'gallery' => [],
            'facade_images' => [],
        }]);

        $field      = new ImagesField($acfService, new FakeWpService());
        $result     = $field->getCallback(['id' => 123], 'images', new WP_REST_Request([]));

        $this->assertEquals([], $result);
    }
}
