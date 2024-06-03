<?php

/**
 * The plugin bootstrap file
 *
 * @link              https://www.fjobeir.com
 * @since             1.0.0
 * @package           Zumrut_Snippets
 *
 * @wordpress-plugin
 * Plugin Name:       Zumrut Snippets
 * Plugin URI:        https://www.fjobeir.com
 * Description:       Modify some functionalities according to Zumrut rules.
 * Version:           1.0.0
 * Author:            Feras Jobeir
 * Author URI:        https://www.fjobeir.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       zumrut-snippets
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
define( 'ZUMRUT_SNIPPETS_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-zumrut-snippets-activator.php
 */
function activate_zumrut_snippets() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-zumrut-snippets-activator.php';
	Zumrut_Snippets_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-zumrut-snippets-deactivator.php
 */
function deactivate_zumrut_snippets() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-zumrut-snippets-deactivator.php';
	Zumrut_Snippets_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_zumrut_snippets' );
register_deactivation_hook( __FILE__, 'deactivate_zumrut_snippets' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-zumrut-snippets.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_zumrut_snippets() {

	$plugin = new Zumrut_Snippets();
	$plugin->run();

}
run_zumrut_snippets();
