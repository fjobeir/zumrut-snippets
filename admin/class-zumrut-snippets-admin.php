<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.fjobeir.com
 * @since      1.0.0
 *
 * @package    Zumrut_Snippets
 * @subpackage Zumrut_Snippets/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Zumrut_Snippets
 * @subpackage Zumrut_Snippets/admin
 * @author     Feras Jobeir <fjobeir@fjobeir.com>
 */
class Zumrut_Snippets_Admin
{

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->load_modules();
	}

	public function load_modules()
	{
		require_once plugin_dir_path(__FILE__) . 'class-zumrut-settings-page.php';
		require_once plugin_dir_path(__FILE__) . 'class-zumrut-products-table.php';
		new Zumrut_Snippets_Settings();
		new Zumrut_Snippets_Products_Table();
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Zumrut_Snippets_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Zumrut_Snippets_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		// wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/zumrut-snippets-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Zumrut_Snippets_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Zumrut_Snippets_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		// wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/zumrut-snippets-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Modify the image of a variable product variation to match the color attribute.
	 */
	public function apply_color_images_to_variations($product_id)
	{
		$color_tax = get_option('zumrut_snippets_taxonomy_slug');
		if (empty($color_tax)) {
			// The color attribute slug must be set
			return;
		}

		$product = wc_get_product($product_id);
		if ($product->is_type('variable')) {
			$variations = $product->get_children();
			$color_images = array();

			// Loop through variations to collect color images
			foreach ($variations as $variation_id) {
				$variation = wc_get_product($variation_id);
				$attributes = $variation->get_attributes();
				if (isset($attributes[$color_tax])) {
					$color = $attributes[$color_tax];
					if (!isset($color_images[$color])) {
						$color_images[$color] = array(
							'main' => $variation->get_image_id(),
							'gallery' => array()
						);
					}

					// Collect extra images
					$extra_images = get_post_meta($variation_id, 'rey_extra_variation_images', true);
					if (!empty($extra_images)) {
						$extra_images_array = (array)(explode(',', $extra_images));
						$color_images[$color]['gallery'] = array_unique(array_merge($color_images[$color]['gallery'], $extra_images_array));
					}
				}
			}

			// Apply collected images to all variations of the same color
			foreach ($variations as $variation_id) {
				$variation = wc_get_product($variation_id);
				$attributes = $variation->get_attributes();
				if (isset($attributes[$color_tax])) {
					$color = $attributes[$color_tax];
					if (isset($color_images[$color])) {
						// Update main image
						if (!empty($color_images[$color]['main'])) {
							$variation->set_image_id($color_images[$color]['main']);
							$variation->save();
						}
						// Update extra images
						if (!empty($color_images[$color]['gallery'])) {
							$extra_images = implode(',', array_unique($color_images[$color]['gallery']));
							update_post_meta($variation_id, 'rey_extra_variation_images', $extra_images);
						}
					}
				}
			}
		}
	}
	public function respond_to_product_import($product_id)
	{
		echo 'HIIIIIII';
		$this->apply_color_images_to_variations($product_id);
	}
}
