/* ============================================================
   RStore - Product Compare Module
   Allows side-by-side comparison of up to 4 products.
   ============================================================ */
'use strict';

const Compare = {
  STORAGE_KEY: 'rstore-compare',
  MAX_ITEMS: 4,
  items: [],

  init() {
    this.load();
    this.renderBar();
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
    if (typeof RStore !== 'undefined') RStore.updateBadges();
    this.renderBar();
    this.updateButtons();
  },

  toggle(product) {
    if (this.has(product.id)) {
      this.remove(product.id);
      Toast.info('Removed from Compare', `${product.name} removed.`);
    } else if (this.items.length >= this.MAX_ITEMS) {
      Toast.warning('Compare Limit Reached', `You can compare up to ${this.MAX_ITEMS} products.`);
    } else {
      this.add(product);
      Toast.success('Added to Compare', `${product.name} added. Compare ${this.items.length} products.`);
    }
  },

  add(product) {
    if (!this.has(product.id) && this.items.length < this.MAX_ITEMS) {
      this.items.push(product);
      this.save();
    }
  },

  remove(id) {
    this.items = this.items.filter(item => item.id !== id);
    this.save();
    this.renderPage();
  },

  has(id) { return this.items.some(item => item.id === id); },

  getCount() { return this.items.length; },

  clear() {
    this.items = [];
    this.save();
    this.renderPage();
  },

  updateButtons() {
    document.querySelectorAll('[data-compare]').forEach(btn => {
      const id = parseInt(btn.dataset.compare);
      btn.classList.toggle('active', this.has(id));
      btn.title = this.has(id) ? 'Remove from Compare' : 'Compare';
    });
  },

  renderBar() {
    const bar = document.querySelector('.compare-bar');
    if (!bar) return;

    if (this.items.length === 0) {
      bar.style.display = 'none';
      return;
    }

    bar.style.display = 'flex';
    bar.innerHTML = `
      <div style="display:flex;align-items:center;gap:16px;flex:1;flex-wrap:wrap">
        ${this.items.map(item => `
          <div style="display:flex;align-items:center;gap:8px;background:rgba(255,255,255,0.1);padding:6px 12px;border-radius:8px">
            <span>${item.emoji || '📦'}</span>
            <span style="font-size:13px;font-weight:600;color:white">${item.name.substring(0, 20)}...</span>
            <button onclick="Compare.remove(${item.id})" style="color:rgba(255,255,255,0.7);font-size:12px;cursor:pointer;padding:2px">✕</button>
          </div>
        `).join('')}
      </div>
      <div style="display:flex;gap:12px;align-items:center">
        <button onclick="Compare.clear()" class="btn btn-sm" style="background:rgba(255,255,255,0.2);color:white;border-color:rgba(255,255,255,0.3)">Clear</button>
        <a href="compare.html" class="btn btn-sm btn-white">Compare Now</a>
      </div>
    `;
  },

  renderPage() {
    const table = document.querySelector('.compare-products-table');
    if (!table) return;

    if (this.items.length === 0) {
      table.innerHTML = `
        <div class="empty-state">
          <span class="empty-state-icon">⚖️</span>
          <h2 class="empty-state-title">No products to compare</h2>
          <p class="empty-state-text">Add up to 4 products to compare their features side by side.</p>
          <a href="shop.html" class="btn btn-primary btn-lg">Browse Products</a>
        </div>
      `;
      return;
    }

    const attrs = ['category', 'rating', 'reviews', 'price', 'original'];
    const labels = { category: 'Category', rating: 'Rating', reviews: 'Reviews', price: 'Price', original: 'Original Price' };

    table.innerHTML = `
      <table class="compare-table" style="width:100%">
        <thead>
          <tr>
            <th style="width:160px">Feature</th>
            ${this.items.map(item => `
              <th>
                <div style="text-align:center">
                  <div style="font-size:3rem;margin-bottom:8px">${item.emoji || '📦'}</div>
                  <div style="font-size:14px;font-weight:700">${item.name}</div>
                  <div style="font-size:18px;font-weight:900;color:var(--clr-primary);margin-top:4px">$${item.price}</div>
                  <button onclick="Compare.remove(${item.id})" class="btn btn-sm" style="margin-top:8px;font-size:12px">Remove</button>
                </div>
              </th>
            `).join('')}
          </tr>
        </thead>
        <tbody>
          ${attrs.map(attr => `
            <tr>
              <td><strong>${labels[attr]}</strong></td>
              ${this.items.map(item => `
                <td style="text-align:center">
                  ${attr === 'rating'
        ? `<div style="display:flex;justify-content:center;gap:2px">${renderStars(item[attr])}</div> <span style="font-size:12px;color:var(--text-muted)">${item[attr]}/5</span>`
        : attr === 'price' || attr === 'original'
          ? item[attr] ? `$${item[attr]}` : '—'
          : item[attr] || '—'
      }
                </td>
              `).join('')}
            </tr>
          `).join('')}
          <tr>
            <td><strong>Add to Cart</strong></td>
            ${this.items.map(item => `
              <td style="text-align:center">
                <button class="btn btn-primary btn-sm" onclick="Cart.add(DEMO_PRODUCTS.find(p=>p.id===${item.id}))">Add to Cart</button>
              </td>
            `).join('')}
          </tr>
        </tbody>
      </table>
    `;
  }
};

// Bind Compare Events globally
document.addEventListener('click', (e) => {
  const cmpBtn = e.target.closest('[data-compare]');
  if (cmpBtn) {
    const id = parseInt(cmpBtn.dataset.compare);
    const product = DEMO_PRODUCTS.find(p => p.id === id) || DEMO_PRODUCTS[0];
    Compare.toggle(product);
  }
});
