<?php

namespace SchoolsManager\PostType\School\Test;

class SchoolConfigurationTest extends \PHPUnit\Framework\TestCase
{
    protected static $postTypeArgs = null;

    public static function setUpBeforeClass(): void
    {
        self::$postTypeArgs = \SchoolsManager\PostType\School\SchoolConfiguration::getPostTypeArgs()['args'];
    }

    public function testPostTypeIsDisabledInRest()
    {
        $this->assertTrue(self::$postTypeArgs['show_in_rest']);
    }
}
