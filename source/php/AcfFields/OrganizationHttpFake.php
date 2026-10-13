<?php

namespace SchoolsManager\AcfFields;

use WpService\Contracts\GetTransient;
use WpService\Contracts\IsWpError;
use WpService\Contracts\SetTransient;
use WpService\Contracts\WpRemoteGet;
use WpService\Contracts\WpRemoteRetrieveBody;
use WpService\Contracts\WpRemoteRetrieveHeader;
use WpService\Contracts\WpRemoteRetrieveResponseCode;

/** In-memory WordPress HTTP and transient boundary for organization tests. */
class OrganizationHttpFake implements
    GetTransient,
    SetTransient,
    WpRemoteGet,
    IsWpError,
    WpRemoteRetrieveBody,
    WpRemoteRetrieveHeader,
    WpRemoteRetrieveResponseCode
{
    public array $responses  = [];
    public array $transients = [];
    public array $requests   = [];

    public function getTransient(string $transient): mixed
    {
        return $this->transients[$transient] ?? false;
    }

    public function setTransient(string $transient, mixed $value, int $expiration = 0): bool
    {
        $this->transients[$transient] = $value;
        return true;
    }

    public function wpRemoteGet(string $url, array $args = []): array|\WP_Error
    {
        $this->requests[] = $url;
        parse_str((string) parse_url($url, PHP_URL_QUERY), $query);
        return $this->responses[(int) $query['page']] ?? ['code' => 404, 'body' => '', 'pages' => ''];
    }

    public function isWpError(mixed $thing): bool
    {
        return $thing instanceof \WP_Error;
    }

    public function wpRemoteRetrieveBody(array|\WP_Error $response): string
    {
        return $response['body'];
    }

    public function wpRemoteRetrieveHeader(array|\WP_Error $response, string $header): array|string
    {
        return $response['pages'];
    }

    public function wpRemoteRetrieveResponseCode(array|\WP_Error $response): int|string
    {
        return $response['code'];
    }
}
