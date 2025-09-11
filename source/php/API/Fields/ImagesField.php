<?php

namespace SchoolsManager\API\Fields;

use AcfService\Contracts\GetField;
use SchoolsManager\API\Fields\GetImage\GetImageInterface;
use SchoolsManager\Entity\API\Field;
use SchoolsManager\Entity\API\FieldGetCallback;
use SchoolsManager\PostType\ElementarySchool\ElementarySchoolConfiguration;
use SchoolsManager\PostType\PreSchool\PreSchoolConfiguration;
use WP_REST_Request;
use WpService\Contracts\GetPostField;
use WpService\Contracts\GetPostMeta;
use WpService\Contracts\WpGetAttachmentUrl;

class ImagesField extends Field
{
    use FieldGetCallback;

    public string|array $objectType;
    public string $attribute = 'images';

    public function __construct(
        private GetField $acfService,
        private GetImageInterface $imageProvider
    ) {
        $this->objectType = [
            PreSchoolConfiguration::POST_TYPE_SLUG,
            ElementarySchoolConfiguration::POST_TYPE_SLUG
        ];
    }

    public function getCallback(string|array $object, string $field_name, WP_REST_Request $request): array
    {
        $gallery      = $this->acfService->getField('gallery', $object['id']) ?: [];
        $facadeImages = $this->acfService->getField('facade_images', $object['id']) ?: [];

        $images = array_merge($gallery, $facadeImages);
        $images = array_map(fn($item) => $item['image'], $images);

        return array_map(function ($image) {
            return $this->imageProvider->getImage((int)($image['id'] ?? 0))->toArray();
        }, $images);
    }
}
