<?php

namespace SchoolsManager\PostType\Person;

use SchoolsManager\Helper\Icon as Icon;

class PersonConfiguration
{
    public static function getPostTypeArgs(): array
    {
        return [
            'slug'         => 'person',
            'namePlural'   => __('persons', ASM_TEXT_DOMAIN),
            'nameSingular' => __('person', ASM_TEXT_DOMAIN),
            'args'         => [
                'description'         => __('Persons', ASM_TEXT_DOMAIN),
                'menu_icon'           => Icon::get('people'),
                'publicly_queryable'  => true,
                'show_ui'             => true,
                'show_in_nav_menus'   => true,
                'has_archive'         => true,
                'hierarchical'        => false,
                'exclude_from_search' => true,
                'supports'            => array('title', 'revisions', 'thumbnail'),
                'show_in_rest'        => true,
                'capability_type'     => 'post',
                'map_meta_cap'        => true
            ]
        ];
    }
}
