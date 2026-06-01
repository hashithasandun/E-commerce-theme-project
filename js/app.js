/* ============================================================
   RStore - Core App JavaScript
   Theme initialization, dark mode, scroll effects, etc.
   ============================================================ */

'use strict';

// ============================================================
// RSTORE CORE APP
// ============================================================
const RStore = {

  // State
  state: {
    theme: localStorage.getItem('rstore-theme') || 'light',
    cartCount: 0,
    wishlistCount: 0,
    compareCount: 0,
    isScrolled: false,
    mobileMenuOpen: false,
    cartDrawerOpen: false,
  },

  // Init
  init() {
    this.applyTheme(this.state.theme);
    this.initScroll();
    this.initMobileMenu();
    this.initCartDrawer();
    this.initSearch();
    this.initScrollReveal();
    this.initBackToTop();
    this.initCounters();
    this.updateBadges();
    this.initSmoothScroll();
    this.initPageLoad();
    console.log('%c🛍 R Store Theme Loaded!', 'color:#6C3FE8;font-size:14px;font-weight:bold;');
  },

  // ============================================================
  // DARK MODE / THEME
  // ============================================================
  applyTheme(theme) {
    document.documentElement.setAttribute('data-theme', theme);
    this.state.theme = theme;
    localStorage.setItem('rstore-theme', theme);

    const toggles = document.querySelectorAll('[data-theme-toggle]');
    toggles.forEach(t => {
      const icon = t.querySelector('i, .theme-icon');
      if (icon) {
        icon.className = theme === 'dark' ? 'fa fa-sun-o' : 'fa fa-moon-o';
      }
      t.innerHTML = theme === 'dark'
        ? '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/><line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/></svg>'
        : '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>';
    });
  },

  toggleTheme() {
    const newTheme = this.state.theme === 'light' ? 'dark' : 'light';
    this.applyTheme(newTheme);

    // Add animation
    document.body.style.transition = 'background-color 0.3s ease, color 0.3s ease';
    setTimeout(() => { document.body.style.transition = ''; }, 400);
  },

  // ============================================================
  // SCROLL EFFECTS
  // ============================================================
  initScroll() {
    let lastScroll = 0;
    const header = document.querySelector('.site-header');
    const nav = document.querySelector('.main-nav');

    window.addEventListener('scroll', () => {
      const scrollY = window.pageYOffset;

      // Header shadow
      if (header) {
        if (scrollY > 50) {
          header.classList.add('scrolled');
        } else {
          header.classList.remove('scrolled');
        }
      }

      // Hide nav on scroll down (optional)
      if (nav) {
        if (scrollY > lastScroll && scrollY > 200) {
          nav.style.transform = 'translateY(-100%)';
        } else {
          nav.style.transform = 'translateY(0)';
        }
      }

      lastScroll = scrollY;
      this.state.isScrolled = scrollY > 50;

      // Back to top
      this.updateBackToTop(scrollY);
    }, { passive: true });
  },

  // ============================================================
  // SCROLL REVEAL (Intersection Observer)
  // ============================================================
  initScrollReveal() {
    const observer = new IntersectionObserver((entries) => {
      entries.forEach((entry, i) => {
        if (entry.isIntersecting) {
          const el = entry.target;
          const delay = el.dataset.delay || (i * 50);
          setTimeout(() => {
            el.classList.add('visible');
          }, parseInt(delay));
          observer.unobserve(el);
        }
      });
    }, {
      threshold: 0.1,
      rootMargin: '0px 0px -50px 0px'
    });

    document.querySelectorAll('.reveal, .reveal-left, .reveal-right, .reveal-scale').forEach(el => {
      observer.observe(el);
    });
  },

  // ============================================================
  // BACK TO TOP
  // ============================================================
  initBackToTop() {
    const btn = document.querySelector('.back-to-top');
    if (!btn) return;

    btn.addEventListener('click', () => {
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });
  },

  updateBackToTop(scrollY) {
    const btn = document.querySelector('.back-to-top');
    if (!btn) return;
    btn.classList.toggle('visible', scrollY > 400);
  },

  // ============================================================
  // MOBILE MENU
  // ============================================================
  initMobileMenu() {
    const toggle = document.querySelector('.mobile-menu-toggle');
    const menu = document.querySelector('.mobile-menu');
    const overlay = document.querySelector('.mobile-menu-overlay');
    const panel = document.querySelector('.mobile-menu-panel');

    if (!toggle || !menu) return;

    toggle.addEventListener('click', () => this.toggleMobileMenu());

    if (overlay) {
      overlay.addEventListener('click', () => this.closeMobileMenu());
    }

    // Close on escape
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && this.state.mobileMenuOpen) {
        this.closeMobileMenu();
      }
    });
  },

  toggleMobileMenu() {
    this.state.mobileMenuOpen ? this.closeMobileMenu() : this.openMobileMenu();
  },

  openMobileMenu() {
    const menu = document.querySelector('.mobile-menu');
    if (!menu) return;
    menu.classList.add('active');
    document.body.style.overflow = 'hidden';
    this.state.mobileMenuOpen = true;
  },

  closeMobileMenu() {
    const menu = document.querySelector('.mobile-menu');
    if (!menu) return;
    menu.classList.remove('active');
    document.body.style.overflow = '';
    this.state.mobileMenuOpen = false;
  },

  // ============================================================
  // CART DRAWER
  // ============================================================
  initCartDrawer() {
    // Open triggers
    document.querySelectorAll('[data-open-cart]').forEach(el => {
      el.addEventListener('click', () => this.openCartDrawer());
    });

    // Close triggers
    document.querySelectorAll('[data-close-cart]').forEach(el => {
      el.addEventListener('click', () => this.closeCartDrawer());
    });

    const overlay = document.querySelector('.cart-drawer-overlay');
    if (overlay) {
      overlay.addEventListener('click', () => this.closeCartDrawer());
    }

    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && this.state.cartDrawerOpen) {
        this.closeCartDrawer();
      }
    });
  },

  openCartDrawer() {
    const drawer = document.querySelector('.cart-drawer');
    const overlay = document.querySelector('.cart-drawer-overlay');
    if (!drawer) return;

    drawer.classList.add('active');
    overlay?.classList.add('active');
    document.body.style.overflow = 'hidden';
    this.state.cartDrawerOpen = true;

    Cart.renderDrawer();
  },

  closeCartDrawer() {
    const drawer = document.querySelector('.cart-drawer');
    const overlay = document.querySelector('.cart-drawer-overlay');

    drawer?.classList.remove('active');
    overlay?.classList.remove('active');
    document.body.style.overflow = '';
    this.state.cartDrawerOpen = false;
  },

  // ============================================================
  // SEARCH
  // ============================================================
  initSearch() {
    const input = document.querySelector('.header-search-input');
    const dropdown = document.querySelector('.search-dropdown');

    if (!input) return;

    let searchTimer;

    input.addEventListener('input', (e) => {
      clearTimeout(searchTimer);
      const val = e.target.value.trim();

      if (val.length < 2) {
        dropdown?.classList.remove('active');
        return;
      }

      searchTimer = setTimeout(() => {
        this.showSearchResults(val, dropdown);
      }, 300);
    });

    input.addEventListener('focus', () => {
      if (input.value.length >= 2) {
        dropdown?.classList.add('active');
      }
    });

    document.addEventListener('click', (e) => {
      if (!e.target.closest('.header-search')) {
        dropdown?.classList.remove('active');
      }
    });

    // Mobile search toggle
    const searchBtn = document.querySelector('[data-toggle-search]');
    const headerSearch = document.querySelector('.header-search');
    if (searchBtn && headerSearch) {
      searchBtn.addEventListener('click', () => {
        headerSearch.classList.toggle('mobile-visible');
        if (headerSearch.classList.contains('mobile-visible')) {
          input.focus();
        }
      });
    }
  },

  showSearchResults(query, dropdown) {
    if (!dropdown) return;

    // Search in products data
    const results = DEMO_PRODUCTS.filter(p =>
      p.name.toLowerCase().includes(query.toLowerCase()) ||
      p.category.toLowerCase().includes(query.toLowerCase())
    ).slice(0, 5);

    if (results.length === 0) {
      dropdown.innerHTML = `<p class="text-muted text-sm" style="padding:12px">No results for "${query}"</p>`;
      dropdown.classList.add('active');
      return;
    }

    dropdown.innerHTML = `
      <div class="search-category">Products</div>
      ${results.map(p => `
        <div class="search-item" onclick="window.location='product.html'">
          <div class="search-item-img">
            <div style="width:100%;height:100%;background:${p.color || 'var(--bg-tertiary)'};display:flex;align-items:center;justify-content:center;font-size:1.5rem">${p.emoji || '📦'}</div>
          </div>
          <div class="search-item-info">
            <div class="search-item-name">${p.name}</div>
            <div class="search-item-price">$${p.price.toFixed(2)}</div>
          </div>
        </div>
      `).join('')}
      <div style="padding-top:12px;border-top:1px solid var(--border-color);margin-top:8px;">
        <a href="search.html?q=${encodeURIComponent(query)}" class="btn btn-outline btn-sm btn-full">See all results</a>
      </div>
    `;

    dropdown.classList.add('active');
  },

  // ============================================================
  // COUNTERS (Animated number counting)
  // ============================================================
  initCounters() {
    const counters = document.querySelectorAll('[data-counter]');

    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          this.animateCounter(entry.target);
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.5 });

    counters.forEach(c => observer.observe(c));
  },

  animateCounter(el) {
    const target = parseFloat(el.dataset.counter);
    const duration = parseInt(el.dataset.duration) || 2000;
    const prefix = el.dataset.prefix || '';
    const suffix = el.dataset.suffix || '';
    const decimals = (target % 1 !== 0) ? 1 : 0;

    const start = performance.now();

    const update = (time) => {
      const elapsed = time - start;
      const progress = Math.min(elapsed / duration, 1);
      const eased = 1 - Math.pow(1 - progress, 3); // ease out cubic
      const current = (target * eased).toFixed(decimals);

      el.textContent = prefix + Number(current).toLocaleString() + suffix;

      if (progress < 1) requestAnimationFrame(update);
    };

    requestAnimationFrame(update);
  },

  // ============================================================
  // BADGES UPDATE
  // ============================================================
  updateBadges() {
    // Cart
    const cartCount = Cart.getCount();
    this.state.cartCount = cartCount;
    document.querySelectorAll('[data-cart-count]').forEach(el => {
      el.textContent = cartCount;
      el.style.display = cartCount > 0 ? 'flex' : 'none';
    });

    // Wishlist
    const wishlistCount = Wishlist.getCount();
    this.state.wishlistCount = wishlistCount;
    document.querySelectorAll('[data-wishlist-count]').forEach(el => {
      el.textContent = wishlistCount;
      el.style.display = wishlistCount > 0 ? 'flex' : 'none';
    });

    // Compare
    const compareCount = Compare.getCount();
    this.state.compareCount = compareCount;
    document.querySelectorAll('[data-compare-count]').forEach(el => {
      el.textContent = compareCount;
      el.style.display = compareCount > 0 ? 'flex' : 'none';
    });
  },

  // ============================================================
  // SMOOTH SCROLL (Anchor links)
  // ============================================================
  initSmoothScroll() {
    document.querySelectorAll('a[href^="#"]').forEach(link => {
      link.addEventListener('click', (e) => {
        const target = document.querySelector(link.getAttribute('href'));
        if (target) {
          e.preventDefault();
          const offset = 130; // header + nav height
          const top = target.getBoundingClientRect().top + window.pageYOffset - offset;
          window.scrollTo({ top, behavior: 'smooth' });
        }
      });
    });
  },

  // ============================================================
  // PAGE LOAD ANIMATION
  // ============================================================
  initPageLoad() {
    document.body.classList.add('page-loaded');
    setTimeout(() => {
      document.querySelectorAll('.animate-on-load').forEach((el, i) => {
        setTimeout(() => {
          el.style.opacity = '1';
          el.style.transform = 'translateY(0)';
        }, i * 100);
      });
    }, 100);
  },

};

