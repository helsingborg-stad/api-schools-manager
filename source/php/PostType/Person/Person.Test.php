<?php

namespace SchoolsManager\PostType\Person;

use WP_UnitTestCase;

class PersonTest extends WP_UnitTestCase
{
    private const POST_TYPE = 'person';

    public function testPostTypeExists()
    {
        $this->assertContains(self::POST_TYPE, get_post_types());
    }

    public function testRestApiDisabledOnPostType()
    {
        $this->assertFalse(get_post_type_object(self::POST_TYPE)->show_in_rest);
    }
}
