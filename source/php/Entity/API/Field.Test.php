<?php

namespace SchoolsManager\Entity\API\Test;
namespace SchoolsManager\Entity\API;

use Mockery;
use WP_Mock;

class SUT extends Field
{
}

// phpcs:ignore PSR1.Classes.ClassDeclaration.MultipleClasses
class FieldTest extends \PHPUnit\Framework\TestCase
{
    protected $sut = null;

    public static function setUpBeforeClass(): void
    {
        Mockery::mock('WP_Error');
    }

    public function setUp(): void
    {
        $this->sut = new SUT();
    }

    public function testRegisterReturnsErrorIfNoPropsAreSet()
    {
        $result = $this->sut->register();
        $this->assertInstanceOf('WP_Error', $result);
    }

    public function testRegisterReturnsErrorIfObjectTypeNotSet()
    {
        $this->sut->attribute = 'test';
        $result               = $this->sut->register();

        $this->assertInstanceOf('WP_Error', $result);
    }

    public function testRegisterReturnsErrorIfAttributeNotSet()
    {
        $this->sut->objectType = 'test';
        $result                = $this->sut->register();

        $this->assertInstanceOf('WP_Error', $result);
    }

    public function testRegisterReturnsReturnsErrorIfFieldRegistrationFails()
    {
        $this->sut->objectType = 'test';
        $this->sut->attribute  = 'test';

        WP_Mock::userFunction('register_rest_field')->once()->andThrow('error');
        $result = $this->sut->register();

        $this->assertInstanceOf('WP_Error', $result);
    }

    public function testRegisterReturnsTrueIfPropsAreSet()
    {
        $this->sut->objectType = 'test';
        $this->sut->attribute  = 'test';

        WP_Mock::userFunction('register_rest_field')->once()->withAnyArgs();
        $result = $this->sut->register();

        $this->assertTrue($result);
    }
}
