<?php
/**
 * Template Name: Demo - Furniture Niche
 *
 * @package RStore
 */
$uri = get_template_directory_uri();
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> data-theme="light">
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>R Store | Furniture Niche Demo</title>
  <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>🪑</text></svg>">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  
  <link rel="stylesheet" href="<?php echo esc_url( $uri ); ?>/css/main.css">
  <link rel="stylesheet" href="<?php echo esc_url( $uri ); ?>/css/components.css">
  <link rel="stylesheet" href="<?php echo esc_url( $uri ); ?>/css/animations.css">
  <link rel="stylesheet" href="<?php echo esc_url( $uri ); ?>/css/shop.css">
  <link rel="stylesheet" href="<?php echo esc_url( $uri ); ?>/css/responsive.css">
  <link rel="stylesheet" href="<?php echo esc_url( $uri ); ?>/css/extras.css">
  
  <style>
    :root {
      --font-body: 'Quicksand', sans-serif;
      --font-display: 'Outfit', sans-serif;
      --clr-primary: #8E7C68; /* Nordic Warm Earth */
      --clr-primary-soft: rgba(142, 124, 104, 0.1);
      --grad-primary: linear-gradient(135deg, #8E7C68 0%, #5C4D3C 100%);
      --bg-main: #FAF8F5;
      --bg-surface: #FFFFFF;
      --bg-secondary: #F3EFEA;
    }
    body { background-color: var(--bg-main); color: #4A4035; }
    .furniture-hero { min-height: 80vh; display:flex; align-items:center; background: linear-gradient(rgba(255,255,255,0.1), rgba(255,255,255,0.1)), url('https://images.unsplash.com/photo-1524758631624-e2822e304c36?q=80&w=1600') center/cover no-repeat; }
    .furniture-title { font-family: var(--font-display); font-size: clamp(3rem, 7vw, 5rem); font-weight: 800; line-height: 1.1; color: #2C251E; margin-bottom: 24px; }
    .furniture-subtitle { font-size: 1.1rem; line-height: 1.6; color: #5C4D3C; margin-bottom: 32px; max-width: 500px; }
  </style>
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div class="topbar" style="background:#8E7C68; color:white">
  <div class="container" style="overflow:hidden">
    <div class="topbar-marquee">
      <div class="topbar-item"><span>🏡</span> Sustainable handcrafting methods</div>
      <div class="topbar-divider">•</div>
      <div class="topbar-item"><span>🚚</span> Free white-glove assembly on premium items</div>
      <div class="topbar-divider">•</div>
      <div class="topbar-item"><span>🔥</span> Summer Cozy Launch</div>
      <div class="topbar-divider">•</div>
      <div class="topbar-item"><span>🏡</span> Sustainable handcrafting methods</div>
    </div>
  </div>
</div>

<header class="site-header" id="site-header" style="background:rgba(250,248,245,0.85); border-bottom:1px solid rgba(142, 124, 104, 0.1)">
  <div class="container">
    <div class="header-inner">
      <button class="mobile-menu-toggle" id="mobile-menu-toggle" aria-label="Open menu"><span></span><span></span><span></span></button>
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo">
        <div class="logo-icon" style="background:var(--grad-primary)">🏡</div>
        <span class="logo-text">R<span> store</span></span>
      </a>
      <div class="header-search">
        <input type="search" class="header-search-input" placeholder="Search home design..." autocomplete="off" style="background:#FFFFFF; border-color:rgba(142, 124, 104, 0.2)">
        <button class="header-search-btn" style="color:var(--clr-primary)">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
        </button>
        <div class="search-dropdown" id="search-dropdown"></div>
      </div>
      <div class="header-actions">
        <button class="theme-toggle" data-theme-toggle>
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>
        </button>
        <a href="<?php echo esc_url( home_url( '/account' ) ); ?>" class="header-action-btn">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
        </a>
        <a href="<?php echo esc_url( home_url( '/wishlist' ) ); ?>" class="header-action-btn">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
          <span class="header-action-badge" data-wishlist-count style="display:none">0</span>
        </a>
        <button class="header-action-btn" data-open-cart>
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
          <span class="header-action-badge" data-cart-count style="display:none">0</span>
        </button>
      </div>
    </div>
  </div>
</header>

<nav class="main-nav" style="background:#FAF8F5; border-bottom:1px solid rgba(142, 124, 104, 0.1)">
  <div class="container">
    <ul class="nav-inner">
      <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nav-link">Home</a></li>
      <li><a href="<?php echo esc_url( home_url( '/shop' ) ); ?>" class="nav-link">Shop</a></li>
      <li><a href="<?php echo esc_url( home_url( '/demos/demo-fashion' ) ); ?>" class="nav-link">Fashion Niche</a></li>
      <li><a href="<?php echo esc_url( home_url( '/demos/demo-electronics' ) ); ?>" class="nav-link">Electronics Niche</a></li>
      <li><a href="<?php echo esc_url( home_url( '/demos/demo-furniture' ) ); ?>" class="nav-link active">Furniture Niche</a></li>
    </ul>
  </div>
</nav>

<main>
  <!-- Hero Section -->
  <section class="furniture-hero">
    <div class="container">
      <div style="max-width: 600px">
        <h1 class="furniture-title">Nordic Living Spaces</h1>
        <p class="furniture-subtitle">Minimalist Scandinavian designs focusing on clean lines, light woods, sustainable production and absolute comfort.</p>
        <div style="display:flex; gap:16px; flex-wrap:wrap">
          <a href="<?php echo esc_url( home_url( '/shop' ) ); ?>" class="btn btn-primary btn-lg" style="background:var(--grad-primary); border-color:var(--clr-primary)">Discover Comforts</a>
          <a href="<?php echo esc_url( home_url( '/shop?sale=true' ) ); ?>" class="btn btn-outline btn-lg" style="color:#2C251E; border-color:#8E7C68">Shop Minimalist</a>
        </div>
      </div>
    </div>
  </section>

  <!-- Niche highlights -->
  <section class="section">
    <div class="container">
      <div class="section-header">
        <h2 class="section-title">Cozy Elements</h2>
        <p class="section-subtitle">Crafted with attention to longevity, textures and natural light.</p>
      </div>

      <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap:32px">
        <div class="glass-card" style="padding: 32px; background:white">
          <div style="font-size:2rem; margin-bottom:16px">🪵</div>
          <h3 style="font-family:var(--font-display); font-size:18px; font-weight:800; color:#2C251E; margin-bottom:8px">Sustainable Wood</h3>
          <p style="font-size:14px; opacity:0.8; line-height:1.5">FSC-certified solid oak, birch, and walnut woods providing long-term structural resilience.</p>
        </div>

        <div class="glass-card" style="padding: 32px; background:white">
          <div style="font-size:2rem; margin-bottom:16px">🐑</div>
          <h3 style="font-family:var(--font-display); font-size:18px; font-weight:800; color:#2C251E; margin-bottom:8px">Organic Fabrics</h3>
          <p style="font-size:14px; opacity:0.8; line-height:1.5">Eco-friendly wools, linum fabrics, and pure cotton layers offering premium breathability.</p>
        </div>

        <div class="glass-card" style="padding: 32px; background:white">
          <div style="font-size:2rem; margin-bottom:16px">✏️</div>
          <h3 style="font-family:var(--font-display); font-size:18px; font-weight:800; color:#2C251E; margin-bottom:8px">Pure Form Designs</h3>
          <p style="font-size:14px; opacity:0.8; line-height:1.5">Award winning shapes removing unnecessary details to focus purely on functional posture.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Curated Collection Grid -->
  <section class="section-sm" style="background:var(--bg-secondary)">
    <div class="container">
      <div class="section-header">
        <h2 class="section-title">Cozy Living Catalog</h2>
        <p class="section-subtitle">Stunning armchairs, office furniture, tables, and home decoration accessories.</p>
      </div>

      <div class="products-grid cols-4" id="furniture-products-grid">
        <!-- Rendered dynamically -->
      </div>
    </div>
  </section>
</main>

<footer class="site-footer" style="background:#3C332A; color:#E3DFD9">
  <div class="container">
    <div class="footer-bottom">
      <div class="footer-copy" style="color:rgba(255,255,255,0.6)">© 2026 R Store Home. All rights reserved.</div>
      <div class="footer-payments">
        <div class="payment-badge">VISA</div>
        <div class="payment-badge">MC</div>
        <div class="payment-badge">PayPal</div>
      </div>
    </div>
  </div>
</footer>

<!-- Compare Bar -->
<div class="compare-bar" style="display:none;position:fixed;bottom:0;left:0;right:0;background:var(--grad-primary);padding:12px 24px;z-index:var(--z-fixed);align-items:center;gap:16px;box-shadow:0 -4px 20px rgba(142, 124, 104,0.2)"></div>

<!-- Cart Drawer -->
<div class="cart-drawer-overlay" id="cart-overlay"></div>
<div class="cart-drawer" id="cart-drawer">
  <div class="cart-drawer-header">
    <div class="cart-drawer-title">🛒 My Cart <span class="cart-drawer-count" data-cart-count>0</span></div>
    <button class="cart-drawer-close" data-close-cart>✕</button>
  </div>
  <div class="cart-drawer-body"></div>
  <div class="cart-drawer-footer">
    <div class="cart-subtotal">
      <span class="cart-subtotal-label">Subtotal</span>
      <span class="cart-subtotal-value">$0.00</span>
    </div>
    <a href="<?php echo esc_url( home_url( '/cart' ) ); ?>" class="btn btn-secondary btn-full mb-4">View Cart</a>
    <a href="<?php echo esc_url( home_url( '/checkout' ) ); ?>" class="btn btn-primary btn-full">Checkout →</a>
  </div>
</div>

<!-- Mobile menu -->
<div class="mobile-menu" id="mobile-menu">
  <div class="mobile-menu-overlay"></div>
  <div class="mobile-menu-panel">
    <div class="mobile-nav-header">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo"><div class="logo-icon" style="background:var(--grad-primary)">🏡</div><span class="logo-text">R<span> store</span></span></a>
      <button class="cart-drawer-close" onclick="RStore.closeMobileMenu()">✕</button>
    </div>
    <div class="mobile-nav-links">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="mobile-nav-link">🏠 Home</a>
      <a href="<?php echo esc_url( home_url( '/shop' ) ); ?>" class="mobile-nav-link">🛍 Shop</a>
      <a href="<?php echo esc_url( home_url( '/wishlist' ) ); ?>" class="mobile-nav-link">❤️ Wishlist</a>
      <a href="<?php echo esc_url( home_url( '/account' ) ); ?>" class="mobile-nav-link">👤 Account</a>
    </div>
  </div>
</div>

<button class="back-to-top" id="back-to-top">↑</button>
<div class="toast-container" id="toast-container"></div>

<script src="<?php echo esc_url( $uri ); ?>/js/app.js"></script>
<script src="<?php echo esc_url( $uri ); ?>/js/cart.js"></script>
<script src="<?php echo esc_url( $uri ); ?>/js/wishlist.js"></script>
<script src="<?php echo esc_url( $uri ); ?>/js/sales-booster.js"></script>

<script>
function renderStars(rating) {
  return '★'.repeat(Math.floor(rating)) + (rating % 1 ? '<span class="star half">★</span>' : '') + '★'.repeat(5 - Math.ceil(rating));
}

document.addEventListener('DOMContentLoaded', () => {
  const furnitureProducts = [
    { id: 6, name: 'Ergonomic Office Chair', price: 399.00, original: 599.00, rating: 4.5, reviews: 67, category: 'Furniture', emoji: '🪑', color: '#FA709A' },
    { id: 12, name: 'Natural Beeswax Candle Set', price: 28.00, original: 40.00, rating: 4.8, reviews: 203, category: 'Home', emoji: '🕯️', color: '#4FACFE' },
    { id: 15, name: 'Minimalist Dining Table', price: 499.00, original: 699.00, rating: 4.9, reviews: 42, category: 'Furniture', emoji: '🪵', color: '#8E7C68' },
    { id: 16, name: 'Woven Cotton Rug', price: 85.00, original: 120.00, rating: 4.7, reviews: 114, category: 'Home', emoji: '🧶', color: '#FAF8F5' },
  ];

  const grid = document.getElementById('furniture-products-grid');
  if (grid) {
    grid.innerHTML = furnitureProducts.map(p => `
      <div class="product-card reveal visible" data-product-id="${p.id}" style="background:var(--bg-surface); border:1px solid rgba(142, 124, 104, 0.1)">
        <div class="product-img-wrap">
          <div style="width:100%;height:100%;background:linear-gradient(135deg,${p.color}22,${p.color}44);display:flex;align-items:center;justify-content:center;font-size:5rem">
            ${p.emoji}
          </div>
          <div class="product-badges">
            ${p.original ? `<span class="badge badge-sale">-${Math.round((1-p.price/p.original)*100)}%</span>` : ''}
          </div>
          <div class="product-actions">
            <button class="product-action-btn" data-wishlist="${p.id}" title="Wishlist">♡</button>
            <button class="product-action-btn" data-compare="${p.id}" title="Compare">⚖</button>
            <button class="product-action-btn" onclick="window.location='<?php echo esc_url( home_url( '/product' ) ); ?>'" title="View">👁</button>
          </div>
          <div class="product-quick-add" data-add-to-cart="${p.id}">🛒 Add to Cart</div>
        </div>
        <div class="product-info">
          <div class="product-category" style="color:var(--clr-primary)">${p.category}</div>
          <a href="<?php echo esc_url( home_url( '/product' ) ); ?>" class="product-name" style="font-size:16px; font-weight:700; color:#2C251E">${p.name}</a>
          <div class="product-rating">
            <div class="stars" style="color:var(--clr-warning);display:flex">${renderStars(p.rating)}</div>
            <span class="rating-count">(${p.reviews})</span>
          </div>
          <div class="product-price-row">
            <span class="product-price" style="color:var(--clr-primary)">$${p.price.toFixed(2)}</span>
            ${p.original ? `<span class="product-price-original">$${p.original.toFixed(2)}</span>` : ''}
          </div>
        </div>
      </div>
    `).join('');
  }
});
</script>
<?php wp_footer(); ?>
</body>
</html>
