<?php 

if (function_exists('acf_add_local_field_group')) {
    acf_add_local_field_group(array(
    'key' => 'group_651e669808174',
    'title' => __('Preschool data', 'api-schools-manager'),
    'fields' => array(
        0 => array(
            'key' => 'field_651e669809b2b',
            'label' => __('Custom excerpt', 'api-schools-manager'),
            'name' => 'custom_excerpt',
            'aria-label' => '',
            'type' => 'wysiwyg',
            'instructions' => __('Use this space to write a short and engaging summary about your school. This summary will appear at the beginning of your school\'s page on the website, giving visitors a quick glimpse of what your school is all about.

Think of it as the first impression for your school\'s page. Keep it brief (one or two sentences) and focus on what makes your school special. This summary can also appear in other places where people find information about your school, such as search results and archives.', 'api-schools-manager'),
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
        1 => array(
            'key' => 'field_652960b541619',
            'label' => __('Facade images', 'api-schools-manager'),
            'name' => 'facade_images',
            'aria-label' => '',
            'type' => 'repeater',
            'instructions' => __('Upload up to 6 images of the school\'s facade. Images should be clear and well-lit.', 'api-schools-manager'),
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
                    'key' => 'field_652960b54161a',
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
                    'parent_repeater' => 'field_652960b541619',
                ),
            ),
        ),
        2 => array(
            'key' => 'field_652960ba4161b',
            'label' => __('Image gallery', 'api-schools-manager'),
            'name' => 'gallery',
            'aria-label' => '',
            'type' => 'repeater',
            'instructions' => __('Use this section to create an image gallery showcasing different aspects of the school. You can upload up to 6 images. Each image should represent a unique feature or area of the school, such as classrooms, playgrounds, labs, or other facilities. Make sure the images are in high resolution and properly captioned to provide context. The gallery is an excellent way to visually engage prospective students and parents, offering them a glimpse into the school environment.

Please note: The image gallery will only be accessible if the \'Video\' field is left empty. This is to ensure that the webpage remains uncluttered and user-friendly. If a video is uploaded, focus on its quality and relevance, and consider using the gallery section for another post where a video is not included.', 'api-schools-manager'),
            'required' => 0,
            'conditional_logic' => array(
                0 => array(
                    0 => array(
                        'field' => 'field_652663d62efd2',
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
                    'key' => 'field_652960ba4161c',
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
                    'parent_repeater' => 'field_652960ba4161b',
                ),
            ),
        ),
        3 => array(
            'key' => 'field_652663d62efd2',
            'label' => __('Video', 'api-schools-manager'),
            'name' => 'video',
            'aria-label' => '',
            'type' => 'oembed',
            'instructions' => __('This field is designated for embedding a video that showcases the school. Please note that the video must be hosted on an external service, such as YouTube or Vimeo. Direct uploads are not supported in this field. 
<br><br>
<strong>Video Content:</strong> The video should be concise, informative, and engaging. It could include a tour of the school, interviews with staff and students, or highlights of school activities and programs.
<br><br>
<strong>Privacy and Permissions:</strong> Ensure you have the right permissions and that the video complies with privacy policies, especially if it features students.
<br><br>
Please be aware that if you utilize this video field, the \'Image Gallery\' section will become inaccessible. This is to maintain a clean and user-friendly page layout. If you wish to use the image gallery, leave this video field empty.', 'api-schools-manager'),
            'required' => 0,
            'conditional_logic' => array(
                0 => array(
                    0 => array(
                        'field' => 'field_652960ba4161b',
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
        4 => array(
            'key' => 'field_651e6698097ca',
            'label' => __('Number of children', 'api-schools-manager'),
            'name' => 'number_of_children',
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
        5 => array(
            'key' => 'field_651e669809859',
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
        6 => array(
            'key' => 'field_651e669809811',
            'label' => __('Number of units', 'api-schools-manager'),
            'name' => 'number_of_units',
            'aria-label' => '',
            'type' => 'number',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => array(
                0 => array(
                    0 => array(
                        'field' => 'field_651e66980968f',
                        'operator' => '==',
                        'value' => 'pre_school',
                    ),
                ),
            ),
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
            'key' => 'field_6528d90953367',
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
        8 => array(
            'key' => 'field_652cfb47f60e9',
            'label' => __('Visit Us', 'api-schools-manager'),
            'name' => 'visit_us',
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
        9 => array(
            'key' => 'field_65295aed43689',
            'label' => __('Open hours', 'api-schools-manager'),
            'name' => 'open_hours',
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
                    'key' => 'field_65295aed4368a',
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
                    'key' => 'field_65295aed4368b',
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
            'key' => 'field_651e669809b74',
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
                    'key' => 'field_651e669812780',
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
                    'key' => 'field_651e6698127c9',
                    'label' => '',
                    'name' => 'about_us',
                    'aria-label' => '',
                    'type' => 'wysiwyg',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => array(
                        0 => array(
                            0 => array(
                                'field' => 'field_651e66980968f',
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
                    'key' => 'field_651e669812812',
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
                    'key' => 'field_651e66981285a',
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
                    'key' => 'field_6528d32730684',
                    'label' => __('Orientation', 'api-schools-manager'),
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
                    'key' => 'field_6528d32530683',
                    'label' => '',
                    'name' => 'orientation',
                    'aria-label' => '',
                    'type' => 'wysiwyg',
                    'instructions' => __('This is what happens when your child starts in pre-school class at our school.', 'api-schools-manager'),
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
                    'key' => 'field_651e6698128a1',
                    'label' => __('Optional row', 'api-schools-manager'),
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
                    'open' => 1,
                    'multi_expand' => 1,
                    'endpoint' => 0,
                ),
                7 => array(
                    'key' => 'field_65375d8c49d5d',
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
                            'key' => 'field_65375d8c49d5e',
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
                            'parent_repeater' => 'field_65375d8c49d5d',
                        ),
                        1 => array(
                            'key' => 'field_65375d8c49d5f',
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
                            'parent_repeater' => 'field_65375d8c49d5d',
                        ),
                    ),
                ),
            ),
        ),
        11 => array(
            'key' => 'field_651e669809bbb',
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
                    'key' => 'field_651e669816f70',
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
                    'parent_repeater' => 'field_651e669809bbb',
                ),
                1 => array(
                    'key' => 'field_6530cac991160',
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
                    'new_lines' => '',
                    'parent_repeater' => 'field_651e669809bbb',
                ),
            ),
        ),
        12 => array(
            'key' => 'field_651e669809ae2',
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
            'key' => 'field_651e669809a99',
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
            'key' => 'field_651e669809c03',
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
            'collapsed' => 'field_64f6c6760ecf5',
            'button_label' => __('Add contact', 'api-schools-manager'),
            'rows_per_page' => 20,
            'sub_fields' => array(
                0 => array(
                    'key' => 'field_651e6698183ec',
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
                    'parent_repeater' => 'field_651e669809c03',
                ),
                1 => array(
                    'key' => 'field_651e669818435',
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
                    'parent_repeater' => 'field_651e669809c03',
                ),
            ),
        ),
        15 => array(
            'key' => 'field_651e669809c4a',
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
            'key' => 'field_651e669809c92',
            'label' => '',
            'name' => 'cta_application',
            'aria-label' => '',
            'type' => 'group',
            'instructions' => __('If these fields are left unedited, the application Call-To-Action box will use the default settings from School Settings Manager.', 'api-schools-manager'),
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
                    'key' => 'field_6553858f749a8',
                    'label' => __('Display on website', 'api-schools-manager'),
                    'name' => 'display_on_website',
                    'aria-label' => '',
                    'type' => 'true_false',
                    'instructions' => __('Uncheck this to hide the application Call-To-Action box on the website', 'api-schools-manager'),
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'message' => '',
                    'default_value' => 1,
                    'ui' => 0,
                    'ui_on_text' => '',
                    'ui_off_text' => '',
                ),
                1 => array(
                    'key' => 'field_65536d9acd483',
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
                2 => array(
                    'key' => 'field_651e66981a2f9',
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
                3 => array(
                    'key' => 'field_651e66981a343',
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
                4 => array(
                    'key' => 'field_651e66981a38e',
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
            'key' => 'field_651e669809cda',
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
        18 => array(
            'key' => 'field_65843cdc0c2e8',
            'label' => __('Posttype Canonical URL', 'api-schools-manager'),
            'name' => 'posttype_canonical_url',
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
    ),
    'location' => array(
        0 => array(
            0 => array(
                'param' => 'post_type',
                'operator' => '==',
                'value' => 'pre-school',
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