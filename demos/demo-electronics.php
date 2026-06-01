<?php
/**
 * Template Name: Demo - Electronics Niche
 *
 * @package RStore
 */
$uri = get_template_directory_uri();
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> data-theme="dark">
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>R Store | Electronics Niche Demo</title>
  <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>⚡</text></svg>">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=Share+Tech+Mono&display=swap" rel="stylesheet">
  
  <link rel="stylesheet" href="<?php echo esc_url( $uri ); ?>/css/main.css">
  <link rel="stylesheet" href="<?php echo esc_url( $uri ); ?>/css/components.css">
  <link rel="stylesheet" href="<?php echo esc_url( $uri ); ?>/css/animations.css">
  <link rel="stylesheet" href="<?php echo esc_url( $uri ); ?>/css/shop.css">
  <link rel="stylesheet" href="<?php echo esc_url( $uri ); ?>/css/responsive.css">
  <link rel="stylesheet" href="<?php echo esc_url( $uri ); ?>/css/extras.css">
  
  <style>
    :root {
      --clr-primary: #00E5FF; /* Cyber Neon Blue */
      --clr-primary-soft: rgba(0, 229, 255, 0.1);
      --grad-primary: linear-gradient(135deg, #00E5FF 0%, #0083B0 100%);
      --bg-main: #0B0E14;
      --bg-surface: #121824;
      --bg-secondary: #172030;
      --border-color: rgba(0, 229, 255, 0.15);
    }
    body { background-color: var(--bg-main); color: #E2E8F0; }
    .tech-hero { min-height: 80vh; display:flex; align-items:center; background: radial-gradient(circle at 80% 20%, rgba(0, 229, 255, 0.15) 0%, transparent 50%), #0B0E14; border-bottom: 1px solid var(--border-color); }
    .tech-title { font-family: var(--font-display); font-size: clamp(2.5rem, 6vw, 4.5rem); font-weight: 900; line-height: 1.1; margin-bottom: 24px; text-transform: uppercase; letter-spacing: -1px; }
    .tech-title span { background: var(--grad-primary); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
    .tech-mono { font-family: 'Share Tech Mono', monospace; color: var(--clr-primary); font-size: 14px; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 16px; display:block; }
    .spec-badge { background: rgba(0, 229, 255, 0.08); border: 1px solid rgba(0, 229, 255, 0.2); padding: 8px 16px; border-radius: 10px; font-size: 13px; font-weight: 600; display:inline-flex; align-items:center; gap:8px; }
  </style>
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div class="topbar" style="background:#05070A; border-bottom:1px solid rgba(255,255,255,0.05)">
  <div class="container" style="overflow:hidden">
    <div class="topbar-marquee">
      <div class="topbar-item"><span>⚡</span> System Status: All Servers Online</div>
      <div class="topbar-divider">•</div>
      <div class="topbar-item"><span>🚀</span> Next-Gen Silicon Release</div>
      <div class="topbar-divider">•</div>
      <div class="topbar-item"><span>🎟</span> CODE: CYBER20 for 20% Discount</div>
      <div class="topbar-divider">•</div>
      <div class="topbar-item"><span>⚡</span> System Status: All Servers Online</div>
    </div>
  </div>
</div>

<header class="site-header" id="site-header" style="background:rgba(11,14,20,0.8); border-bottom:1px solid var(--border-color)">
  <div class="container">
    <div class="header-inner">
      <button class="mobile-menu-toggle" id="mobile-menu-toggle" aria-label="Open menu"><span></span><span></span><span></span></button>
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo">
        <div class="logo-icon" style="background:var(--grad-primary)">⚡</div>
        <span class="logo-text">R<span> store</span></span>
      </a>
      <div class="header-search">
        <input type="search" class="header-search-input" placeholder="Search components, gear..." autocomplete="off" style="background:#0F131D; border-color:var(--border-color); color:white">
        <button class="header-search-btn">
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

<nav class="main-nav" style="background:#0F131D; border-bottom:1px solid rgba(255,255,255,0.05)">
  <div class="container">
    <ul class="nav-inner">
      <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nav-link">Home</a></li>
      <li><a href="<?php echo esc_url( home_url( '/shop' ) ); ?>" class="nav-link">Shop</a></li>
      <li><a href="<?php echo esc_url( home_url( '/demos/demo-fashion' ) ); ?>" class="nav-link">Fashion Niche</a></li>
      <li><a href="<?php echo esc_url( home_url( '/demos/demo-electronics' ) ); ?>" class="nav-link active">Electronics Niche</a></li>
      <li><a href="<?php echo esc_url( home_url( '/demos/demo-furniture' ) ); ?>" class="nav-link">Furniture Niche</a></li>
    </ul>
  </div>
</nav>

<main>
  <!-- Hero Section -->
  <section class="tech-hero">
    <div class="container">
      <div style="max-width: 650px">
        <span class="tech-mono">⚡ NEXT-GEN SILICON LAUNCH</span>
        <h1 class="tech-title">Quantum <span>Gear</span></h1>
        <p style="font-size:1.2rem; line-height:1.6; opacity:0.8; margin-bottom:32px">Experience raw speed, ultra low latencies, and high performance design. Outfitted with customized active thermal controls and carbon composite plating.</p>
        <div style="display:flex; gap:16px; flex-wrap:wrap">
          <a href="<?php echo esc_url( home_url( '/shop' ) ); ?>" class="btn btn-primary btn-lg" style="background:var(--grad-primary); border-color:var(--clr-primary); color:#0B0E14; font-weight:800">Configure Build</a>
          <a href="<?php echo esc_url( home_url( '/shop?sale=true' ) ); ?>" class="btn btn-outline btn-lg">Explore Specs</a>
        </div>
      </div>
    </div>
  </section>

  <!-- Technical Specs Feature Highlight -->
  <section class="section">
    <div class="container">
      <div class="section-header">
        <h2 class="section-title">Built for <span class="text-gradient" style="background:var(--grad-primary); -webkit-background-clip:text">Power Users</span></h2>
        <p class="section-subtitle">Engineered to outperform under intense industrial and gaming loads.</p>
      </div>

      <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap:32px">
        <div class="glass-card" style="padding: 32px; border-color:var(--border-color)">
          <div style="font-size:2rem; margin-bottom:16px">❄️</div>
          <h3 style="font-family:var(--font-display); font-size:18px; font-weight:800; color:white; margin-bottom:8px">Liquid Metal Cooling</h3>
          <p style="font-size:14px; opacity:0.7; line-height:1.5">Active thermal interface materials offering up to 18x higher thermal conductivity than classic paste.</p>
        </div>

        <div class="glass-card" style="padding: 32px; border-color:var(--border-color)">
          <div style="font-size:2rem; margin-bottom:16px">🏎️</div>
          <h3 style="font-family:var(--font-display); font-size:18px; font-weight:800; color:white; margin-bottom:8px">PCIe Gen 5 Architecture</h3>
          <p style="font-size:14px; opacity:0.7; line-height:1.5">Unleash extreme bandwidth capacities up to 32 GT/s per lane for massive concurrent data loads.</p>
        </div>

        <div class="glass-card" style="padding: 32px; border-color:var(--border-color)">
          <div style="font-size:2rem; margin-bottom:16px">🔋</div>
          <h3 style="font-family:var(--font-display); font-size:18px; font-weight:800; color:white; margin-bottom:8px">Intelligent Power Grid</h3>
          <p style="font-size:14px; opacity:0.7; line-height:1.5">Smart distribution phases and low internal resistance delivering extremely flat voltage ripples.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Curated Collection Grid -->
  <section class="section-sm" style="background:#0F131D; border-top: 1px solid rgba(255,255,255,0.05)">
    <div class="container">
      <div class="section-header">
        <h2 class="section-title">Futuristic Catalog</h2>
        <p class="section-subtitle">Explore high-end audio, computing accessories, and wearables.</p>
      </div>

      <div class="products-grid cols-4" id="tech-products-grid">
        <!-- Rendered dynamically -->
      </div>
    </div>
  </section>
</main>

<footer class="site-footer" style="background:#080A0E; border-top: 1px solid var(--border-color)">
  <div class="container">
    <div class="footer-bottom">
      <div class="footer-copy">© 2026 R Store Tech. All rights reserved.</div>
      <div class="footer-payments">
        <div class="payment-badge">VISA</div>
        <div class="payment-badge">MC</div>
        <div class="payment-badge">PayPal</div>
      </div>
    </div>
  </div>
</footer>

<!-- Compare Bar -->
<div class="compare-bar" style="display:none;position:fixed;bottom:0;left:0;right:0;background:var(--grad-primary);padding:12px 24px;z-index:var(--z-fixed);align-items:center;gap:16px;box-shadow:0 -4px 20px rgba(0, 229, 255,0.2)"></div>

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
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo"><div class="logo-icon" style="background:var(--grad-primary)">⚡</div><span class="logo-text">R<span> store</span></span></a>
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
  const techProducts = [
    { id: 1, name: 'Premium Wireless Headphones', price: 129.99, original: 199.99, rating: 4.8, reviews: 234, category: 'Electronics', emoji: '🎧', color: '#667EEA' },
    { id: 3, name: 'Smart Fitness Watch', price: 199.00, original: 299.00, rating: 4.7, reviews: 456, category: 'Electronics', emoji: '⌚', color: '#F093FB' },
    { id: 8, name: 'Portable Bluetooth Speaker', price: 79.99, original: 120.00, rating: 4.7, reviews: 289, category: 'Electronics', emoji: '🔊', color: '#30CFD0' },
    { id: 11, name: 'Wireless Mechanical Keyboard', price: 159.00, original: 220.00, rating: 4.7, reviews: 98, category: 'Electronics', emoji: '⌨️', color: '#F093FB' },
  ];

  const grid = document.getElementById('tech-products-grid');
  if (grid) {
    grid.innerHTML = techProducts.map(p => `
      <div class="product-card reveal visible" data-product-id="${p.id}" style="background:var(--bg-surface); border:1px solid var(--border-color)">
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
          <a href="<?php echo esc_url( home_url( '/product' ) ); ?>" class="product-name" style="font-size:16px; font-weight:700; color:white">${p.name}</a>
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
