<?php

use SchoolsManager\PostType\School\SchoolPost;

class SchoolPostTest extends WP_UnitTestCase {

    public function testGetPagesReturnsPageIds() {
        $schoolPost = new SchoolPost(WP_UnitTestCase::factory()->post->create_and_get(['post_type' => 'school']));
        $pageID = WP_UnitTestCase::factory()->post->create_and_get(['post_type' => 'page'])->ID;
        update_field('parent_school', $schoolPost->ID, $pageID);

        $this->assertContains($pageID, $schoolPost->getPages());
    }
}