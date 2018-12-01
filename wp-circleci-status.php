<?php

/**
 * WP Circle CI Status
 * @link              https://github.com/thatwpdeveloper
 * @since             1.0.0
 * @package           Wp_Circleci_Status
 *
 * @wordpress-plugin
 * Plugin Name:       WP Circle CI Status
 * Plugin URI:        https://github.com/thatwpdeveloper/wp-circleci-status
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            That WP Developer
 * Author URI:        https://github.com/thatwpdeveloper
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp-circleci-status
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'PLUGIN_NAME_VERSION', '1.0.3' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wp-circleci-status.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wp_circleci_status() {

	$plugin = new Wp_Circleci_Status();
	$plugin->run();

}
run_wp_circleci_status();