// ============================================================
// TOAST NOTIFICATIONS
// ============================================================
const Toast = {
  show(options = {}) {
    const {
      title = 'Notification',
      message = '',
      type = 'success',
      duration = 3500,
      icon = null
    } = options;

    let container = document.querySelector('.toast-container');
    if (!container) {
      container = document.createElement('div');
      container.className = 'toast-container';
      document.body.appendChild(container);
    }

    const icons = { success: '✓', error: '✕', warning: '⚠', info: 'ℹ' };
    const toastIcon = icon || icons[type] || icons.info;

    const toast = document.createElement('div');
    toast.className = `toast toast-${type}`;
    toast.innerHTML = `
      <div class="toast-icon">${toastIcon}</div>
      <div class="toast-content">
        <div class="toast-title">${title}</div>
        ${message ? `<div class="toast-msg">${message}</div>` : ''}
      </div>
      <div class="toast-close" onclick="Toast.remove(this.parentElement)">✕</div>
    `;

    container.appendChild(toast);

    setTimeout(() => Toast.remove(toast), duration);

    return toast;
  },

  remove(toast) {
    if (!toast) return;
    toast.classList.add('removing');
    setTimeout(() => toast.remove(), 300);
  },

  success(title, message) { return this.show({ title, message, type: 'success' }); },
  error(title, message) { return this.show({ title, message, type: 'error' }); },
  warning(title, message) { return this.show({ title, message, type: 'warning' }); },
  info(title, message) { return this.show({ title, message, type: 'info' }); },
};

