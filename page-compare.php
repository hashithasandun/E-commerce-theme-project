<?php
/**
 * Template Name: Compare Page
 *
 * @package RStore
 */

get_header(); ?>

<main>
  <div class="page-hero">
    <div class="container">
      <nav class="breadcrumb">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="breadcrumb-item">Home</a>
        <span class="breadcrumb-sep">/</span>
        <span class="breadcrumb-active">Compare Products</span>
      </nav>
      <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:16px">
        <h1 class="page-hero-title">⚖️ Compare Products</h1>
        <button class="btn btn-outline btn-sm" onclick="if(typeof Compare !== 'undefined'){Compare.clear();}">Clear All</button>
      </div>
    </div>
  </div>

  <div class="section-sm">
    <div class="container">
      <!-- Glassmorphic comparison card -->
      <div class="glass-card" style="padding: 24px; overflow-x: auto;">
        <div class="compare-products-table">
          <!-- Rendered dynamically by Compare.renderPage() inside compare.js -->
        </div>
      </div>
    </div>
  </div>
</main>

<?php get_footer(); ?>

<script>
document.addEventListener('DOMContentLoaded', () => {
  if (typeof Compare !== 'undefined') {
    Compare.renderPage();
  }
});
</script>
