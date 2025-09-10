<?php

namespace SchoolsManager\API\Fields;

use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(FieldsRegistrar::class)]
class FieldsRegistrarTest extends \PHPUnit\Framework\TestCase
{
    public function testFieldsRegistrarRegistersFields()
    {
        $field = $this->getMockBuilder(\SchoolsManager\Entity\API\FieldInterface::class)->getMock();

        $field->expects($this->once())->method('register');

        $fieldsRegistrar = new FieldsRegistrar([$field]);
        $fieldsRegistrar->registerFields();
    }
}
