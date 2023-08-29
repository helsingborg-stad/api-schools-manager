<?php

namespace SchoolsManager\MetaBox;

use WP_Post;

class SchoolPagesMetaBoxCallback
{
    private array $pagePosts = array();

    public function __construct()
    {
        $this->getPages();
    }

    private function getPages()
    {
        $this->pagePosts = get_posts(
            array(
                'post_type' => 'page',
                'meta_key'  => 'parent_school',
            )
        );
    }

    private function printDescription(): void
    {
        if (empty($this->pagePosts)) {
            $paragraph1 = __(<<<'EOD'
            No pages are associated with this school yet.
            EOD, ASM_TEXT_DOMAIN);

            $paragraph2 = __(<<<'EOD'
            To associate a page with this school, edit the page and select
            this school from the "Parent School" dropdown.
            EOD, ASM_TEXT_DOMAIN);

            echo '<p><i>' . esc_html($paragraph1) . '</i></p>';
            echo '<p>' . esc_html($paragraph2) . '</p>';
        } else {
            echo '<p>' . esc_html(__('These pages are associated with this school.', ASM_TEXT_DOMAIN)) . '</p>';
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
        $this->printDescription();
        $this->printPageEditLinksListMarkup();
    }
}
