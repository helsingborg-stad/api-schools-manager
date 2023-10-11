<?php

namespace SchoolsManager\Entity\API;

use WP_REST_Request;

trait FieldGetCallback
{
    abstract public function getCallback(
        string|array $object,
        string $field_name,
        WP_REST_Request $request
    ): mixed;
}
