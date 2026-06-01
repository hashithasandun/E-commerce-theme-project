<?php
/**
 * Template Name: Demo - Fashion Niche
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
  <title>R Store | Fashion Niche Demo</title>
  <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>👗</text></svg>">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  
  <link rel="stylesheet" href="<?php echo esc_url( $uri ); ?>/css/main.css">
  <link rel="stylesheet" href="<?php echo esc_url( $uri ); ?>/css/components.css">
  <link rel="stylesheet" href="<?php echo esc_url( $uri ); ?>/css/animations.css">
  <link rel="stylesheet" href="<?php echo esc_url( $uri ); ?>/css/shop.css">
  <link rel="stylesheet" href="<?php echo esc_url( $uri ); ?>/css/responsive.css">
  <link rel="stylesheet" href="<?php echo esc_url( $uri ); ?>/css/extras.css">
  
  <style>
    :root {
      --font-display: 'Playfair Display', serif;
      --clr-primary: #D4AF37; /* Luxury Gold */
      --clr-primary-soft: rgba(212, 175, 55, 0.1);
      --grad-primary: linear-gradient(135deg, #D4AF37 0%, #AA7C11 100%);
    }
    .fashion-hero { min-height: 80vh; display:flex; align-items:center; background: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)), url('<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/demos/fashion-hero.jpg') center/cover no-repeat; color:white; }
    .fashion-title { font-family: var(--font-display); font-size: clamp(3rem, 8vw, 6rem); font-weight: 900; line-height: 1.1; margin-bottom: 24px; text-shadow: 0 4px 20px rgba(0,0,0,0.3); }
    .lookbook-card { position:relative; overflow:hidden; border-radius:24px; aspect-ratio: 3/4; }
    .lookbook-img { width:100%; height:100%; object-fit:cover; transition: transform 0.8s ease; }
    .lookbook-card:hover .lookbook-img { transform: scale(1.08); }
    .lookbook-overlay { position:absolute; inset:0; background: linear-gradient(to top, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0.1) 70%); display:flex; flex-direction:column; justify-content:flex-end; padding:32px; color:white; }
  </style>
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div class="topbar">
  <div class="container" style="overflow:hidden">
    <div class="topbar-marquee">
      <div class="topbar-item"><span>✨</span> Paris Fashion Week Collection Now Live</div>
      <div class="topbar-divider">•</div>
      <div class="topbar-item"><span>🚚</span> Worldwide express delivery</div>
      <div class="topbar-divider">•</div>
      <div class="topbar-item"><span>🎟</span> Use coupon FASHION20 for 20% off</div>
      <div class="topbar-divider">•</div>
      <div class="topbar-item"><span>✨</span> Paris Fashion Week Collection Now Live</div>
    </div>
  </div>
</div>

<header class="site-header" id="site-header">
  <div class="container">
    <div class="header-inner">
      <button class="mobile-menu-toggle" id="mobile-menu-toggle" aria-label="Open menu"><span></span><span></span><span></span></button>
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo">
        <div class="logo-icon" style="background:var(--grad-primary)">F</div>
        <span class="logo-text">R<span> store</span></span>
      </a>
      <div class="header-search">
        <input type="search" class="header-search-input" placeholder="Search style catalog..." autocomplete="off">
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

<nav class="main-nav">
  <div class="container">
    <ul class="nav-inner">
      <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nav-link">Home</a></li>
      <li><a href="<?php echo esc_url( home_url( '/shop' ) ); ?>" class="nav-link">Shop</a></li>
      <li><a href="<?php echo esc_url( home_url( '/demos/demo-fashion' ) ); ?>" class="nav-link active">Fashion Niche</a></li>
      <li><a href="<?php echo esc_url( home_url( '/demos/demo-electronics' ) ); ?>" class="nav-link">Electronics Niche</a></li>
      <li><a href="<?php echo esc_url( home_url( '/demos/demo-furniture' ) ); ?>" class="nav-link">Furniture Niche</a></li>
    </ul>
  </div>
</nav>

