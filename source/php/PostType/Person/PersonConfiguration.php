<?php

namespace SchoolsManager\PostType\Person;

use SchoolsManager\Helper\Icon as Icon;

class PersonConfiguration
{
    public static function getPostTypeArgs(): array
    {
        return [
            'slug'         => 'person',
            'namePlural'   => __('persons', 'api-schools-manager'),
            'nameSingular' => __('person', 'api-schools-manager'),
            'args'         => [
                'description'         => __('Persons', 'api-schools-manager'),
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
