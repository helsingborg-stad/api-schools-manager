<?php

namespace SchoolsManager\MetaBox\Test;

use Mockery;
use SchoolsManager\MetaBox\SchoolPagesMetaBox;
use SchoolsManager\MetaBox\SchoolPagesMetaBoxCallback;

class SchoolPagesMetaBoxTest extends \PHPUnit\Framework\TestCase
{
    use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

    public function testCallsRenderOnSchoolPagesMetaBoxCallback()
    {
        $metaBoxCallbackRender = Mockery::spy(SchoolPagesMetaBoxCallback::class);
        $sut                   = new SchoolPagesMetaBox($metaBoxCallbackRender);

        $sut->callback();

        $metaBoxCallbackRender->shouldHaveReceived('render')->times(1);
    }
}
