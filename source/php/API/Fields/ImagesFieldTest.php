<?php

namespace SchoolsManager\API\Fields;

use AcfService\Contracts\GetField;
use AcfService\Implementations\FakeAcfService;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\TestCase;
use SchoolsManager\API\Fields\GetImage\GetImageInterface;
use SchoolsManager\API\Fields\GetImage\ImageInterface;
use SchoolsManager\Entity\API\Field;
use SchoolsManager\Entity\API\FieldGetCallback;
use SchoolsManager\PostType\ElementarySchool\ElementarySchoolConfiguration;
use SchoolsManager\PostType\PreSchool\PreSchoolConfiguration;
use WP_REST_Request;
use WpService\Contracts\GetPostField;
use WpService\Contracts\GetPostMeta;
use WpService\Contracts\WpGetAttachmentUrl;

class ImagesFieldTest extends TestCase
{
    #[TestDox('facade images are prioritized over gallery images')]
    public function testFacadeImagesArePrioritizedOverGalleryImages(): void
    {
        $acfService    = new FakeAcfService(['getField' => fn($field, $postId) => match ($field) {
            'gallery' => [
                ['image' => ['id' => 1]],
                ['image' => ['id' => 2]],
            ],
            'facade_images' => [
                ['image' => ['id' => 3]],
            ],
            default => null,
        }]);
        $imageProvider = $this->createMock(GetImageInterface::class);
        $imageProvider->method('getImage')->willReturnCallback(function ($id) {
            $image = $this->createMock(ImageInterface::class);
            $image->method('toArray')->willReturn(['id' => $id]);
            return $image;
        });

        $field  = new ImagesField($acfService, $imageProvider);
        $result = $field->getCallback(['id' => 123], '', new WP_REST_Request([]));

        $this->assertCount(3, $result);
        $this->assertEquals(3, $result[0]['id']);
        $this->assertEquals(1, $result[1]['id']);
        $this->assertEquals(2, $result[2]['id']);
    }
}
