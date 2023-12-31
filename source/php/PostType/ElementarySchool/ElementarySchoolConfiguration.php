<?php

namespace SchoolsManager\PostType\ElementarySchool;

use SchoolsManager\Helper\Icon as Icon;

class ElementarySchoolConfiguration
{
    public const POST_TYPE_SLUG = 'elementary-school';

    public function getPostTypeArgs(): array
    {
        return [
            'slug'         => self::POST_TYPE_SLUG,
            'namePlural'   => __('Elementary schools', 'api-schools-manager'),
            'nameSingular' => __('Elementary school', 'api-schools-manager'),
            'args'         => [
                'description'         => __('Elementary schools', 'api-schools-manager'),
                'menu_icon'           => Icon::get('school'),
                'publicly_queryable'  => true,
                'show_ui'             => true,
                'show_in_nav_menus'   => true,
                'has_archive'         => true,
                'hierarchical'        => true,
                'exclude_from_search' => true,
                'supports'            => array('title', 'revisions', 'thumbnail', 'excerpt'),
                'show_in_rest'        => true,
                'capability_type'     => 'post',
                'map_meta_cap'        => true,
            ]
        ];
    }
}
