<?php

/**
 * Plugin Name:       Schools Manager
 * Plugin URI:        https://github.com/helsingborg-stad/api-schools-manager
 * Description:       Creates a api that may be used to manage schools
 * Version: 0.24.0
 * Author:            Thor Brink @ Helsingborg Stad
 * Author URI:        https://github.com/helsingborg-stad
 * License:           MIT
 * License URI:       https://opensource.org/licenses/MIT
 * Text Domain:       api-schools-manager
 * Domain Path:       /languages
 */

// Protect agains direct file access
if (!defined('WPINC')) {
    die;
}

define('SCHOOLS_MANAGER_PATH', plugin_dir_path(__FILE__));
define('SCHOOLS_MANAGER_URL', plugins_url('', __FILE__));
define('SCHOOLS_MANAGER_TEMPLATE_PATH', SCHOOLS_MANAGER_PATH . 'templates/');

require_once SCHOOLS_MANAGER_PATH . 'Public.php';

// Register the autoloader
if (file_exists(SCHOOLS_MANAGER_PATH . 'vendor/autoload.php')) {
    require SCHOOLS_MANAGER_PATH . '/vendor/autoload.php';
}

// Acf auto import and export
add_action('acf/init', function () {
    $acfExportManager = new \AcfExportManager\AcfExportManager();
    $acfExportManager->setTextdomain('api-schools-manager');
    $acfExportManager->setExportFolder(SCHOOLS_MANAGER_PATH . 'source/php/AcfFields/');
    $acfExportManager->autoExport(array(
        // School fields
        'elementary-school-data'   => 'group_651e694d7a010',
        'pre-school-data'          => 'group_651e669808174',
        'page-fields'              => 'group_64e84e2b7a8c4',
        'notice'                   => 'group_6524011f6f467',
        'person-details'           => 'group_64e6f3b077aa6',
        'schools-manager-settings' => 'group_654b8e292c983'
    ));

    $acfExportManager->import();
});

// Start application
new SchoolsManager\App(
    new \AcfService\Implementations\NativeAcfService(),
    new \WpService\Implementations\NativeWpService()
);

add_action('plugins_loaded', function () {

    load_plugin_textdomain('api-schools-manager', false, dirname(plugin_basename(__FILE__)) . '/languages');
});
