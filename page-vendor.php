<?php
/**
 * Template Name: Vendor Page
 *
 * @package RStore
 */

get_header(); ?>

<main class="container">
  <!-- Style blocks specific to vendor dashboard layout -->
  <style>
    .vendor-grid { display: grid; grid-template-columns: 260px 1fr; gap: 32px; margin-top: 40px; }
    .vendor-sidebar { display: flex; flex-direction: column; gap: 8px; }
    .vendor-nav-link { display: flex; align-items: center; gap: 12px; padding: 14px 20px; border-radius: 12px; color: var(--text-muted); font-weight: 600; text-decoration: none; transition: all 0.3s; cursor: pointer; border: none; background: transparent; width: 100%; text-align: left; font-size: 14px; }
    .vendor-nav-link:hover { color: var(--clr-primary); background: var(--clr-primary-soft); }
    .vendor-nav-link.active { color: white; background: var(--grad-primary); box-shadow: 0 4px 15px rgba(108,63,232,0.3); }
    .vendor-stat-card { background: var(--bg-surface); border: 1px solid var(--border-color); border-radius: 20px; padding: 24px; display: flex; align-items: center; gap: 20px; box-shadow: var(--shadow-sm); transition: transform 0.3s, box-shadow 0.3s; }
    .vendor-stat-card:hover { transform: translateY(-4px); box-shadow: var(--shadow-md); }
    .vendor-stat-icon { width: 56px; height: 56px; border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; }
    .vendor-stat-num { font-family: var(--font-display); font-size: 2rem; font-weight: 800; color: var(--text-main); line-height: 1.2; }
    .vendor-stat-label { font-size: 13px; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.5px; }
    .chart-container { background: var(--bg-surface); border: 1px solid var(--border-color); border-radius: 20px; padding: 24px; margin-bottom: 32px; }
    .vendor-badge-status { padding: 4px 10px; border-radius: 20px; font-size: 11px; font-weight: 700; text-transform: uppercase; }
    .status-active { background: var(--clr-success-soft); color: var(--clr-success); }
    .status-pending { background: var(--clr-warning-soft); color: var(--clr-warning); }
    .status-inactive { background: rgba(0,0,0,0.05); color: var(--text-muted); }
  </style>

  <div class="vendor-grid">
    <!-- Sidebar navigation -->
    <aside class="vendor-sidebar">
      <div class="glass-card" style="padding: 20px; display:flex; flex-direction:column; gap:16px; align-items:center; text-align:center; margin-bottom:24px">
        <div style="width: 80px; height: 80px; border-radius: 50%; background: var(--grad-primary); display:flex; align-items:center; justify-content:center; color:white; font-size:2rem; font-weight:700">MM</div>
        <div>
          <h3 style="font-family:var(--font-display); font-size:16px; font-weight:800; color:var(--text-main)">Matrix Media Store</h3>
          <span style="font-size:12px; color:var(--text-muted)">Verified Vendor</span>
        </div>
      </div>

      <div class="glass-card" style="padding: 12px; display:flex; flex-direction:column; gap:4px">
        <button class="vendor-nav-link active" data-tab-btn="dashboard">📊 Dashboard</button>
        <button class="vendor-nav-link" data-tab-btn="products">📦 Products</button>
        <button class="vendor-nav-link" data-tab-btn="orders">🛍 Orders</button>
        <button class="vendor-nav-link" data-tab-btn="settings">⚙️ Store Settings</button>
      </div>
    </aside>

    <!-- Main Content Panels -->
    <section class="vendor-content-panels">
      
      <!-- TAB: Dashboard -->
      <div class="vendor-tab-panel active" id="tab-panel-dashboard">
        <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:16px; margin-bottom:32px">
          <div>
            <h1 style="font-family:var(--font-display); font-size:2rem; font-weight:900; color:var(--text-main)">Welcome Back, Matrix Media!</h1>
            <p style="color:var(--text-muted); font-size:14px; margin-top:4px">Here's what is happening with your store today.</p>
          </div>
          <button class="btn btn-primary" onclick="if(typeof Modal!=='undefined'){Modal.open('add-product-modal');}">➕ Add New Product</button>
        </div>

        <!-- Stats Grid -->
        <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap:24px; margin-bottom:40px">
          <div class="vendor-stat-card">
            <div class="vendor-stat-icon" style="background:var(--clr-primary-soft); color:var(--clr-primary)">💰</div>
            <div>
              <div class="vendor-stat-num" data-counter="14250" data-prefix="$">$0</div>
              <div class="vendor-stat-label">Total Earnings</div>
            </div>
          </div>
          
          <div class="vendor-stat-card">
            <div class="vendor-stat-icon" style="background:var(--clr-success-soft); color:var(--clr-success)">📦</div>
            <div>
              <div class="vendor-stat-num" data-counter="84">0</div>
              <div class="vendor-stat-label">Products Sold</div>
            </div>
          </div>

          <div class="vendor-stat-card">
            <div class="vendor-stat-icon" style="background:var(--clr-info-soft); color:var(--clr-info)">👁️</div>
            <div>
              <div class="vendor-stat-num" data-viewer-count>18</div>
              <div class="vendor-stat-label">Active Store Viewers</div>
            </div>
          </div>

          <div class="vendor-stat-card">
            <div class="vendor-stat-icon" style="background:var(--clr-warning-soft); color:var(--clr-warning)">⭐</div>
            <div>
              <div class="vendor-stat-num">4.8</div>
              <div class="vendor-stat-label">Vendor Rating</div>
            </div>
          </div>
        </div>

        <!-- Visual Analytics Block -->
        <div class="chart-container">
          <h3 style="font-family:var(--font-display); font-size:16px; font-weight:800; color:var(--text-main); margin-bottom:20px">Weekly Sales Revenue</h3>
          <div style="height: 200px; display:flex; align-items:flex-end; gap:20px; padding: 20px 10px; border-bottom:1px solid var(--border-color); position:relative">
            <div style="position:absolute; left:0; right:0; top:25%; border-top:1px dashed var(--border-color); opacity:0.5"></div>
            <div style="position:absolute; left:0; right:0; top:50%; border-top:1px dashed var(--border-color); opacity:0.5"></div>
            <div style="position:absolute; left:0; right:0; top:75%; border-top:1px dashed var(--border-color); opacity:0.5"></div>
            
            <div style="flex:1; display:flex; flex-direction:column; align-items:center; gap:8px; z-index:1">
              <div style="height: 120px; width:100%; max-width:40px; background:var(--grad-primary); border-radius:8px 8px 0 0; animation: scaleUp 1s ease"></div>
              <span style="font-size:11px; color:var(--text-muted)">Mon</span>
            </div>
            <div style="flex:1; display:flex; flex-direction:column; align-items:center; gap:8px; z-index:1">
              <div style="height: 80px; width:100%; max-width:40px; background:var(--grad-primary); border-radius:8px 8px 0 0; animation: scaleUp 1s ease"></div>
              <span style="font-size:11px; color:var(--text-muted)">Tue</span>
            </div>
            <div style="flex:1; display:flex; flex-direction:column; align-items:center; gap:8px; z-index:1">
              <div style="height: 150px; width:100%; max-width:40px; background:var(--grad-primary); border-radius:8px 8px 0 0; animation: scaleUp 1s ease"></div>
              <span style="font-size:11px; color:var(--text-muted)">Wed</span>
            </div>
            <div style="flex:1; display:flex; flex-direction:column; align-items:center; gap:8px; z-index:1">
              <div style="height: 110px; width:100%; max-width:40px; background:var(--grad-primary); border-radius:8px 8px 0 0; animation: scaleUp 1s ease"></div>
              <span style="font-size:11px; color:var(--text-muted)">Thu</span>
            </div>
            <div style="flex:1; display:flex; flex-direction:column; align-items:center; gap:8px; z-index:1">
              <div style="height: 175px; width:100%; max-width:40px; background:var(--grad-primary); border-radius:8px 8px 0 0; animation: scaleUp 1s ease"></div>
              <span style="font-size:11px; color:var(--text-muted)">Fri</span>
            </div>
            <div style="flex:1; display:flex; flex-direction:column; align-items:center; gap:8px; z-index:1">
              <div style="height: 140px; width:100%; max-width:40px; background:var(--grad-primary); border-radius:8px 8px 0 0; animation: scaleUp 1s ease"></div>
              <span style="font-size:11px; color:var(--text-muted)">Sat</span>
            </div>
            <div style="flex:1; display:flex; flex-direction:column; align-items:center; gap:8px; z-index:1">
              <div style="height: 190px; width:100%; max-width:40px; background:var(--grad-primary); border-radius:8px 8px 0 0; animation: scaleUp 1s ease"></div>
              <span style="font-size:11px; color:var(--text-muted)">Sun</span>
            </div>
          </div>
        </div>

        <!-- Recent activities -->
        <div class="glass-card" style="padding: 24px">
          <h3 style="font-family:var(--font-display); font-size:16px; font-weight:800; color:var(--text-main); margin-bottom:20px">Recent Shop Activity</h3>
          <div style="display:flex; flex-direction:column; gap:16px" data-orders-ticker>
            <!-- Rendered by sales-booster.js orders ticker -->
          </div>
        </div>
      </div>

      <!-- TAB: Products -->
      <div class="vendor-tab-panel" id="tab-panel-products" style="display:none">
        <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:16px; margin-bottom:32px">
          <div>
            <h1 style="font-family:var(--font-display); font-size:2rem; font-weight:900; color:var(--text-main)">Store Catalog</h1>
            <p style="color:var(--text-muted); font-size:14px; margin-top:4px">View, edit, and manage all your product listings.</p>
          </div>
          <button class="btn btn-primary" onclick="if(typeof Modal!=='undefined'){Modal.open('add-product-modal');}">➕ Add New Product</button>
        </div>

        <div class="glass-card" style="padding: 20px; overflow-x: auto">
          <table class="compare-table" style="width:100%" id="vendor-products-table">
            <thead>
              <tr>
                <th>Product</th>
                <th>Category</th>
                <th>Price</th>
                <th>Rating</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <!-- Rendered via JS -->
            </tbody>
          </table>
        </div>
      </div>

      <!-- TAB: Orders -->
      <div class="vendor-tab-panel" id="tab-panel-orders" style="display:none">
        <div style="margin-bottom:32px">
          <h1 style="font-family:var(--font-display); font-size:2rem; font-weight:900; color:var(--text-main)">Store Orders</h1>
          <p style="color:var(--text-muted); font-size:14px; margin-top:4px">Track customer shipments, orders, and payments.</p>
        </div>

        <div class="glass-card" style="padding: 20px; overflow-x: auto">
          <table class="compare-table" style="width:100%">
            <thead>
              <tr>
                <th>Order ID</th>
                <th>Customer</th>
                <th>Date</th>
                <th>Product</th>
                <th>Amount</th>
                <th>Shipment Status</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><strong>#SZ-9042</strong></td>
                <td>Priya from Kandy</td>
                <td>May 29, 2026</td>
                <td>Designer Leather Jacket</td>
                <td><strong>$289.00</strong></td>
                <td><span class="vendor-badge-status status-active">Shipped</span></td>
              </tr>
              <tr>
                <td><strong>#SZ-8951</strong></td>
                <td>Niro from Galle</td>
                <td>May 28, 2026</td>
                <td>Premium Wireless Headphones</td>
                <td><strong>$129.99</strong></td>
                <td><span class="vendor-badge-status status-active">Delivered</span></td>
              </tr>
              <tr>
                <td><strong>#SZ-8924</strong></td>
                <td>James from London</td>
                <td>May 27, 2026</td>
                <td>Smart Fitness Watch</td>
                <td><strong>$199.00</strong></td>
                <td><span class="vendor-badge-status status-pending">Processing</span></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <!-- TAB: Settings -->
      <div class="vendor-tab-panel" id="tab-panel-settings" style="display:none">
        <div style="margin-bottom:32px">
          <h1 style="font-family:var(--font-display); font-size:2rem; font-weight:900; color:var(--text-main)">Store Profile Settings</h1>
          <p style="color:var(--text-muted); font-size:14px; margin-top:4px">Customize your banner, logos, payouts, and customer policies.</p>
        </div>

        <div class="glass-card" style="padding: 32px">
          <form onsubmit="handleSettingsSave(event)" style="display:flex; flex-direction:column; gap:20px; max-width:600px">
            <div>
              <label class="form-label" style="font-weight:700">Store Name</label>
              <input type="text" class="form-input" value="Matrix Media Store" style="background:var(--bg-secondary); border-color:var(--border-color); color:var(--text-main)" required>
            </div>
            
            <div>
              <label class="form-label" style="font-weight:700">Support Email</label>
              <input type="email" class="form-input" value="support@matrixmedia.shop" style="background:var(--bg-secondary); border-color:var(--border-color); color:var(--text-main)" required>
            </div>

            <div>
              <label class="form-label" style="font-weight:700">Commission Payout Account (PayPal / Bank)</label>
              <input type="text" class="form-input" value="matrixmedia-payout@paypal.com" style="background:var(--bg-secondary); border-color:var(--border-color); color:var(--text-main)" required>
            </div>

            <button type="submit" class="btn btn-primary" style="align-self: flex-start">Save Profile</button>
          </form>
        </div>
      </div>

    </section>
  </div>
