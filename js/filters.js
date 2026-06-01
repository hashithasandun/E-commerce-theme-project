/* ============================================================
   RStore - Product Filters
   Handles AJAX-like filtering, category tabs, and sorting
   ============================================================ */
'use strict';

const ProductFilters = {
  activeFilters: {},

  init() {
    this.bindFilterEvents();
    this.initPriceSlider();
    this.initMobileFilterToggle();
  },

  bindFilterEvents() {
    // Category filters
    document.querySelectorAll('[data-filter-category]').forEach(btn => {
      btn.addEventListener('click', () => {
        const cat = btn.dataset.filterCategory;
        document.querySelectorAll('[data-filter-category]').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        this.activeFilters.category = cat === 'all' ? null : cat;
        this.applyFilters();
      });
    });

    // Sort
    const sortSelect = document.querySelector('[data-sort]');
    if (sortSelect) {
      sortSelect.addEventListener('change', () => {
        this.activeFilters.sort = sortSelect.value;
        this.applyFilters();
      });
    }

    // Rating filter
    document.querySelectorAll('[data-filter-rating]').forEach(btn => {
      btn.addEventListener('click', () => {
        document.querySelectorAll('[data-filter-rating]').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        this.activeFilters.minRating = parseFloat(btn.dataset.filterRating);
        this.applyFilters();
      });
    });

    // Clear all
    const clearBtn = document.querySelector('[data-clear-filters]');
    if (clearBtn) {
      clearBtn.addEventListener('click', () => {
        this.activeFilters = {};
        document.querySelectorAll('[data-filter-category],[data-filter-rating]').forEach(b => b.classList.remove('active'));
        const firstCat = document.querySelector('[data-filter-category="all"]');
        if (firstCat) firstCat.classList.add('active');
        this.applyFilters();
      });
    }
  },

  applyFilters() {
    if (typeof DEMO_PRODUCTS === 'undefined') return;
    let products = [...DEMO_PRODUCTS];

    // Category
    if (this.activeFilters.category) {
      products = products.filter(p => p.category === this.activeFilters.category);
    }

    // Price range
    if (this.activeFilters.minPrice !== undefined) {
      products = products.filter(p => p.price >= this.activeFilters.minPrice);
    }
    if (this.activeFilters.maxPrice !== undefined) {
      products = products.filter(p => p.price <= this.activeFilters.maxPrice);
    }

    // Rating
    if (this.activeFilters.minRating) {
      products = products.filter(p => p.rating >= this.activeFilters.minRating);
    }

    // Sort
    switch (this.activeFilters.sort) {
      case 'price-asc': products.sort((a, b) => a.price - b.price); break;
      case 'price-desc': products.sort((a, b) => b.price - a.price); break;
      case 'rating': products.sort((a, b) => b.rating - a.rating); break;
      case 'newest': products.sort((a, b) => b.id - a.id); break;
      case 'popular': products.sort((a, b) => b.reviews - a.reviews); break;
    }

    this.renderProducts(products);
    this.updateResultCount(products.length);
  },

  renderProducts(products) {
    const grid = document.querySelector('.products-grid');
    if (!grid) return;

    if (products.length === 0) {
      grid.innerHTML = `
        <div class="empty-state" style="grid-column:1/-1">
          <span class="empty-state-icon">🔍</span>
          <h3 class="empty-state-title">No products found</h3>
          <p class="empty-state-text">Try adjusting your filters or search terms.</p>
          <button class="btn btn-outline" onclick="ProductFilters.clearAll()">Clear Filters</button>
        </div>
      `;
      return;
    }

    grid.innerHTML = products.map(p => this.renderProductCard(p)).join('');
    grid.querySelectorAll('.reveal').forEach(el => el.classList.add('visible'));
  },

  renderProductCard(p) {
    const discount = p.original
      ? Math.round((1 - p.price / p.original) * 100)
      : 0;

    return `
      <div class="product-card reveal" data-product-id="${p.id}">
        <div class="product-img-wrap">
          <div style="width:100%;height:100%;background:linear-gradient(135deg,${p.color}22,${p.color}44);display:flex;align-items:center;justify-content:center;font-size:5rem">
            ${p.emoji}
          </div>
          <div class="product-badges">
            ${discount > 0 ? `<span class="badge badge-sale">-${discount}%</span>` : ''}
            ${p.id <= 3 ? '<span class="badge badge-new">NEW</span>' : ''}
          </div>
          <div class="product-actions">
            <button class="product-action-btn" data-wishlist="${p.id}" title="Add to Wishlist">♡</button>
            <button class="product-action-btn" data-compare="${p.id}" title="Compare">⚖</button>
            <button class="product-action-btn" onclick="window.location='product.html'" title="Quick View">👁</button>
          </div>
          <div class="product-quick-add" data-add-to-cart="${p.id}">
            🛒 Add to Cart
          </div>
        </div>
        <div class="product-info">
          <div class="product-category">${p.category}</div>
          <a href="product.html" class="product-name">${p.name}</a>
          <div class="product-rating">
            <div class="stars">${renderStars(p.rating)}</div>
            <span class="rating-count">(${p.reviews})</span>
          </div>
          <div class="product-price-row">
            <span class="product-price">$${p.price.toFixed(2)}</span>
            ${p.original ? `<span class="product-price-original">$${p.original.toFixed(2)}</span>` : ''}
          </div>
        </div>
      </div>
    `;
  },

  updateResultCount(count) {
    const countEl = document.querySelector('[data-results-count]');
    if (countEl) {
      countEl.textContent = count;
    }
  },

  initPriceSlider() {
    const minSlider = document.querySelector('[data-price-min]');
    const maxSlider = document.querySelector('[data-price-max]');
    const minDisplay = document.querySelector('[data-price-min-display]');
    const maxDisplay = document.querySelector('[data-price-max-display]');

    if (!minSlider || !maxSlider) return;

    const update = () => {
      const min = parseInt(minSlider.value);
      const max = parseInt(maxSlider.value);

      if (min > max) {
        minSlider.value = max;
        return;
      }

      if (minDisplay) minDisplay.textContent = `$${min}`;
      if (maxDisplay) maxDisplay.textContent = `$${max}`;

      this.activeFilters.minPrice = min;
      this.activeFilters.maxPrice = max;

      clearTimeout(this._priceTimer);
      this._priceTimer = setTimeout(() => this.applyFilters(), 400);
    };

    minSlider.addEventListener('input', update);
    maxSlider.addEventListener('input', update);
  },

  initMobileFilterToggle() {
    const mobileFilterBtn = document.querySelector('[data-toggle-filters]');
    const sidebar = document.querySelector('.shop-sidebar, .sidebar-drawer');
    const overlay = document.querySelector('.filter-mobile-overlay');

    if (!mobileFilterBtn || !sidebar) return;

    mobileFilterBtn.addEventListener('click', () => {
      sidebar.classList.toggle('open');
      overlay?.classList.toggle('active');
    });

    overlay?.addEventListener('click', () => {
      sidebar.classList.remove('open');
      overlay.classList.remove('active');
    });
  },

  clearAll() {
    this.activeFilters = {};
    this.applyFilters();
  }
};
