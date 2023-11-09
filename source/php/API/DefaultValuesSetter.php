<?php

namespace SchoolsManager\API;

class DefaultValuesSetter
{
    public function addHooks()
    {
        add_filter('acf/load_value', array($this, 'setAcfFieldsDefaultValues'), 10, 3);
    }

    public function setAcfFieldsDefaultValues($value, $postId, $field)
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
                $value = $this->setDefaultValue($value, $postId, $field, $defaultFieldNameSuffix);
            }
        }

        return $value;
    }

    private function setDefaultValue($value, $postId, $field, string $defaultFieldNameSuffix)
    {
        $isEmpty = $this->getEmptyCheckByField($field);

        if ($isEmpty($value)) {
            $postType         = get_post_type($postId);
            $defaultFieldName = "default_{$postType}_application_settings_{$defaultFieldNameSuffix}";
            $defaultValue     = get_field($defaultFieldName, 'option');

            if (!$isEmpty($defaultValue)) {
                return $defaultValue;
            }
        }

        return $value;
    }

    private function getEmptyCheckByField(array $field)
    {
        if ($field['type'] === 'link') {
            return fn($value) => empty($value) || (empty($value['url']) && empty($value['title']));
        }

        return fn($value) => empty($value);
    }

    private function isRestRequest(): bool
    {
        return function_exists('did_action') && did_action('rest_api_init');
    }
}
