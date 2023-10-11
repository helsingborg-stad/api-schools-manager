<?php

namespace SchoolsManager\API\Fields;

use SchoolsManager\Entity\API\FieldInterface;
use SchoolsManager\Entity\API\FieldsRegistrarInterface;

class FieldsRegistrar implements FieldsRegistrarInterface
{
    /**
     * @var FieldInterface[]
     */
    private $fields = [];

    /**
     * FieldsRegistrar constructor.
     *
     * @param FieldInterface[] $fields
     */
    public function __construct($fields)
    {
        $this->fields = $fields;
    }

    public function registerFields(): void
    {
        foreach ($this->fields as $field) {
            $field->register();
        }
    }
}