// ============================================================
// MODAL MANAGER
// ============================================================
const Modal = {
  open(id) {
    const overlay = document.getElementById(id);
    if (!overlay) return;
    overlay.classList.add('active');
    document.body.style.overflow = 'hidden';
  },

  close(id) {
    const overlay = id
      ? document.getElementById(id)
      : document.querySelector('.modal-overlay.active');
    if (!overlay) return;
    overlay.classList.remove('active');
    document.body.style.overflow = '';
  },

  init() {
    document.querySelectorAll('[data-modal-open]').forEach(el => {
      el.addEventListener('click', () => this.open(el.dataset.modalOpen));
    });

    document.querySelectorAll('[data-modal-close], .modal-close').forEach(el => {
      el.addEventListener('click', () => {
        const overlay = el.closest('.modal-overlay');
        if (overlay) {
          overlay.classList.remove('active');
          document.body.style.overflow = '';
        }
      });
    });

    document.querySelectorAll('.modal-overlay').forEach(overlay => {
      overlay.addEventListener('click', (e) => {
        if (e.target === overlay) {
          overlay.classList.remove('active');
          document.body.style.overflow = '';
        }
      });
    });

    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') {
        document.querySelectorAll('.modal-overlay.active').forEach(o => {
          o.classList.remove('active');
          document.body.style.overflow = '';
        });
      }
    });
  }
};

