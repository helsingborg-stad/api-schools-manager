<?php

namespace SchoolsManager\PostType\School;

use SchoolsManager\Helper\Icon as Icon;

class SchoolConfiguration
{
    public static function getPostTypeArgs(): array
    {
        return [
            'slug' => 'school',
            'namePlural' => __('schools', ASM_TEXT_DOMAIN),
            'nameSingular' => __('school', ASM_TEXT_DOMAIN),
            'args' => [
                'description' => __('Schools', ASM_TEXT_DOMAIN),
                'menu_icon' => Icon::get('school'),
                'publicly_queryable' => true,
                'show_ui' => true,
                'show_in_nav_menus' => true,
                'has_archive' => true,
                'hierarchical' => false,
                'exclude_from_search' => true,
                'supports' => array('title', 'revisions', 'thumbnail'),
                'show_in_rest' => true,
                'capability_type' => 'post',
                'map_meta_cap' => true,
            ]
        ];
    }
}
