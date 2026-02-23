<?php

namespace SchoolsManager\API;

/**
 * Sets default values for ACF fields.
 */
class DefaultValuesSetter
{
    /**
     * Sets default values for ACF fields.
     *
     * @return void
     */
    public function addHooks()
    {
        add_filter('acf/load_value/name=cta_application', function ($value, $postId, $field) {
            if (!$this->isRestRequest()) {
                return $value;
            }

            return $this->handleCtaFields($value, $postId, $field);
        }, 10, 3);

        add_filter('acf/prepare_field/name=posttype_canonical_url', [$this, 'hidePosttypeCanonicalUrlField'], 10, 1);
    }

    /**
     * Handles the logic for setting default values for CTA fields based on their subfields' values and dependencies.
     * 
     * @param mixed $value The current value of the CTA field.
     * @param int $postId The ID of the post being edited.
     * @param array $field The field configuration array for the CTA field.
     * @return mixed The modified value for the CTA field with default values applied to subfields
     */
    private function handleCtaFields($value, $postId, $field): array
    {
        if (empty($field['sub_fields']) || !is_array($field['sub_fields'])) {
            return $value;
        }

        $subFields = $field['sub_fields'];

        $shouldGetDefaultValue = $this->getSubfieldsEmptyStatus($value, $postId, $subFields);

        $shouldGetDefaultValue = $this->applyCtaDependencies($shouldGetDefaultValue);

        $value = $this->fillDefaultValues($value, $postId, $subFields, $shouldGetDefaultValue);

        return $value;
    }

    /**
     * Checks if the subfields of the CTA field are empty and returns an array indicating which subfields should get default values.
     * 
     * @param array $value The current value of the CTA field.
     * @param int $postId The ID of the post being edited.
     * @param array $subFields The configuration array for the subfields of the CTA field.
     * @return array An associative array where the keys are the subfield names and the values
     */
    private function getSubfieldsEmptyStatus(array $value, int $postId, array $subFields): array
    {
        $status = [
            'title' => true,
            'description' => true,
            'cta_apply_here' => true,
            'cta_how_to_apply' => true,
        ];

        foreach ($subFields as $subField) {
            if (!array_key_exists($subField['name'], $status)) {
                continue;
            }

            $subFieldValue = $value[$subField['key']] ?? null;
            $status[$subField['name']] = $this->getEmptyCheckByField($subFieldValue, $subField['type']);
        }

        return $status;
    }

    /**
     * Applies dependencies between CTA subfields. If one of the CTA links is filled, both should be treated as filled to avoid inconsistent states.
     * 
     * @param array $status An associative array indicating which CTA subfields are empty.
     * @return array The modified status array with dependencies applied.
     */
    private function applyCtaDependencies(array $status): array
    {
        // Both CTA links must be treated together
        $both = min(
            (int) $status['cta_apply_here'],
            (int) $status['cta_how_to_apply']
        );

        $status['cta_apply_here'] = (bool) $both;
        $status['cta_how_to_apply'] = (bool) $both;

        return $status;
    }

    /**
     * Fills the CTA subfields with default values if they are empty and should get default values.
     * 
     * @param array $value The current value of the CTA field.
     * @param int $postId The ID of the post being edited.
     * @param array $subFields The configuration array for the subfields of the CTA field.
     * @param array $shouldGetDefaultValue An associative array indicating which subfields should get default values.
     * @return array The modified value for the CTA field with default values applied to
     */
    private function fillDefaultValues(array $value, int $postId, array $subFields, array $shouldGetDefaultValue): array
    {
        foreach ($subFields as $subField) {
            if (!array_key_exists($subField['name'], $shouldGetDefaultValue) || !$shouldGetDefaultValue[$subField['name']]) {
                continue;
            }

            $value[$subField['key']] = $this->getDefaultValue($postId, $subField['name']);
        }

        return $value;
    }

    /**
     * Returns the default value for a given field.
     *
     * @param int $postId The ID of the post.
     * @param string $defaultFieldNameSuffix The suffix of the default field name.
     * @return mixed The default value.
     */
    protected function getDefaultValue($postId, string $defaultFieldNameSuffix): mixed
    {
        $defaultFieldName = $this->getDefaultFieldName($postId, $defaultFieldNameSuffix);
        $defaultValue     = \get_field($defaultFieldName, 'option');

        return $defaultValue ?? null;
    }


    /**
     * Sets the field as readonly and applies a value. Sets the field wrapper as hidden.
     *
     * @param array $field The field to be modified.
     * @return array The modified field with default values applied.
     */
    public function hidePosttypeCanonicalUrlField($field)
    {
        $field['wrapper']['class'] = 'hidden';

        $field['readonly']     = true;
        $field['instructions'] = __('This is set under School Manager Settings (per post type).', 'schools-manager');
        $field['value']        = $this->getCurrentPosttypeCanonicalUrl();

        return $field;
    }

    /**
     * Retrieves the current post type's canonical URL.
     *
     * @return string The canonical URL of the current post type, or an empty string if not found or invalid.
     */
    protected function getCurrentPosttypeCanonicalUrl(): string
    {
        $postType = get_post_type();
        $url      = \get_field("{$postType}_canonical_url", 'options');
        if (filter_var($url, FILTER_VALIDATE_URL)) {
            return $url;
        }
        return '';
    }

    /**
     * Returns the name of the default field for a given post type and suffix.
     *
     * @param int $postId The ID of the post.
     * @param string $suffix The suffix of the default field name.
     * @return string The name of the default field.
     */
    private function getDefaultFieldName($postId, string $suffix): string
    {
        $postType = get_post_type($postId);
        return "default_{$postType}_application_settings_{$suffix}";
    }

    /**
     * Returns a callable function that checks if a given field is empty.
     *
     * @param array $field The field to check.
     * @return callable The function that checks if the field is empty.
     */
    private function getEmptyCheckByField(mixed $value, string $fieldType): bool
    {
        if ($fieldType === 'link') {
            return empty($value) || (empty($value['url']) && empty($value['title']));
        }

        return empty($value);
    }

    /**
     * Check if the current request is a REST request.
     *
     * @return bool Returns true if the request is a REST request, false otherwise.
     */
    protected function isRestRequest(): bool
    {
        return function_exists('did_action') && did_action('rest_api_init');
    }
}
