<?php

namespace SchoolsManager;

use SchoolsManager\API\Api;
use SchoolsManager\API\Fields\FieldsRegistrar;
use SchoolsManager\API\Fields\SchoolPagesField;
use SchoolsManager\MetaBox\SchoolPagesMetaBox;
use SchoolsManager\MetaBox\SchoolPagesMetaBoxCallback;
use SchoolsManager\PostType\Person\Person;
use SchoolsManager\PostType\Person\PersonConfiguration;
use SchoolsManager\PostType\School\School;
use SchoolsManager\PostType\School\SchoolConfiguration;
use SchoolsManager\Taxonomy\GeographicArea\GeographicArea as GeographicArea;
use SchoolsManager\Taxonomy\Grade\Grade as Grade;
use SchoolsManager\Taxonomy\SchoolType\SchoolType as SchoolType;
use SchoolsManager\Taxonomy\Profile\Profile as Profile;
use SchoolsManager\Taxonomy\SchoolType\SchoolType as ProfessionalTitle;

class App
{
    public function __construct()
    {
        add_action('plugins_loaded', array( $this, 'init' ));
        add_filter('rest_prepare_taxonomy', array($this, 'respectMetaBoxCbInGutenberg' ), 10, 3);

        add_action('plugins_loaded', array( $this, 'useGoogleApiKeyIfDefined' ));
    }


    public function init()
    {
        $apiFields          = [new SchoolPagesField()];
        $apiFieldsRegistrar = new FieldsRegistrar($apiFields);

        //General
        $api = new Api($apiFieldsRegistrar);
        $api->addHooks();

        $admin = new Admin();
        $admin->addHooks();

        //Post types
        $school = new School(...array_values(SchoolConfiguration::getPostTypeArgs()));
        $school->addHooks();

        $person = new Person(...array_values(PersonConfiguration::getPostTypeArgs()));
        $person->addHooks();

        //Meta boxes
        $schoolPagesCallbackRenderer = new SchoolPagesMetaBoxCallback();
        $schoolPagesMetaBox          = new SchoolPagesMetaBox($schoolPagesCallbackRenderer);
        $schoolPagesMetaBox->addHooks();

        // Taxonomies
        $sharedArguments = [
        'meta_box_cb' => false
        ];

        $taxonomyConfigurations = [
        [
            SchoolType::class,
            __('School types', ASM_TEXT_DOMAIN),
            __('School type', ASM_TEXT_DOMAIN),
            'school_type',
            ['school'],
            []
        ],
        [
            GeographicArea::class,
            __('Areas', ASM_TEXT_DOMAIN),
            __('Area', ASM_TEXT_DOMAIN),
            'area',
            ['school'],
            []
        ],
        [
            Grade::class,
            __(
                'Grades',
                ASM_TEXT_DOMAIN
            ),
            __(
                'Grade',
                ASM_TEXT_DOMAIN
            ),
            'grade',
            ['school'],
            []
        ],
        [
            Profile::class,
            __(
                'Profiles',
                ASM_TEXT_DOMAIN
            ),
            __(
                'Profile',
                ASM_TEXT_DOMAIN
            ),
            'profile',
            ['school'],
            []
        ],
        [
            ProfessionalTitle::class,
            __(
                'Professional titles',
                ASM_TEXT_DOMAIN
            ),
            __(
                'Professional title',
                ASM_TEXT_DOMAIN
            ),
            'professional_title',
            ['person'],
            []
        ]
        ];

        $taxonomies = [];

        foreach ($taxonomyConfigurations as $config) {
            list($class,
            $plural,
            $singular,
            $slug,
            $postType,
            $uniqueArgs
            )             = $config;
            $args         = array_merge($sharedArguments, $uniqueArgs);
            $taxonomies[] = new $class($plural, $singular, $slug, $postType, $args);
        }

        foreach ($taxonomies as $taxonomy) {
            $taxonomy->registerTaxonomy();
        }
    }

    public function respectMetaBoxCbInGutenberg($response, $taxonomy, $request)
    {
        $context = ! empty($request['context']) ? $request['context'] : 'view';

            // Context is edit in the editor
        if ($context === 'edit' && $taxonomy->meta_box_cb === false) {
            $data_response = $response->get_data();

            $data_response['visibility']['show_ui'] = false;

            $response->set_data($data_response);
        }

            return $response;
    }

    public function useGoogleApiKeyIfDefined(): void
    {
        if (defined('GOOGLE_API_KEY')) {
            \acf_update_setting('google_api_key', \GOOGLE_API_KEY);
        }
    }
}
