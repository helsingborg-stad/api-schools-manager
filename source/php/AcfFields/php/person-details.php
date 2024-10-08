<?php 

if (function_exists('acf_add_local_field_group')) {
    acf_add_local_field_group(array(
    'key' => 'group_64e6f3b077aa6',
    'title' => __('Person details', 'api-schools-manager'),
    'fields' => array(
        0 => array(
            'key' => 'field_66ebe6f715611',
            'label' => __('Person instructions', 'api-schools-manager'),
            'name' => '',
            'aria-label' => '',
            'type' => 'message',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'message' => __('Add the name in the title field.', 'api-schools-manager'),
            'new_lines' => 'wpautop',
            'esc_html' => 0,
        ),
        1 => array(
            'key' => 'field_64e6f3b00a717',
            'label' => __('E-mail', 'api-schools-manager'),
            'name' => 'e-mail',
            'aria-label' => '',
            'type' => 'email',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'default_value' => '',
            'placeholder' => '',
            'prepend' => '',
            'append' => '',
        ),
        2 => array(
            'key' => 'field_64e6f3e40a718',
            'label' => __('Phone number', 'api-schools-manager'),
            'name' => 'phone-number',
            'aria-label' => '',
            'type' => 'text',
            'instructions' => __('Use format (07XX-XX XX XX)', 'api-schools-manager'),
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
    ),
    'location' => array(
        0 => array(
            0 => array(
                'param' => 'post_type',
                'operator' => '==',
                'value' => 'person',
            ),
        ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => array(
        0 => 'excerpt',
    ),
    'active' => true,
    'description' => '',
    'show_in_rest' => 1,
));
}