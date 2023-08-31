<?php

namespace SchoolsManager\Entity\API;

use WP_Error;
use WP_REST_Request;

trait FieldUpdateCallback
{
    abstract public function updateCallback(
        string|array $object,
        string $field_name,
        WP_REST_Request $request
    ): WP_Error | true;
}
