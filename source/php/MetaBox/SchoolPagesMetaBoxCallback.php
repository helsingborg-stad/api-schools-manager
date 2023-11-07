<?php

namespace SchoolsManager\MetaBox;

use WP_Post;
use SchoolsManager\Entity\MetaBox\MetaBoxCallbackRendererInterface;

class SchoolPagesMetaBoxCallback implements MetaBoxCallbackRendererInterface
{
    private array $pagePosts = array();

    private function getPages(int $postID)
    {
        $this->pagePosts = get_posts(
            array(
                'post_type'  => 'page',
                'meta_key'   => 'parent_school',
                'meta_value' => $postID,
            )
        );
    }

    private function printDescription(): void
    {
        if (empty($this->pagePosts)) {
            $paragraph1 = __(<<<'EOD'
            No pages are associated with this school yet.
            EOD, 'api-schools-manager');

            $paragraph2 = __(<<<'EOD'
            To associate a page with this school, edit the page and select
            this school from the "Parent School" dropdown.
            EOD, 'api-schools-manager');

            echo '<p><i>' . esc_html($paragraph1) . '</i></p>';
            echo '<p>' . esc_html($paragraph2) . '</p>';
        } else {
            echo '<p>' . esc_html(__('These pages are associated with this school.', 'api-schools-manager')) . '</p>';
        }
    }

    private function printPageListItemMarkup(WP_Post $pagePost): void
    {
        printf(
            '<li><a href="%s" title="%s">%s</a></li>',
            esc_url(get_edit_post_link($pagePost->ID)),
            esc_html($pagePost->post_title),
            esc_html($pagePost->post_title)
        );
    }

    private function printPageEditLinksListMarkup(): void
    {
        echo '<ul>';

        foreach ($this->pagePosts as $pagePost) {
            $this->printPageListItemMarkup($pagePost);
        }

        echo '</ul>';
    }

    public function render(): void
    {
        $this->getPages(get_the_ID());
        $this->printDescription();
        $this->printPageEditLinksListMarkup();
    }
}
