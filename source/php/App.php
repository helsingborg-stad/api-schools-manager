<?php

namespace SchoolsManager;

use AcfService\AcfService;
use SchoolsManager\API\Api;
use SchoolsManager\API\DefaultValuesSetter;
use SchoolsManager\API\Fields\FieldsRegistrar;
use SchoolsManager\API\Fields\SchoolPagesField;
use SchoolsManager\API\Fields\ImagesField;
use SchoolsManager\Entity\PostType;
use SchoolsManager\PostColumn\PostColumn;
use SchoolsManager\MetaBox\SchoolPagesMetaBox;
use SchoolsManager\MetaBox\SchoolPagesMetaBoxCallback;
use SchoolsManager\PostColumn\Columns\PageSchoolColumnRenderer;
use SchoolsManager\PostColumn\Columns\PageSchoolColumnSorting;
use SchoolsManager\PostType\ElementarySchool\ElementarySchoolConfiguration;
use SchoolsManager\PostType\Person\Person;
use SchoolsManager\PostType\Person\PersonConfiguration;
use SchoolsManager\PostType\PreSchool\PreSchoolConfiguration;
use SchoolsManager\Taxonomy\GeographicArea\GeographicArea;
use SchoolsManager\Taxonomy\Grade\Grade;
use SchoolsManager\Taxonomy\Usp\Usp;
use WpService\WpService;

class App
{
    public function __construct(private AcfService $acfService, private WpService $wpService)
    {
        $this->wpService->addAction('plugins_loaded', array( $this, 'init' ));

        $this->wpService->addAction('admin_init', array($this, 'hideUnusedAdminPages'));

        $this->wpService->addAction('plugins_loaded', array( $this, 'useGoogleApiKeyIfDefined' ));

        $this->wpService->addFilter('rest_prepare_taxonomy', array($this, 'respectMetaBoxCbInGutenberg' ), 10, 3);

        $this->wpService->addAction('admin_menu', array( $this, 'hideStandardExcerptBox'));

        $this->wpService->addAction('acf/save_post', array($this, 'saveCustomExcerptField'), 20, 1);

        $this->wpService->addFilter('acf/fields/post_object/result/name=person', array($this, 'displayContactMetaInMetaBox'), 10, 4);

        $this->wpService->addAction('post_updated', array($this, 'setPageParentOnPostUpdated'));
    }


    public function hideStandardExcerptBox()
    {
        $this->wpService->removeMetaBox('postexcerpt', ['pre-school', 'elementary-school'], 'normal');
    }

    public function hideUnusedAdminPages()
    {

        $this->wpService->removeMenuPage('edit.php'); // Posts
        $this->wpService->removeMenuPage('link-manager.php');
        $this->wpService->removeMenuPage('edit-comments.php');
        $this->wpService->removeMenuPage('themes.php');
        $this->wpService->removeMenuPage('tools.php');
        $this->wpService->removeMenuPage('index.php');

        $this->wpService->removeSubmenuPage('options-general.php', 'options-discussion.php');
        $this->wpService->removeSubmenuPage('options-general.php', 'options-writing.php');
        $this->wpService->removeSubmenuPage('options-general.php', 'options-privacy.php');
    }

    public function displayContactMetaInMetaBox($title, $post, $field, $post_id)
    {

        if ($this->wpService->isAdmin()) {
            $email = $this->acfService->getField('e-mail', $post->ID);
            if ($title) {
                $title .= " ($email)";
            }
        }
        return $title;
    }

