<?php 

if (function_exists('acf_add_local_field_group')) {
    acf_add_local_field_group(array(
    'key' => 'group_6524011f6f467',
    'title' => __('Notice', 'api-schools-manager'),
    'fields' => array(
        0 => array(
            'key' => 'field_6524011f00e89',
            'label' => __('Heading', 'api-schools-manager'),
            'name' => 'notice_heading',
            'aria-label' => '',
            'type' => 'text',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'default_value' => '',
            'maxlength' => '',
            'placeholder' => '',
            'prepend' => '',
            'append' => '',
        ),
        1 => array(
            'key' => 'field_652404f800e8a',
            'label' => __('Content', 'api-schools-manager'),
            'name' => 'notice_content',
            'aria-label' => '',
            'type' => 'textarea',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'default_value' => '',
            'maxlength' => '',
            'rows' => '',
            'placeholder' => '',
            'new_lines' => '',
        ),
    ),
    'location' => array(
        0 => array(
            0 => array(
                'param' => 'post_type',
                'operator' => '==',
                'value' => 'pre-school',
            ),
        ),
        1 => array(
            0 => array(
                'param' => 'post_type',
                'operator' => '==',
                'value' => 'elementary-school',
            ),
        ),
    ),
    'menu_order' => 0,
    'position' => 'acf_after_title',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => true,
    'description' => '',
    'show_in_rest' => 1,
));
}