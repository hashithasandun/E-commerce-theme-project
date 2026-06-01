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
	wp_enqueue_script( 'rstore-instant-search', $uri . '/js/instant-search.js', array( 'rstore-app' ), '1.0.0', true );
	wp_enqueue_script( 'rstore-quick-view', $uri . '/js/quick-view.js', array( 'rstore-app' ), '1.0.0', true );

	// Fetch logged-in user's database wishlist
	$user_wishlist = array();
	if ( is_user_logged_in() ) {
		$user_wishlist = get_user_meta( get_current_user_id(), '_rstore_wishlist', true );
		if ( ! is_array( $user_wishlist ) ) {
			$user_wishlist = array();
		}
	}

	// Localize AJAX URL and initial states to frontend scripts
	wp_localize_script( 'rstore-app', 'rstore_vars', array(
		'ajax_url'      => admin_url( 'admin-ajax.php' ),
		'is_logged_in'  => is_user_logged_in(),
		'user_wishlist' => array_values( array_map( 'intval', $user_wishlist ) ),
	) );
}
add_action( 'wp_enqueue_scripts', 'rstore_enqueue_assets' );

// Load Elementor custom widgets integration helper safely on init hook
add_action( 'init', function() {
	if ( did_action( 'elementor/loaded' ) ) {
		require_once get_template_directory() . '/inc/elementor-widgets.php';
	}
} );

/**
 * Register Custom Product Brand Taxonomy
 */
function rstore_register_brand_taxonomy() {
	if ( ! class_exists( 'WooCommerce' ) ) {
		return;
	}
	$labels = array(
		'name'              => _x( 'Brands', 'taxonomy general name', 'rstore' ),
		'singular_name'     => _x( 'Brand', 'taxonomy singular name', 'rstore' ),
		'search_items'      => __( 'Search Brands', 'rstore' ),
		'all_items'         => __( 'All Brands', 'rstore' ),
		'parent_item'       => __( 'Parent Brand', 'rstore' ),
		'parent_item_colon' => __( 'Parent Brand:', 'rstore' ),
		'edit_item'         => __( 'Edit Brand', 'rstore' ),
		'update_item'       => __( 'Update Brand', 'rstore' ),
		'add_new_item'      => __( 'Add New Brand', 'rstore' ),
		'new_item_name'     => __( 'New Brand Name', 'rstore' ),
		'menu_name'         => __( 'Brands', 'rstore' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'brand' ),
	);

	register_taxonomy( 'product_brand', array( 'product' ), $args );
}
add_action( 'init', 'rstore_register_brand_taxonomy', 0 );

/**
 * AJAX Instant Search & Auto-Complete Callback
 */
function rstore_ajax_search_callback() {
	$term = isset( $_GET['term'] ) ? sanitize_text_field( $_GET['term'] ) : '';
	$results = array();

	if ( ! empty( $term ) ) {
		if ( class_exists( 'WooCommerce' ) ) {
			$args = array(
				'post_type'      => 'product',
				'post_status'    => 'publish',
				's'              => $term,
				'posts_per_page' => 5,
			);
			$query = new WP_Query( $args );

			if ( $query->have_posts() ) {
				while ( $query->have_posts() ) {
					$query->the_post();
					$product = wc_get_product( get_the_ID() );
					$results[] = array(
						'id'        => get_the_ID(),
						'title'     => get_the_title(),
						'permalink' => get_permalink(),
						'price'     => $product ? $product->get_price_html() : '',
						'image'     => get_the_post_thumbnail_url( get_the_ID(), 'thumbnail' ) ? get_the_post_thumbnail_url( get_the_ID(), 'thumbnail' ) : wc_placeholder_img_src(),
					);
				}
				wp_reset_postdata();
			}
		} else {
			// Mock product search database fallback for offline/development environments
			$mock_products = array(
				array(
					'id'        => 101,
					'title'     => 'Premium Wireless Headphones',
					'permalink' => '#',
					'price'     => '<span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">$</span>199.00</bdi></span>',
					'image'     => get_template_directory_uri() . '/assets/images/products/headphones.jpg',
				),
				array(
					'id'        => 102,
					'title'     => 'Minimalist Leather Watch',
					'permalink' => '#',
					'price'     => '<span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">$</span>149.00</bdi></span>',
					'image'     => get_template_directory_uri() . '/assets/images/products/watch.jpg',
				),
				array(
					'id'        => 103,
					'title'     => 'Ergonomic Office Chair',
					'permalink' => '#',
					'price'     => '<span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">$</span>299.00</bdi></span>',
					'image'     => get_template_directory_uri() . '/assets/images/products/chair.jpg',
				),
				array(
					'id'        => 104,
					'title'     => 'Water-Resistant Smartwatch',
					'permalink' => '#',
					'price'     => '<span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">$</span>189.00</bdi></span>',
					'image'     => get_template_directory_uri() . '/assets/images/products/watch.jpg',
				),
			);
			foreach ( $mock_products as $mock ) {
				if ( stripos( $mock['title'], $term ) !== false ) {
					$results[] = $mock;
				}
			}
		}
	}

	wp_send_json_success( $results );
}
add_action( 'wp_ajax_rstore_ajax_search', 'rstore_ajax_search_callback' );
add_action( 'wp_ajax_nopriv_rstore_ajax_search', 'rstore_ajax_search_callback' );

/**
 * Product Quick View Lightbox Endpoint Callback
 */
