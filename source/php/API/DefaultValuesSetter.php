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
        add_filter('acf/load_value', array($this, 'setDefaultValues'), 10, 3);
    }

    /**
     * Sets default values for ACF fields.
     *
     * @param mixed $value The value of the field.
     * @param int $postId The ID of the post.
     * @param array $field The field.
     * @return mixed The default value.
     */
    public function setDefaultValues(mixed $value, $postId, array $field): mixed
    {
        if (!$this->isRestRequest()) {
            return $value;
        }

        $defaultFieldsMap = [
            'cta_application_description'      => 'description',
            'cta_application_cta_apply_here'   => 'cta_apply_here',
            'cta_application_cta_how_to_apply' => 'cta_how_to_apply',
        ];

        foreach ($defaultFieldsMap as $fieldName => $defaultFieldNameSuffix) {
            if ($field['name'] === $fieldName) {
                $value = $this->getDefaultValue($value, $postId, $field, $defaultFieldNameSuffix);
            }
        }

        return $value;
    }

    /**
     * Returns the default value for a given field.
     *
     * @param mixed $value The value of the field.
     * @param int $postId The ID of the post.
     * @param array $field The field.
     * @param string $defaultFieldNameSuffix The suffix of the default field name.
     * @return mixed The default value.
     */
    private function getDefaultValue(mixed $value, $postId, array $field, string $defaultFieldNameSuffix): mixed
    {
        $isEmpty = $this->getEmptyCheckByField($field);

        if ($isEmpty($value)) {
            $defaultFieldName = $this->getDefaultFieldName($postId, $defaultFieldNameSuffix);
            $defaultValue     = \get_field($defaultFieldName, 'option');

            if (!$isEmpty($defaultValue)) {
                return $defaultValue;
            }
        }

        return $value;
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
    private function getEmptyCheckByField(array $field): callable
    {
        if ($field['type'] === 'link') {
            return fn($value) => empty($value) || (empty($value['url']) && empty($value['title']));
        }

        return fn($value) => empty($value);
    }

    /**
     * Check if the current request is a REST request.
     *
     * @return bool Returns true if the request is a REST request, false otherwise.
     */
    private function isRestRequest(): bool
    {
        return function_exists('did_action') && did_action('rest_api_init');
    }
}
