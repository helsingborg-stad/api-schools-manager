<?php

namespace SchoolsManager\PostColumn;

interface PostColumnRendererInterface
{
    public function render(string $column, int $postId): void;
}
