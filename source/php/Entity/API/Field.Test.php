<?php

namespace SchoolsManager\Entity\API\Test;
namespace SchoolsManager\Entity\API;

class SUT extends Field
{
    public function getCallback(
        string | array $object,
        string $field_name,
        \WP_REST_Request $request
    ): ?\WP_REST_Response {
        return null;
    }

    public function updateCallback(
        string | array $object,
        string $field_name,
        \WP_REST_Request $request
    ): ?\WP_REST_Response {
        return null;
    }
}

// phpcs:ignore PSR1.Classes.ClassDeclaration.MultipleClasses
class FieldTest extends \WP_UnitTestCase
{
    protected $sut = null;

    // phpcs:ignore PSR1.Methods.CamelCapsMethodName.NotCamelCaps
    public function set_up(): void
    {
        $this->sut = new SUT();
        parent::set_up();
    }

    public function testRegisterReturnsErrorIfNoPropsAreSet()
    {
        $result = $this->sut->register();

        $this->assertWPError($result);
    }

    public function testRegisterReturnsErrorIfObjectTypeNotSet()
    {
        $this->sut->attribute = 'test';
        $result               = $this->sut->register();

        $this->assertWPError($result);
    }

    public function testRegisterReturnsErrorIfAttributeNotSet()
    {
        $this->sut->objectType = 'test';
        $result                = $this->sut->register();

        $this->assertWPError($result);
    }

    public function testRegisterReturnsTrueIfPropsAreSet()
    {
        $this->sut->objectType = 'test';
        $this->sut->attribute  = 'test';
        $result                = $this->sut->register();

        $this->assertTrue($result);
    }
}
