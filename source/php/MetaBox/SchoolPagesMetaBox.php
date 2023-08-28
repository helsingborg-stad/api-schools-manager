<?php

namespace SchoolsManager\MetaBox;

use SchoolsManager\Entity\MetaBox\MetaBox;
use SchoolsManager\Entity\MetaBox\MetaBoxContext;
use SchoolsManager\Entity\MetaBox\MetaBoxPriority;

class SchoolPagesMetaBox extends MetaBox
{
    public function __construct()
    {
        $this->id           = 'school_pages';
        $this->title        = 'Pages';
        $this->screen       = 'school';
        $this->context      = MetaBoxContext::SIDE;
        $this->priority     = MetaBoxPriority::DEFAULT;
        $this->callbackArgs = null;

        parent::__construct();
    }

    public function callback(): void
    {
        $callback = new SchoolPagesMetaBoxCallback();
        $callback->render();
    }
}
