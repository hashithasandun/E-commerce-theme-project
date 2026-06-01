/* ============================================================
   RStore - Premium Wishlist Management Engine (Plugin-Free)
   ============================================================ */
'use strict';

const Wishlist = {
  STORAGE_KEY: 'rstore-wishlist',
  items: [], // Array of product objects (guests) or product IDs (logged-in)

  // ============================================================
  // INIT
  // ============================================================
  init() {
    this.load();
    this.bindGlobalEvents();
    this.updateButtons();
    this.renderPage();
  },

  // ============================================================
  // PERSISTENCE & LOAD
  // ============================================================
  load() {
    if (window.rstore_vars && window.rstore_vars.is_logged_in) {
      // Logged in: Load initial IDs list synced from WordPress metadata database
      var ids = window.rstore_vars.user_wishlist || [];
      this.items = ids.map(function(id) {
        return { id: parseInt(id) }; // Load basic placeholder objects with IDs
      });
      // Optionally merge guest items from localStorage to DB if any exists
      this.syncGuestItemsToDatabase();
    } else {
      // Guest: Fallback to client-side localStorage
      try {
        const saved = localStorage.getItem(this.STORAGE_KEY);
        this.items = saved ? JSON.parse(saved) : [];
      } catch (e) {
        this.items = [];
      }
    }
  },

  saveLocal() {
    if (!window.rstore_vars || !window.rstore_vars.is_logged_in) {
      localStorage.setItem(this.STORAGE_KEY, JSON.stringify(this.items));
    }
    RStore.updateBadges();
    this.updateButtons();
  },

  syncGuestItemsToDatabase() {
    try {
      const saved = localStorage.getItem(this.STORAGE_KEY);
      const guestItems = saved ? JSON.parse(saved) : [];
      if (Array.isArray(guestItems) && guestItems.length > 0) {
        // Sync each guest item to user metadata table sequentially
        guestItems.forEach(item => {
          if (!this.has(item.id)) {
            this.sendToggleRequest(item.id, 'add');
          }
        });
        // Clear guest storage after syncing
        localStorage.removeItem(this.STORAGE_KEY);
      }
    } catch (e) {
      // Fail silently
    }
  },

  // ============================================================
  // STATE OPERATIONS
  // ============================================================
  toggle(product, btnElement) {
    var productId = parseInt(product.id);

    // Trigger visual heart-burst scale animation immediately
    if (btnElement) {
      btnElement.classList.add('wishlist-burst');
      setTimeout(function() {
        btnElement.classList.remove('wishlist-burst');
      }, 450);
    }

    if (window.rstore_vars && window.rstore_vars.is_logged_in) {
      // Logged in: Send AJAX request to Hostinger database
      this.sendToggleRequest(productId, this.has(productId) ? 'remove' : 'add', product.name);
    } else {
      // Guest: Toggle in local storage array
      if (this.has(productId)) {
        this.items = this.items.filter(item => parseInt(item.id) !== productId);
        this.saveLocal();
        Toast.info('Removed from Wishlist', `${product.name} removed from your wishlist.`);
        this.animateCardRemoval(productId);
      } else {
        this.items.push({
          id: productId,
          name: product.name,
          price: parseFloat(product.price),
          original: product.original ? parseFloat(product.original) : null,
          image: product.image || null,
          emoji: product.emoji || '🛍',
          color: product.color || '#6C3FE8',
          category: product.category || '',
          savedAt: new Date().toISOString()
        });
        this.saveLocal();
        Toast.success('Added to Wishlist! ❤️', `${product.name} has been saved to your wishlist.`);
      }
      this.renderPage();
    }
  },

  sendToggleRequest(productId, action, productName) {
    var ajaxUrl = window.rstore_vars.ajax_url || '/wp-admin/admin-ajax.php';
    var formData = new FormData();
    formData.append('action', 'rstore_toggle_wishlist');
    formData.append('product_id', productId);

    fetch(ajaxUrl, {
      method: 'POST',
      body: formData
    })
    .then(response => response.json())
    .then(response => {
      if (response.success && response.data) {
        // Sync state with server response array
        var ids = response.data.items || [];
        this.items = ids.map(id => ({ id: parseInt(id) }));
        
        RStore.updateBadges();
        this.updateButtons();

        if (productName) {
          if (response.data.status === 'added') {
            Toast.success('Added to Wishlist! ❤️', `${productName} has been saved to your database wishlist.`);
          } else {
            Toast.info('Removed from Wishlist', `${productName} has been removed.`);
            this.animateCardRemoval(productId);
          }
        }
        
        // Reload page details if we are on the wishlist template page to keep SQL data aligned
        var grid = document.getElementById('wishlist-grid');
        if (grid) {
          setTimeout(() => { location.reload(); }, 600);
        }
      }
    })
    .catch(() => {
      Toast.error('Connection Error', 'Failed to update wishlist on the server.');
    });
  },

  has(id) {
    return this.items.some(item => parseInt(item.id) === parseInt(id));
  },

  getCount() {
    return this.items.length;
  },

  // ============================================================
  // UI RENDERERS
  // ============================================================
  updateButtons() {
    document.querySelectorAll('[data-wishlist]').forEach(btn => {
      const id = parseInt(btn.dataset.wishlist);
      const isWishlisted = this.has(id);
      
      btn.classList.toggle('wishlisted', isWishlisted);
      btn.title = isWishlisted ? 'Remove from Wishlist' : 'Add to Wishlist';

      if (isWishlisted) {
        btn.style.color = 'var(--clr-danger)';
        var icon = btn.querySelector('svg');
        if (icon) {
          icon.setAttribute('fill', 'var(--clr-danger)');
          icon.setAttribute('stroke', 'var(--clr-danger)');
        }
      } else {
        btn.style.color = '';
        var icon = btn.querySelector('svg');
        if (icon) {
          icon.setAttribute('fill', 'none');
          icon.setAttribute('stroke', 'currentColor');
        }
      }
    });
  },

  animateCardRemoval(productId) {
    var card = document.querySelector(`.wishlist-grid .product-card[data-product-id="${productId}"]`);
    if (card) {
      card.style.transition = 'all 0.5s cubic-bezier(0.4, 0, 0.2, 1)';
      card.style.opacity = '0';
      card.style.transform = 'scale(0.8) translateY(20px)';
      setTimeout(() => {
        card.remove();
        // Check if empty
        var grid = document.querySelector('.wishlist-grid');
        if (grid && grid.querySelectorAll('.product-card').length === 0) {
          this.renderPage();
        }
      }, 500);
    }
  },

  renderPage() {
    const grid = document.querySelector('.wishlist-grid');
    if (!grid) return;

    // For logged-in users, the wishlist page handles dynamic WooCommerce PHP loops natively,
    // so we only render empty states or let the client-side localStorage fallback handle guests.
    if (window.rstore_vars && window.rstore_vars.is_logged_in) {
      if (this.items.length === 0) {
        grid.innerHTML = `
          <div class="empty-state" style="grid-column:1/-1; padding: 60px 24px;">
            <span class="empty-state-icon">❤️</span>
            <h2 class="empty-state-title">Your wishlist is empty</h2>
            <p class="empty-state-text">Save items you love to your database wishlist and sync across devices!</p>
            <a href="${window.location.origin}/shop" class="btn btn-primary btn-lg">Discover Products</a>
          </div>
        `;
        // Hide control buttons
        var controls = document.querySelector('.wishlist-controls');
        if (controls) controls.style.display = 'none';
      }
      return;
    }

    // Guest local rendering
    if (this.items.length === 0) {
      grid.innerHTML = `
        <div class="empty-state" style="grid-column:1/-1; padding: 60px 24px;">
          <span class="empty-state-icon">❤️</span>
          <h2 class="empty-state-title">Your wishlist is empty</h2>
          <p class="empty-state-text">Save items you love to your guest wishlist and shop them later.</p>
          <a href="#" class="btn btn-primary btn-lg" onclick="RStore.closeCartDrawer(); return false;">Discover Products</a>
        </div>
      `;
      var controls = document.querySelector('.wishlist-controls');
      if (controls) controls.style.display = 'none';
      return;
    }

    grid.innerHTML = this.items.map(item => `
      <div class="product-card" data-product-id="${item.id}">
        <div class="product-img-wrap">
          <div style="width:100%;height:100%;background:${item.color || '#6C3FE8'};display:flex;align-items:center;justify-content:center;font-size:4rem">
            ${item.emoji || '📦'}
          </div>
          <button class="wishlist-item-remove" onclick="Wishlist.toggle({id: ${item.id}, name: '${item.name}'})" title="Remove">✕</button>
          <div class="product-badges">
            ${item.original && item.price < item.original ? `<span class="badge badge-sale">-${Math.round((1 - item.price / item.original) * 100)}%</span>` : ''}
          </div>
        </div>
        <div class="product-info">
          <div class="product-category">${item.category || 'Category'}</div>
          <div class="product-name">${item.name}</div>
          <div class="product-price-row">
            <span class="product-price">$${parseFloat(item.price).toFixed(2)}</span>
            ${item.original ? `<span class="product-price-original">$${parseFloat(item.original).toFixed(2)}</span>` : ''}
          </div>
          <button class="btn btn-primary btn-full mt-auto" style="margin-top:16px" onclick="RStore.addToCart(${item.id}, '${item.name}', ${item.price}, '${item.image}')">
            Add to Cart
          </button>
        </div>
      </div>
    `).join('');
  },

  // ============================================================
  // GLOBAL LISTENERS
  // ============================================================
  bindGlobalEvents() {
    document.addEventListener('click', (e) => {
      const wishBtn = e.target.closest('[data-wishlist]');
      if (wishBtn) {
        e.preventDefault();
        const id = parseInt(wishBtn.dataset.wishlist);
        
        // Find product attributes inside local DOM card or fallback to placeholder
        const card = wishBtn.closest('.product-card') || wishBtn.closest('.quick-view-container');
        var name = card ? card.querySelector('.product-name, .quick-view-title')?.textContent.trim() : 'Product';
        var price = card ? card.querySelector('.product-price, .quick-view-price')?.textContent.replace(/[^0-9.]/g, '') : '0.00';
        var image = card ? card.querySelector('.product-img-wrap img, .qv-gallery-slide img')?.src : '';

        const product = {
          id: id,
          name: name || 'Product',
          price: parseFloat(price) || 0.00,
          image: image || ''
        };

        this.toggle(product, wishBtn);
      }
    });
  }
};

// Initialize Wishlist Engine
Wishlist.init();
