/* ============================================================
   RStore - Multi-Step Checkout
   ============================================================ */
'use strict';

const Checkout = {
  currentStep: 1,
  totalSteps: 3,

  formData: {
    contact: {},
    shipping: {},
    payment: {}
  },

  init() {
    if (!document.querySelector('.checkout-steps')) return;

    this.renderStep(1);
    this.bindEvents();
    this.renderOrderSummary();
  },

  // ============================================================
  // STEP NAVIGATION
  // ============================================================
  goToStep(step) {
    if (step < 1 || step > this.totalSteps) return;

    // Validate current step
    if (step > this.currentStep && !this.validateStep(this.currentStep)) return;

    this.currentStep = step;
    this.renderStep(step);
    this.updateStepUI(step);

    // Scroll to top of checkout
    document.querySelector('.checkout-steps')?.scrollIntoView({ behavior: 'smooth', block: 'start' });
  },

  nextStep() { this.goToStep(this.currentStep + 1); },
  prevStep() { this.goToStep(this.currentStep - 1); },

  // ============================================================
  // VALIDATE STEP
  // ============================================================
  validateStep(step) {
    const stepEl = document.querySelector(`[data-step="${step}"]`);
    if (!stepEl) return true;

    let isValid = true;
    const requiredFields = stepEl.querySelectorAll('[required]');

    requiredFields.forEach(field => {
      const val = field.value.trim();
      const group = field.closest('.form-group');
      const errorEl = group?.querySelector('.form-error');

      if (!val) {
        field.classList.add('error');
        if (errorEl) errorEl.style.display = 'flex';
        isValid = false;
      } else {
        field.classList.remove('error');
        if (errorEl) errorEl.style.display = 'none';
      }

      // Email validation
      if (field.type === 'email' && val) {
        const emailValid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(val);
        if (!emailValid) {
          field.classList.add('error');
          isValid = false;
        }
      }

      // Phone validation
      if (field.type === 'tel' && val) {
        const phoneValid = /^[\+]?[\d\s-]{7,15}$/.test(val);
        if (!phoneValid) {
          field.classList.add('error');
          isValid = false;
        }
      }
    });

    if (!isValid) {
      Toast.error('Please fill all required fields', 'Check the highlighted fields and try again.');
    }

    return isValid;
  },

  // ============================================================
  // SAVE STEP DATA
  // ============================================================
  saveStepData(step) {
    const stepEl = document.querySelector(`[data-step="${step}"]`);
    if (!stepEl) return;

    const fields = stepEl.querySelectorAll('input, select, textarea');
    const data = {};

    fields.forEach(field => {
      if (field.name) {
        data[field.name] = field.type === 'checkbox' ? field.checked : field.value;
      }
    });

    const keys = ['contact', 'shipping', 'payment'];
    if (keys[step - 1]) {
      this.formData[keys[step - 1]] = data;
    }
  },

  // ============================================================
  // UPDATE STEP INDICATORS
  // ============================================================
  updateStepUI(step) {
    document.querySelectorAll('.checkout-step').forEach((el, i) => {
      el.classList.remove('active', 'completed');
      if (i + 1 < step) el.classList.add('completed');
      if (i + 1 === step) el.classList.add('active');
    });

    // Update step panels
    document.querySelectorAll('[data-step]').forEach(el => {
      el.style.display = parseInt(el.dataset.step) === step ? 'block' : 'none';
    });
  },

  // ============================================================
  // RENDER EACH STEP CONTENT
  // ============================================================
  renderStep(step) {
    const stepPanels = {
      1: this.renderContactStep(),
      2: this.renderShippingStep(),
      3: this.renderPaymentStep(),
    };
  },

  renderContactStep() { /* Rendered in HTML */ },
  renderShippingStep() { /* Rendered in HTML */ },
  renderPaymentStep() { /* Rendered in HTML */ },

  // ============================================================
  // ORDER SUMMARY
  // ============================================================
  renderOrderSummary() {
    const summaryEl = document.querySelector('.checkout-order-items');
    if (!summaryEl) return;

    summaryEl.innerHTML = Cart.items.map(item => `
      <div class="cart-item" style="padding:12px 0">
        <div class="cart-item-img">
          <div style="width:100%;height:100%;background:${item.color};display:flex;align-items:center;justify-content:center;font-size:1.5rem">
            ${item.emoji}
          </div>
        </div>
        <div class="cart-item-info">
          <div class="cart-item-name">${item.name}</div>
          <div class="cart-item-variant">Qty: ${item.quantity}</div>
        </div>
        <div class="cart-item-price" style="flex-shrink:0">
          $${(item.price * item.quantity).toFixed(2)}
        </div>
      </div>
    `).join('') || '<p class="text-muted text-sm text-center" style="padding:20px">No items in cart</p>';

    // Update totals
    document.querySelectorAll('[data-checkout-subtotal]').forEach(el => el.textContent = `$${Cart.getSubtotal().toFixed(2)}`);
    document.querySelectorAll('[data-checkout-shipping]').forEach(el => {
      const ship = Cart.getShipping();
      el.textContent = ship === 0 ? 'FREE' : `$${ship.toFixed(2)}`;
    });
    document.querySelectorAll('[data-checkout-tax]').forEach(el => el.textContent = `$${Cart.getTax().toFixed(2)}`);
    document.querySelectorAll('[data-checkout-total]').forEach(el => el.textContent = `$${Cart.getTotal().toFixed(2)}`);
  },

  // ============================================================
  // PLACE ORDER
  // ============================================================
  placeOrder() {
    if (!this.validateStep(3)) return;
    this.saveStepData(3);

    const btn = document.querySelector('[data-place-order]');
    if (btn) {
      btn.classList.add('loading');
      btn.textContent = 'Processing...';
    }

    // Simulate order processing
    setTimeout(() => {
      Cart.clear();
      launchConfetti();
      this.showSuccessScreen();
    }, 2000);
  },

  showSuccessScreen() {
    const checkoutEl = document.querySelector('.checkout-main');
    if (!checkoutEl) return;

    const orderNum = 'RS' + Math.random().toString(36).substr(2, 8).toUpperCase();

    checkoutEl.innerHTML = `
      <div style="text-align:center;padding:80px 40px">
        <div style="width:100px;height:100px;background:var(--grad-primary);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 32px;font-size:3rem;animation:scaleInSpring 0.6s cubic-bezier(0.34,1.56,0.64,1)">
          ✓
        </div>
        <h1 style="font-family:var(--font-display);font-size:2.5rem;font-weight:900;background:var(--grad-primary);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;margin-bottom:16px">
          Order Placed! 🎉
        </h1>
        <p style="font-size:1.1rem;color:var(--text-secondary);margin-bottom:8px">
          Thank you for your order!
        </p>
        <p style="font-size:0.9rem;color:var(--text-muted);margin-bottom:40px">
          Order #<strong>${orderNum}</strong> — Confirmation sent to your email
        </p>
        <div style="display:flex;gap:16px;justify-content:center;flex-wrap:wrap">
          <a href="account.html" class="btn btn-primary btn-lg">Track My Order</a>
          <a href="index.html" class="btn btn-secondary btn-lg">Continue Shopping</a>
        </div>
      </div>
    `;
  },

  // ============================================================
  // PAYMENT METHOD SELECTION
  // ============================================================
  selectPaymentMethod(method) {
    document.querySelectorAll('.payment-method').forEach(el => el.classList.remove('selected'));
    document.querySelector(`[data-payment="${method}"]`)?.classList.add('selected');

    // Show/hide relevant fields
    const cardFields = document.querySelector('.card-fields');
    const bankFields = document.querySelector('.bank-fields');

    if (cardFields) cardFields.style.display = method === 'card' ? 'block' : 'none';
    if (bankFields) bankFields.style.display = method === 'bank' ? 'block' : 'none';
  },

  // ============================================================
  // BIND EVENTS
  // ============================================================
  bindEvents() {
    // Step navigation buttons
    document.querySelectorAll('[data-next-step]').forEach(btn => {
      btn.addEventListener('click', () => {
        this.saveStepData(this.currentStep);
        this.nextStep();
      });
    });

    document.querySelectorAll('[data-prev-step]').forEach(btn => {
      btn.addEventListener('click', () => this.prevStep());
    });

    document.querySelectorAll('[data-goto-step]').forEach(btn => {
      btn.addEventListener('click', () => {
        const step = parseInt(btn.dataset.gotoStep);
        if (step <= this.currentStep) this.goToStep(step);
      });
    });

    // Place order
    document.querySelectorAll('[data-place-order]').forEach(btn => {
      btn.addEventListener('click', () => this.placeOrder());
    });

    // Payment methods
    document.querySelectorAll('.payment-method').forEach(el => {
      el.addEventListener('click', () => {
        this.selectPaymentMethod(el.dataset.payment);
      });
    });

    // Card number formatting
    const cardInput = document.querySelector('[data-card-number]');
    if (cardInput) {
      cardInput.addEventListener('input', (e) => {
        let val = e.target.value.replace(/\D/g, '').substring(0, 16);
        val = val.match(/.{1,4}/g)?.join(' ') || val;
        e.target.value = val;
      });
    }

    // Expiry formatting
    const expiryInput = document.querySelector('[data-card-expiry]');
    if (expiryInput) {
      expiryInput.addEventListener('input', (e) => {
        let val = e.target.value.replace(/\D/g, '').substring(0, 4);
        if (val.length >= 2) val = val.substring(0, 2) + '/' + val.substring(2);
        e.target.value = val;
      });
    }

    // Same as billing
    const sameAsBilling = document.querySelector('[data-same-as-billing]');
    if (sameAsBilling) {
      sameAsBilling.addEventListener('change', () => {
        const billingForm = document.querySelector('.billing-address');
        if (billingForm) {
          billingForm.style.display = sameAsBilling.checked ? 'none' : 'block';
        }
      });
    }
  }
};
