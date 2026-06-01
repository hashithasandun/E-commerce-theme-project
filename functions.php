<?php
/**
 * R Store Theme Functions and Definitions
 * Enqueues style sheets and script assets, registers layouts,
 * and sets up general core behaviors.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Setup Theme Supports
 */
function rstore_setup() {
	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Let WordPress manage the document title.
	add_theme_support( 'title-tag' );

	// Enable support for Post Thumbnails on posts and pages.
	add_theme_support( 'post-thumbnails' );

	// Register Navigation Menus.
	register_nav_menus( array(
		'primary-menu' => esc_html__( 'Primary Menu', 'rstore' ),
		'footer-menu'  => esc_html__( 'Footer Menu', 'rstore' ),
	) );

	// Enable HTML5 markup support.
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
		'style',
		'script',
	) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	// Declare WooCommerce support
	add_theme_support( 'woocommerce', array(
		'thumbnail_image_width' => 300,
		'single_image_width'    => 600,
		'product_grid'          => array(
			'default_rows'    => 3,
			'min_rows'        => 1,
			'default_columns' => 4,
			'min_columns'     => 1,
			'max_columns'     => 6,
		),
	) );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'rstore_setup' );

/**
 * Enqueue Styles and Scripts
 */
function rstore_enqueue_assets() {
	$uri = get_template_directory_uri();

	// Enqueue Google Fonts
	wp_enqueue_style( 'rstore-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Outfit:wght@300;400;500;600;700;800;900&display=swap', array(), null );

	// Enqueue Theme Stylesheets
	wp_enqueue_style( 'rstore-main', $uri . '/css/main.css', array(), '1.0.0' );
	wp_enqueue_style( 'rstore-components', $uri . '/css/components.css', array( 'rstore-main' ), '1.0.0' );
	wp_enqueue_style( 'rstore-animations', $uri . '/css/animations.css', array( 'rstore-main' ), '1.0.0' );
	wp_enqueue_style( 'rstore-shop', $uri . '/css/shop.css', array( 'rstore-main' ), '1.0.0' );
	wp_enqueue_style( 'rstore-responsive', $uri . '/css/responsive.css', array( 'rstore-main' ), '1.0.0' );
	wp_enqueue_style( 'rstore-extras', $uri . '/css/extras.css', array( 'rstore-main' ), '1.0.0' );

	// Enqueue Core JavaScript Modules (in proper loading sequence)
	wp_enqueue_script( 'rstore-app', $uri . '/js/app.js', array(), '1.0.0', true );
	wp_enqueue_script( 'rstore-cart', $uri . '/js/cart.js', array( 'rstore-app' ), '1.0.0', true );
	wp_enqueue_script( 'rstore-wishlist', $uri . '/js/wishlist.js', array( 'rstore-app' ), '1.0.0', true );
	wp_enqueue_script( 'rstore-compare', $uri . '/js/compare.js', array( 'rstore-app' ), '1.0.0', true );
	wp_enqueue_script( 'rstore-filters', $uri . '/js/filters.js', array( 'rstore-app' ), '1.0.0', true );
	wp_enqueue_script( 'rstore-slider', $uri . '/js/slider.js', array( 'rstore-app' ), '1.0.0', true );
	wp_enqueue_script( 'rstore-mega-menu', $uri . '/js/mega-menu.js', array( 'rstore-app' ), '1.0.0', true );
	wp_enqueue_script( 'rstore-sales-booster', $uri . '/js/sales-booster.js', array( 'rstore-app' ), '1.0.0', true );
	wp_enqueue_script( 'rstore-checkout', $uri . '/js/checkout.js', array( 'rstore-app' ), '1.0.0', true );
	wp_enqueue_script( 'rstore-theme-builder', $uri . '/js/theme-builder.js', array( 'rstore-app' ), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'rstore_enqueue_assets' );

// Load Elementor custom widgets integration helper safely on init hook
add_action( 'init', function() {
	if ( did_action( 'elementor/loaded' ) ) {
		require_once get_template_directory() . '/inc/elementor-widgets.php';
	}
} );