</main>

<!-- Add Product Modal -->
<div class="modal-overlay" id="add-product-modal">
  <div class="modal-content glass-card" style="max-width:550px; padding:32px; border-radius:24px">
    <button class="modal-close" style="color:var(--text-main)" onclick="if(typeof Modal!=='undefined'){Modal.close('add-product-modal');}">✕</button>
    <h2 style="font-family:var(--font-display); font-size:1.8rem; font-weight:900; margin-bottom:24px; color:var(--text-main)">➕ List New Product</h2>
    
    <form id="add-product-form" onsubmit="handleNewProduct(event)" style="display:flex; flex-direction:column; gap:16px">
      <div>
        <label class="form-label" style="font-weight:700">Product Name</label>
        <input type="text" id="new-prod-name" class="form-input" placeholder="e.g. Ergonomic Keyboard" style="background:var(--bg-secondary); border-color:var(--border-color); color:var(--text-main)" required>
      </div>

      <div style="display:grid; grid-template-columns: 1fr 1fr; gap:16px">
        <div>
          <label class="form-label" style="font-weight:700">Price ($)</label>
          <input type="number" id="new-prod-price" class="form-input" placeholder="e.g. 99" style="background:var(--bg-secondary); border-color:var(--border-color); color:var(--text-main)" required>
        </div>
        <div>
          <label class="form-label" style="font-weight:700">Category</label>
          <select id="new-prod-cat" class="form-input" style="background:var(--bg-secondary); border-color:var(--border-color); color:var(--text-main)" required>
            <option value="Electronics">Electronics</option>
            <option value="Fashion">Fashion</option>
            <option value="Home">Home</option>
            <option value="Beauty">Beauty</option>
          </select>
        </div>
      </div>

      <div style="display:grid; grid-template-columns: 1fr 1fr; gap:16px">
        <div>
          <label class="form-label" style="font-weight:700">Emoji Icon (Image Mock)</label>
          <input type="text" id="new-prod-emoji" class="form-input" placeholder="e.g. 🎹" style="background:var(--bg-secondary); border-color:var(--border-color); color:var(--text-main)" required>
        </div>
        <div>
          <label class="form-label" style="font-weight:700">Hex Color theme</label>
          <input type="color" id="new-prod-color" class="form-input" value="#6C3FE8" style="background:var(--bg-secondary); border-color:var(--border-color); color:var(--text-main); height:45px; padding:2px" required>
        </div>
      </div>

      <button type="submit" class="btn btn-primary" style="margin-top:12px">List Product</button>
    </form>
  </div>
