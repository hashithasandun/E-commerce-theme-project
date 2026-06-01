<?php
/**
 * Template Name: Cart Page
 *
 * @package RStore
 */

get_header(); ?>

<main>
  <!-- Breadcrumb -->
  <div class="container">
    <nav class="breadcrumb">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="breadcrumb-item">Home</a>
      <span class="breadcrumb-sep">/</span>
      <span class="breadcrumb-active">Shopping Cart</span>
    </nav>
  </div>

  <div class="section-sm">
    <div class="container">
      <h1 style="font-family:var(--font-display);font-size:2rem;font-weight:900;margin-bottom:32px">🛒 My Cart</h1>

      <!-- Shipping Progress -->
      <div style="background:var(--clr-primary-soft);border:1px solid var(--border-light);border-radius:16px;padding:20px 24px;margin-bottom:32px">
        <div class="cart-progress-text" style="text-align:center;margin-bottom:12px" data-shipping-text></div>
        <div class="cart-progress-bar">
          <div class="cart-progress-fill" data-shipping-progress style="width:0%"></div>
        </div>
      </div>

      <div class="cart-layout cart-content">

        <!-- Cart Items -->
        <div>
          <div style="background:var(--bg-card);border-radius:20px;border:1px solid var(--border-color);overflow:hidden;box-shadow:var(--shadow-card)">
            <div style="padding:20px 24px;border-bottom:1px solid var(--border-color);display:flex;align-items:center;justify-content:space-between">
              <span style="font-size:16px;font-weight:700">Cart Items (<span data-cart-count>0</span>)</span>
              <button onclick="if(confirm('Clear cart?')) Cart.clear()" style="font-size:13px;color:var(--clr-danger);font-weight:600;cursor:pointer">Clear All</button>
            </div>
            <table class="cart-table" style="width:100%">
              <thead>
                <tr>
                  <th>Product</th>
                  <th>Price</th>
                  <th>Quantity</th>
                  <th>Total</th>
                  <th></th>
                </tr>
              </thead>
              <tbody class="cart-table-body">
                <!-- Rendered by Cart.updateCartPage() -->
              </tbody>
            </table>
          </div>

          <!-- Continue Shopping & Update -->
          <div style="display:flex;gap:16px;margin-top:20px;flex-wrap:wrap">
            <a href="<?php echo esc_url( home_url( '/shop' ) ); ?>" class="btn btn-secondary">
              ← Continue Shopping
            </a>
            <button class="btn btn-outline" onclick="if(typeof Cart !== 'undefined') { Cart.save(); }">
              ↻ Update Cart
            </button>
          </div>

          <!-- You May Also Like -->
          <div style="margin-top:40px">
            <h3 style="font-size:18px;font-weight:700;margin-bottom:20px">💡 You May Also Like</h3>
            <div class="products-grid cols-4" id="upsell-products" style="gap:16px">
              <!-- Rendered by JS -->
            </div>
          </div>
        </div>

        <!-- Order Summary -->
        <div class="order-summary">
          <div class="summary-header">Order Summary</div>
          <div class="summary-body">

            <!-- Coupon Code -->
            <form class="coupon-form" style="margin-bottom:24px" onsubmit="event.preventDefault();">
              <input type="text" class="coupon-input" placeholder="Coupon code (try: RSTORE20)">
              <button type="submit" class="btn btn-secondary btn-sm" style="flex-shrink:0" onclick="if(typeof Cart !== 'undefined') { Cart.applyCoupon(); }">Apply</button>
            </form>

            <!-- Rows -->
            <div class="summary-row">
              <span class="summary-row-label">Subtotal</span>
              <span class="summary-row-value" data-summary-subtotal>$0.00</span>
            </div>
            <div class="summary-row">
              <span class="summary-row-label">Shipping</span>
              <span class="summary-row-value" data-summary-shipping>$9.99</span>
            </div>
            <div class="summary-row">
              <span class="summary-row-label">Tax (8%)</span>
              <span class="summary-row-value" data-summary-tax>$0.00</span>
            </div>
            <div class="summary-row">
              <span class="summary-row-label">Discount</span>
              <span class="summary-row-value" style="color:var(--clr-success)" id="discount-row">—</span>
            </div>

            <div class="summary-total-row">
              <span class="summary-total-label">Total</span>
              <span class="summary-total-value" data-summary-total>$0.00</span>
            </div>

            <a href="<?php echo esc_url( home_url( '/checkout' ) ); ?>" class="btn btn-primary btn-full btn-lg" style="margin-top:8px">
              Proceed to Checkout →
            </a>

            <!-- Payment Icons -->
            <div style="display:flex;gap:8px;justify-content:center;margin-top:16px;flex-wrap:wrap">
              <div class="payment-badge">VISA</div>
              <div class="payment-badge">MC</div>
              <div class="payment-badge">AMEX</div>
              <div class="payment-badge">PayPal</div>
              <div class="payment-badge">Apple Pay</div>
            </div>

            <div style="text-align:center;margin-top:12px;font-size:12px;color:var(--text-muted)">
              🔒 SSL Secure Checkout — Your data is protected
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</main>

<?php get_footer(); ?>

<script>
document.addEventListener('DOMContentLoaded', () => {
  if (typeof Cart !== 'undefined') {
    Cart.updateCartPage();
    Cart.updateOrderSummary();
  }

  // Upsell products
  const upsell = document.getElementById('upsell-products');
  if (upsell && typeof DEMO_PRODUCTS !== 'undefined') {
    upsell.innerHTML = DEMO_PRODUCTS.slice(4, 8).map(p => `
      <div class="product-card" data-product-id="${p.id}">
        <div class="product-img-wrap">
          <div style="width:100%;height:100%;background:linear-gradient(135deg,${p.color}33,${p.color}66);display:flex;align-items:center;justify-content:center;font-size:4rem">${p.emoji}</div>
          <div class="product-quick-add" data-add-to-cart="${p.id}">🛒 Add to Cart</div>
        </div>
        <div class="product-info">
          <a href="<?php echo esc_url( home_url( '/product' ) ); ?>" class="product-name" style="font-size:13px">${p.name}</a>
          <div class="product-price-row" style="margin-top:8px">
            <span class="product-price" style="font-size:14px">$${p.price.toFixed(2)}</span>
          </div>
        </div>
      </div>
    `).join('');
  }

  if (typeof Cart !== 'undefined') {
    Cart.updateOrderSummary();
  }
});
</script>
