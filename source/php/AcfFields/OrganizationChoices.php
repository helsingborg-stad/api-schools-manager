<?php

namespace SchoolsManager\AcfFields;

use WpService\Contracts\GetTransient;
use WpService\Contracts\IsWpError;
use WpService\Contracts\SetTransient;
use WpService\Contracts\WpRemoteGet;
use WpService\Contracts\WpRemoteRetrieveBody;
use WpService\Contracts\WpRemoteRetrieveHeader;
use WpService\Contracts\WpRemoteRetrieveResponseCode;

/**
 * Loads event organization terms for the school editor.
 */
class OrganizationChoices
{
    private const ENDPOINT       = 'https://event.helsingborg.io/wp-json/wp/v2/organization/';
    private const FRESH_CACHE    = 'schools_manager_event_organizations';
    private const FALLBACK_CACHE = 'schools_manager_event_organizations_fallback';

    private bool $resolved          = false;
    private ?array $resolvedChoices = null;

    public function __construct(
        private GetTransient&SetTransient&WpRemoteGet&IsWpError&WpRemoteRetrieveBody&
        WpRemoteRetrieveHeader&WpRemoteRetrieveResponseCode $wpService
    ) {
    }

    /**
     * Returns ID-to-name choices, or null if neither the API nor a cache is available.
     *
     * @return array<int, string>|null
     */
    public function getChoices(): ?array
    {
        if ($this->resolved) {
            return $this->resolvedChoices;
        }

        $this->resolved = true;
        $fresh          = $this->wpService->getTransient(self::FRESH_CACHE);
        if (is_array($fresh)) {
            return $this->resolvedChoices = $fresh;
        }

        $choices = $this->fetchChoices();
        if ($choices !== null) {
            $this->wpService->setTransient(self::FRESH_CACHE, $choices, 3600);
            $this->wpService->setTransient(self::FALLBACK_CACHE, $choices, 604800);
            return $this->resolvedChoices = $choices;
        }

        $fallback                     = $this->wpService->getTransient(self::FALLBACK_CACHE);
        return $this->resolvedChoices = is_array($fallback) ? $fallback : null;
    }

    /**
     * Fetches every page before making the choices available to callers.
     *
     * @return array<int, string>|null
     */
    private function fetchChoices(): ?array
    {
        $choices = [];
        for ($page = 1; $page <= 100; $page++) {
            $url      = self::ENDPOINT . '?per_page=100&hide_empty=false&_fields=id,name&page=' . $page;
            $response = $this->wpService->wpRemoteGet($url, ['timeout' => 10]);
            if (
                $this->wpService->isWpError($response) ||
                $this->wpService->wpRemoteRetrieveResponseCode($response) !== 200
            ) {
                return null;
            }

            $terms = json_decode($this->wpService->wpRemoteRetrieveBody($response), true);
            if (!is_array($terms) || !array_is_list($terms)) {
                return null;
            }

            foreach ($terms as $term) {
                if (
                    !is_array($term) || !isset($term['id'], $term['name']) ||
                    !is_int($term['id']) || $term['id'] <= 0 || !is_string($term['name']) || $term['name'] === ''
                ) {
                    return null;
                }
                $choices[$term['id']] = $term['name'];
            }

            $totalPages = $this->wpService->wpRemoteRetrieveHeader($response, 'x-wp-totalpages');
            if (
                is_array($totalPages) || ($totalPages !== '' &&
                (!ctype_digit($totalPages) || (int) $totalPages < $page || (int) $totalPages > 100))
            ) {
                return null;
            }
            if ($totalPages !== '' ? $page >= (int) $totalPages : count($terms) < 100) {
                asort($choices, SORT_NATURAL | SORT_FLAG_CASE);
                return $choices;
            }
        }

        return null;
    }
}
