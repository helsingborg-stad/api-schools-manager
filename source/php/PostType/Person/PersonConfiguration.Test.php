<?php

namespace SchoolsManager\PostType\Person\Test;

class PersonConfigurationTest extends \PHPUnit\Framework\TestCase
{
    protected static $postTypeArgs = null;

    public static function setUpBeforeClass(): void
    {
        self::$postTypeArgs = \SchoolsManager\PostType\Person\PersonConfiguration::getPostTypeArgs()['args'];
    }

    public function testPostTypeIsDisabledInRest()
    {
        $this->assertFalse(self::$postTypeArgs['show_in_rest']);
    }
}
