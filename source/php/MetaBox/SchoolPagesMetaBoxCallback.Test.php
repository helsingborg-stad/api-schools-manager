<?php

namespace SchoolsManager\MetaBox\Test;

use Mockery;
use SchoolsManager\MetaBox\SchoolPagesMetaBoxCallback;
use WP_Mock;

class SchoolPagesMetaBoxCallbackTest extends \PHPUnit\Framework\TestCase
{
    public function testRenderShouldInformThatNoPagesAreAssociated()
    {
        WP_Mock::userFunction('get_posts')->once()->andReturn([]);

        $this->expectOutputRegex('/No pages are associated with this school yet/');

        $sut = new SchoolPagesMetaBoxCallback();
        $sut->render();
    }

    public function testRenderListsPagesIfPagesAreAssociated()
    {
        $page             = Mockery::mock('WP_Post');
        $page->ID         = 1;
        $page->post_title = 'Foo';

        WP_Mock::userFunction('get_posts')->once()->andReturn([$page]);
        WP_Mock::userFunction('get_edit_post_link')->once()->andReturn('');

        $this->expectOutputRegex('/\<a href="" title="Foo"\>Foo\<\/a\>/');

        $sut = new SchoolPagesMetaBoxCallback();
        $sut->render();
    }
}