    /**
     * Initializes the App by registering the API,
     * Admin, Post Types, Meta Boxes and Taxonomies.
     *
     * @return void
     */
    public function init()
    {
        //API
        $apiFieldsRegistrar = new FieldsRegistrar([
            new SchoolPagesField($this->wpService),
            new ImagesField($this->acfService, $this->wpService)
        ]);

        //General
        $api = new Api($apiFieldsRegistrar);
        $api->addHooks();

        $apiDefaultValuesSetter = new DefaultValuesSetter();
        $apiDefaultValuesSetter->addHooks();

        $admin = new Admin();
        $admin->addHooks();

        /**
         * Post columns
         */

        // Column renderers
        $pageSchoolColumnRenderer = new PageSchoolColumnRenderer();

        // Column sorting
        $pageSchoolColumnSorting = new PageSchoolColumnSorting();

        // Columns
        $postColumn = new PostColumn(
            __('School', 'api-schools-manager'),
            $pageSchoolColumnRenderer,
            $pageSchoolColumnSorting
        );

        // Initialize post columns
        $postColumn->addHooks();

        /**
         * Post type: Pre school
         */
        $preSchoolPostTypeConfiguration = new PreSchoolConfiguration();
        $preSchoolPostTypeArgs          = $preSchoolPostTypeConfiguration->getPostTypeArgs();
        $preSchoolPostType              = new PostType(...array_values($preSchoolPostTypeArgs));
        $preSchoolPostType->addHooks();

        /**
         * Post type: Elementary school
         */
        $elementarySchoolPostTypeConfiguration = new ElementarySchoolConfiguration();
        $elementarySchoolPostTypeArgs          = $elementarySchoolPostTypeConfiguration->getPostTypeArgs();
        $elementarySchoolPostType              = new PostType(...array_values($elementarySchoolPostTypeArgs));
        $elementarySchoolPostType->addHooks();

        $person = new Person(...array_values(PersonConfiguration::getPostTypeArgs()));
        $person->addHooks();

        //Meta boxes
        $schoolPagesCallbackRenderer = new SchoolPagesMetaBoxCallback();
        $schoolPagesMetaBox          = new SchoolPagesMetaBox($schoolPagesCallbackRenderer);
        $schoolPagesMetaBox->addHooks();


        // Arguments shared across all taxonomies
        $sharedArguments = [
            'meta_box_cb' => false
        ];

        /**
         * $taxonomyConfigurations
         *
         * An array of taxonomy configurations.
         *
         * Each configuration is an array with the following elements:
         * - The taxonomy class name.
         * - The plural name of the taxonomy.
         * - The singular name of the taxonomy.
         * - The taxonomy slug.
         * - An array of post types to which the taxonomy should be registered.
         * - An array of additional arguments to be passed to the register_taxonomy() function.
         *
         * @var array
         */

        $taxonomyConfigurations = [
        [
            GeographicArea::class,
            __('Areas', 'api-schools-manager'),
            __('Area', 'api-schools-manager'),
            'area',
            ['elementary-school', 'pre-school'],
            []
        ],
        [
            Usp::class,
            __('USPs', 'api-schools-manager'),
            __('USP', 'api-schools-manager'),
            'usp',
            ['elementary-school', 'pre-school'],
            ['hierarchical' => true]
        ],
        [
            Grade::class,
            __(
                'Grades',
                'api-schools-manager'
            ),
            __(
                'Grade',
                'api-schools-manager'
            ),
            'grade',
            ['elementary-school'],
            []
        ],
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

    /**
     * This method is used to modify the response object
     * for the REST API request to respect the meta box
     * callback in Gutenberg.
     *
     * @param WP_REST_Response $response The response object for the REST API request.
     * @param WP_Taxonomy $taxonomy The taxonomy object.
     * @param WP_REST_Request $request The REST API request object.
     *
     * @return WP_REST_Response The modified response object.
     */
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

    /**
     * Sets the Google API key if it is defined.
     *
     * If the constant 'GOOGLE_API_KEY' is defined,
     * this method sets the Google API key using the 'acf_update_setting' function.
     *
     * @return void
     */
    public function useGoogleApiKeyIfDefined(): void
    {
        if (defined('GOOGLE_API_KEY')) {
            \acf_update_setting('google_api_key', \GOOGLE_API_KEY);
        }
    }


    /**
     * Saves the custom excerpt field for a given post ID.
     *
     * @param int $postId The ID of the post to save the custom excerpt for.
     * @return void
     */
    public function saveCustomExcerptField($postId): void
    {

        $customExcerpt = $this->acfService->getField('custom_excerpt', $postId);

        remove_action('acf/save_post', array($this, 'saveCustomExcerptField'), 20, 1);
        wp_update_post(['ID' => $postId, 'post_excerpt' => $customExcerpt], false);
        add_action('acf/save_post', array($this, 'saveCustomExcerptField'), 20, 1);
    }

    public function setPageParentOnPostUpdated(int $postId)
    {
        $fieldName = 'parent_school';
        $postType  = 'page';

        if (get_post_type($postId) !== $postType) {
            return;
        }

        $value = get_post_meta($postId, $fieldName, true);

        if (empty($value)) {
            return;
        }

        // Remove filter to prevent infinite loop.
        remove_filter('post_updated', [$this, 'setPageParentOnPostUpdated'], 10, 1);

        // Update page and set post_parent.
        wp_update_post(['ID' => $postId, 'post_parent' => $value], true);
    }
}
