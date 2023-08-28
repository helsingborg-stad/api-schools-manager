<?php

namespace SchoolsManager\MetaBox\Test;

use SchoolsManager\MetaBox\SchoolPagesMetaBox;
use WP_UnitTestCase;

class SchoolPagesMetaBoxTest extends WP_UnitTestCase
{
    public function testRegistersMetabox()
    {
        $sut = new SchoolPagesMetaBox();
        $sut->addHooks();

        do_action('add_meta_boxes');

        $this->assertNotEmpty($GLOBALS['wp_meta_boxes'][$sut->screen][$sut->context][$sut->priority][$sut->id]);
    }
}