</div>

<?php get_footer(); ?>

<script>
// Tab Switching
document.querySelectorAll('[data-tab-btn]').forEach(btn => {
  btn.addEventListener('click', () => {
    document.querySelectorAll('[data-tab-btn]').forEach(b => b.classList.remove('active'));
    document.querySelectorAll('.vendor-tab-panel').forEach(p => p.style.display = 'none');
    
    btn.classList.add('active');
    const panelId = `tab-panel-${btn.dataset.tabBtn}`;
    const panel = document.getElementById(panelId);
    if (panel) panel.style.display = 'block';
  });
});

// Render Vendor Products
function renderVendorCatalog() {
  const tbody = document.querySelector('#vendor-products-table tbody');
  if (!tbody) return;

  if (typeof DEMO_PRODUCTS !== 'undefined') {
    const vendorProducts = DEMO_PRODUCTS.slice(0, 4);

    tbody.innerHTML = vendorProducts.map(p => `
      <tr data-prod-row="${p.id}">
        <td>
          <div style="display:flex; align-items:center; gap:12px">
            <div style="width:40px; height:40px; border-radius:8px; background:linear-gradient(135deg, ${p.color}33, ${p.color}66); display:flex; align-items:center; justify-content:center; font-size:1.5rem">
              ${p.emoji}
            </div>
            <span style="font-weight:700">${p.name}</span>
          </div>
        </td>
        <td>${p.category}</td>
        <td><strong>$${p.price.toFixed(2)}</strong></td>
        <td>⭐ ${p.rating} (${p.reviews} reviews)</td>
        <td><span class="vendor-badge-status status-active">Active</span></td>
        <td>
          <button class="btn btn-sm btn-outline" style="padding:4px 8px" onclick="deleteVendorProduct(${p.id})">Delete</button>
        </td>
      </tr>
    `).join('');
  }
}

