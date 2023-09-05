<?php

namespace SchoolsManager\Entity\MetaBox;

use WP_Screen;

abstract class MetaBox
{
    public string $id                     = '';
    public string $title                  = '';
    public string|array|WP_Screen $screen = '';
    public string $context                = MetaBoxContext::NORMAL;
    public string $priority               = MetaBoxPriority::DEFAULT;
    public null|array $callbackArgs       = null;
    protected $callback                   = null;
    private MetaBoxCallbackRendererInterface $callbackRenderer;

    /**
     * Constructor
     */
    public function __construct(MetaBoxCallbackRendererInterface $callbackRenderer)
    {
        $this->callbackRenderer = $callbackRenderer;
        $this->callback         = array( $this, 'callback' );
    }

    public function addHooks(): void
    {
        add_action('add_meta_boxes', array( $this, 'addMetaBox' ));
    }

    public function addMetaBox(): void
    {
        add_meta_box(
            $this->id,
            $this->title,
            $this->callback,
            $this->screen,
            $this->context,
            $this->priority,
            $this->callbackArgs
        );
    }

    /**
     * Render the metabox
     *
     * @return void
     */
    public function callback()
    {
        $this->callbackRenderer->render();
    }
}
