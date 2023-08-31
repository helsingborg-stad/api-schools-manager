<?php

namespace SchoolsManager\API\Test;

use SchoolsManager\API\Api;
use SchoolsManager\API\Fields\FieldsRegistrar;

class ApiTest extends \PHPUnit\Framework\TestCase
{
    public function testApiCallsRegisterFieldsOnFieldsRegistrar()
    {
        $fieldsRegistrar = $this->getMockBuilder(FieldsRegistrar::class)
            ->disableOriginalConstructor()
            ->getMock();

        $fieldsRegistrar->expects($this->once())->method('registerFields');
        new Api($fieldsRegistrar);
    }
}
