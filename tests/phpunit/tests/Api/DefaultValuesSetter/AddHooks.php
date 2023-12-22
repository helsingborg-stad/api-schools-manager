<?php

namespace SchoolsManager\Tests\API\DefaultValuesSetter;

use Mockery;
use SchoolsManager\API\DefaultValuesSetter;
use WP_Mock;
use WP_Mock\Tools\TestCase;

class AddHooksTest extends TestCase
{
    /**
     * @testdox Applies filter to ACF field by name.
     */
    public function testAppliesFilterToAcfFieldByName()
    {
        $defaultValuesSetter = new DefaultValuesSetter();
        $fieldName           = 'posttype_canonical_url';
        $filter              = 'acf/prepare_field/name=' . $fieldName;

        WP_Mock::expectFilterAdded($filter, [$defaultValuesSetter, 'hidePosttypeCanonicalUrlField'], 10, 1);
        $defaultValuesSetter->addHooks();

        $this->assertConditionsMet();
    }
}
