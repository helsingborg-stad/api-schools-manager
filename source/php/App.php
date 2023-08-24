<?php

namespace SchoolsManager;

use SchoolsManager\API\Api;
use SchoolsManager\API\Auth\JWTAuthentication;
use SchoolsManager\PostType\Person\Person;
use SchoolsManager\PostType\Person\PersonConfiguration;
use SchoolsManager\PostType\School\School as School;
use SchoolsManager\PostType\School\SchoolConfiguration;

class App
{
    public function __construct()
    {
        add_action('plugins_loaded', array($this, 'init'));
    }

    public function init()
    {
        //General
        new Api();
        $admin = new Admin();
        $admin->addHooks();

        $JWTAuthentication = new JWTAuthentication(defined('SCHOOLS_MANAGER_JWT_SECRET_KEY') ? constant('SCHOOLS_MANAGER_JWT_SECRET_KEY') : '');

        //Post types
        $school = new School(...array_values(SchoolConfiguration::getPostTypeArgs()));
        $school->addHooks();
        
        $person = new Person(...array_values(PersonConfiguration::getPostTypeArgs()));
        $person->addHooks();
    }
}
