<?php 

if (function_exists('acf_add_local_field_group')) {
    acf_add_local_field_group(array(
    'key' => 'group_651e694d7a010',
    'title' => __('Elementary school data', 'api-schools-manager'),
    'fields' => array(
        0 => array(
            'key' => 'field_651e694d7b36f',
            'label' => __('Facade images', 'api-schools-manager'),
            'name' => 'facade_images',
            'aria-label' => '',
            'type' => 'repeater',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'layout' => 'block',
            'pagination' => 0,
            'min' => 0,
            'max' => 6,
            'collapsed' => '',
            'button_label' => __('Add facade image', 'api-schools-manager'),
            'rows_per_page' => 20,
            'sub_fields' => array(
                0 => array(
                    'key' => 'field_652cd91f17dd0',
                    'label' => __('Image', 'api-schools-manager'),
                    'name' => 'image',
                    'aria-label' => '',
                    'type' => 'focuspoint',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'preview_size' => 'medium',
                    'min_width' => '',
                    'min_height' => '',
                    'min_size' => '',
                    'max_width' => '',
                    'max_height' => '',
                    'max_size' => '',
                    'parent_repeater' => 'field_651e694d7b36f',
                ),
            ),
        ),
        1 => array(
            'key' => 'field_651e694d7b3b7',
            'label' => __('Image gallery', 'api-schools-manager'),
            'name' => 'gallery',
            'aria-label' => '',
            'type' => 'repeater',
            'instructions' => __('Image gallery is only available if video is empty.', 'api-schools-manager'),
            'required' => 0,
            'conditional_logic' => array(
                0 => array(
                    0 => array(
                        'field' => 'field_65265eecd4706',
                        'operator' => '==empty',
                    ),
                ),
            ),
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'layout' => 'block',
            'pagination' => 0,
            'min' => 0,
            'max' => 6,
            'collapsed' => '',
            'button_label' => __('Add image', 'api-schools-manager'),
            'rows_per_page' => 20,
            'sub_fields' => array(
                0 => array(
                    'key' => 'field_652ced5511e28',
                    'label' => __('Image', 'api-schools-manager'),
                    'name' => 'image',
                    'aria-label' => '',
                    'type' => 'focuspoint',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'preview_size' => 'medium',
                    'min_width' => '',
                    'min_height' => '',
                    'min_size' => '',
                    'max_width' => '',
                    'max_height' => '',
                    'max_size' => '',
                    'parent_repeater' => 'field_651e694d7b3b7',
                ),
            ),
        ),
        2 => array(
            'key' => 'field_65265eecd4706',
            'label' => __('Video', 'api-schools-manager'),
            'name' => 'video',
            'aria-label' => '',
            'type' => 'oembed',
            'instructions' => __('Video is only available if image gallery is empty.', 'api-schools-manager'),
            'required' => 0,
            'conditional_logic' => array(
                0 => array(
                    0 => array(
                        'field' => 'field_651e694d7b3b7',
                        'operator' => '==empty',
                    ),
                ),
            ),
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'width' => '',
            'height' => '',
        ),
        3 => array(
            'key' => 'field_651e694d7b7ad',
            'label' => __('Custom excerpt', 'api-schools-manager'),
            'name' => 'custom_excerpt',
            'aria-label' => '',
            'type' => 'wysiwyg',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'default_value' => '',
            'tabs' => 'all',
            'toolbar' => 'basic',
            'media_upload' => 0,
            'delay' => 0,
        ),
        4 => array(
            'key' => 'field_651e694d7b523',
            'label' => __('Grades', 'api-schools-manager'),
            'name' => 'grades',
            'aria-label' => '',
            'type' => 'taxonomy',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => array(
                0 => array(
                    0 => array(
                        'field' => 'field_651e694d7b36f',
                        'operator' => '!=empty',
                    ),
                ),
            ),
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'taxonomy' => 'grade',
            'add_term' => 1,
            'save_terms' => 1,
            'load_terms' => 1,
            'return_format' => 'id',
            'field_type' => 'checkbox',
            'bidirectional' => 0,
            'multiple' => 0,
            'allow_null' => 0,
            'bidirectional_target' => array(
            ),
        ),
        5 => array(
            'key' => 'field_651e694d7b44d',
            'label' => __('Number of students', 'api-schools-manager'),
            'name' => 'number_of_students',
            'aria-label' => '',
            'type' => 'number',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'default_value' => '',
            'min' => '',
            'max' => '',
            'placeholder' => '',
            'step' => '',
            'prepend' => '',
            'append' => '',
        ),
        6 => array(
            'key' => 'field_65376d3447255',
            'label' => __('Number of profiles', 'api-schools-manager'),
            'name' => 'number_of_profiles',
            'aria-label' => '',
            'type' => 'number',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'default_value' => '',
            'min' => '',
            'max' => '',
            'placeholder' => '',
            'step' => '',
            'prepend' => '',
            'append' => '',
        ),
        7 => array(
            'key' => 'field_651e694d7b4dc',
            'label' => __('Area', 'api-schools-manager'),
            'name' => 'area',
            'aria-label' => '',
            'type' => 'taxonomy',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'taxonomy' => 'area',
            'add_term' => 0,
            'save_terms' => 1,
            'load_terms' => 1,
            'return_format' => 'id',
            'field_type' => 'select',
            'allow_null' => 0,
            'bidirectional' => 0,
            'multiple' => 0,
            'bidirectional_target' => array(
            ),
        ),
        8 => array(
            'key' => 'field_6528dbde39aab',
            'label' => __('USP:s', 'api-schools-manager'),
            'name' => 'usp',
            'aria-label' => '',
            'type' => 'taxonomy',
            'instructions' => __('Drag and drop the terms to set the order in which to display them.', 'api-schools-manager'),
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'taxonomy' => 'usp',
            'add_term' => 1,
            'save_terms' => 1,
            'load_terms' => 1,
            'return_format' => 'id',
            'field_type' => 'multi_select',
            'allow_null' => 1,
            'bidirectional' => 0,
            'multiple' => 0,
            'bidirectional_target' => array(
            ),
        ),
        9 => array(
            'key' => 'field_651e694d7b5b3',
            'label' => __('Open hours (leisure center)', 'api-schools-manager'),
            'name' => 'open_hours_leisure_center',
            'aria-label' => '',
            'type' => 'group',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'layout' => 'block',
            'sub_fields' => array(
                0 => array(
                    'key' => 'field_652959e07444d',
                    'label' => __('Open', 'api-schools-manager'),
                    'name' => 'open',
                    'aria-label' => '',
                    'type' => 'time_picker',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '50',
                        'class' => '',
                        'id' => '',
                    ),
                    'display_format' => 'H:i',
                    'return_format' => 'H:i',
                ),
                1 => array(
                    'key' => 'field_65295a067444e',
                    'label' => __('Close', 'api-schools-manager'),
                    'name' => 'close',
                    'aria-label' => '',
                    'type' => 'time_picker',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '50',
                        'class' => '',
                        'id' => '',
                    ),
                    'display_format' => 'H:i',
                    'return_format' => 'H:i',
                ),
            ),
        ),
        10 => array(
            'key' => 'field_651e694d7b7f4',
            'label' => __('Information', 'api-schools-manager'),
            'name' => 'information',
            'aria-label' => '',
            'type' => 'group',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'layout' => 'block',
            'sub_fields' => array(
                0 => array(
                    'key' => 'field_651e694d850b6',
                    'label' => __('About Us', 'api-schools-manager'),
                    'name' => '',
                    'aria-label' => '',
                    'type' => 'accordion',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'open' => 0,
                    'multi_expand' => 1,
                    'endpoint' => 0,
                ),
                1 => array(
                    'key' => 'field_651e694d85100',
                    'label' => '',
                    'name' => 'about_us',
                    'aria-label' => '',
                    'type' => 'wysiwyg',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => array(
                        0 => array(
                            0 => array(
                                'field' => 'field_651e694d7b326',
                                'operator' => '!=empty',
                            ),
                        ),
                    ),
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'tabs' => 'all',
                    'toolbar' => 'basic',
                    'media_upload' => 0,
                    'delay' => 0,
                ),
                2 => array(
                    'key' => 'field_651e694d85149',
                    'label' => __('How we work', 'api-schools-manager'),
                    'name' => '',
                    'aria-label' => '',
                    'type' => 'accordion',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'open' => 0,
                    'multi_expand' => 1,
                    'endpoint' => 0,
                ),
                3 => array(
                    'key' => 'field_651e694d85191',
                    'label' => '',
                    'name' => 'how_we_work',
                    'aria-label' => '',
                    'type' => 'wysiwyg',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'tabs' => 'all',
                    'toolbar' => 'basic',
                    'media_upload' => 0,
                    'delay' => 0,
                ),
                4 => array(
                    'key' => 'field_6528d3b9f5e33',
                    'label' => __('Our leisure center', 'api-schools-manager'),
                    'name' => '',
                    'aria-label' => '',
                    'type' => 'accordion',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'open' => 0,
                    'multi_expand' => 1,
                    'endpoint' => 0,
                ),
                5 => array(
                    'key' => 'field_6528d3b2f5e32',
                    'label' => '',
                    'name' => 'our_leisure_center',
                    'aria-label' => '',
                    'type' => 'wysiwyg',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'tabs' => 'all',
                    'toolbar' => 'basic',
                    'media_upload' => 0,
                    'delay' => 0,
                ),
                6 => array(
                    'key' => 'field_651e694d851da',
                    'label' => __('Optional rows', 'api-schools-manager'),
                    'name' => '',
                    'aria-label' => '',
                    'type' => 'accordion',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'open' => 0,
                    'multi_expand' => 1,
                    'endpoint' => 0,
                ),
                7 => array(
                    'key' => 'field_651e694d85222',
                    'label' => '',
                    'name' => 'optional',
                    'aria-label' => '',
                    'type' => 'repeater',
                    'instructions' => __('You can add up to 5 optional rows. Click the arrow icon in the top of the left column next to a row to close it. Drag and drop rows by clicking and holding the left column to reorder them if necessary.', 'api-schools-manager'),
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'layout' => 'block',
                    'pagination' => 0,
                    'min' => 0,
                    'max' => 5,
                    'collapsed' => 'field_651e694d8799b',
                    'button_label' => __('Lägg till', 'api-schools-manager'),
                    'rows_per_page' => 20,
                    'sub_fields' => array(
                        0 => array(
                            'key' => 'field_651e694d8799b',
                            'label' => __('Heading', 'api-schools-manager'),
                            'name' => 'heading',
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
                            'parent_repeater' => 'field_651e694d85222',
                        ),
                        1 => array(
                            'key' => 'field_651e694d879e5',
                            'label' => __('Content', 'api-schools-manager'),
                            'name' => 'content',
                            'aria-label' => '',
                            'type' => 'wysiwyg',
                            'instructions' => '',
                            'required' => 0,
                            'conditional_logic' => 0,
                            'wrapper' => array(
                                'width' => '',
                                'class' => '',
                                'id' => '',
                            ),
                            'default_value' => '',
                            'tabs' => 'all',
                            'toolbar' => 'basic',
                            'media_upload' => 0,
                            'delay' => 0,
                            'parent_repeater' => 'field_651e694d85222',
                        ),
                    ),
                ),
            ),
        ),
        11 => array(
            'key' => 'field_651e694d7b83b',
            'label' => __('Visiting address', 'api-schools-manager'),
            'name' => 'visiting_address',
            'aria-label' => '',
            'type' => 'repeater',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'layout' => 'block',
            'pagination' => 0,
            'min' => 1,
            'max' => 0,
            'collapsed' => 'field_64f6bff16c30a',
            'button_label' => __('Add additional addresses', 'api-schools-manager'),
            'rows_per_page' => 20,
            'sub_fields' => array(
                0 => array(
                    'key' => 'field_651e694d89981',
                    'label' => __('Address', 'api-schools-manager'),
                    'name' => 'address',
                    'aria-label' => '',
                    'type' => 'google_map',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'center_lat' => '56.043398530874754',
                    'center_lng' => '12.707579121882867',
                    'zoom' => '',
                    'height' => 200,
                    'parent_repeater' => 'field_651e694d7b83b',
                ),
                1 => array(
                    'key' => 'field_6523fed15e46d',
                    'label' => __('Description', 'api-schools-manager'),
                    'name' => 'description',
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
                    'new_lines' => 'wpautop',
                    'parent_repeater' => 'field_651e694d7b83b',
                ),
            ),
        ),
        12 => array(
            'key' => 'field_651e694d7b766',
            'label' => __('Link Facebook', 'api-schools-manager'),
            'name' => 'link_facebook',
            'aria-label' => '',
            'type' => 'url',
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
        ),
        13 => array(
            'key' => 'field_651e694d7b71f',
            'label' => __('Link Instagram', 'api-schools-manager'),
            'name' => 'link_instagram',
            'aria-label' => '',
            'type' => 'url',
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
        ),
        14 => array(
            'key' => 'field_651e694d7b89a',
            'label' => __('Contacts', 'api-schools-manager'),
            'name' => 'contacts',
            'aria-label' => '',
            'type' => 'repeater',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'layout' => 'row',
            'pagination' => 0,
            'min' => 0,
            'max' => 0,
            'collapsed' => 'field_651e694d8ae0b',
            'button_label' => __('Add contact', 'api-schools-manager'),
            'rows_per_page' => 20,
            'sub_fields' => array(
                0 => array(
                    'key' => 'field_651e694d8adbd',
                    'label' => __('Professional title', 'api-schools-manager'),
                    'name' => 'professional_title',
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
                    'parent_repeater' => 'field_651e694d7b89a',
                ),
                1 => array(
                    'key' => 'field_651e694d8ae0b',
                    'label' => __('Person', 'api-schools-manager'),
                    'name' => 'person',
                    'aria-label' => '',
                    'type' => 'post_object',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'post_type' => array(
                        0 => 'person',
                    ),
                    'post_status' => array(
                        0 => 'publish',
                    ),
                    'taxonomy' => '',
                    'return_format' => 'object',
                    'multiple' => 0,
                    'allow_null' => 0,
                    'bidirectional' => 0,
                    'ui' => 1,
                    'bidirectional_target' => array(
                    ),
                    'parent_repeater' => 'field_651e694d7b89a',
                ),
            ),
        ),
        15 => array(
            'key' => 'field_651e694d7b8ed',
            'label' => __('Call to action: Application', 'api-schools-manager'),
            'name' => '',
            'aria-label' => '',
            'type' => 'accordion',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'open' => 0,
            'multi_expand' => 0,
            'endpoint' => 0,
        ),
        16 => array(
            'key' => 'field_651e694d7b93a',
            'label' => '',
            'name' => 'cta_application',
            'aria-label' => '',
            'type' => 'group',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'layout' => 'block',
            'sub_fields' => array(
                0 => array(
                    'key' => 'field_65536dc0e959a',
                    'label' => __('Title', 'api-schools-manager'),
                    'name' => 'title',
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
                    'key' => 'field_651e694d8cdfc',
                    'label' => __('Description', 'api-schools-manager'),
                    'name' => 'description',
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
                2 => array(
                    'key' => 'field_651e694d8ce45',
                    'label' => __('Apply here', 'api-schools-manager'),
                    'name' => 'cta_apply_here',
                    'aria-label' => '',
                    'type' => 'link',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '50',
                        'class' => '',
                        'id' => '',
                    ),
                    'return_format' => 'array',
                ),
                3 => array(
                    'key' => 'field_651e694d8ce8c',
                    'label' => __('How to apply', 'api-schools-manager'),
                    'name' => 'cta_how_to_apply',
                    'aria-label' => '',
                    'type' => 'link',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '50',
                        'class' => '',
                        'id' => '',
                    ),
                    'return_format' => 'array',
                ),
            ),
        ),
        17 => array(
            'key' => 'field_651e694d7b983',
            'label' => __('end call to action accordion', 'api-schools-manager'),
            'name' => '',
            'aria-label' => '',
            'type' => 'accordion',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'open' => 0,
            'multi_expand' => 0,
            'endpoint' => 1,
        ),
    ),
    'location' => array(
        0 => array(
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
    'hide_on_screen' => array(
        0 => 'excerpt',
    ),
    'active' => true,
    'description' => '',
    'show_in_rest' => 1,
));
}