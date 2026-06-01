/* ============================================================
   RStore - Header, Footer, and Section Live Theme Builder
   Allows live custom configurations of theme colors, typography,
   header layouts, and section visibilities. Persists in localStorage.
   ============================================================ */
'use strict';

const ThemeBuilder = {
  STORAGE_KEY: 'rstore-theme-builder',

  // Default Config
  config: {
    primaryColor: '#6C3FE8',
    accentColor: '#EC4899',
    fontDisplay: 'Outfit',
    headerLayout: 'classic', // classic, minimal, centered
    showBoosters: true,
    showFooterPayments: true,
    showFeaturedCategories: true
  },

  init() {
    this.load();
    this.applySettings();
    this.createCustomizerUI();
  },

  load() {
    try {
      const saved = localStorage.getItem(this.STORAGE_KEY);
      if (saved) {
        this.config = { ...this.config, ...JSON.parse(saved) };
      }
    } catch {
      console.warn('Could not load theme builder configurations.');
    }
  },

  save() {
    localStorage.setItem(this.STORAGE_KEY, JSON.stringify(this.config));
    this.applySettings();
  },

  applySettings() {
    // 1. Apply colors
    document.documentElement.style.setProperty('--clr-primary', this.config.primaryColor);
    document.documentElement.style.setProperty('--clr-secondary', this.config.accentColor);
    document.documentElement.style.setProperty('--clr-primary-soft', `${this.config.primaryColor}1a`);

    // 2. Apply fonts
    document.documentElement.style.setProperty('--font-display', `"${this.config.fontDisplay}", sans-serif`);

    // 3. Apply Header Layouts via classes on site-header
    const header = document.querySelector('.site-header');
    if (header) {
      header.classList.remove('header-layout-classic', 'header-layout-minimal', 'header-layout-centered');
      header.classList.add(`header-layout-${this.config.headerLayout}`);
    }

    // 4. Toggle sections
    const boosters = document.querySelector('.sales-booster-section, .booster-ticker-wrap');
    if (boosters) boosters.style.display = this.config.showBoosters ? '' : 'none';

    const categories = document.querySelector('.categories-grid, .categories-section');
    if (categories) categories.style.display = this.config.showFeaturedCategories ? '' : 'none';

    // 5. Toggle footer payments
    const payments = document.querySelector('.footer-payments');
    if (payments) payments.style.display = this.config.showFooterPayments ? '' : 'none';
  },

  createCustomizerUI() {
    // 1. Create floating gear toggle button
    const btn = document.createElement('button');
    btn.className = 'theme-customizer-toggle';
    btn.innerHTML = '⚙️';
    btn.title = 'Live Layout Customizer';
    btn.style.cssText = `
      position: fixed;
      right: 24px;
      bottom: 88px;
      width: 50px;
      height: 50px;
      border-radius: 50%;
      background: var(--grad-primary);
      color: white;
      font-size: 1.5rem;
      border: none;
      cursor: pointer;
      box-shadow: 0 4px 20px rgba(108,63,232,0.4);
      z-index: 99999;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: transform 0.3s;
    `;
    btn.addEventListener('mouseenter', () => btn.style.transform = 'scale(1.1) rotate(45deg)');
    btn.addEventListener('mouseleave', () => btn.style.transform = 'scale(1) rotate(0deg)');

    // 2. Create glassmorphic customization sidebar panel
    const panel = document.createElement('div');
    panel.className = 'theme-customizer-panel';
    panel.style.cssText = `
      position: fixed;
      top: 0;
      right: -340px;
      width: 320px;
      height: 100vh;
      background: var(--bg-surface);
      backdrop-filter: blur(20px);
      border-left: 1px solid var(--border-color);
      box-shadow: -10px 0 30px rgba(0,0,0,0.1);
      z-index: 999999;
      transition: right 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
      display: flex;
      flex-direction: column;
      padding: 24px;
      color: var(--text-main);
      overflow-y: auto;
    `;

    panel.innerHTML = `
      <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:24px; border-bottom:1px solid var(--border-color); padding-bottom:12px">
        <h3 style="font-family:var(--font-display); font-weight:800; font-size:18px; margin:0">🎨 Live Customizer</h3>
        <button class="customizer-close-btn" style="background:transparent; border:none; cursor:pointer; font-size:18px; color:var(--text-main)">✕</button>
      </div>

      <!-- Color Pickers -->
      <div style="margin-bottom:20px">
        <h4 style="font-size:12px; text-transform:uppercase; letter-spacing:1px; color:var(--text-muted); margin-bottom:12px">Brand Colors</h4>
        <div style="display:flex; gap:16px; margin-bottom:12px">
          <div style="flex:1">
            <label style="font-size:11px; font-weight:700; display:block; margin-bottom:4px">Primary Color</label>
            <input type="color" id="cust-color-primary" value="${this.config.primaryColor}" style="width:100%; height:36px; padding:2px; border:1px solid var(--border-color); border-radius:6px; background:transparent">
          </div>
          <div style="flex:1">
            <label style="font-size:11px; font-weight:700; display:block; margin-bottom:4px">Accent Color</label>
            <input type="color" id="cust-color-accent" value="${this.config.accentColor}" style="width:100%; height:36px; padding:2px; border:1px solid var(--border-color); border-radius:6px; background:transparent">
          </div>
        </div>
      </div>

      <!-- Typography -->
      <div style="margin-bottom:20px">
        <h4 style="font-size:12px; text-transform:uppercase; letter-spacing:1px; color:var(--text-muted); margin-bottom:12px">Typography</h4>
        <select id="cust-font-display" class="form-input" style="height:38px; font-size:13px; background:var(--bg-secondary); border-color:var(--border-color); color:var(--text-main)">
          <option value="Outfit" ${this.config.fontDisplay === 'Outfit' ? 'selected' : ''}>Outfit (Modern Geometric)</option>
          <option value="Inter" ${this.config.fontDisplay === 'Inter' ? 'selected' : ''}>Inter (Sleek Tech)</option>
          <option value="Playfair Display" ${this.config.fontDisplay === 'Playfair Display' ? 'selected' : ''}>Playfair (Elegant Boutique)</option>
        </select>
      </div>

      <!-- Header Layout -->
      <div style="margin-bottom:20px">
        <h4 style="font-size:12px; text-transform:uppercase; letter-spacing:1px; color:var(--text-muted); margin-bottom:12px">Header Builder</h4>
        <select id="cust-header-layout" class="form-input" style="height:38px; font-size:13px; background:var(--bg-secondary); border-color:var(--border-color); color:var(--text-main)">
          <option value="classic" ${this.config.headerLayout === 'classic' ? 'selected' : ''}>Classic Row Layout</option>
          <option value="minimal" ${this.config.headerLayout === 'minimal' ? 'selected' : ''}>Minimalist Left Brand</option>
          <option value="centered" ${this.config.headerLayout === 'centered' ? 'selected' : ''}>Centered Brand Logo</option>
        </select>
      </div>

      <!-- Section Builders -->
      <div style="margin-bottom:24px">
        <h4 style="font-size:12px; text-transform:uppercase; letter-spacing:1px; color:var(--text-muted); margin-bottom:12px">Layout Sections</h4>
        
        <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:10px">
          <span style="font-size:13px; font-weight:600">Featured Categories</span>
          <input type="checkbox" id="cust-sec-categories" ${this.config.showFeaturedCategories ? 'checked' : ''} style="width:16px; height:16px; accent-color:var(--clr-primary)">
        </div>

        <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:10px">
          <span style="font-size:13px; font-weight:600">Sales Urgency Tools</span>
          <input type="checkbox" id="cust-sec-boosters" ${this.config.showBoosters ? 'checked' : ''} style="width:16px; height:16px; accent-color:var(--clr-primary)">
        </div>

        <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:10px">
          <span style="font-size:13px; font-weight:600">Footer Payment Icons</span>
          <input type="checkbox" id="cust-sec-payments" ${this.config.showFooterPayments ? 'checked' : ''} style="width:16px; height:16px; accent-color:var(--clr-primary)">
        </div>
      </div>

      <!-- Action Buttons -->
      <div style="margin-top:auto; display:flex; flex-direction:column; gap:10px">
        <button class="btn btn-primary btn-full" id="cust-apply-btn">Apply & Save</button>
        <button class="btn btn-outline btn-full" id="cust-reset-btn" style="font-size:12px; border-color:var(--border-color); color:var(--text-muted)">Reset to Default</button>
      </div>
    `;

    document.body.appendChild(btn);
    document.body.appendChild(panel);

    // 3. Bind UI click toggle events
    btn.addEventListener('click', () => {
      const open = panel.style.right === '0px';
      panel.style.right = open ? '-340px' : '0px';
    });

    panel.querySelector('.customizer-close-btn').addEventListener('click', () => {
      panel.style.right = '-340px';
    });

    // 4. Bind interactive control updates
    panel.querySelector('#cust-apply-btn').addEventListener('click', () => {
      this.config.primaryColor = panel.querySelector('#cust-color-primary').value;
      this.config.accentColor = panel.querySelector('#cust-color-accent').value;
      this.config.fontDisplay = panel.querySelector('#cust-font-display').value;
      this.config.headerLayout = panel.querySelector('#cust-header-layout').value;
      this.config.showFeaturedCategories = panel.querySelector('#cust-sec-categories').checked;
      this.config.showBoosters = panel.querySelector('#cust-sec-boosters').checked;
      this.config.showFooterPayments = panel.querySelector('#cust-sec-payments').checked;

      this.save();
      if (typeof Toast !== 'undefined') {
        Toast.success('Layout Updated! 🎨', 'Your custom theme layout and colors were applied successfully.');
        if (typeof launchConfetti === 'function') launchConfetti(25);
      }
      panel.style.right = '-340px';
    });

    panel.querySelector('#cust-reset-btn').addEventListener('click', () => {
      if (!confirm('Reset all theme colors and layout sections to default?')) return;
      this.config = {
        primaryColor: '#6C3FE8',
        accentColor: '#EC4899',
        fontDisplay: 'Outfit',
        headerLayout: 'classic',
        showBoosters: true,
        showFooterPayments: true,
        showFeaturedCategories: true
      };

      panel.querySelector('#cust-color-primary').value = this.config.primaryColor;
      panel.querySelector('#cust-color-accent').value = this.config.accentColor;
      panel.querySelector('#cust-font-display').value = this.config.fontDisplay;
      panel.querySelector('#cust-header-layout').value = this.config.headerLayout;
      panel.querySelector('#cust-sec-categories').checked = this.config.showFeaturedCategories;
      panel.querySelector('#cust-sec-boosters').checked = this.config.showBoosters;
      panel.querySelector('#cust-sec-payments').checked = this.config.showFooterPayments;

      this.save();
      panel.style.right = '-340px';
    });
  }
};

// Auto Initialize
document.addEventListener('DOMContentLoaded', () => {
  ThemeBuilder.init();
});
