<?php

namespace SchoolsManager\API;

use SchoolsManager\Entity\API\FieldsRegistrarInterface;
use SchoolsManager\Helper\ExitCaller;
use SchoolsManager\Helper\Url;

class Api
{
    private $fieldsRegistrar;

    public function __construct(FieldsRegistrarInterface $fieldsRegistrar)
    {
        $this->fieldsRegistrar = $fieldsRegistrar;
        $this->fieldsRegistrar->registerFields();
    }

    public function addHooks()
    {
        add_action('template_redirect', array($this, 'redirectToApi'));
    }

    /**
     * Force the usage of WordPress api
     * @return void
     */
    public function redirectToApi()
    {
        if (php_sapi_name() === 'cli') {
            return;
        }

        if (is_admin()) {
            return;
        }

        if (!Url::isRest() && Url::isAnyPageButRest()) {
            wp_redirect(rest_url());
            ExitCaller::exit();
        }
    }
}
