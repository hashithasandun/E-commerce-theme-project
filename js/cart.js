/* ============================================================
   RStore - Cart Management
   localStorage-based cart with full CRUD operations
   ============================================================ */

'use strict';

const Cart = {
  STORAGE_KEY: 'rstore-cart',
  FREE_SHIPPING_THRESHOLD: 100,

  // ============================================================
  // STATE
  // ============================================================
  items: [],

  // ============================================================
  // INIT
  // ============================================================
  init() {
    this.load();
    this.bindEvents();
    this.renderDrawer();
  },

  // ============================================================
  // STORAGE
  // ============================================================
  load() {
    try {
      const saved = localStorage.getItem(this.STORAGE_KEY);
      this.items = saved ? JSON.parse(saved) : [];
    } catch (e) {
      this.items = [];
    }
  },

  save() {
    localStorage.setItem(this.STORAGE_KEY, JSON.stringify(this.items));
    RStore.updateBadges();
    this.renderDrawer();
    this.updateCartPage();
  },

  // ============================================================
  // CART OPERATIONS
  // ============================================================
  add(product, quantity = 1, variant = null) {
    const existing = this.findItem(product.id, variant);

    if (existing) {
      existing.quantity += quantity;
    } else {
      this.items.push({
        id: product.id,
        name: product.name,
        price: product.price,
        originalPrice: product.original || null,
        image: product.image || null,
        emoji: product.emoji || '📦',
        color: product.color || '#6C3FE8',
        category: product.category || '',
        variant: variant,
        quantity: quantity,
        addedAt: new Date().toISOString()
      });
    }

    this.save();
    this.showAddedAnimation(product);
    Toast.success('Added to Cart!', `${product.name} has been added to your cart.`);
    RStore.openCartDrawer();
  },

  remove(id, variant = null) {
    this.items = this.items.filter(item =>
      !(item.id === id && item.variant === variant)
    );
    this.save();
    Toast.info('Item Removed', 'Item has been removed from your cart.');
  },

  updateQuantity(id, quantity, variant = null) {
    const item = this.findItem(id, variant);
    if (!item) return;

    if (quantity <= 0) {
      this.remove(id, variant);
      return;
    }

    item.quantity = Math.max(1, Math.min(quantity, 99));
    this.save();
  },

  clear() {
    this.items = [];
    this.save();
  },

  // ============================================================
  // GETTERS
  // ============================================================
  findItem(id, variant = null) {
    return this.items.find(item => item.id === id && item.variant === variant);
  },

  getCount() {
    return this.items.reduce((sum, item) => sum + item.quantity, 0);
  },

  getSubtotal() {
    return this.items.reduce((sum, item) => sum + (item.price * item.quantity), 0);
  },

  getShipping() {
    const subtotal = this.getSubtotal();
    return subtotal >= this.FREE_SHIPPING_THRESHOLD ? 0 : 9.99;
  },

  getTax() {
    return this.getSubtotal() * 0.08; // 8% tax
  },

  getTotal() {
    return this.getSubtotal() + this.getShipping() + this.getTax();
  },

  // ============================================================
  // RENDER DRAWER
  // ============================================================
  renderDrawer() {
    const drawerBody = document.querySelector('.cart-drawer-body');
    const drawerCount = document.querySelector('.cart-drawer-count');
    if (!drawerBody) return;

    if (drawerCount) drawerCount.textContent = this.getCount();

    if (this.items.length === 0) {
      drawerBody.innerHTML = `
        <div class="empty-state" style="padding:60px 24px">
          <span class="empty-state-icon">🛒</span>
          <h3 class="empty-state-title">Your cart is empty</h3>
          <p class="empty-state-text">Start adding some items to your cart!</p>
          <a href="shop.html" class="btn btn-primary" onclick="RStore.closeCartDrawer()">
            Shop Now
          </a>
        </div>
      `;
      return;
    }

    const subtotal = this.getSubtotal();
    const remaining = Math.max(0, this.FREE_SHIPPING_THRESHOLD - subtotal);
    const progress = Math.min(100, (subtotal / this.FREE_SHIPPING_THRESHOLD) * 100);

    drawerBody.innerHTML = `
      <!-- Free Shipping Progress -->
      <div class="cart-progress-wrap">
        ${remaining > 0
        ? `<div class="cart-progress-text">Add <strong>$${remaining.toFixed(2)}</strong> more for <strong>🚚 Free Shipping!</strong></div>`
        : `<div class="cart-progress-text">🎉 You've unlocked <strong>Free Shipping!</strong></div>`
      }
        <div class="cart-progress-bar">
          <div class="cart-progress-fill" style="width:${progress}%"></div>
        </div>
      </div>

      <!-- Items -->
      ${this.items.map(item => this.renderDrawerItem(item)).join('')}
    `;

    // Update footer
    const footer = document.querySelector('.cart-drawer-footer');
    if (footer) {
      footer.innerHTML = `
        <div class="cart-subtotal">
          <span class="cart-subtotal-label">Subtotal (${this.getCount()} items)</span>
          <span class="cart-subtotal-value">$${subtotal.toFixed(2)}</span>
        </div>
        <a href="cart.html" class="btn btn-secondary btn-full mb-4" onclick="RStore.closeCartDrawer()">
          View Cart
        </a>
        <a href="checkout.html" class="btn btn-primary btn-full" onclick="RStore.closeCartDrawer()">
          Checkout → 
        </a>
        <p style="text-align:center;font-size:11px;color:var(--text-muted);margin-top:12px">
          🔒 Secure checkout with SSL encryption
        </p>
      `;
    }

    // Bind quantity buttons
    this.bindDrawerEvents(drawerBody);
  },

  renderDrawerItem(item) {
    return `
      <div class="cart-item" data-item-id="${item.id}" data-item-variant="${item.variant || ''}">
        <div class="cart-item-img">
          ${item.image
        ? `<img src="${item.image}" alt="${item.name}" style="width:100%;height:100%;object-fit:cover">`
        : `<div style="width:100%;height:100%;background:${item.color};display:flex;align-items:center;justify-content:center;font-size:1.8rem">${item.emoji}</div>`
      }
        </div>
        <div class="cart-item-info">
          <div class="cart-item-name">${item.name}</div>
          ${item.variant ? `<div class="cart-item-variant">${item.variant}</div>` : ''}
          <div class="cart-item-price-row">
            <div class="cart-item-price">$${(item.price * item.quantity).toFixed(2)}</div>
            <div class="cart-item-qty">
              <button class="qty-btn" data-action="decrease" data-id="${item.id}" data-variant="${item.variant || ''}">−</button>
              <span class="qty-value">${item.quantity}</span>
              <button class="qty-btn" data-action="increase" data-id="${item.id}" data-variant="${item.variant || ''}">+</button>
            </div>
          </div>
        </div>
        <button class="cart-item-remove" data-id="${item.id}" data-variant="${item.variant || ''}" title="Remove item">✕</button>
      </div>
    `;
  },

  bindDrawerEvents(container) {
    container.querySelectorAll('.qty-btn').forEach(btn => {
      btn.addEventListener('click', () => {
        const id = parseInt(btn.dataset.id);
        const variant = btn.dataset.variant || null;
        const item = this.findItem(id, variant);
        if (!item) return;

        const newQty = btn.dataset.action === 'increase'
          ? item.quantity + 1
          : item.quantity - 1;

        this.updateQuantity(id, newQty, variant);
      });
    });

    container.querySelectorAll('.cart-item-remove').forEach(btn => {
      btn.addEventListener('click', () => {
        const id = parseInt(btn.dataset.id);
        const variant = btn.dataset.variant || null;
        this.remove(id, variant);
      });
    });
  },

  // ============================================================
  // CART PAGE
  // ============================================================
  updateCartPage() {
    const tableBody = document.querySelector('.cart-table-body');
    if (!tableBody) return;

    if (this.items.length === 0) {
      const cartContent = document.querySelector('.cart-content');
      if (cartContent) {
        cartContent.innerHTML = `
          <div class="empty-state">
            <span class="empty-state-icon">🛒</span>
            <h2 class="empty-state-title">Your cart is empty</h2>
            <p class="empty-state-text">Looks like you haven't added any items yet.</p>
            <a href="shop.html" class="btn btn-primary btn-lg">Continue Shopping</a>
          </div>
        `;
      }
      return;
    }

    tableBody.innerHTML = this.items.map(item => `
      <tr data-item-id="${item.id}">
        <td>
          <div class="cart-product-cell">
            <div style="width:80px;height:80px;border-radius:12px;overflow:hidden;background:${item.color};display:flex;align-items:center;justify-content:center;font-size:2rem;flex-shrink:0">
              ${item.emoji}
            </div>
            <div>
              <div class="cart-product-name">${item.name}</div>
              ${item.variant ? `<div class="cart-product-variant">${item.variant}</div>` : ''}
            </div>
          </div>
        </td>
        <td>$${item.price.toFixed(2)}</td>
        <td>
          <div class="quantity-input">
            <button class="quantity-btn" data-action="decrease" data-id="${item.id}">−</button>
            <input type="number" class="quantity-field" value="${item.quantity}" min="1" max="99" data-id="${item.id}">
            <button class="quantity-btn" data-action="increase" data-id="${item.id}">+</button>
          </div>
        </td>
        <td><strong>$${(item.price * item.quantity).toFixed(2)}</strong></td>
        <td>
          <button class="cart-remove-btn" data-id="${item.id}" title="Remove">🗑️</button>
        </td>
      </tr>
    `).join('');

    // Update summary
    this.updateOrderSummary();
    this.bindCartPageEvents(tableBody);
  },

  updateOrderSummary() {
    const subtotalEl = document.querySelector('[data-summary-subtotal]');
    const shippingEl = document.querySelector('[data-summary-shipping]');
    const taxEl = document.querySelector('[data-summary-tax]');
    const totalEl = document.querySelector('[data-summary-total]');

    if (subtotalEl) subtotalEl.textContent = `$${this.getSubtotal().toFixed(2)}`;
    if (taxEl) taxEl.textContent = `$${this.getTax().toFixed(2)}`;
    if (totalEl) totalEl.textContent = `$${this.getTotal().toFixed(2)}`;

    if (shippingEl) {
      const shipping = this.getShipping();
      shippingEl.textContent = shipping === 0 ? 'FREE' : `$${shipping.toFixed(2)}`;
      shippingEl.classList.toggle('free', shipping === 0);
    }

    // Progress bar
    const subtotal = this.getSubtotal();
    const progress = Math.min(100, (subtotal / this.FREE_SHIPPING_THRESHOLD) * 100);
    const progressFill = document.querySelector('[data-shipping-progress]');
    const progressText = document.querySelector('[data-shipping-text]');

    if (progressFill) progressFill.style.width = `${progress}%`;
    if (progressText) {
      const remaining = Math.max(0, this.FREE_SHIPPING_THRESHOLD - subtotal);
      progressText.innerHTML = remaining > 0
        ? `Add <strong>$${remaining.toFixed(2)}</strong> more for Free Shipping!`
        : `🎉 You've unlocked Free Shipping!`;
    }
  },

  bindCartPageEvents(container) {
    container.querySelectorAll('.quantity-btn').forEach(btn => {
      btn.addEventListener('click', () => {
        const id = parseInt(btn.dataset.id);
        const item = this.findItem(id);
        if (!item) return;

        const newQty = btn.dataset.action === 'increase'
          ? item.quantity + 1
          : item.quantity - 1;

        this.updateQuantity(id, newQty);
      });
    });

    container.querySelectorAll('.quantity-field').forEach(input => {
      input.addEventListener('change', () => {
        const id = parseInt(input.dataset.id);
        this.updateQuantity(id, parseInt(input.value));
      });
    });

    container.querySelectorAll('.cart-remove-btn').forEach(btn => {
      btn.addEventListener('click', () => {
        this.remove(parseInt(btn.dataset.id));
      });
    });
  },

  // ============================================================
  // ADD ANIMATION (Flying product to cart)
  // ============================================================
  showAddedAnimation(product) {
    const cartBtn = document.querySelector('[data-open-cart]');
    if (!cartBtn) return;

    const fly = document.createElement('div');
    fly.className = 'cart-fly';
    fly.innerHTML = product.emoji || '🛍';

    const trigger = document.querySelector('.btn-add-to-cart') || document.querySelector('[data-add-to-cart]');
    if (!trigger) return;

    const fromRect = trigger.getBoundingClientRect();
    const toRect = cartBtn.getBoundingClientRect();

    fly.style.cssText = `
      position: fixed;
      left: ${fromRect.left + fromRect.width / 2 - 25}px;
      top: ${fromRect.top + fromRect.height / 2 - 25}px;
      width: 50px;
      height: 50px;
      z-index: 9999;
      pointer-events: none;
      font-size: 1.5rem;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    `;

    document.body.appendChild(fly);

    requestAnimationFrame(() => {
      requestAnimationFrame(() => {
        fly.style.left = `${toRect.left + toRect.width / 2 - 25}px`;
        fly.style.top = `${toRect.top + toRect.height / 2 - 25}px`;
        fly.style.opacity = '0';
        fly.style.transform = 'scale(0.3)';
      });
    });

    setTimeout(() => fly.remove(), 700);
  },

  // ============================================================
  // BIND EVENTS
  // ============================================================
  bindEvents() {
    document.addEventListener('click', (e) => {
      // Add to cart buttons
      const addBtn = e.target.closest('[data-add-to-cart]');
      if (addBtn) {
        const productId = parseInt(addBtn.dataset.addToCart);
        const product = DEMO_PRODUCTS.find(p => p.id === productId) || DEMO_PRODUCTS[0];
        this.add(product);
        return;
      }

      // Quick add
      const quickAdd = e.target.closest('.product-quick-add');
      if (quickAdd) {
        const card = quickAdd.closest('.product-card');
        const productId = parseInt(card?.dataset.productId);
        const product = DEMO_PRODUCTS.find(p => p.id === productId) || DEMO_PRODUCTS[0];
        this.add(product);
        return;
      }
    });

    // Cart page
    if (document.querySelector('.cart-table')) {
      this.updateCartPage();
    }

    // Coupon form
    const couponForm = document.querySelector('.coupon-form');
    if (couponForm) {
      couponForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const code = couponForm.querySelector('.coupon-input')?.value.trim().toUpperCase();
        if (code === 'RSTORE20') {
          Toast.success('Coupon Applied!', '20% discount has been applied to your order.');
        } else {
          Toast.error('Invalid Coupon', 'Please enter a valid coupon code.');
        }
      });
    }
  },
};

// Expose addToCart globally under RStore namespace for Quick View triggers
window.RStore = window.RStore || {};
window.RStore.addToCart = function(id, name, price, img) {
  Cart.add({
    id: id,
    name: name,
    price: parseFloat(price),
    image: img,
    emoji: '🛍'
  });
};
