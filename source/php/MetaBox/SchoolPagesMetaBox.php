<?php

namespace SchoolsManager\MetaBox;

use SchoolsManager\Entity\MetaBox\MetaBox;
use SchoolsManager\Entity\MetaBox\MetaBoxContext;
use SchoolsManager\Entity\MetaBox\MetaBoxPriority;
use SchoolsManager\PostType\ElementarySchool\ElementarySchoolConfiguration;
use SchoolsManager\PostType\PreSchool\PreSchoolConfiguration;

class SchoolPagesMetaBox extends MetaBox
{
    public function __construct(SchoolPagesMetaBoxCallback $callbackRenderer)
    {
        $this->id           = 'school_pages';
        $this->title        = 'Pages';
        $this->screen       = [ElementarySchoolConfiguration::POST_TYPE_SLUG, PreSchoolConfiguration::POST_TYPE_SLUG];
        $this->context      = MetaBoxContext::SIDE;
        $this->priority     = MetaBoxPriority::DEFAULT;
        $this->callbackArgs = null;

        parent::__construct($callbackRenderer);
    }
}
