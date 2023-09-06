<?php

if (function_exists('acf_add_local_field_group')) {
    acf_add_local_field_group(array(
    'key'                   => 'group_64e84e2b7a8c4',
    'title'                 => __('Page fields', ASM_TEXT_DOMAIN),
    'fields'                => array(
        array(
            'key'                  => 'field_64e84e2bf63f8',
            'label'                => __('Parent School', ASM_TEXT_DOMAIN),
            'name'                 => 'parent_school',
            'aria-label'           => '',
            'type'                 => 'post_object',
            'instructions'         => __('Select a school to which this page belongs.', ASM_TEXT_DOMAIN),
            'required'             => 0,
            'conditional_logic'    => 0,
            'wrapper'              => array(
                'width' => '',
                'class' => '',
                'id'    => '',
            ),
            'post_type'            => array(
                0 => 'school',
            ),
            'post_status'          => '',
            'taxonomy'             => '',
            'return_format'        => 'id',
            'multiple'             => 0,
            'allow_null'           => 0,
            'bidirectional'        => 0,
            'ui'                   => 1,
            'bidirectional_target' => array(
            ),
        ),
    ),
    'location'              => array(
        array(
            array(
                'param'    => 'post_type',
                'operator' => '==',
                'value'    => 'page',
            ),
        ),
    ),
    'menu_order'            => 0,
    'position'              => 'side',
    'style'                 => 'default',
    'label_placement'       => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen'        => '',
    'active'                => true,
    'description'           => '',
    'show_in_rest'          => 0,
    ));
};