// ============================================================
// ACCORDION
// ============================================================
const Accordion = {
  init() {
    document.querySelectorAll('.accordion-header').forEach(header => {
      header.addEventListener('click', () => {
        const item = header.closest('.accordion-item');
        const isOpen = item.classList.contains('open');

        // Close all in same group
        const group = item.closest('.accordion');
        if (group) {
          group.querySelectorAll('.accordion-item.open').forEach(i => {
            i.classList.remove('open');
          });
        }

        if (!isOpen) item.classList.add('open');
      });
    });
  }
};

// ============================================================
// TABS
// ============================================================
const Tabs = {
  init() {
    document.querySelectorAll('.tab-btn').forEach(btn => {
      btn.addEventListener('click', () => {
        const tabGroup = btn.closest('[data-tabs]') || btn.closest('.tabs-wrapper') || btn.parentElement;
        const targetId = btn.dataset.tab;
        const targetPanel = document.getElementById(targetId) || document.querySelector(`[data-tab-panel="${targetId}"]`);

        // Deactivate siblings
        tabGroup.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');

        // Find tab panels container
        const panelsContainer = document.querySelector(`[data-tab-panels="${btn.closest('[data-tabs]')?.dataset.tabs}"]`)
          || btn.closest('.tabs-wrapper')?.querySelector('.tab-panels')
          || document.querySelector('.tab-panels');

        if (panelsContainer) {
          panelsContainer.querySelectorAll('.tab-panel').forEach(p => p.classList.remove('active'));
        }

        if (targetPanel) targetPanel.classList.add('active');
      });
    });
  }
};

