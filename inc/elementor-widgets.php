<?php
/**
 * Elementor Custom Widgets Integration Loader
 *
 * Registers the 'R Store Premium Elements' category and custom widgets
 * (Hero Slider, Product Grid, and Sales Booster) when Elementor is active.
 *
 * @package RStore
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Main RStore Elementor Extension Loader Class
 */
class RStore_Elementor_Widgets_Loader {

	private static $_instance = null;

	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public function __construct() {
		add_action( 'elementor/elements/categories_registered', array( $this, 'register_widget_categories' ) );
		add_action( 'elementor/widgets/register', array( $this, 'register_custom_widgets' ) );
	}

	/**
	 * Register Category
	 */
	public function register_widget_categories( $elements_manager ) {
		$elements_manager->add_category(
			'rstore-elements',
			array(
				'title' => esc_html__( 'R Store Premium Elements', 'rstore' ),
				'icon'  => 'fa fa-shopping-bag',
			)
		);
	}

	/**
	 * Register Widgets
	 */
	public function register_custom_widgets( $widgets_manager ) {
		// Include Widget Classes
		require_once __DIR__ . '/widgets/widget-hero-slider.php';
		require_once __DIR__ . '/widgets/widget-product-grid.php';
		require_once __DIR__ . '/widgets/widget-sales-booster.php';

		// Register Widgets
		$widgets_manager->register( new \RStore_Elementor_Hero_Slider_Widget() );
		$widgets_manager->register( new \RStore_Elementor_Product_Grid_Widget() );
		$widgets_manager->register( new \RStore_Elementor_Sales_Booster_Widget() );
	}
}

// Initialize Loader
RStore_Elementor_Widgets_Loader::instance();