<main>
  <!-- Hero Section -->
  <section class="fashion-hero">
    <div class="container">
      <div style="max-width: 650px">
        <span class="badge badge-sale" style="background:var(--clr-primary); font-size:12px; padding:6px 12px; margin-bottom:20px; font-weight:700">EXCLUSIVE LAUNCH</span>
        <h1 class="fashion-title">Summer Elegance</h1>
        <p style="font-size:1.2rem; line-height:1.6; opacity:0.9; margin-bottom:32px">Redefining modern silhouettes with organic breathable linen fabric. Handcrafted luxury items designed for the warm breeze.</p>
        <div style="display:flex; gap:16px; flex-wrap:wrap">
          <a href="<?php echo esc_url( home_url( '/shop' ) ); ?>" class="btn btn-primary btn-lg" style="background:var(--grad-primary); border-color:var(--clr-primary)">Discover Lookbook</a>
          <a href="<?php echo esc_url( home_url( '/shop?sale=true' ) ); ?>" class="btn btn-outline-white btn-lg">Shop the Sale</a>
        </div>
      </div>
    </div>
  </section>

  <!-- Lookbooks -->
  <section class="section">
    <div class="container">
      <div class="section-header">
        <h2 class="section-title" style="font-family:var(--font-display); font-size:2.8rem">Seasonal <span class="text-gradient" style="background:var(--grad-primary); -webkit-background-clip:text">Lookbooks</span></h2>
        <p class="section-subtitle">Curated capsule wardrobes designed by international stylists.</p>
      </div>

      <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap:32px">
        <div class="lookbook-card reveal">
          <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/demos/lookbook-boho.jpg" class="lookbook-img" alt="Boho Beach">
          <div class="lookbook-overlay">
            <span style="font-size:11px; text-transform:uppercase; font-weight:700; letter-spacing:1px; color:var(--clr-primary)">Collection 01</span>
            <h3 style="font-family:var(--font-display); font-size:1.8rem; font-weight:800; margin-top:8px">Bohemian Breeze</h3>
            <p style="font-size:13px; opacity:0.8; margin-top:8px; margin-bottom:16px">Free flowing silhouettes, floral prints and organic textures.</p>
            <a href="<?php echo esc_url( home_url( '/shop' ) ); ?>" class="btn btn-sm btn-white" style="align-self:flex-start">View Lookbook</a>
          </div>
        </div>

        <div class="lookbook-card reveal">
          <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/demos/lookbook-mini.jpg" class="lookbook-img" alt="Minimalist">
          <div class="lookbook-overlay">
            <span style="font-size:11px; text-transform:uppercase; font-weight:700; letter-spacing:1px; color:var(--clr-primary)">Collection 02</span>
            <h3 style="font-family:var(--font-display); font-size:1.8rem; font-weight:800; margin-top:8px">Modern Tailoring</h3>
            <p style="font-size:13px; opacity:0.8; margin-top:8px; margin-bottom:16px">Sleek blazers, structured trousers and clean architectural cuts.</p>
            <a href="<?php echo esc_url( home_url( '/shop' ) ); ?>" class="btn btn-sm btn-white" style="align-self:flex-start">View Lookbook</a>
          </div>
        </div>

        <div class="lookbook-card reveal">
          <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/demos/lookbook-casual.jpg" class="lookbook-img" alt="Casual">
          <div class="lookbook-overlay">
            <span style="font-size:11px; text-transform:uppercase; font-weight:700; letter-spacing:1px; color:var(--clr-primary)">Collection 03</span>
            <h3 style="font-family:var(--font-display); font-size:1.8rem; font-weight:800; margin-top:8px">Linen Essentials</h3>
            <p style="font-size:13px; opacity:0.8; margin-top:8px; margin-bottom:16px">Premium lightweight layers tailored for effortless everyday styling.</p>
            <a href="<?php echo esc_url( home_url( '/shop' ) ); ?>" class="btn btn-sm btn-white" style="align-self:flex-start">View Lookbook</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Curated Collection Grid -->
  <section class="section-sm" style="background:var(--bg-secondary)">
    <div class="container">
      <div class="section-header">
        <h2 class="section-title" style="font-family:var(--font-display)">Shop the <span style="font-style:italic">Collection</span></h2>
        <p class="section-subtitle">Chic luxury apparel items currently trending in high fashion.</p>
      </div>

      <div class="products-grid cols-4" id="fashion-products-grid">
        <!-- Rendered dynamically -->
      </div>
    </div>
  </section>
</main>

<footer class="site-footer">
  <div class="container">
    <div class="footer-bottom">
      <div class="footer-copy">© 2026 R Store Fashion. All rights reserved.</div>
      <div class="footer-payments">
        <div class="payment-badge">VISA</div>
        <div class="payment-badge">MC</div>
        <div class="payment-badge">PayPal</div>
      </div>
    </div>
  </div>
</footer>

<!-- Compare Bar -->
<div class="compare-bar" style="display:none;position:fixed;bottom:0;left:0;right:0;background:var(--grad-primary);padding:12px 24px;z-index:var(--z-fixed);align-items:center;gap:16px;box-shadow:0 -4px 20px rgba(108,63,232,0.3)"></div>

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
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo"><div class="logo-icon" style="background:var(--grad-primary)">F</div><span class="logo-text">R<span> store</span></span></a>
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
  const fashionProducts = [
    { id: 2, name: 'Designer Leather Jacket', price: 289.00, original: 420.00, rating: 4.9, reviews: 89, category: 'Fashion', emoji: '🧥', color: '#764BA2' },
    { id: 9, name: 'Merino Wool Sweater', price: 110.00, original: 160.00, rating: 4.6, reviews: 143, category: 'Fashion', emoji: '🧶', color: '#667EEA' },
    { id: 13, name: 'High-Waist Linen Trousers', price: 75.00, original: 99.00, rating: 4.8, reviews: 34, category: 'Fashion', emoji: '👖', color: '#E2B07E' },
    { id: 14, name: 'Silk Summer Dress', price: 185.00, original: 240.00, rating: 4.9, reviews: 62, category: 'Fashion', emoji: '👗', color: '#EC4899' },
  ];

  const grid = document.getElementById('fashion-products-grid');
  if (grid) {
    grid.innerHTML = fashionProducts.map(p => `
      <div class="product-card reveal visible" data-product-id="${p.id}">
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
          <a href="<?php echo esc_url( home_url( '/product' ) ); ?>" class="product-name" style="font-family:var(--font-display); font-size:16px; font-weight:700">${p.name}</a>
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
