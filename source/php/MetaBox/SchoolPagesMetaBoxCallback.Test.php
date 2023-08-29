<?php

namespace SchoolsManager\MetaBox\Test;

use WP_UnitTestCase;

class SchoolPagesMetaBoxCallbackTest extends WP_UnitTestCase
{
    public function testRenderOutputsMarkup()
    {
        $this->expectOutputRegex('/<p>.*<\/p>/');
        $this->expectOutputRegex('/<ul>.*<\/ul>/');

        $schoolPagesMetaBoxCallback = new \SchoolsManager\MetaBox\SchoolPagesMetaBoxCallback();
        $schoolPagesMetaBoxCallback->render();
    }
}
