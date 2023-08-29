<?php

namespace SchoolsManager;

use WP_Block_Editor_Context;
use WP_Block_Type_Registry;

class Admin
{
    public function addHooks()
    {
        add_action('init', array($this, 'addOptionsPage'));
        add_action('after_setup_theme', array($this, 'themeSupport'));

        // Allow only specific block categories.
        add_filter('allowed_block_types_all', array($this, 'filterAllowedBlockTypes'), 100, 2);
    }

    /**
     * Registers option page
     * @return void
     */
    public function addOptionsPage(): void
    {
    }

    /**
     * Add theme support
     */
    public function themeSupport()
    {
        add_theme_support('post-thumbnails');
    }

    public function filterAllowedBlockTypes($allowedBlocks, $blockEditorContext): array
    {
        $allBlocks = WP_Block_Type_Registry::get_instance()->get_all_registered();

        // Remove all categories but text.
        $allowed = array_filter($allBlocks, function ($block) {
            return $block->category === 'text';
        });

        return array_keys($allowed);
    }
}
