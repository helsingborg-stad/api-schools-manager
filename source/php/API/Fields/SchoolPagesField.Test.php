<?php

namespace SchoolsManager\Entity\API\Fields\Test;

use Mockery;
use SchoolsManager\API\Fields\SchoolPagesField;
use SchoolsManager\PostType\School\SchoolConfiguration;
use WP_Mock;

class SchoolPagesFieldTest extends \PHPUnit\Framework\TestCase
{
    public function testSchoolPagesQueriesPagesBySchoolId()
    {
        $schoolID         = 123;
        $schoolObject     = ['id' => $schoolID];
        $schoolPagesField = new SchoolPagesField();
        $wpRestRequest    = Mockery::mock('WP_REST_Request');
        $getPostsArgs     = [
            'post_type'      => 'page',
            'fields'         => 'ids',
            'posts_per_page' => -1,
            'meta_key'       => 'parent_school',
            'meta_value'     => $schoolID,
            'post_type__in'  => array('page')
        ];

        WP_Mock::userFunction('get_posts', [
            'times'  => 1,
            'args'   => [$getPostsArgs],
            'return' => []
        ]);

        $this->assertSame([], $schoolPagesField->getCallback($schoolObject, 'pages', $wpRestRequest));
    }
}
