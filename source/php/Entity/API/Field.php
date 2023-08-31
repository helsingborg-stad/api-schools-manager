<?php

namespace SchoolsManager\Entity\API;

use WP_Error;
use WP_REST_Request;
use WP_REST_Response;

abstract class Field implements FieldInterface
{
    public string|array $objectType;
    public string $attribute;
    public ?array $schema = null;
    private array $args   = array();

    public function register(): bool|WP_Error
    {
        $validationResult = $this->validatePropsBeforeRegister();

        if (is_wp_error($validationResult)) {
            return $validationResult;
        }

        $this->args = array(
            'get_callback'    => array($this, 'getCallback'),
            'update_callback' => array($this, 'updateCallback'),
            'schema'          => $this->schema
        );

        try {
            register_rest_field($this->objectType, $this->attribute, $this->args);
        } catch (\Throwable $th) {
            return new WP_Error(
                'field_registration_failed',
                'The field registration failed.'
            );
        }

        return true;
    }

    private function validatePropsBeforeRegister(): bool|WP_Error
    {
        if (!isset($this->objectType) || empty($this->objectType)) {
            return new WP_Error(
                'object_type_not_set',
                'The object type is not set.'
            );
        }

        if (!isset($this->attribute) || empty($this->attribute)) {
            return new WP_Error(
                'attribute_not_set',
                'The attribute is not set.'
            );
        }

        return true;
    }
}
