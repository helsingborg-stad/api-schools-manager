<?php

namespace SchoolsManager;

class Admin
{
    public function addHooks()
    {
        add_action('acf/init', array($this, 'addOptionsPage'));
        add_action('after_setup_theme', array($this, 'themeSupport'));
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
}
