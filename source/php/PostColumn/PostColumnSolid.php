<?php

namespace SchoolsManager\PostColumn;

use WP_Query;

class PostColumnSolid
{
    private string $columnTitle;
    private string $columnId;
    private PostColumnRendererInterface $postColumnRenderer;
    private ?PostColumnSortingInterface $postColumnSorting;

    public function __construct(
        string $columnTitle,
        PostColumnRendererInterface $postColumnRenderer,
        ?PostColumnSortingInterface $postColumnSorting
    ) {
        $this->columnTitle        = $columnTitle;
        $this->columnId           = $this->getColumnId();
        $this->postColumnRenderer = $postColumnRenderer;
        $this->postColumnSorting  = $postColumnSorting;
    }

    public function addHooks(): void
    {
        add_filter('manage_pages_columns', [$this, 'addCustomColumn']);
        add_action('manage_pages_custom_column', [$this, 'populateCustomColumn'], 10, 2);
        add_filter('manage_edit-page_sortable_columns', [$this, 'registerSortableColumn']);
        add_action('pre_get_posts', [$this, 'handleSorting']);
    }

    private function getColumnId(): string
    {
        if (!isset($this->columnId)) {
            $this->columnId = strtolower(str_replace(' ', '_', $this->columnTitle));
        }

        return $this->columnId;
    }

    public function addCustomColumn($columns)
    {
        $column = [$this->columnId => $this->columnTitle];

        // Insert $column before the last element in $columns
        return array_slice($columns, 0, -1, true) + $column + array_slice($columns, -1, 1, true);
    }

    public function populateCustomColumn($column, $postId): void
    {
        if ($column == $this->columnId) {
            $this->postColumnRenderer->render($column, $postId);
        }
    }

    public function registerSortableColumn($columns)
    {
        if ($this->postColumnSorting !== null) {
            $columns[$this->columnId] = $this->columnId;
        }

        return $columns;
    }

    public function handleSorting(WP_Query $query)
    {
        if (!is_admin() || !$query->is_main_query()) {
            return;
        }

        if ($this->postColumnSorting !== null) {
            $query = $this->postColumnSorting->sort($query, $this->columnId);
        }
    }
}
