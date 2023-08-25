<?php

namespace SchoolsManager\MetaBox\School;

use SchoolsManager\Entity\MetaBox;

class Pages extends MetaBox
{
    public function callback(): void
    {
        echo 'Hello!';
    }
}
