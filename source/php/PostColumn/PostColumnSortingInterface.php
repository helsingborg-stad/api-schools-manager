<?php

namespace SchoolsManager\PostColumn;

use WP_Query;

interface PostColumnSortingInterface
{
    public function sort(WP_Query $wpQuery, string $columnId): WP_Query;
}
