<?php

namespace SchoolsManager\API\Fields;

use SchoolsManager\Entity\API\Field;
use SchoolsManager\Entity\API\FieldGetCallback;
use SchoolsManager\PostType\School\SchoolConfiguration;
use WP_REST_Request;

class SchoolPagesField extends Field
{
    use FieldGetCallback;

    public string|array $objectType = SchoolConfiguration::POST_TYPE_SLUG;
    public string $attribute        = 'pages';

    public function getCallback(string|array $object, string $field_name, WP_REST_Request $request): array
    {
        return get_posts(
            array(
                'post_type'      => 'page',
                'fields'         => 'ids',
                'posts_per_page' => -1,
                'meta_key'       => 'parent_school',
                'meta_value'     => $object['id'],
            )
        );
    }
}
