<?php

namespace SchoolsManager\API\Fields;

use SchoolsManager\Entity\API\Field;
use SchoolsManager\Entity\API\FieldGetCallback;
use SchoolsManager\PostType\ElementarySchool\ElementarySchoolConfiguration;
use SchoolsManager\PostType\PreSchool\PreSchoolConfiguration;
use WP_REST_Request;
use WpService\Contracts\GetPosts;

class SchoolPagesEmbeddedField extends Field
{
    use FieldGetCallback;

    public string|array $objectType;
    public string $attribute = 'pages_embedded';

    public function __construct(private GetPosts $wpService)
    {
        $this->objectType = [
            PreSchoolConfiguration::POST_TYPE_SLUG,
            ElementarySchoolConfiguration::POST_TYPE_SLUG
        ];
    }

    public function getCallback(string|array $object, string $field_name, WP_REST_Request $request): array
    {
        return array_map(function ($post) {
            return [
                'ID'           => $post->ID,
                'post_title'   => $post->post_title,
                'post_content' => $post->post_content
            ];
        }, $this->wpService->getPosts(
            array(
                'post_type'      => 'page',
                'posts_per_page' => -1,
                'meta_key'       => 'parent_school',
                'meta_value'     => $object['id'],
                'post_type__in'  => array('page'),
            )
        ));
    }
}
