<?php

namespace SchoolsManager;

use SchoolsManager\API\Api;
use SchoolsManager\API\Fields\FieldsRegistrar;
use SchoolsManager\API\Fields\SchoolPagesField;
use SchoolsManager\MetaBox\SchoolPagesMetaBox;
use SchoolsManager\PostType\Person\Person;
use SchoolsManager\PostType\Person\PersonConfiguration;
use SchoolsManager\PostType\School\School;
use SchoolsManager\PostType\School\SchoolConfiguration;

class App
{
    public function __construct()
    {
        add_action('plugins_loaded', array( $this, 'init' ));
    }

    public function init()
    {
        $apiFields          = [new SchoolPagesField()];
        $apiFieldsRegistrar = new FieldsRegistrar($apiFields);

        //General
        new Api($apiFieldsRegistrar);
        $admin = new Admin();
        $admin->addHooks();

        //Post types
        $school = new School(...array_values(SchoolConfiguration::getPostTypeArgs()));
        $school->addHooks();

        $person = new Person(...array_values(PersonConfiguration::getPostTypeArgs()));
        $person->addHooks();

        //Meta boxes
        $schoolPagesMetaBox = new SchoolPagesMetaBox();
        $schoolPagesMetaBox->addHooks();
    }
}
