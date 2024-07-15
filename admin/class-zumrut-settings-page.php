<?php

class Zumrut_Snippets_Settings {

    public function __construct() {
        add_action( 'admin_menu', array( $this, 'add_admin_menu' ) );
        add_action( 'admin_init', array( $this, 'register_settings' ) );
        add_action( 'admin_init', array( $this, 'add_settings_section' ) );
        add_action( 'admin_init', array( $this, 'add_settings_field' ) );
    }

     public function add_admin_menu() {
        add_menu_page(
            __("Zumrut Snippets Settings", "zumrut-snippets"),
            __("Zumrut Snippets Settings", "zumrut-snippets"),
            'manage_options',
            'zumrut-snippets-settings',
            array( $this, 'settings_page' ),
            'dashicons-admin-generic'
        );
    }

    // Function to display the settings page
    public function settings_page() {
        ?>
        <div class="wrap">
            <h1><?php _e("Zumrut Snippets", "zumrut-snippets") ?></h1>
            <form method="post" action="options.php">
                <?php
                settings_fields( 'zumrut-snippets-color-attribute-slug' );
                do_settings_sections( 'zumrut-snippets-settings' );
                submit_button();
                ?>
            </form>
        </div>
        <?php
    }

    public function register_settings() {
        register_setting( 'zumrut-snippets-color-attribute-slug', 'zumrut_snippets_taxonomy_slug' );
    }

    public function add_settings_section() {
        add_settings_section(
            'zumrut_snippets_settings_section', // Section ID
            __("Color attribute slug", "zumrut-snippets"), // Section Title
            array( $this, 'section_callback' ), // Callback function
            'zumrut-snippets-settings' // Page ID
        );
    }

    public function section_callback() {
        echo '<p>' . __("Enter your taxonomy slug here", "zumrut-snippets") . '.</p>';
    }

    public function add_settings_field() {
        add_settings_field(
            'zumrut_snippets_taxonomy_slug', // Field ID
            __("Attribute slug", "zumrut-snippets"), // Field Title
            array( $this, 'taxonomy_slug_callback' ), // Callback function
            'zumrut-snippets-settings', // Page ID
            'zumrut_snippets_settings_section' // Section ID
        );
    }

    public function taxonomy_slug_callback() {
        $taxonomy_slug = get_option( 'zumrut_snippets_taxonomy_slug' );
        echo '<input type="text" name="zumrut_snippets_taxonomy_slug" value="' . esc_attr( $taxonomy_slug ) . '" />';
    }
}
