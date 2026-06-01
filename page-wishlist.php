<?php
/**
 * Template Name: Wishlist Page
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
        <span class="breadcrumb-active">Wishlist</span>
      </nav>
      <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:16px">
        <h1 class="page-hero-title">❤️ My Wishlist</h1>
        <div style="display:flex;gap:12px;align-items:center">
          <button class="btn btn-outline" onclick="addAllToCart()">🛒 Add All to Cart</button>
          <button class="btn btn-danger-outline" onclick="clearWishlist()">Clear Wishlist</button>
        </div>
      </div>
    </div>
  </div>

  <div class="section-sm">
    <div class="container">
      <!-- Wishlist Grid -->
      <div class="wishlist-grid products-grid cols-4" id="wishlist-grid">
        <!-- Rendered by Wishlist.renderPage() -->
      </div>

      <!-- Recommended -->
      <div style="margin-top:64px">
        <div class="section-header" style="text-align:left;margin-bottom:32px">
          <h2 class="section-title">You Might Also <span class="text-gradient">Love</span></h2>
          <p class="section-subtitle">Based on your wishlist</p>
        </div>
        <div class="products-grid cols-4" id="recommended-products">
          <!-- Rendered by JS -->
        </div>
      </div>
    </div>
  </div>
</main>

<?php get_footer(); ?>

<script>
function addAllToCart() {
  if (typeof Wishlist !== 'undefined' && typeof Cart !== 'undefined') {
    if (Wishlist.items.length === 0) { Toast.info('Wishlist Empty', 'Add items to your wishlist first.'); return; }
    Wishlist.items.forEach(item => Cart.add(item, 1));
    Toast.success('All Added! 🛒', `${Wishlist.items.length} items added to your cart.`);
  }
}

function clearWishlist() {
  if (typeof Wishlist !== 'undefined') {
    if (!confirm('Clear your entire wishlist?')) return;
    Wishlist.items = [];
    Wishlist.save();
    Toast.info('Wishlist Cleared');
  }
}

document.addEventListener('DOMContentLoaded', () => {
  // Override grid container
  const originalGrid = document.querySelector('.wishlist-grid');
  if (originalGrid && typeof Wishlist !== 'undefined') {
    Wishlist.renderPage();
  }

  // Recommended
  const rec = document.getElementById('recommended-products');
  if (rec && typeof DEMO_PRODUCTS !== 'undefined') {
    rec.innerHTML = DEMO_PRODUCTS.slice(0, 4).map(p => `
      <div class="product-card reveal" data-product-id="${p.id}">
        <div class="product-img-wrap">
          <div style="width:100%;height:100%;background:linear-gradient(135deg,${p.color}33,${p.color}66);display:flex;align-items:center;justify-content:center;font-size:5rem">${p.emoji}</div>
          <div class="product-badges">${p.original ? `<span class="badge badge-sale">-${Math.round((1-p.price/p.original)*100)}%</span>` : ''}</div>
          <div class="product-actions">
            <button class="product-action-btn" data-wishlist="${p.id}" title="Wishlist">♡</button>
          </div>
          <div class="product-quick-add" data-add-to-cart="${p.id}">🛒 Add to Cart</div>
        </div>
        <div class="product-info">
          <div class="product-category">${p.category}</div>
          <a href="<?php echo esc_url( home_url( '/product' ) ); ?>" class="product-name">${p.name}</a>
          <div class="product-price-row" style="margin-top:8px">
            <span class="product-price">$${p.price.toFixed(2)}</span>
            ${p.original ? `<span class="product-price-original">$${p.original.toFixed(2)}</span>` : ''}
          </div>
        </div>
      </div>
    `).join('');
    setTimeout(() => rec.querySelectorAll('.reveal').forEach(el => el.classList.add('visible')), 100);
  }
});
</script>
