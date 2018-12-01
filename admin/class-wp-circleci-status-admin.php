<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/thatwpdeveloper
 * @since      1.0.0
 *
 * @package    Wp_Circleci_Status
 * @subpackage Wp_Circleci_Status/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wp_Circleci_Status
 * @subpackage Wp_Circleci_Status/admin
 * @author     That WP Developer <thatwpdeveloper@gmail.com>
 */
class Wp_Circleci_Status_Admin {

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
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	public function set_dashboard_widget() {
        wp_add_dashboard_widget(
            $this->plugin_name,
            __('CircleCI Status', 'wp-circleci-status'),
            array($this, 'set_dashboard_widget_html')
        );
    }

	public function set_dashboard_widget_html() {

        require_once plugin_dir_path( dirname( __FILE__ ) ) . '/admin/partials/dashboard-widget.php';
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/dashboard-widget.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * Enqueues the Status Page JS library.
		 */

        wp_enqueue_script($this->plugin_name . '-lib', 'https://cdn.statuspage.io/se-v2.js', null, null, true );

        /**
         * Enqueues the script that fetches the status.
         */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/dashboard-widget.js', array( $this->plugin_name . '-lib' ), $this->version, true );
	}

}
