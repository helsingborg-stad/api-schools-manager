<?php

use Yoast\PHPUnitPolyfills\TestCases\TestCase;

const POST_TYPE = 'school';

class SchoolTest extends TestCase
{
    public function testPostTypeExists()
    {
        $this->assertContains(POST_TYPE, get_post_types());
    }

    public function testPostTypeShowsInRest()
    {
        $this->assertTrue(get_post_type_object(POST_TYPE)->show_in_rest);
    }
}
