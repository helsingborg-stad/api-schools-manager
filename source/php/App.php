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

use SchoolsManager\Taxonomy\GeographicArea\GeographicArea as GeographicArea;
use SchoolsManager\Taxonomy\Grade\Grade as Grade;
use SchoolsManager\Taxonomy\SchoolType\SchoolType as SchoolType;
use SchoolsManager\Taxonomy\Profile\Profile as Profile;
use SchoolsManager\Taxonomy\Specialization\Specialization as Specialization;
use SchoolsManager\Taxonomy\SchoolType\SchoolType as ProfessionalTitle;

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

        // Taxonomies
        // TODO Ensure native term meta boxes are hidden in Gutenberg to
        // see https://github.com/WordPress/gutenberg/issues/13816#issuecomment-470137667
        $taxonomies = [];
        $sharedArguments = [
            'meta_box_cb' => false
        ];
        $taxonomies[] = 
            new SchoolType(
                __('School types', ASM_TEXT_DOMAIN),
                __('School type', ASM_TEXT_DOMAIN), 
                'school_type', 
                ['school'], 
                array_merge($sharedArguments, [])
            );
        $taxonomies[] = 
            new GeographicArea(
                __('Areas', ASM_TEXT_DOMAIN),
                __('Area', ASM_TEXT_DOMAIN), 
                'area', 
                ['school'], 
                array_merge($sharedArguments, [])
            );
        $taxonomies[] = 
            new Grade(
                __('Grades', ASM_TEXT_DOMAIN),
                __('Grade', ASM_TEXT_DOMAIN), 
                'grade', 
                ['school'], 
                array_merge($sharedArguments, [])
            );
        $taxonomies[] = 
            new Profile(
                __('Profiles', ASM_TEXT_DOMAIN),
                __('Profile', ASM_TEXT_DOMAIN), 
                'profile', 
                ['school'], 
                array_merge($sharedArguments, [])
            );

        $taxonomies[] = 
            new ProfessionalTitle(
                __('Professional titles', ASM_TEXT_DOMAIN),
                __('Professional title', ASM_TEXT_DOMAIN), 
                'professional_title', 
                ['person'], 
                array_merge($sharedArguments, [])
            );
        foreach ($taxonomies as $taxonomy) {
            $taxonomy->registerTaxonomy();
        }
        
    }
}