// ============================================================
// FILTER PANELS (Sidebar accordion)
// ============================================================
const FilterPanels = {
  init() {
    document.querySelectorAll('.filter-panel-header').forEach(header => {
      header.addEventListener('click', () => {
        const panel = header.closest('.filter-panel');
        panel.classList.toggle('open');
      });

      // Open by default
      const panel = header.closest('.filter-panel');
      if (panel.dataset.defaultOpen !== 'false') {
        panel.classList.add('open');
      }
    });
  }
};

// ============================================================
// DEMO PRODUCTS DATA
// ============================================================
const DEMO_PRODUCTS = [
  { id: 1, name: 'Premium Wireless Headphones', price: 129.99, original: 199.99, rating: 4.8, reviews: 234, category: 'Electronics', emoji: '🎧', color: '#667EEA' },
  { id: 2, name: 'Designer Leather Jacket', price: 289.00, original: 420.00, rating: 4.9, reviews: 89, category: 'Fashion', emoji: '🧥', color: '#764BA2' },
  { id: 3, name: 'Smart Fitness Watch', price: 199.00, original: 299.00, rating: 4.7, reviews: 456, category: 'Electronics', emoji: '⌚', color: '#F093FB' },
  { id: 4, name: 'Minimalist Running Shoes', price: 89.99, original: 149.99, rating: 4.6, reviews: 178, category: 'Shoes', emoji: '👟', color: '#4FACFE' },
  { id: 5, name: 'Organic Face Serum', price: 45.00, original: 75.00, rating: 4.9, reviews: 321, category: 'Beauty', emoji: '✨', color: '#43E97B' },
  { id: 6, name: 'Ergonomic Office Chair', price: 399.00, original: 599.00, rating: 4.5, reviews: 67, category: 'Furniture', emoji: '🪑', color: '#FA709A' },
  { id: 7, name: 'Ceramic Pour-Over Coffee Set', price: 65.00, original: 90.00, rating: 4.8, reviews: 112, category: 'Kitchen', emoji: '☕', color: '#FEE140' },
  { id: 8, name: 'Portable Bluetooth Speaker', price: 79.99, original: 120.00, rating: 4.7, reviews: 289, category: 'Electronics', emoji: '🔊', color: '#30CFD0' },
  { id: 9, name: 'Merino Wool Sweater', price: 110.00, original: 160.00, rating: 4.6, reviews: 143, category: 'Fashion', emoji: '🧶', color: '#667EEA' },
  { id: 10, name: 'Stainless Steel Water Bottle', price: 32.00, original: 50.00, rating: 4.9, reviews: 567, category: 'Sports', emoji: '🍶', color: '#764BA2' },
  { id: 11, name: 'Wireless Mechanical Keyboard', price: 159.00, original: 220.00, rating: 4.7, reviews: 98, category: 'Electronics', emoji: '⌨️', color: '#F093FB' },
  { id: 12, name: 'Natural Beeswax Candle Set', price: 28.00, original: 40.00, rating: 4.8, reviews: 203, category: 'Home', emoji: '🕯️', color: '#4FACFE' },
];

