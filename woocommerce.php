<?php
/**
 * The template for displaying WooCommerce content
 *
 * This is the fallback template when WooCommerce overrides are loaded natively.
 *
 * @package RStore
 */

get_header(); ?>

<main id="primary" class="site-main section">
	<div class="container">
		<div class="glass-card" style="padding: 40px; border: 1px solid var(--border-color)">
			<?php woocommerce_content(); ?>
		</div>
	</div>
</main>

<?php
get_footer();
