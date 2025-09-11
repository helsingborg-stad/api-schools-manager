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
use WpService\Contracts\GetPostThumbnailId;
use WpService\Contracts\GetThePostThumbnailUrl;
use WpService\Contracts\WpGetAttachmentUrl;

class EmployeeField extends Field
{
    use FieldGetCallback;

    public string|array $objectType;
    public string $attribute = 'employee';
    public function __construct(
        private GetField $acfService,
        private GetPostThumbnailId $wpService,
        private GetImageInterface $imageProvider
    ) {
        $this->objectType = [
            PreSchoolConfiguration::POST_TYPE_SLUG,
            ElementarySchoolConfiguration::POST_TYPE_SLUG
        ];
    }

    public function getCallback(string|array $object, string $field_name, WP_REST_Request $request): array
    {
        $contacts = $this->acfService->getField('contacts', $object['id']) ?: [];

        if (!is_array($contacts) || empty($contacts)) {
            return [];
        }

        return array_filter(array_map([$this, 'formatEmployee'], $contacts));
    }

    public function formatEmployee(array $contact): ?array
    {
        if (empty($contact['person']) || !($contact['person'] instanceof \WP_Post)) {
            return null;
        }

        $person = $contact['person'];
        $image  = $this->imageProvider->getImage($this->wpService->getPostThumbnailId($person->ID));

        return [
            'job_title' => $contact['professional_title'] ?? null,
            'name'      => $person->post_title ?? null,
            'email'     => $this->acfService->getField('e-mail', $person->ID) ?: null,
            'telephone' => $this->acfService->getField('phone-number', $person->ID) ?: null,
            'image'     => $image->toArray()
        ];
    }
}
