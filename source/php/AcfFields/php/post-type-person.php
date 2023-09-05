<?php

if (function_exists('acf_add_local_field_group')) {
    acf_add_local_field_group(array(
        'key'                   => 'group_64e6f3b077aa6',
        'title'                 => __('Person details', ASM_TEXT_DOMAIN),
        'fields'                => array(
            array(
                'key'               => 'field_64e6f3b00a717',
                'label'             => __('E-mail', ASM_TEXT_DOMAIN),
                'name'              => 'e-mail',
                'aria-label'        => '',
                'type'              => 'email',
                'instructions'      => '',
                'required'          => 0,
                'conditional_logic' => 0,
                'wrapper'           => array(
                    'width' => '',
                    'class' => '',
                    'id'    => '',
                ),
                'default_value'     => '',
                'placeholder'       => '',
                'prepend'           => '',
                'append'            => '',
            ),
            array(
                'key'               => 'field_64e6f3e40a718',
                'label'             => __('Phone number', ASM_TEXT_DOMAIN),
                'name'              => 'phone-number',
                'aria-label'        => '',
                'type'              => 'text',
                'instructions'      => '',
                'required'          => 0,
                'conditional_logic' => 0,
                'wrapper'           => array(
                    'width' => '',
                    'class' => '',
                    'id'    => '',
                ),
                'default_value'     => '',
                'maxlength'         => '',
                'placeholder'       => '',
                'prepend'           => '',
                'append'            => '',
            ),
        ),
        'location'              => array(
            array(
                array(
                    'param'    => 'post_type',
                    'operator' => '==',
                    'value'    => 'person',
                ),
            ),
        ),
        'menu_order'            => 0,
        'position'              => 'normal',
        'style'                 => 'default',
        'label_placement'       => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen'        => '',
        'active'                => true,
        'description'           => '',
        'show_in_rest'          => 0,
    ));
}
