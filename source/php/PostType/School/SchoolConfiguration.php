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
                'map_meta_cap' => true
            ]
        ];
    }

    public static function getStatusTerms(): array
    {
        return [
            [
                'name' => __('Approved', 'api-schools-manager'),
                'slug' => 'approved',
                'description' => __('Approved assignment', 'api-schools-manager'),
                'color' => '#1e73be'
            ],
            [
                'name' => __('Pending', 'api-schools-manager'),
                'slug' => 'pending',
                'description' => __('Pending assignment', 'api-schools-manager'),
                'color' => '#dd9933'
            ],
            [
                'name' => __('Denied', 'api-schools-manager'),
                'slug' => 'denied',
                'description' => __('Denied assignment', 'api-schools-manager'),
                'color' => '#dd3333'
            ],
            [
                'name' => __('Completed', 'api-schools-manager'),
                'slug' => 'completed',
                'description' => __('Completed assignment', 'api-schools-manager'),
                'color' => '#dd3333'
            ]
        ];
    }

    public static function getEligibilityTerms(): array
    {
        return [
            [
                'name' => __('Level 1', 'api-schools-manager'),
                'slug' => '1',
                'description' => __('No criminal record required.', 'api-schools-manager'),
                'color' => '#81D742'
            ],
            [
                'name' => __('Level 2', 'api-schools-manager'),
                'slug' => '2',
                'description' => __('Criminal record is required.', 'api-schools-manager'),
                'color' => '#dd9933'
            ],
        ];
    }
}
