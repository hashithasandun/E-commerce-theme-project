/* ============================================================
   RStore - Wishlist Management
   ============================================================ */
'use strict';

const Wishlist = {
  STORAGE_KEY: 'rstore-wishlist',
  items: [],

  init() {
    this.load();
    this.renderPage();
    this.updateButtons();
  },

  load() {
    try {
      const saved = localStorage.getItem(this.STORAGE_KEY);
      this.items = saved ? JSON.parse(saved) : [];
    } catch { this.items = []; }
  },

  save() {
    localStorage.setItem(this.STORAGE_KEY, JSON.stringify(this.items));
    RStore.updateBadges();
    this.updateButtons();
    this.renderPage();
  },

  toggle(product) {
    if (this.has(product.id)) {
      this.remove(product.id);
      Toast.info('Removed from Wishlist', `${product.name} removed.`);
    } else {
      this.add(product);
      Toast.success('Added to Wishlist! ❤️', `${product.name} saved to your wishlist.`);
    }
    RStore.updateBadges();
  },

  add(product) {
    if (!this.has(product.id)) {
      this.items.push({ ...product, savedAt: new Date().toISOString() });
      this.save();
    }
  },

  remove(id) {
    this.items = this.items.filter(item => item.id !== id);
    this.save();
  },

  has(id) {
    return this.items.some(item => item.id === id);
  },

  getCount() { return this.items.length; },

  updateButtons() {
    document.querySelectorAll('[data-wishlist]').forEach(btn => {
      const id = parseInt(btn.dataset.wishlist);
      btn.classList.toggle('wishlisted', this.has(id));
      btn.title = this.has(id) ? 'Remove from Wishlist' : 'Add to Wishlist';

      const icon = btn.querySelector('svg, i, span.icon');
      if (btn.classList.contains('wishlisted')) {
        btn.style.color = 'var(--clr-danger)';
      } else {
        btn.style.color = '';
      }
    });
  },

  renderPage() {
    const grid = document.querySelector('.wishlist-grid');
    if (!grid) return;

    if (this.items.length === 0) {
      grid.innerHTML = `
        <div class="empty-state" style="grid-column:1/-1">
          <span class="empty-state-icon">❤️</span>
          <h2 class="empty-state-title">Your wishlist is empty</h2>
          <p class="empty-state-text">Save items you love to your wishlist and shop them later.</p>
          <a href="shop.html" class="btn btn-primary btn-lg">Discover Products</a>
        </div>
      `;
      return;
    }

    grid.innerHTML = this.items.map(item => `
      <div class="product-card" data-product-id="${item.id}">
        <div class="product-img-wrap">
          <div style="width:100%;height:100%;background:${item.color || '#6C3FE8'};display:flex;align-items:center;justify-content:center;font-size:4rem">
            ${item.emoji || '📦'}
          </div>
          <button class="wishlist-item-remove" onclick="Wishlist.remove(${item.id})" title="Remove">✕</button>
          <div class="product-badges">
            ${item.price < item.original ? `<span class="badge badge-sale">-${Math.round((1 - item.price / item.original) * 100)}%</span>` : ''}
          </div>
        </div>
        <div class="product-info">
          <div class="product-category">${item.category}</div>
          <div class="product-name">${item.name}</div>
          <div class="product-rating">
            <div class="stars">${renderStars(item.rating)}</div>
            <span class="rating-count">(${item.reviews})</span>
          </div>
          <div class="product-price-row">
            <span class="product-price">$${item.price.toFixed(2)}</span>
            ${item.original ? `<span class="product-price-original">$${item.original.toFixed(2)}</span>` : ''}
          </div>
          <button class="btn btn-primary btn-full mt-auto" style="margin-top:16px" onclick="Cart.add(${JSON.stringify(item).replace(/"/g, '&quot;')})">
            Add to Cart
          </button>
        </div>
      </div>
    `).join('');
  }
};

/* ============================================================
   Bind Wishlist Events Globally
   ============================================================ */
document.addEventListener('click', (e) => {
  const wishBtn = e.target.closest('[data-wishlist]');
  if (wishBtn) {
    const id = parseInt(wishBtn.dataset.wishlist);
    const product = DEMO_PRODUCTS.find(p => p.id === id) || DEMO_PRODUCTS[0];
    // Heart burst animation
    wishBtn.classList.add('wishlist-burst');
    setTimeout(() => wishBtn.classList.remove('wishlist-burst'), 400);
    Wishlist.toggle(product);
  }
});
