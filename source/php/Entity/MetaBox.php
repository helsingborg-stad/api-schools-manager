<?php

namespace SchoolsManager\Entity;

use WP_Screen;

final class MetaBoxContext
{
    static const NORMAL = 'normal';
    static const SIDE = 'side';
    static public const ADVANCED = 'advanced';
}

final class MetaBoxPriority
{
    static const HIGH = 'high';
    static const CORE = 'core';
    static const DEFAULT = 'default';
    static const LOW = 'low';
}

abstract class MetaBox
{

    /**
     * Meta box constructor.
     * 
     * @param string $id
     * @param string $title
     * @param string|array|WP_Screen $screen
     * @param string $context
     * @param string $priority
     */
    public function __construct(
        string $id,
        string $title,
        string|array|WP_Screen $screen,
        MetaBoxContext $context = MetaBoxContext::NORMAL,
        MetaBoxPriority $priority = MetaBoxPriority::DEFAULT
    ) {
        $callback = array($this, 'callback');
        $callbackArgs = $this->getCallbackArgs();

        add_meta_box($id, $title, $callback, $screen, $context, $priority, $callbackArgs);
    }

    /**
     * Get callback arguments.
     * 
     * @return array|null
     */
    private function getCallbackArgs(): array|null
    {
        return null;
    }

    /**
     * Render meta box contents.
     * 
     * @return void
     */
    abstract function callback(): void;
}
