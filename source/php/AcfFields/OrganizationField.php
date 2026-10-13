<?php

namespace SchoolsManager\AcfFields;

use WpService\Contracts\AddFilter;
use WpService\Contracts\GetPostMeta;

/**
 * Registers and handles the organization select for school editors.
 */
class OrganizationField
{
    public function __construct(
        private OrganizationChoices $organizationChoices,
        private AddFilter&GetPostMeta $wpService
    ) {
    }

    /** Registers the ACF field callbacks. */
    public function addHooks(): void
    {
        $this->wpService->addFilter('acf/load_field/name=event_organization', [$this, 'loadChoices'], 10, 1);
        $this->wpService->addFilter('acf/update_value/name=event_organization', [$this, 'updateValue'], 10, 3);
    }

    /**
     * Populates the select from the event site.
     *
     * @param array $field ACF field configuration.
     * @return array Updated field configuration.
     */
    public function loadChoices(array $field): array
    {
        $choices          = $this->organizationChoices->getChoices();
        $field['choices'] = $choices ?? [];
        if ($choices === null) {
            $field['disabled']     = 1;
            $field['instructions'] = __(
                'Organizations are temporarily unavailable. Your previous selection will be kept.',
                'api-schools-manager'
            );
        }

        return $field;
    }

    /**
     * Preserves a saved organization when its option list is unavailable.
     *
    * @param mixed $value Submitted organization name.
     * @param int|string $postId ACF post identifier.
     * @param array $field ACF field configuration.
    * @return mixed Organization name to save.
     */
    public function updateValue(mixed $value, int|string $postId, array $field): mixed
    {
        if ($this->organizationChoices->getChoices() === null) {
            return $this->wpService->getPostMeta($postId, $field['name'], true);
        }

        return $value;
    }
}
