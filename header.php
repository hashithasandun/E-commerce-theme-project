<!DOCTYPE html>
<html <?php language_attributes(); ?> data-theme="light">
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>🛍</text></svg>">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<?php wp_body_open(); ?>

<!-- Announcement Topbar -->
<div class="topbar">
  <div class="container" style="overflow:hidden">
    <div class="topbar-marquee">
      <div class="topbar-item">🚚 Free shipping over $100</div>
      <div class="topbar-divider">•</div>
      <div class="topbar-item">🔥 Summer Sale — Up to 60% OFF</div>
      <div class="topbar-divider">•</div>
      <div class="topbar-item">🎁 Free gift with orders over $150</div>
      <div class="topbar-divider">•</div>
      <div class="topbar-item">🚚 Free shipping over $100</div>
      <div class="topbar-divider">•</div>
      <div class="topbar-item">🔥 Summer Sale — Up to 60% OFF</div>
    </div>
  </div>
</div>

<!-- Main Site Header -->
<header class="site-header" id="site-header">
  <div class="container">
    <div class="header-inner">
      <button class="mobile-menu-toggle" id="mobile-menu-toggle" aria-label="Open menu"><span></span><span></span><span></span></button>
      
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo">
        <div class="logo-icon">R</div>
        <span class="logo-text">R<span> store</span></span>
      </a>

      <!-- Search Area -->
      <div class="header-search">
        <form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" style="display:flex; width:100%">
          <input type="search" name="s" class="header-search-input" placeholder="Search products, brands..." autocomplete="off" value="<?php echo get_search_query(); ?>">
          <button type="submit" class="header-search-btn">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
              <circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/>
            </svg>
          </button>
        </form>
        <div class="search-dropdown" id="search-dropdown"></div>
      </div>

      <!-- Action Buttons -->
      <div class="header-actions">
        <button class="theme-toggle" data-theme-toggle aria-label="Toggle dark mode">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/>
          </svg>
        </button>

        <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'account' ) ) ); ?>" class="header-action-btn" title="Account">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>
          </svg>
        </a>

        <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'wishlist' ) ) ); ?>" class="header-action-btn" title="Wishlist">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
          </svg>
          <span class="header-action-badge" data-wishlist-count style="display:none">0</span>
        </a>

        <button class="header-action-btn" data-open-cart title="Cart">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/>
          </svg>
          <span class="header-action-badge" data-cart-count style="display:none">0</span>
        </button>
      </div>
    </div>
  </div>
</header>

<!-- Main Navigation -->
<nav class="main-nav">
  <div class="container">
    <ul class="nav-inner">
      <li class="nav-item"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nav-link"><?php esc_html_e( 'Home', 'rstore' ); ?></a></li>
      <li class="nav-item"><a href="<?php echo esc_url( home_url( '/shop' ) ); ?>" class="nav-link"><?php esc_html_e( 'Shop', 'rstore' ); ?></a></li>
      <li class="nav-item"><a href="<?php echo esc_url( home_url( '/shop?sale=true' ) ); ?>" class="nav-link"><?php esc_html_e( 'Sale', 'rstore' ); ?> <span class="nav-badge hot">HOT</span></a></li>
      <li class="nav-item"><a href="<?php echo esc_url( home_url( '/vendor' ) ); ?>" class="nav-link"><?php esc_html_e( 'Vendor Dashboard', 'rstore' ); ?></a></li>
      <li class="nav-item"><a href="<?php echo esc_url( home_url( '/compare' ) ); ?>" class="nav-link"><?php esc_html_e( 'Compare', 'rstore' ); ?></a></li>
    </ul>
  </div>
</nav>
