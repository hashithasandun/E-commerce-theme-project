<?php
/**
 * Elementor Widget: Dynamic Product Grid
 *
 * @package RStore
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class RStore_Elementor_Product_Grid_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'rstore_product_grid';
	}

	public function get_title() {
		return esc_html__( 'Product Catalog Grid', 'rstore' );
	}

	public function get_icon() {
		return 'eicon-grid';
	}

	public function get_categories() {
		return array( 'rstore-elements' );
	}

	protected function register_controls() {
		$this->start_controls_section(
			'content_section',
			array(
				'label' => esc_html__( 'Grid Settings', 'rstore' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'posts_per_page',
			array(
				'label'   => esc_html__( 'Total Products Count', 'rstore' ),
				'type'    => \Elementor\Controls_Manager::NUMBER,
				'default' => 8,
				'min'     => 1,
				'max'     => 40,
			)
		);

		$this->add_control(
			'columns',
			array(
				'label'   => esc_html__( 'Grid Columns', 'rstore' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => '4',
				'options' => array(
					'2' => esc_html__( '2 Columns', 'rstore' ),
					'3' => esc_html__( '3 Columns', 'rstore' ),
					'4' => esc_html__( '4 Columns', 'rstore' ),
				),
			)
		);

		$this->add_control(
			'category',
			array(
				'label'       => esc_html__( 'Filter by Category Slug', 'rstore' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'e.g., fashion, electronics', 'rstore' ),
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$limit    = intval( $settings['posts_per_page'] );
		$cols     = esc_attr( $settings['columns'] );

		echo '<div class="products-grid cols-' . $cols . ' stagger-children">';

		// If WooCommerce is active, query real database items
		if ( class_exists( 'WooCommerce' ) ) {
			$args = array(
				'limit'   => $limit,
				'status'  => 'publish',
				'orderby' => 'date',
				'order'   => 'DESC',
			);

			if ( ! empty( $settings['category'] ) ) {
				$args['category'] = array( esc_attr( $settings['category'] ) );
			}

			$products = wc_get_products( $args );

			if ( ! empty( $products ) ) {
				foreach ( $products as $product ) {
					$id            = $product->get_id();
					$name          = $product->get_name();
					$price         = $product->get_price();
					$regular_price = $product->get_regular_price();
					$rating        = $product->get_average_rating();
					$reviews       = $product->get_review_count();
					$image_id      = $product->get_image_id();
					$image_url     = $image_id ? wp_get_attachment_image_url( $image_id, 'medium' ) : '';
					$categories    = wc_get_product_category_list( $id );
					
					$discount = 0;
					if ( $regular_price && $price < $regular_price ) {
						$discount = Math.round( ( 1 - $price / $regular_price ) * 100 );
					}
					?>
					<div class="product-card reveal visible" data-product-id="<?php echo esc_attr( $id ); ?>">
						<div class="product-img-wrap">
							<?php if ( $image_url ) : ?>
								<img src="<?php echo esc_url( $image_url ); ?>" class="product-img" alt="<?php echo esc_attr( $name ); ?>">
							<?php else : ?>
								<div style="width:100%;height:100%;background:linear-gradient(135deg,var(--clr-primary-soft),rgba(108,63,232,0.2));display:flex;align-items:center;justify-content:center;font-size:3rem">📦</div>
							<?php endif; ?>
							<div class="product-badges">
								<?php if ( $discount > 0 ) : ?>
									<span class="badge badge-sale">-<?php echo esc_html( $discount ); ?>%</span>
								<?php endif; ?>
							</div>
							<div class="product-actions">
								<button class="product-action-btn" data-wishlist="<?php echo esc_attr( $id ); ?>" title="<?php esc_attr_e( 'Add to Wishlist', 'rstore' ); ?>">♡</button>
								<button class="product-action-btn" data-compare="<?php echo esc_attr( $id ); ?>" title="<?php esc_attr_e( 'Compare', 'rstore' ); ?>">⚖</button>
								<button class="product-action-btn" onclick="window.location='<?php echo esc_url( get_permalink( $id ) ); ?>'" title="<?php esc_attr_e( 'Quick View', 'rstore' ); ?>">👁</button>
							</div>
							<div class="product-quick-add" data-add-to-cart="<?php echo esc_attr( $id ); ?>">🛒 <?php esc_html_e( 'Add to Cart', 'rstore' ); ?></div>
						</div>
						<div class="product-info">
							<div class="product-category"><?php echo $categories; ?></div>
							<a href="<?php echo esc_url( get_permalink( $id ) ); ?>" class="product-name"><?php echo esc_html( $name ); ?></a>
							<div class="product-rating">
								<div class="stars">
									<?php
									for ( $i = 1; $i <= 5; $i ++ ) {
										if ( $i <= floor( $rating ) ) {
											echo '<span class="star">★</span>';
										} elseif ( $i - 0.5 <= $rating ) {
											echo '<span class="star half">★</span>';
										} else {
											echo '<span class="star empty">★</span>';
										}
									}
									?>
								</div>
								<span class="rating-count">(<?php echo esc_html( $reviews ); ?>)</span>
							</div>
							<div class="product-price-row">
								<span class="product-price">$<?php echo esc_html( number_format( (float) $price, 2 ) ); ?></span>
								<?php if ( $regular_price && $price < $regular_price ) : ?>
									<span class="product-price-original">$<?php echo esc_html( number_format( (float) $regular_price, 2 ) ); ?></span>
								<?php endif; ?>
							</div>
						</div>
					</div>
					<?php
				}
			} else {
				echo '<p class="text-muted text-center" style="grid-column: 1/-1; padding: 40px;">' . esc_html__( 'No products found matching your settings.', 'rstore' ) . '</p>';
			}
		} else {
			// Fallback to stylized mock placeholder graphics to demonstrate the grid
			for ( $i = 1; $i <= $limit; $i ++ ) {
				$mock_prices = array( 1 => 129, 2 => 289, 3 => 199, 4 => 85, 5 => 399, 6 => 49, 7 => 79, 8 => 159 );
				$price       = isset( $mock_prices[ $i ] ) ? $mock_prices[ $i ] : 99;
				$emoji_list  = array( 1 => '🎧', 2 => '🧥', 3 => '⌚', 4 => '👟', 5 => '🪑', 6 => '💄', 7 => '🔊', 8 => '⌨️' );
				$emoji       = isset( $emoji_list[ $i ] ) ? $emoji_list[ $i ] : '📦';
				$names       = array( 1 => 'Wireless Headphones', 2 => 'Leather Jacket', 3 => 'Smart Fitness Watch', 4 => 'Running Sneakers', 5 => 'Office Armchair', 6 => 'Matte Lipstick', 7 => 'Bluetooth Speaker', 8 => 'Mechanical Keyboard' );
				$name        = isset( $names[ $i ] ) ? $names[ $i ] : 'R Store Catalog Item';
				?>
				<div class="product-card reveal visible" data-product-id="<?php echo $i; ?>">
					<div class="product-img-wrap">
						<div style="width:100%;height:100%;background:linear-gradient(135deg,rgba(108,63,232,0.1),rgba(108,63,232,0.25));display:flex;align-items:center;justify-content:center;font-size:5rem">
							<?php echo $emoji; ?>
						</div>
						<div class="product-badges">
							<span class="badge badge-sale">NEW</span>
						</div>
						<div class="product-actions">
							<button class="product-action-btn">♡</button>
							<button class="product-action-btn">⚖</button>
							<button class="product-action-btn">👁</button>
						</div>
						<div class="product-quick-add">🛒 <?php esc_html_e( 'Add to Cart', 'rstore' ); ?></div>
					</div>
					<div class="product-info">
						<div class="product-category"><?php esc_html_e( 'PROMOTIONAL', 'rstore' ); ?></div>
						<a href="#" class="product-name"><?php echo esc_html( $name ); ?></a>
						<div class="product-rating">
							<div class="stars">★★★★★</div>
							<span class="rating-count">(<?php echo ( 40 + $i * 12 ); ?>)</span>
						</div>
						<div class="product-price-row">
							<span class="product-price">$<?php echo number_format( $price, 2 ); ?></span>
						</div>
					</div>
				</div>
				<?php
			}
		}

		echo '</div>';
	}
}
