/* ============================================================
   RStore - Sales Booster Module
   Fake viewers, sale popups, countdown timers, stock urgency
   ============================================================ */
'use strict';

const SalesBooster = {

  config: {
    popupDelay: 5000,        // ms before first popup
    popupInterval: 18000,    // ms between popups
    viewerMin: 8,
    viewerMax: 47,
    viewerUpdateInterval: 4000,
    stockMin: 3,
    stockMax: 12,
  },

  fakeCustomers: [
    { name: 'Amal from Colombo', time: '2 minutes ago' },
    { name: 'Priya from Kandy', time: '5 minutes ago' },
    { name: 'Niro from Galle', time: 'just now' },
    { name: 'Kasun from Colombo', time: '3 minutes ago' },
    { name: 'Dilani from Matara', time: '1 minute ago' },
    { name: 'Ruwan from Negombo', time: '7 minutes ago' },
    { name: 'Sandya from Jaffna', time: '4 minutes ago' },
    { name: 'Tharaka from Kurunegala', 'time': 'just now' },
    { name: 'Malini from Ratnapura', 'time': '6 minutes ago' },
    { name: 'Chamara from Anuradhapura', 'time': '8 minutes ago' },
    { name: 'Sarah from New York', time: '12 minutes ago' },
    { name: 'James from London', time: 'just now' },
    { name: 'Emma from Paris', time: '3 minutes ago' },
    { name: 'Luca from Rome', time: '5 minutes ago' },
    { name: 'Yuki from Tokyo', time: '2 minutes ago' },
  ],

  fakeProducts: [
    { name: 'Premium Wireless Headphones', emoji: '🎧', color: '#667EEA' },
    { name: 'Designer Leather Jacket', emoji: '🧥', color: '#764BA2' },
    { name: 'Smart Fitness Watch', emoji: '⌚', color: '#F093FB' },
    { name: 'Minimalist Running Shoes', emoji: '👟', color: '#4FACFE' },
    { name: 'Organic Face Serum', emoji: '✨', color: '#43E97B' },
    { name: 'Portable Bluetooth Speaker', emoji: '🔊', color: '#30CFD0' },
    { name: 'Ceramic Coffee Set', emoji: '☕', color: '#FEE140' },
  ],

  init() {
    this.initViewerCount();
    this.initSalePopups();
    this.initCountdownTimers();
    this.initStockUrgency();
    this.initRecentOrders();
  },

  // ============================================================
  // FAKE VIEWER COUNT
  // ============================================================
  initViewerCount() {
    const viewerEls = document.querySelectorAll('[data-viewer-count]');
    if (!viewerEls.length) return;

    const updateViewers = () => {
      const count = Math.floor(
        Math.random() * (this.config.viewerMax - this.config.viewerMin) +
        this.config.viewerMin
      );

      viewerEls.forEach(el => {
        el.classList.add('animate-fadeIn');
        el.textContent = count;
        setTimeout(() => el.classList.remove('animate-fadeIn'), 400);
      });
    };

    updateViewers();
    setInterval(updateViewers, this.config.viewerUpdateInterval);
  },

  // ============================================================
  // SALE POPUPS (Fake purchase notifications)
  // ============================================================
  initSalePopups() {
    const popup = document.querySelector('.sales-popup');
    if (!popup) return;

    let popupTimeout;

    const showPopup = () => {
      const customer = this.fakeCustomers[Math.floor(Math.random() * this.fakeCustomers.length)];
      const product = this.fakeProducts[Math.floor(Math.random() * this.fakeProducts.length)];

      popup.innerHTML = `
        <div class="sales-popup-img" style="background:${product.color};display:flex;align-items:center;justify-content:center;font-size:1.8rem">
          ${product.emoji}
        </div>
        <div class="sales-popup-info">
          <div class="sales-popup-name">${customer.name}</div>
          <div class="sales-popup-meta">purchased <strong>${product.name}</strong></div>
          <div class="sales-popup-meta" style="margin-top:2px">🕐 ${customer.time}</div>
        </div>
        <button class="sales-popup-close" onclick="this.parentElement.classList.remove('visible')">✕</button>
      `;

      popup.classList.add('visible');

      setTimeout(() => {
        popup.classList.remove('visible');
        popupTimeout = setTimeout(showPopup, this.config.popupInterval);
      }, 5000);
    };

    popupTimeout = setTimeout(showPopup, this.config.popupDelay);

    popup.querySelector('.sales-popup-close')?.addEventListener('click', () => {
      clearTimeout(popupTimeout);
      popup.classList.remove('visible');
      popupTimeout = setTimeout(showPopup, this.config.popupInterval);
    });
  },

  // ============================================================
  // COUNTDOWN TIMERS
  // ============================================================
  initCountdownTimers() {
    document.querySelectorAll('[data-countdown]').forEach(el => {
      const endTimeStr = el.dataset.countdown;
      let endTime;

      if (endTimeStr === 'auto') {
        // Auto-set to end of today or X hours from now
        const hours = parseInt(el.dataset.countdownHours || '24');
        endTime = new Date(Date.now() + hours * 60 * 60 * 1000);
        el.dataset.countdown = endTime.toISOString();
      } else {
        endTime = new Date(endTimeStr);
      }

      // Fallback: 24 hours from now if date is invalid or past
      if (isNaN(endTime) || endTime <= new Date()) {
        endTime = new Date(Date.now() + 24 * 60 * 60 * 1000);
      }

      this.startCountdown(el, endTime);
    });
  },

  startCountdown(el, endTime) {
    const hEl = el.querySelector('[data-hours]');
    const mEl = el.querySelector('[data-minutes]');
    const sEl = el.querySelector('[data-seconds]');
    const dEl = el.querySelector('[data-days]');

    const update = () => {
      const now = new Date();
      const diff = endTime - now;

      if (diff <= 0) {
        // Reset to 24 hours
        endTime = new Date(Date.now() + 24 * 60 * 60 * 1000);
        return;
      }

      const days = Math.floor(diff / (1000 * 60 * 60 * 24));
      const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
      const seconds = Math.floor((diff % (1000 * 60)) / 1000);

      const pad = n => String(n).padStart(2, '0');

      if (dEl) dEl.textContent = pad(days);
      if (hEl) hEl.textContent = pad(hours);
      if (mEl) mEl.textContent = pad(minutes);
      if (sEl) {
        const prevSec = sEl.textContent;
        sEl.textContent = pad(seconds);
        if (prevSec !== pad(seconds)) {
          sEl.style.animation = 'none';
          sEl.offsetHeight; // reflow
          sEl.style.animation = 'countUp 0.3s ease';
        }
      }
    };

    update();
    setInterval(update, 1000);
  },

  // ============================================================
  // STOCK URGENCY
  // ============================================================
  initStockUrgency() {
    document.querySelectorAll('[data-stock-urgency]').forEach(el => {
      const count = parseInt(el.dataset.stockUrgency) ||
        Math.floor(Math.random() * (this.config.stockMax - this.config.stockMin) + this.config.stockMin);

      el.innerHTML = `
        <span style="color:var(--clr-danger)">🔥 Only ${count} left in stock</span>
        — order soon!
      `;

      // Low stock progress
      const bar = document.querySelector('[data-stock-bar]');
      if (bar) {
        const pct = Math.max(10, Math.min(85, count * 5));
        bar.style.width = `${pct}%`;
        bar.style.background = count < 5
          ? 'var(--clr-danger)'
          : count < 10
            ? 'var(--clr-warning)'
            : 'var(--clr-success)';
      }
    });
  },

  // ============================================================
  // RECENT ORDERS TICKER
  // ============================================================
  initRecentOrders() {
    const ticker = document.querySelector('[data-orders-ticker]');
    if (!ticker) return;

    let index = 0;
    const update = () => {
      const c = this.fakeCustomers[index % this.fakeCustomers.length];
      const p = this.fakeProducts[index % this.fakeProducts.length];

      ticker.innerHTML = `
        <span>${p.emoji}</span>
        <strong>${c.name}</strong> purchased <strong>${p.name}</strong> — ${c.time}
      `;

      ticker.style.animation = 'none';
      ticker.offsetHeight;
      ticker.style.animation = 'fadeInUp 0.4s ease';

      index++;
    };

    update();
    setInterval(update, 4000);
  },

  // ============================================================
  // QUANTITY DISCOUNT HIGHLIGHTER
  // ============================================================
  highlightQuantityDiscount(qty) {
    document.querySelectorAll('.qty-discount-row').forEach(row => {
      row.classList.remove('highlight');
      const rowMin = parseInt(row.dataset.qtyMin || 1);
      const rowMax = parseInt(row.dataset.qtyMax || 999);
      if (qty >= rowMin && qty <= rowMax) {
        row.classList.add('highlight');
      }
    });
  },

  // ============================================================
  // WAITLIST (Back in Stock Notifier)
  // ============================================================
  initWaitlist() {
    const form = document.querySelector('.waitlist-form');
    if (!form) return;

    form.addEventListener('submit', (e) => {
      e.preventDefault();
      const email = form.querySelector('input[type="email"]')?.value;
      if (!email) return;

      Toast.success('You\'re on the waitlist! 🎉', 'We\'ll notify you when this item is back in stock.');
      form.reset();
    });
  },

  // ============================================================
  // PROGRESS BARS (Free gift, discount tiers)
  // ============================================================
  updateProgressBars() {
    const subtotal = Cart.getSubtotal();

    document.querySelectorAll('[data-progress-bar]').forEach(bar => {
      const threshold = parseFloat(bar.dataset.progressBar);
      const pct = Math.min(100, (subtotal / threshold) * 100);
      const fill = bar.querySelector('.cart-progress-fill');
      if (fill) fill.style.width = `${pct}%`;

      const text = bar.querySelector('[data-progress-text]');
      if (text) {
        const remaining = Math.max(0, threshold - subtotal);
        const reward = bar.dataset.reward || 'reward';
        text.innerHTML = remaining > 0
          ? `Add <strong>$${remaining.toFixed(2)}</strong> more to unlock ${reward}`
          : `🎉 ${reward} unlocked!`;
      }
    });
  },
};

