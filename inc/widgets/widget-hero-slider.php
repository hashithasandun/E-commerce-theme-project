<?php
/**
 * Elementor Widget: Premium Hero Slider
 *
 * @package RStore
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class RStore_Elementor_Hero_Slider_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'rstore_hero_slider';
	}

	public function get_title() {
		return esc_html__( 'Hero Slider Pro', 'rstore' );
	}

	public function get_icon() {
		return 'eicon-slides';
	}

	public function get_categories() {
		return array( 'rstore-elements' );
	}

	protected function register_controls() {
		// Content Tab
		$this->start_controls_section(
			'content_section',
			array(
				'label' => esc_html__( 'Slider Content', 'rstore' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'label',
			array(
				'label'       => esc_html__( 'Promotional Tag', 'rstore' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__( '🔥 Best Seller — Limited Time', 'rstore' ),
				'placeholder' => esc_html__( 'Enter upper badge label', 'rstore' ),
			)
		);

		$this->add_control(
			'title',
			array(
				'label'       => esc_html__( 'Main Title', 'rstore' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__( 'Premium Wireless Headphones Pro X', 'rstore' ),
				'placeholder' => esc_html__( 'Enter slider title', 'rstore' ),
			)
		);

		$this->add_control(
			'description',
			array(
				'label'       => esc_html__( 'Description', 'rstore' ),
				'type'        => \Elementor\Controls_Manager::TEXTAREA,
				'default'     => esc_html__( 'Experience crystal-clear audio with active noise cancellation. 40-hour battery life, premium comfort, studio-quality sound.', 'rstore' ),
				'placeholder' => esc_html__( 'Enter description text', 'rstore' ),
			)
		);

		$this->add_control(
			'btn_label',
			array(
				'label'       => esc_html__( 'Button Label', 'rstore' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__( 'Shop Now — $129', 'rstore' ),
				'placeholder' => esc_html__( 'Enter button label', 'rstore' ),
			)
		);

		$this->add_control(
			'btn_link',
			array(
				'label'   => esc_html__( 'Button Link', 'rstore' ),
				'type'    => \Elementor\Controls_Manager::URL,
				'default' => array(
					'url' => '#',
				),
			)
		);

		$this->add_control(
			'original_price',
			array(
				'label'   => esc_html__( 'Original Strikethrough Price', 'rstore' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '$199', 'rstore' ),
			)
		);

		$this->add_control(
			'discount_label',
			array(
				'label'   => esc_html__( 'Discount Percentage Badge', 'rstore' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Save 35%', 'rstore' ),
			)
		);

		$this->add_control(
			'emoji',
			array(
				'label'   => esc_html__( 'Floating Emoji Promoter', 'rstore' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '🎧', 'rstore' ),
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
		<div class="hero-slide animate-fadeIn" style="min-height:500px;background:linear-gradient(135deg,#0F0F1A 0%,#1A1A2E 40%,#16213E 100%);margin-bottom:32px">
			<div class="blob blob-purple" style="width:400px;height:400px;top:-100px;right:-100px;opacity:0.3"></div>
			<div class="blob blob-pink" style="width:300px;height:300px;bottom:-50px;right:200px;opacity:0.2"></div>
			<div class="hero-overlay" style="background:linear-gradient(to right, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0.3) 70%, transparent 100%)"></div>

			<div style="position:absolute;right:10%;top:50%;transform:translateY(-50%);font-size:12rem;opacity:0.9;animation:float 4s ease-in-out infinite;filter:drop-shadow(0 20px 40px rgba(108,63,232,0.4));z-index:2">
				<?php echo esc_html( $settings['emoji'] ); ?>
			</div>

			<div class="hero-content" style="z-index: 3">
				<?php if ( ! empty( $settings['label'] ) ) : ?>
					<div class="hero-label animate-fadeInLeft delay-100">
						<?php echo esc_html( $settings['label'] ); ?>
					</div>
				<?php endif; ?>

				<?php if ( ! empty( $settings['title'] ) ) : ?>
					<h1 class="hero-title animate-fadeInUp delay-200" style="color:white">
						<?php echo esc_html( $settings['title'] ); ?>
					</h1>
				<?php endif; ?>

				<?php if ( ! empty( $settings['description'] ) ) : ?>
					<p class="hero-desc animate-fadeInUp delay-300">
						<?php echo esc_html( $settings['description'] ); ?>
					</p>
				<?php endif; ?>

				<div class="hero-actions animate-fadeInUp delay-400">
					<?php if ( ! empty( $settings['btn_label'] ) ) : ?>
						<a href="<?php echo esc_url( $settings['btn_link']['url'] ); ?>" class="btn btn-primary btn-lg">
							<?php echo esc_html( $settings['btn_label'] ); ?>
						</a>
					<?php endif; ?>

					<?php if ( ! empty( $settings['original_price'] ) ) : ?>
						<div class="hero-price-tag animate-scaleIn delay-500">
							<span class="hero-price-label"><?php esc_html_e( 'Original Price', 'rstore' ); ?></span>
							<span class="hero-price-value" style="text-decoration:line-through;color:var(--text-muted)"><?php echo esc_html( $settings['original_price'] ); ?></span>
							<span style="font-size:12px;color:var(--clr-success);font-weight:700"><?php echo esc_html( $settings['discount_label'] ); ?></span>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<?php
	}
}
