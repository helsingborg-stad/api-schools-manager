<?php

namespace SchoolsManager\PostType\PreSchool;

use SchoolsManager\Helper\Icon as Icon;

class PreSchoolConfiguration
{
    public const POST_TYPE_SLUG = 'pre-school';

    public function getPostTypeArgs(): array
    {
        return [
            'slug'         => self::POST_TYPE_SLUG,
            'namePlural'   => __('Pre schools', ASM_TEXT_DOMAIN),
            'nameSingular' => __('Pre school', ASM_TEXT_DOMAIN),
            'args'         => [
                'description'         => __('Pre schools', ASM_TEXT_DOMAIN),
                'menu_icon'           => Icon::get('school'),
                'publicly_queryable'  => true,
                'show_ui'             => true,
                'show_in_nav_menus'   => true,
                'has_archive'         => true,
                'hierarchical'        => false,
                'exclude_from_search' => true,
                'supports'            => array('title', 'revisions', 'thumbnail', 'excerpt'),
                'show_in_rest'        => true,
                'capability_type'     => 'post',
                'map_meta_cap'        => true,
            ]
        ];
    }
}