function rstore_product_quick_view_callback() {
	$product_id = isset( $_GET['product_id'] ) ? intval( $_GET['product_id'] ) : 0;

	if ( ! $product_id ) {
		wp_send_json_error( array( 'message' => 'Invalid product ID' ) );
	}

	if ( class_exists( 'WooCommerce' ) ) {
		$product = wc_get_product( $product_id );
		if ( $product ) {
			$gallery_ids = $product->get_gallery_image_ids();
			$gallery_urls = array( get_the_post_thumbnail_url( $product_id, 'large' ) ? get_the_post_thumbnail_url( $product_id, 'large' ) : wc_placeholder_img_src() );
			foreach ( $gallery_ids as $id ) {
				$gallery_urls[] = wp_get_attachment_url( $id );
			}

			ob_start();
			if ( $product->is_type( 'variable' ) ) {
				woocommerce_variable_add_to_cart();
			} else {
				woocommerce_simple_add_to_cart();
			}
			$cart_html = ob_get_clean();

			$data = array(
				'title'     => $product->get_name(),
				'price'     => $product->get_price_html(),
				'desc'      => $product->get_short_description() ? $product->get_short_description() : get_the_excerpt( $product_id ),
				'gallery'   => $gallery_urls,
				'cart_html' => $cart_html,
			);
			wp_send_json_success( $data );
		}
	}

	// Mock Quick View fallback if WooCommerce is inactive/offline
	$mock_desc = 'Handcrafted using eco-friendly, premium materials. This product combines top-tier performance with stunning visual aesthetics, offering the perfect addition to your space.';
	$mock_gallery = array(
		get_template_directory_uri() . '/assets/images/products/headphones.jpg',
		get_template_directory_uri() . '/assets/images/products/watch.jpg'
	);
	if ( $product_id == 101 ) {
		$mock_title = 'Premium Wireless Headphones';
		$mock_price = '<span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">$</span>199.00</bdi></span>';
	} else if ( $product_id == 102 ) {
		$mock_title = 'Minimalist Leather Watch';
		$mock_price = '<span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">$</span>149.00</bdi></span>';
		$mock_gallery = array( get_template_directory_uri() . '/assets/images/products/watch.jpg' );
	} else {
		$mock_title = 'Handcrafted Premium Product';
		$mock_price = '<span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">$</span>99.00</bdi></span>';
	}

	$mock_data = array(
		'title'     => $mock_title,
		'price'     => $mock_price,
		'desc'      => $mock_desc,
		'gallery'   => $mock_gallery,
		'cart_html' => '<form class="cart" method="post" enctype="multipart/form-data">
			<div class="quantity">
				<input type="number" class="quantity-field" step="1" min="1" max="99" name="quantity" value="1" title="Qty" size="4" placeholder="" inputmode="numeric" />
			</div>
			<button type="button" class="btn btn-primary" style="margin-left: 12px" onclick="RStore.addToCart(' . $product_id . ', \'' . esc_js( $mock_title ) . '\', ' . floatval( str_replace( array( '$', ',' ), '', strip_tags( $mock_price ) ) ) . ', \'' . $mock_gallery[0] . '\')">Add to Cart</button>
		</form>'
	);
	wp_send_json_success( $mock_data );
}
add_action( 'wp_ajax_rstore_product_quick_view', 'rstore_product_quick_view_callback' );
add_action( 'wp_ajax_nopriv_rstore_product_quick_view', 'rstore_product_quick_view_callback' );

/**
 * AJAX Toggle Wishlist Endpoint Callback
 */
function rstore_toggle_wishlist_callback() {
	$product_id = isset( $_POST['product_id'] ) ? intval( $_POST['product_id'] ) : 0;

	if ( ! $product_id ) {
		wp_send_json_error( array( 'message' => 'Invalid product ID' ) );
	}

	$user_id = is_user_logged_in() ? get_current_user_id() : 0;
	if ( ! $user_id ) {
		wp_send_json_error( array( 'message' => 'User not logged in' ) );
	}

	$wishlist = get_user_meta( $user_id, '_rstore_wishlist', true );
	if ( ! is_array( $wishlist ) ) {
		$wishlist = array();
	}

	$status = 'added';
	if ( in_array( $product_id, $wishlist ) ) {
		$wishlist = array_diff( $wishlist, array( $product_id ) );
		$status = 'removed';
	} else {
		$wishlist[] = $product_id;
	}

	update_user_meta( $user_id, '_rstore_wishlist', array_values( array_map( 'intval', $wishlist ) ) );

	wp_send_json_success( array(
		'status' => $status,
		'count'  => count( $wishlist ),
		'items'  => array_values( array_map( 'intval', $wishlist ) ),
	) );
}
add_action( 'wp_ajax_rstore_toggle_wishlist', 'rstore_toggle_wishlist_callback' );
add_action( 'wp_ajax_nopriv_rstore_toggle_wishlist', 'rstore_toggle_wishlist_callback' );

/**
 * AJAX Clear Wishlist Endpoint Callback
 */
function rstore_clear_wishlist_callback() {
	$user_id = is_user_logged_in() ? get_current_user_id() : 0;
	if ( ! $user_id ) {
		wp_send_json_error( array( 'message' => 'User not logged in' ) );
	}

	update_user_meta( $user_id, '_rstore_wishlist', array() );
	wp_send_json_success( array( 'items' => array() ) );
}
add_action( 'wp_ajax_rstore_clear_wishlist', 'rstore_clear_wishlist_callback' );
add_action( 'wp_ajax_nopriv_rstore_clear_wishlist', 'rstore_clear_wishlist_callback' );

