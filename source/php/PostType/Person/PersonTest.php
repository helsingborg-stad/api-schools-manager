<?php

use Yoast\PHPUnitPolyfills\TestCases\TestCase;

class PersonTest extends TestCase
{
    private const POST_TYPE = 'person';

    public function testPostTypeExists()
    {
        $this->assertContains(self::POST_TYPE, get_post_types());
    }
}
