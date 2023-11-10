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
        add_action('enqueue_block_editor_assets', array($this, 'loadScriptInGutenbergEditor'));
        add_action('acf/init', array($this, 'addPluginSettingsPage'));

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
        $allowedBlockNames      = ['core/embed', 'core/image'];
        $allowedBlockCategories = ['text'];
        $allBlocks              = WP_Block_Type_Registry::get_instance()->get_all_registered();

        // Remove all categories but text.
        $allowed = array_filter($allBlocks, fn($block) =>
            in_array($block->name, $allowedBlockNames) ||
            in_array($block->category, $allowedBlockCategories));

        return array_keys($allowed);
    }

    public function loadScriptInGutenbergEditor()
    {
        $fileName = '../../assets/js/unregisterEditorBlocks.js';

        wp_enqueue_script(
            'schools-manager-gutenberg-editor',
            plugin_dir_url(__FILE__) . $fileName,
            array('wp-blocks'),
            filemtime(plugin_dir_path(__FILE__) . $fileName)
        );
    }

    public function addPluginSettingsPage()
    {
        if (function_exists('acf_add_options_page')) {
            acf_add_options_page(array(
                'page_title' => __('Schools Manager Settings', 'schools-manager'),
                'menu_title' => __('Schools Manager Settings', 'schools-manager'),
                'menu_slug'  => 'schools-manager-settings',
                'capability' => 'edit_posts',
                'redirect'   => false
            ));
        }
    }
}
