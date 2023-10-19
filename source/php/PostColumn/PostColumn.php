<?php

namespace SchoolsManager\PostColumn;

class PostColumn
{
    public function __construct()
    {
        add_filter('manage_pages_columns', [$this, 'addCustomColumn']);
        add_action('manage_pages_custom_column', [$this, 'populateCustomColumn'], 10, 2);
        add_filter('manage_edit-page_sortable_columns', [$this, 'registerSortableColumn']);
        add_action('pre_get_posts', [$this, 'handleSorting']);
    }

    public function addCustomColumn($columns)
    {
        unset($columns['comments']);

        $offset  = array_search('date', array_keys($columns));
        $columns = array_slice($columns, 0, $offset, true) + ['parentSchoolTitle' => __('School', 'api-schools-manager')] + array_slice($columns, $offset, null, true);

        return $columns;
    }

    public function populateCustomColumn($column, $postId)
    {
        if ($column == 'parentSchoolTitle') {
            $parentSchoolId = get_post_meta($postId, 'parent_school', true);

            if ($parentSchoolId) {
                $parentSchool = get_post($parentSchoolId);

                if ($parentSchool) {
                    $editLink = get_edit_post_link($parentSchoolId);
                    echo '<a href="' . esc_url($editLink) . '">' . esc_html($parentSchool->post_title) . '</a>';
                } else {
                    echo '';
                }
            } else {
                echo '';
            }
        }
    }

    public function registerSortableColumn($columns)
    {
        $columns['parentSchoolTitle'] = 'parentSchool';
        return $columns;
    }

    public function handleSorting($query)
    {
        if (!is_admin() || !$query->is_main_query()) {
            return;
        }

        if ('parentSchool' === $query->get('orderby')) {
            $order = $query->get('order') ?: 'ASC'; // get the order direction or default to 'ASC'

            $query->set('meta_query', [
                'relation' => 'OR',
                [
                    'key'     => 'parent_school',
                    'compare' => 'EXISTS',
                ],
                [
                    'key'     => 'parent_school',
                    'compare' => 'NOT EXISTS',
                ],
            ]);

            $query->set('orderby', [
                'meta_value' => $order,
                'title'      => $order, // secondary sorting by title, just in case the meta_value is the same
            ]);
        }
    }
}
