<?php

namespace SchoolsManager\API;

use SchoolsManager\Entity\API\FieldsRegistrarInterface;
use SchoolsManager\Helper\Url;

class Api
{
    private $fieldsRegistrar;

    public function __construct(FieldsRegistrarInterface $fieldsRegistrar)
    {
        add_action('template_redirect', array($this, 'redirectToApi'));

        $this->fieldsRegistrar = $fieldsRegistrar;
        $this->fieldsRegistrar->registerFields();
    }

    /**
     * Force the usage of WordPress api
     * @return void
     */
    public static function redirectToApi()
    {
        if (php_sapi_name() === 'cli') {
            return;
        }

        if (is_admin()) {
            return;
        }

        if (strpos(Url::current(), rtrim(rest_url(), "/")) === false && Url::current() == rtrim(home_url(), "/")) {
            wp_redirect(rest_url());
            exit;
        }
    }
}
