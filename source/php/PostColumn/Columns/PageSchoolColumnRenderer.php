<?php

namespace SchoolsManager\PostColumn\Columns;

use SchoolsManager\PostColumn\PostColumnRendererInterface;

class PageSchoolColumnRenderer implements PostColumnRendererInterface
{
    public function render(string $column, int $postId): void
    {
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