// ============================================================
// CONFETTI
// ============================================================
function launchConfetti(count = 80) {
  const colors = ['#6C3FE8', '#A855F7', '#EC4899', '#00D4AA', '#FFB800', '#FF6B6B'];

  for (let i = 0; i < count; i++) {
    const piece = document.createElement('div');
    piece.className = 'confetti-piece';
    piece.style.cssText = `
      left: ${Math.random() * 100}vw;
      top: -20px;
      background: ${colors[Math.floor(Math.random() * colors.length)]};
      transform: rotate(${Math.random() * 360}deg);
      width: ${Math.random() * 12 + 6}px;
      height: ${Math.random() * 8 + 4}px;
      --tx: ${(Math.random() - 0.5) * 200}px;
      --duration: ${Math.random() * 2 + 1.5}s;
      --delay: ${Math.random() * 0.5}s;
    `;
    document.body.appendChild(piece);
    setTimeout(() => piece.remove(), 3500);
  }
}

// ============================================================
// VIEW TOGGLE (Grid / List)
// ============================================================
function initViewToggle() {
  const btns = document.querySelectorAll('.view-btn');
  const grid = document.querySelector('.products-grid');

  btns.forEach(btn => {
    btn.addEventListener('click', () => {
      btns.forEach(b => b.classList.remove('active'));
      btn.classList.add('active');

      if (!grid) return;
      const view = btn.dataset.view;

      grid.classList.remove('products-list');
      if (view === 'list') grid.classList.add('products-list');
    });
  });
}

// ============================================================
// COLS TOGGLE (2/3/4 columns)
// ============================================================
function initColsToggle() {
  const btns = document.querySelectorAll('[data-cols]');
  const grid = document.querySelector('.products-grid');

  btns.forEach(btn => {
    btn.addEventListener('click', () => {
      btns.forEach(b => b.classList.remove('active'));
      btn.classList.add('active');

      if (!grid) return;
      grid.className = `products-grid cols-${btn.dataset.cols}`;
    });
  });
}

// ============================================================
// STAR RATING RENDER
// ============================================================
function renderStars(rating, max = 5) {
  let html = '';
  for (let i = 1; i <= max; i++) {
    if (i <= Math.floor(rating)) {
      html += '<span class="star">★</span>';
    } else if (i - 0.5 <= rating) {
      html += '<span class="star half">★</span>';
    } else {
      html += '<span class="star empty">★</span>';
    }
  }
  return html;
}

// ============================================================
// THEME TOGGLE BUTTON
// ============================================================
document.addEventListener('DOMContentLoaded', () => {
  // Theme toggle
  document.querySelectorAll('[data-theme-toggle]').forEach(btn => {
    btn.addEventListener('click', () => RStore.toggleTheme());
  });

  // Init all modules
  RStore.init();
  Modal.init();
  Accordion.init();
  Tabs.init();
  FilterPanels.init();
  initViewToggle();
  initColsToggle();

  // Cart, Wishlist, Compare (from their own files)
  if (typeof Cart !== 'undefined') Cart.init();
  if (typeof Wishlist !== 'undefined') Wishlist.init();
  if (typeof Compare !== 'undefined') Compare.init();
  if (typeof SalesBooster !== 'undefined') SalesBooster.init();
  if (typeof MegaMenu !== 'undefined') MegaMenu.init();
  if (typeof Checkout !== 'undefined') Checkout.init();
  if (typeof ProductSlider !== 'undefined') ProductSlider.init();
  if (typeof ProductFilters !== 'undefined') ProductFilters.init();
});
