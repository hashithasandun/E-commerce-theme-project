<?php
/**
 * Elementor Widget: Sales Urgency Booster
 *
 * @package RStore
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class RStore_Elementor_Sales_Booster_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'rstore_sales_booster';
	}

	public function get_title() {
		return esc_html__( 'Sales Urgency Booster', 'rstore' );
	}

	public function get_icon() {
		return 'eicon-price-table';
	}

	public function get_categories() {
		return array( 'rstore-elements' );
	}

	protected function register_controls() {
		$this->start_controls_section(
			'content_section',
			array(
				'label' => esc_html__( 'Booster Settings', 'rstore' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'booster_type',
			array(
				'label'   => esc_html__( 'Booster Module Type', 'rstore' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'viewer_count',
				'options' => array(
					'viewer_count' => esc_html__( 'Live Viewers Counter Dot', 'rstore' ),
					'stock_bar'    => esc_html__( 'Low Inventory Urgency Bar', 'rstore' ),
					'sales_ticker' => esc_html__( 'Real-time Sales Ticker Banner', 'rstore' ),
				),
			)
		);

		$this->add_control(
			'min_value',
			array(
				'label'   => esc_html__( 'Min Pulse Limit', 'rstore' ),
				'type'    => \Elementor\Controls_Manager::NUMBER,
				'default' => 12,
			)
		);

		$this->add_control(
			'max_value',
			array(
				'label'   => esc_html__( 'Max Pulse Limit', 'rstore' ),
				'type'    => \Elementor\Controls_Manager::NUMBER,
				'default' => 48,
			)
		);

		$this->add_control(
			'stock_total',
			array(
				'label'     => esc_html__( 'Total Mock Stock Value', 'rstore' ),
				'type'      => \Elementor\Controls_Manager::NUMBER,
				'default'   => 10,
				'condition' => array(
					'booster_type' => 'stock_bar',
				),
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$type     = esc_attr( $settings['booster_type'] );
		$min      = intval( $settings['min_value'] );
		$max      = intval( $settings['max_value'] );
		$val      = rand( $min, $max );

		if ( 'viewer_count' === $type ) {
			?>
			<div style="margin: 20px 0;">
				<div class="viewer-count">
					<div class="viewer-dot"></div>
					<span>
						<strong><?php echo esc_html( $val ); ?></strong> 
						<?php esc_html_e( 'shoppers are actively viewing this deal!', 'rstore' ); ?>
					</span>
				</div>
			</div>
			<?php
		} elseif ( 'stock_bar' === $type ) {
			$stock = intval( $settings['stock_total'] );
			$percent = round( ( $stock / 20 ) * 100 );
			?>
			<div style="margin: 24px 0; max-width: 400px;">
				<div style="display:flex; justify-content:space-between; font-size:12px; font-weight:700; color:var(--clr-danger); margin-bottom:8px">
					<span>🔥 <?php esc_html_e( 'Hurry! Only a few items left in stock!', 'rstore' ); ?></span>
					<span><?php echo esc_html( $stock ); ?> <?php esc_html_e( 'left', 'rstore' ); ?></span>
				</div>
				<div style="width:100%; height:8px; background:var(--bg-secondary); border-radius:4px; overflow:hidden; border:1px solid var(--border-color)">
					<div style="width:<?php echo esc_attr( $percent ); ?>%; height:100%; background:linear-gradient(to right, #FF4757, #FF6B6B); border-radius:4px;"></div>
				</div>
			</div>
			<?php
		} elseif ( 'sales_ticker' === $type ) {
			?>
			<div style="background:var(--clr-primary-soft); border-top:1px solid var(--border-light); border-bottom:1px solid var(--border-light); padding:10px 0; margin-bottom:32px">
				<div class="container" style="display:flex; align-items:center; gap:16px">
					<div style="flex-shrink:0; font-size:12px; font-weight:700; color:var(--clr-primary); white-space:nowrap">🔥 <?php esc_html_e( 'RECENT PURCHASE:', 'rstore' ); ?></div>
					<div style="font-size:13px; color:var(--text-secondary)">
						<strong>Sarah</strong> from Paris, France just purchased a **Wireless Headphones Pro X**! (2 minutes ago)
					</div>
				</div>
			</div>
			<?php
		}
	}
}
