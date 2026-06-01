<!-- Global Footer -->
<footer class="site-footer">
  <div class="container">
    <div class="footer-grid">
      <div class="footer-brand">
        <div class="footer-logo">
          <div class="logo-icon">R</div>
          <span class="footer-logo-text">R store</span>
        </div>
        <p class="footer-desc">Your ultimate shopping destination for premium products with amazing deals.</p>
        <div class="footer-social">
          <a href="#" class="social-btn">f</a>
          <a href="#" class="social-btn">t</a>
          <a href="#" class="social-btn">ig</a>
        </div>
      </div>
      <div>
        <div class="footer-col-title"><?php esc_html_e( 'Quick Links', 'rstore' ); ?></div>
        <div class="footer-links">
          <a href="<?php echo esc_url( home_url( '/shop' ) ); ?>" class="footer-link"><?php esc_html_e( 'All Products', 'rstore' ); ?></a>
          <a href="<?php echo esc_url( home_url( '/shop?sale=true' ) ); ?>" class="footer-link"><?php esc_html_e( 'Sale', 'rstore' ); ?></a>
          <a href="<?php echo esc_url( home_url( '/account' ) ); ?>" class="footer-link"><?php esc_html_e( 'My Account', 'rstore' ); ?></a>
          <a href="<?php echo esc_url( home_url( '/cart' ) ); ?>" class="footer-link"><?php esc_html_e( 'Cart', 'rstore' ); ?></a>
        </div>
      </div>
      <div>
        <div class="footer-col-title"><?php esc_html_e( 'Help', 'rstore' ); ?></div>
        <div class="footer-links">
          <a href="#" class="footer-link"><?php esc_html_e( 'Contact Us', 'rstore' ); ?></a>
          <a href="#" class="footer-link"><?php esc_html_e( 'FAQ', 'rstore' ); ?></a>
          <a href="#" class="footer-link"><?php esc_html_e( 'Returns', 'rstore' ); ?></a>
        </div>
      </div>
      <div>
        <div class="footer-col-title">Newsletter</div>
        <p style="font-size:13px;color:#6666AA;margin-bottom:12px">Get 10% off your first order</p>
        <div class="footer-newsletter-form">
          <input type="email" class="footer-newsletter-input" placeholder="Your email...">
          <button class="btn btn-primary btn-sm">Go</button>
        </div>
      </div>
    </div>
    
    <div class="footer-bottom">
      <div class="footer-copy">© <?php echo date('Y'); ?> R store. All rights reserved. Created by Ravanora Technologies.</div>
      <div class="footer-payments">
        <div class="payment-badge">VISA</div>
        <div class="payment-badge">MC</div>
        <div class="payment-badge">PayPal</div>
      </div>
    </div>
  </div>
</footer>

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

<!-- Mobile Menu -->
<div class="mobile-menu" id="mobile-menu">
  <div class="mobile-menu-overlay"></div>
  <div class="mobile-menu-panel">
    <div class="mobile-nav-header">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo">
        <div class="logo-icon">R</div>
        <span class="logo-text">R<span> store</span></span>
      </a>
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

<div class="sales-popup" id="sales-popup"></div>
<div class="compare-bar" style="display:none;position:fixed;bottom:0;left:0;right:0;background:var(--grad-primary);padding:12px 24px;z-index:var(--z-fixed);align-items:center;gap:16px;box-shadow:0 -4px 20px rgba(108,63,232,0.3)"></div>
<button class="back-to-top" id="back-to-top">↑</button>

<?php wp_footer(); ?>
</body>
</html>
