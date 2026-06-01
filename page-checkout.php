<?php
/**
 * Template Name: Checkout Page
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
      <a href="<?php echo esc_url( home_url( '/cart' ) ); ?>" class="breadcrumb-item">Cart</a>
      <span class="breadcrumb-sep">/</span>
      <span class="breadcrumb-active">Checkout</span>
    </nav>
  </div>

  <div class="section-sm">
    <div class="container checkout-main">

      <!-- Steps -->
      <div class="checkout-steps" style="display:flex;gap:0;margin-bottom:48px">
        <div class="checkout-step active" data-goto-step="1" style="flex:1;display:flex;flex-direction:column;align-items:center;gap:8px;cursor:pointer;position:relative">
          <div class="step-circle">1</div>
          <div class="step-label">Contact</div>
          <div class="step-line" style="position:absolute;top:22px;left:50%;right:-50%;height:2px;background:var(--border-color);z-index:0"></div>
        </div>
        <div class="checkout-step" data-goto-step="2" style="flex:1;display:flex;flex-direction:column;align-items:center;gap:8px;cursor:pointer;position:relative">
          <div class="step-circle">2</div>
          <div class="step-label">Shipping</div>
          <div class="step-line" style="position:absolute;top:22px;left:-50%;right:50%;height:2px;background:var(--border-color);z-index:0"></div>
          <div class="step-line" style="position:absolute;top:22px;left:50%;right:-50%;height:2px;background:var(--border-color);z-index:0"></div>
        </div>
        <div class="checkout-step" data-goto-step="3" style="flex:1;display:flex;flex-direction:column;align-items:center;gap:8px;cursor:pointer;position:relative">
          <div class="step-circle">3</div>
          <div class="step-label">Payment</div>
          <div class="step-line" style="position:absolute;top:22px;left:-50%;right:50%;height:2px;background:var(--border-color);z-index:0"></div>
        </div>
      </div>

      <div class="checkout-layout">

        <!-- Left: Form Steps -->
        <div>

          <!-- STEP 1: Contact -->
          <div data-step="1" class="checkout-step-panel">
            <div style="background:var(--bg-card);border-radius:20px;border:1px solid var(--border-color);padding:32px;box-shadow:var(--shadow-card);margin-bottom:24px">
              <h2 style="font-size:1.25rem;font-weight:700;margin-bottom:24px;display:flex;align-items:center;gap:10px">
                <span style="width:32px;height:32px;background:var(--grad-primary);border-radius:50%;display:flex;align-items:center;justify-content:center;color:white;font-size:14px;font-weight:700">1</span>
                Contact Information
              </h2>
              <div class="form-grid">
                <div class="form-group">
                  <label class="form-label" for="first-name">First Name <span style="color:var(--clr-danger)">*</span></label>
                  <input type="text" class="form-control" id="first-name" name="firstName" required placeholder="John">
                  <div class="form-error" style="display:none"><span>⚠</span> First name is required</div>
                </div>
                <div class="form-group">
                  <label class="form-label" for="last-name">Last Name <span style="color:var(--clr-danger)">*</span></label>
                  <input type="text" class="form-control" id="last-name" name="lastName" required placeholder="Doe">
                </div>
                <div class="form-group form-full">
                  <label class="form-label" for="email">Email Address <span style="color:var(--clr-danger)">*</span></label>
                  <input type="email" class="form-control" id="email" name="email" required placeholder="john@example.com">
                  <div class="form-hint">Order confirmation will be sent to this email</div>
                </div>
                <div class="form-group form-full">
                  <label class="form-label" for="phone">Phone Number <span style="color:var(--clr-danger)">*</span></label>
                  <input type="tel" class="form-control" id="phone" name="phone" required placeholder="+1 (555) 000-0000">
                </div>
                <div class="form-group form-full">
                  <label style="display:flex;align-items:center;gap:12px;cursor:pointer">
                    <input type="checkbox" name="createAccount" id="create-account" style="width:18px;height:18px;accent-color:var(--clr-primary)">
                    <span style="font-size:14px;color:var(--text-secondary)">Create an account to track orders and save your details</span>
                  </label>
                </div>
              </div>
            </div>
            <button class="btn btn-primary btn-lg btn-full" data-next-step>
              Continue to Shipping →
            </button>
          </div>

          <!-- STEP 2: Shipping -->
          <div data-step="2" class="checkout-step-panel" style="display:none">
            <div style="background:var(--bg-card);border-radius:20px;border:1px solid var(--border-color);padding:32px;box-shadow:var(--shadow-card);margin-bottom:24px">
              <h2 style="font-size:1.25rem;font-weight:700;margin-bottom:24px;display:flex;align-items:center;gap:10px">
                <span style="width:32px;height:32px;background:var(--grad-primary);border-radius:50%;display:flex;align-items:center;justify-content:center;color:white;font-size:14px;font-weight:700">2</span>
                Shipping Address
              </h2>
              <div class="form-grid">
                <div class="form-group form-full">
                  <label class="form-label" for="address">Street Address <span style="color:var(--clr-danger)">*</span></label>
                  <input type="text" class="form-control" id="address" name="address" required placeholder="123 Main Street">
                </div>
                <div class="form-group">
                  <label class="form-label" for="city">City <span style="color:var(--clr-danger)">*</span></label>
                  <input type="text" class="form-control" id="city" name="city" required placeholder="New York">
                </div>
                <div class="form-group">
                  <label class="form-label" for="state">State/Province</label>
                  <input type="text" class="form-control" id="state" name="state" placeholder="NY">
                </div>
                <div class="form-group">
                  <label class="form-label" for="zip">ZIP/Postal Code <span style="color:var(--clr-danger)">*</span></label>
                  <input type="text" class="form-control" id="zip" name="zip" required placeholder="10001">
                </div>
                <div class="form-group">
                  <label class="form-label" for="country">Country <span style="color:var(--clr-danger)">*</span></label>
                  <select class="form-select" id="country" name="country" required>
                    <option value="">Select country</option>
                    <option value="US" selected>🇺🇸 United States</option>
                    <option value="GB">🇬🇧 United Kingdom</option>
                    <option value="CA">🇨🇦 Canada</option>
                    <option value="AU">🇦🇺 Australia</option>
                    <option value="IN">🇮🇳 India</option>
                    <option value="LK">🇱🇰 Sri Lanka</option>
                    <option value="SG">🇸🇬 Singapore</option>
                    <option value="DE">🇩🇪 Germany</option>
                    <option value="FR">🇫🇷 France</option>
                    <option value="JP">🇯🇵 Japan</option>
                  </select>
                </div>
              </div>

              <!-- Shipping Methods -->
              <div style="margin-top:28px">
                <h3 style="font-size:15px;font-weight:700;margin-bottom:16px">Shipping Method</h3>
                <div style="display:flex;flex-direction:column;gap:12px">
                  <label class="payment-method selected" data-payment="free-ship" style="display:flex;align-items:center;gap:16px;padding:16px 20px;border:2px solid var(--clr-primary);border-radius:16px;cursor:pointer;background:var(--clr-primary-soft)">
                    <input type="radio" name="shipping-method" value="free" checked style="accent-color:var(--clr-primary)">
                    <div style="flex:1">
                      <div style="font-weight:600;font-size:14px">🚚 Free Standard Shipping</div>
                      <div style="font-size:12px;color:var(--text-muted)">5-7 business days</div>
                    </div>
                    <div style="font-weight:700;color:var(--clr-success)">FREE</div>
                  </label>
                  <label class="payment-method" style="display:flex;align-items:center;gap:16px;padding:16px 20px;border:2px solid var(--border-color);border-radius:16px;cursor:pointer">
                    <input type="radio" name="shipping-method" value="express" style="accent-color:var(--clr-primary)">
                    <div style="flex:1">
                      <div style="font-weight:600;font-size:14px">⚡ Express Shipping</div>
                      <div style="font-size:12px;color:var(--text-muted)">2-3 business days</div>
                    </div>
                    <div style="font-weight:700">$9.99</div>
                  </label>
                  <label class="payment-method" style="display:flex;align-items:center;gap:16px;padding:16px 20px;border:2px solid var(--border-color);border-radius:16px;cursor:pointer">
                    <input type="radio" name="shipping-method" value="overnight" style="accent-color:var(--clr-primary)">
                    <div style="flex:1">
                      <div style="font-weight:600;font-size:14px">🚀 Overnight Delivery</div>
                      <div style="font-size:12px;color:var(--text-muted)">Next business day</div>
                    </div>
                    <div style="font-weight:700">$19.99</div>
                  </label>
                </div>
              </div>
            </div>
            <div style="display:flex;gap:12px">
              <button class="btn btn-secondary btn-lg" data-prev-step>← Back</button>
              <button class="btn btn-primary btn-lg" style="flex:1" data-next-step>Continue to Payment →</button>
            </div>
          </div>

          <!-- STEP 3: Payment -->
          <div data-step="3" class="checkout-step-panel" style="display:none">
            <div style="background:var(--bg-card);border-radius:20px;border:1px solid var(--border-color);padding:32px;box-shadow:var(--shadow-card);margin-bottom:24px">
              <h2 style="font-size:1.25rem;font-weight:700;margin-bottom:24px;display:flex;align-items:center;gap:10px">
                <span style="width:32px;height:32px;background:var(--grad-primary);border-radius:50%;display:flex;align-items:center;justify-content:center;color:white;font-size:14px;font-weight:700">3</span>
                Payment Method
              </h2>

              <!-- Payment Options -->
              <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:12px;margin-bottom:24px">
                <div class="payment-method selected" data-payment="card" style="display:flex;flex-direction:column;align-items:center;gap:8px;padding:16px;border:2px solid var(--clr-primary);border-radius:16px;cursor:pointer;background:var(--clr-primary-soft);text-align:center">
                  <div style="font-size:2rem">💳</div>
                  <div style="font-size:13px;font-weight:600">Credit Card</div>
                </div>
                <div class="payment-method" data-payment="paypal" style="display:flex;flex-direction:column;align-items:center;gap:8px;padding:16px;border:2px solid var(--border-color);border-radius:16px;cursor:pointer;text-align:center">
                  <div style="font-size:2rem">🅿️</div>
                  <div style="font-size:13px;font-weight:600">PayPal</div>
                </div>
                <div class="payment-method" data-payment="apple" style="display:flex;flex-direction:column;align-items:center;gap:8px;padding:16px;border:2px solid var(--border-color);border-radius:16px;cursor:pointer;text-align:center">
                  <div style="font-size:2rem">🍎</div>
                  <div style="font-size:13px;font-weight:600">Apple Pay</div>
                </div>
              </div>

              <!-- Card Fields -->
              <div class="card-fields">
                <div class="form-group" style="margin-bottom:16px">
                  <label class="form-label">Cardholder Name <span style="color:var(--clr-danger)">*</span></label>
                  <input type="text" class="form-control" name="cardName" required placeholder="John Doe">
                </div>
                <div class="form-group" style="margin-bottom:16px">
                  <label class="form-label">Card Number <span style="color:var(--clr-danger)">*</span></label>
                  <div style="position:relative">
                    <input type="text" class="form-control" name="cardNumber" data-card-number required placeholder="1234 5678 9012 3456" maxlength="19" style="padding-right:60px">
                    <div style="position:absolute;right:12px;top:50%;transform:translateY(-50%);font-size:18px">💳</div>
                  </div>
                </div>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px">
                  <div class="form-group">
                    <label class="form-label">Expiry Date <span style="color:var(--clr-danger)">*</span></label>
                    <input type="text" class="form-control" name="cardExpiry" data-card-expiry required placeholder="MM/YY" maxlength="5">
                  </div>
                  <div class="form-group">
                    <label class="form-label">CVV <span style="color:var(--clr-danger)">*</span></label>
                    <div style="position:relative">
                      <input type="password" class="form-control" name="cardCvv" required placeholder="123" maxlength="4">
                      <div title="3-4 digits on the back of your card" style="position:absolute;right:12px;top:50%;transform:translateY(-50%);cursor:help;color:var(--text-muted)">?</div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Security badges -->
              <div style="display:flex;align-items:center;gap:16px;margin-top:24px;padding-top:20px;border-top:1px solid var(--border-color);flex-wrap:wrap">
                <div style="display:flex;align-items:center;gap:6px;font-size:12px;color:var(--text-muted)"><span>🔒</span> SSL Secured</div>
                <div style="display:flex;align-items:center;gap:6px;font-size:12px;color:var(--text-muted)"><span>🛡️</span> Fraud Protected</div>
                <div style="display:flex;align-items:center;gap:6px;font-size:12px;color:var(--text-muted)"><span>✓</span> PCI Compliant</div>
              </div>
            </div>

            <div style="display:flex;gap:12px">
              <button class="btn btn-secondary btn-lg" data-prev-step>← Back</button>
              <button class="btn btn-primary btn-lg" style="flex:1" id="place-order-btn" data-place-order>
                🔒 Place Order — $<span data-checkout-total>0.00</span>
              </button>
            </div>
          </div>

        </div>

        <!-- Right: Order Summary -->
        <div class="order-summary">
          <div class="summary-header">Your Order</div>
          <div class="summary-body">
            <div class="checkout-order-items" style="margin-bottom:20px;max-height:300px;overflow-y:auto">
              <!-- Rendered by Checkout.renderOrderSummary() -->
            </div>

            <div class="coupon-form" style="margin-bottom:20px">
              <input type="text" class="coupon-input" placeholder="Coupon code">
              <button type="button" class="btn btn-secondary btn-sm" onclick="if(typeof Cart !== 'undefined'){Cart.applyCoupon();}">Apply</button>
            </div>

            <div class="summary-row"><span class="summary-row-label">Subtotal</span><span class="summary-row-value" data-checkout-subtotal>$0.00</span></div>
            <div class="summary-row"><span class="summary-row-label">Shipping</span><span class="summary-row-value" data-checkout-shipping>FREE</span></div>
            <div class="summary-row"><span class="summary-row-label">Tax</span><span class="summary-row-value" data-checkout-tax>$0.00</span></div>

            <div class="summary-total-row">
              <span class="summary-total-label">Total</span>
              <span class="summary-total-value" data-checkout-total>$0.00</span>
            </div>

            <div style="text-align:center;margin-top:16px;font-size:12px;color:var(--text-muted)">
              🔒 Your payment info is encrypted and secure
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
  // Checkout step panels - toggle display
  const panels = document.querySelectorAll('.checkout-step-panel');
  const steps = document.querySelectorAll('.checkout-step');
  let currentStep = 1;

  function showStep(n) {
    currentStep = n;
    panels.forEach((p, i) => {
      p.style.display = i + 1 === n ? 'block' : 'none';
    });
    steps.forEach((s, i) => {
      s.classList.remove('active', 'completed');
      if (i + 1 < n) s.classList.add('completed');
      if (i + 1 === n) s.classList.add('active');
    });
  }

  showStep(1);

  // Next buttons
  document.querySelectorAll('[data-next-step]').forEach(btn => {
    btn.addEventListener('click', () => {
      const panel = document.querySelector(`[data-step="${currentStep}"]`);
      let valid = true;
      panel?.querySelectorAll('[required]').forEach(f => {
        if (!f.value.trim()) { f.classList.add('error'); valid = false; }
        else f.classList.remove('error');
      });
      if (!valid) { Toast.error('Required Fields Missing', 'Please fill in all required fields.'); return; }
      showStep(currentStep + 1);
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });
  });

  // Prev buttons
  document.querySelectorAll('[data-prev-step]').forEach(btn => {
    btn.addEventListener('click', () => {
      showStep(currentStep - 1);
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });
  });

  // Step indicators
  steps.forEach((s, i) => {
    s.addEventListener('click', () => {
      if (i + 1 <= currentStep) showStep(i + 1);
    });
  });

  // Render order summary
  if (typeof Checkout !== 'undefined') {
    Checkout.renderOrderSummary();
  }

  // Place order
  document.querySelectorAll('[data-place-order]').forEach(btn => {
    btn.addEventListener('click', () => {
      const panel = document.querySelector(`[data-step="3"]`);
      let valid = true;
      panel?.querySelectorAll('[required]').forEach(f => {
        if (!f.value.trim()) { f.classList.add('error'); valid = false; }
        else f.classList.remove('error');
      });
      if (!valid) { Toast.error('Payment Details Missing', 'Please fill in all payment fields.'); return; }

      btn.classList.add('loading');
      btn.disabled = true;
      btn.textContent = '⏳ Processing...';

      setTimeout(() => {
        if (typeof Cart !== 'undefined') {
          Cart.clear();
        }
        if (typeof launchConfetti === 'function') {
          launchConfetti();
        }

        const trackerId = `SZ-${Math.random().toString(36).substr(2,8).toUpperCase()}`;
        document.querySelector('.checkout-main').innerHTML = `
          <div style="text-align:center;padding:80px 40px;max-width:600px;margin:0 auto">
            <div style="width:120px;height:120px;background:var(--grad-primary);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 32px;font-size:3.5rem;animation:scaleInSpring 0.6s cubic-bezier(0.34,1.56,0.64,1)">✓</div>
            <h1 style="font-family:var(--font-display);font-size:2.5rem;font-weight:900;background:var(--grad-primary);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;margin-bottom:16px">Order Placed! 🎉</h1>
            <p style="font-size:1.1rem;color:var(--text-secondary);margin-bottom:8px">Thank you for your order!</p>
            <p style="color:var(--text-muted);margin-bottom:8px">Order # <strong>${trackerId}</strong></p>
            <p style="color:var(--text-muted);margin-bottom:48px">We'll send a confirmation email with tracking details shortly.</p>
            <div style="display:flex;gap:16px;justify-content:center;flex-wrap:wrap">
              <a href="<?php echo esc_url( home_url( '/account' ) ); ?>" class="btn btn-primary btn-lg">📦 Track My Order</a>
              <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-secondary btn-lg">Continue Shopping</a>
            </div>
          </div>
        `;
      }, 2000);
    });
  });

  // Payment method selection
  document.querySelectorAll('.payment-method[data-payment]').forEach(el => {
    el.addEventListener('click', () => {
      document.querySelectorAll('.payment-method[data-payment]').forEach(m => {
        m.classList.remove('selected');
        m.style.border = '2px solid var(--border-color)';
        m.style.background = '';
      });
      el.classList.add('selected');
      el.style.border = '2px solid var(--clr-primary)';
      el.style.background = 'var(--clr-primary-soft)';

      const cardFields = document.querySelector('.card-fields');
      if (cardFields) {
        cardFields.style.display = el.dataset.payment === 'card' ? 'block' : 'none';
      }
    });
  });

  // Card number formatting
  document.querySelector('[data-card-number]')?.addEventListener('input', e => {
    let v = e.target.value.replace(/\D/g,'').substring(0,16);
    v = v.match(/.{1,4}/g)?.join(' ') || v;
    e.target.value = v;
  });

  document.querySelector('[data-card-expiry]')?.addEventListener('input', e => {
    let v = e.target.value.replace(/\D/g,'').substring(0,4);
    if (v.length >= 2) v = v.substring(0,2) + '/' + v.substring(2);
    e.target.value = v;
  });
});
</script>
