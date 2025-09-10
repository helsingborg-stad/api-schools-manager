<?php

namespace SchoolsManager\PostType\Person;

use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(PersonConfiguration::class)]
class PersonConfigurationTest extends \PHPUnit\Framework\TestCase
{
    protected static $postTypeArgs = null;

    public static function setUpBeforeClass(): void
    {
        define('SCHOOLS_MANAGER_PATH', '');
        self::$postTypeArgs = \SchoolsManager\PostType\Person\PersonConfiguration::getPostTypeArgs()['args'];
    }

    public function testPostTypeIsEnabledInRest()
    {
        $this->assertTrue(self::$postTypeArgs['show_in_rest']);
    }
}
