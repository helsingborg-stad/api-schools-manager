<?php

namespace SchoolsManager\Tests\API\DefaultValuesSetter;

use Mockery;
use SchoolsManager\API\DefaultValuesSetter;
use WP_Mock\Tools\TestCase;

class SetDefaultValuesTest extends TestCase
{
    /**
     * @testdox Skips if is not a REST request.
     */
    public function testSkipsIfIsNotRestRequest()
    {
        $defaultValuesSetter = $this->getDefaultValueSetter();
        $defaultValuesSetter->shouldReceive('isRestRequest')->andReturn(false);
        $defaultValuesSetter->shouldReceive('getDefaultValue')->times(0);

        $defaultValuesSetter->setDefaultValues('foo', 1, ['name' => 'test']);

        $this->assertConditionsMet();
    }

    /**
     * @testdox Sets the default value for the field.
     * @dataProvider dataProviderTestSetsDefaultValue
     */
    public function testSetsDefaultValue($fieldName)
    {
        $defaultValue        = 'bar';
        $defaultValuesSetter = $this->getDefaultValueSetter();
        $defaultValuesSetter->shouldReceive('isRestRequest')->andReturn(true);
        $defaultValuesSetter->shouldReceive('getDefaultValue')->andReturn($defaultValue);

        $result = $defaultValuesSetter->setDefaultValues('foo', 1, ['name' => $fieldName]);

        $this->assertSame($defaultValue, $result);
    }

    public function dataProviderTestSetsDefaultValue()
    {
        return array(
            array('cta_application_title'),
            array('cta_application_description'),
            array('cta_application_cta_apply_here'),
            array('cta_application_cta_how_to_apply'),
        );
    }

    /**
     * @testdox Sets the current posttype canonical URL as default value for the posttype_canonical_url field.
     */
    public function testSetsPostTypeCanonicalUrl()
    {
        $fieldName           = 'posttype_canonical_url';
        $defaultValue        = 'url';
        $defaultValuesSetter = $this->getDefaultValueSetter();
        $defaultValuesSetter->shouldReceive('isRestRequest')->andReturn(true);
        $defaultValuesSetter->shouldReceive('getCurrentPosttypeCanonicalUrl')->once()->andReturn($defaultValue);

        $result = $defaultValuesSetter->setDefaultValues('foo', 1, ['name' => $fieldName]);

        $this->assertSame($defaultValue, $result);
    }

    private function getDefaultValueSetter()
    {
        return Mockery::mock(DefaultValuesSetter::class)->makePartial()->shouldAllowMockingProtectedMethods();
    }
}
