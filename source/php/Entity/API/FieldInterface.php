<?php

namespace SchoolsManager\Entity\API;

use WP_Error;

interface FieldInterface
{
    public function register(): bool|WP_Error;
}