function deleteVendorProduct(id) {
  if (!confirm('Are you sure you want to delete this listing?')) return;
  const row = document.querySelector(`[data-prod-row="${id}"]`);
  row?.remove();
  Toast.info('Listing Removed', 'The product has been removed from catalog.');
}

function handleNewProduct(e) {
  e.preventDefault();
  const name = document.getElementById('new-prod-name').value;
  const price = parseFloat(document.getElementById('new-prod-price').value);
  const category = document.getElementById('new-prod-cat').value;
  const emoji = document.getElementById('new-prod-emoji').value;
  const color = document.getElementById('new-prod-color').value;

  const newProd = {
    id: Date.now(),
    name,
    price,
    original: price * 1.25,
    rating: 5.0,
    reviews: 0,
    category,
    emoji,
    color
  };

  if (typeof DEMO_PRODUCTS !== 'undefined') {
    DEMO_PRODUCTS.unshift(newProd);
  }

  // Add dynamically to table
  const tbody = document.querySelector('#vendor-products-table tbody');
  if (tbody) {
    const tr = document.createElement('tr');
    tr.setAttribute('data-prod-row', newProd.id);
    tr.innerHTML = `
      <td>
        <div style="display:flex; align-items:center; gap:12px">
          <div style="width:40px; height:40px; border-radius:8px; background:linear-gradient(135deg, ${color}33, ${color}66); display:flex; align-items:center; justify-content:center; font-size:1.5rem">
            ${emoji}
          </div>
          <span style="font-weight:700">${name}</span>
        </div>
      </td>
      <td>${category}</td>
      <td><strong>$${price.toFixed(2)}</strong></td>
      <td>⭐ 5.0 (0 reviews)</td>
      <td><span class="vendor-badge-status status-pending">Pending Review</span></td>
      <td>
        <button class="btn btn-sm btn-outline" style="padding:4px 8px" onclick="deleteVendorProduct(${newProd.id})">Delete</button>
      </td>
    </tr>
    `;
    tbody.prepend(tr);
  }

  if (typeof Modal !== 'undefined') {
    Modal.close('add-product-modal');
  }
  e.target.reset();
  Toast.success('Product Listed! 📦', `${name} is successfully listed under review.`);
  if (typeof launchConfetti === 'function') {
    launchConfetti(40);
  }
}

function handleSettingsSave(e) {
  e.preventDefault();
  Toast.success('Profile Saved! ⚙️', 'Your vendor store profile settings were updated.');
}

document.addEventListener('DOMContentLoaded', () => {
  renderVendorCatalog();
});
</script>
