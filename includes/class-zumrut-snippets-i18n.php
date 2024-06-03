<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://www.fjobeir.com
 * @since      1.0.0
 *
 * @package    Zumrut_Snippets
 * @subpackage Zumrut_Snippets/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Zumrut_Snippets
 * @subpackage Zumrut_Snippets/includes
 * @author     Feras Jobeir <fjobeir@fjobeir.com>
 */
class Zumrut_Snippets_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'zumrut-snippets',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
