<?php

namespace SchoolsManager\PostColumn\Columns;

use SchoolsManager\PostColumn\PostColumnSortingInterface;
use WP_Query;

class PageSchoolColumnSorting implements PostColumnSortingInterface
{
    private string $metaKey = 'parent_school';

    public function sort(WP_Query $wpQuery, string $columnId): WP_Query
    {
        if ($wpQuery->get('orderby') === $columnId) {
            $order = $wpQuery->get('order') ?: 'ASC';

            $wpQuery->set('meta_query', [
                'relation' => 'OR',
                [
                    'key'     => $this->metaKey,
                    'compare' => 'EXISTS',
                ],
                [
                    'key'     => $this->metaKey,
                    'compare' => 'NOT EXISTS',
                ],
            ]);

            $wpQuery->set('orderby', [
                'meta_value' => $order,
                'title'      => $order,
            ]);
        }

        return $wpQuery;
    }
}
