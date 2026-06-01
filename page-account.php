<?php
/**
 * Template Name: Account Page
 *
 * @package RStore
 */

get_header(); ?>

<main>
  <div class="page-hero">
    <div class="container">
      <nav class="breadcrumb">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="breadcrumb-item">Home</a>
        <span class="breadcrumb-sep">/</span>
        <span class="breadcrumb-active">My Account</span>
      </nav>
      <h1 class="page-hero-title">My Account</h1>
    </div>
  </div>

  <div class="section-sm">
    <div class="container">
      <div class="account-layout" style="display:grid;grid-template-columns:280px 1fr;gap:var(--space-8)">

        <!-- Sidebar -->
        <aside>
          <!-- User Card -->
          <div style="background:var(--bg-card);border-radius:20px;border:1px solid var(--border-color);padding:28px;box-shadow:var(--shadow-card);text-align:center;margin-bottom:20px">
            <div style="width:80px;height:80px;background:var(--grad-primary);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;font-size:2rem;font-weight:900;color:white;font-family:var(--font-display)">J</div>
            <div style="font-size:18px;font-weight:700;margin-bottom:4px">John Doe</div>
            <div style="font-size:13px;color:var(--text-muted);margin-bottom:16px">john@example.com</div>
            <div style="background:var(--clr-primary-soft);border-radius:12px;padding:10px 16px">
              <div style="font-size:11px;font-weight:700;color:var(--clr-primary);text-transform:uppercase;letter-spacing:0.5px;margin-bottom:4px">⭐ Premium Member</div>
              <div style="font-size:13px;color:var(--text-secondary)">Gold Status — 4,200 points</div>
            </div>
          </div>

          <!-- Nav -->
          <nav style="background:var(--bg-card);border-radius:20px;border:1px solid var(--border-color);overflow:hidden;box-shadow:var(--shadow-card)">
            <button class="account-nav-link active" onclick="showTab('orders')" id="nav-orders">📦 My Orders</button>
            <button class="account-nav-link" onclick="showTab('wishlist')" id="nav-wishlist">❤️ Wishlist</button>
            <button class="account-nav-link" onclick="showTab('profile')" id="nav-profile">👤 Profile</button>
            <button class="account-nav-link" onclick="showTab('addresses')" id="nav-addresses">📍 Addresses</button>
            <button class="account-nav-link" onclick="showTab('payments')" id="nav-payments">💳 Payment Methods</button>
            <button class="account-nav-link" onclick="showTab('returns')" id="nav-returns">🔄 Returns</button>
            <button class="account-nav-link" onclick="showTab('notifications')" id="nav-notifications">🔔 Notifications</button>
            <button class="account-nav-link" onclick="showTab('security')" id="nav-security">🔒 Security</button>
            <button class="account-nav-link" style="color:var(--clr-danger)" onclick="Toast.info('Sign Out', 'Signed out successfully!')">🚪 Sign Out</button>
          </nav>
        </aside>

        <!-- Content -->
        <div>

          <!-- Orders Tab -->
          <div id="tab-orders" class="account-tab-panel">
            <div style="background:var(--bg-card);border-radius:20px;border:1px solid var(--border-color);overflow:hidden;box-shadow:var(--shadow-card)">
              <div style="padding:20px 24px;border-bottom:1px solid var(--border-color);display:flex;justify-content:space-between;align-items:center">
                <span style="font-size:18px;font-weight:700">📦 My Orders</span>
                <div style="display:flex;gap:8px">
                  <button class="btn btn-sm btn-secondary active">All</button>
                  <button class="btn btn-sm btn-secondary">Pending</button>
                  <button class="btn btn-sm btn-secondary">Shipped</button>
                  <button class="btn btn-sm btn-secondary">Delivered</button>
                </div>
              </div>

              <!-- Order Items -->
              <div id="orders-list">
                <div class="order-item">
                  <div class="order-product-img" style="display:flex;align-items:center;justify-content:center;font-size:2.5rem;background:linear-gradient(135deg,#667EEA33,#667EEA66)">🎧</div>
                  <div class="order-product-info">
                    <div class="order-product-name">Premium Wireless Headphones Pro X</div>
                    <div class="order-product-meta">Order #SZ-A4B8C2 · May 28, 2026</div>
                    <div style="margin-top:8px;display:flex;gap:8px">
                      <span class="badge" style="background:var(--clr-success-soft);color:var(--clr-success)">✓ Delivered</span>
                      <span style="font-size:13px;color:var(--text-muted)">1x · $129.99</span>
                    </div>
                  </div>
                  <div style="text-align:right;flex-shrink:0">
                    <div style="font-size:16px;font-weight:700;margin-bottom:8px">$129.99</div>
                    <div style="display:flex;flex-direction:column;gap:6px">
                      <a href="<?php echo esc_url( home_url( '/product' ) ); ?>" class="btn btn-sm btn-outline">Buy Again</a>
                      <button class="btn btn-sm btn-secondary" onclick="Toast.info('Order tracking', 'Your order is completed and delivered!')">Track Order</button>
                      <button class="btn btn-sm btn-secondary" onclick="showTab('returns')">Return</button>
                    </div>
                  </div>
                </div>
                <div class="order-item">
                  <div class="order-product-img" style="display:flex;align-items:center;justify-content:center;font-size:2.5rem;background:linear-gradient(135deg,#FA709A33,#FA709A66)">✨</div>
                  <div class="order-product-info">
                    <div class="order-product-name">Organic Face Serum</div>
                    <div class="order-product-meta">Order #SZ-D9E3F1 · May 24, 2026</div>
                    <div style="margin-top:8px;display:flex;gap:8px">
                      <span class="badge" style="background:rgba(255,184,0,0.15);color:var(--clr-warning)">📦 In Transit</span>
                      <span style="font-size:13px;color:var(--text-muted)">2x · $90.00</span>
                    </div>
                  </div>
                  <div style="text-align:right;flex-shrink:0">
                    <div style="font-size:16px;font-weight:700;margin-bottom:8px">$90.00</div>
                    <div style="display:flex;flex-direction:column;gap:6px">
                      <button class="btn btn-sm btn-primary" onclick="Toast.info('Shipment update', 'Package is in transit, arriving shortly.')">Track Order</button>
                    </div>
                  </div>
                </div>
                <div class="order-item">
                  <div class="order-product-img" style="display:flex;align-items:center;justify-content:center;font-size:2.5rem;background:linear-gradient(135deg,#4FACFE33,#4FACFE66)">⌚</div>
                  <div class="order-product-info">
                    <div class="order-product-name">Smart Fitness Watch</div>
                    <div class="order-product-meta">Order #SZ-G7H2I5 · May 20, 2026</div>
                    <div style="margin-top:8px;display:flex;gap:8px">
                      <span class="badge" style="background:var(--clr-primary-soft);color:var(--clr-primary)">⏳ Processing</span>
                      <span style="font-size:13px;color:var(--text-muted)">1x · $199.00</span>
                    </div>
                  </div>
                  <div style="text-align:right;flex-shrink:0">
                    <div style="font-size:16px;font-weight:700;margin-bottom:8px">$199.00</div>
                    <button class="btn btn-sm btn-danger-outline" onclick="Toast.info('Order Cancelled','We\'ll process your refund within 3-5 business days.')">Cancel</button>
                  </div>
                </div>
              </div>

              <div style="padding:20px 24px;text-align:center;border-top:1px solid var(--border-color)">
                <a href="<?php echo esc_url( home_url( '/shop' ) ); ?>" class="btn btn-primary">Continue Shopping →</a>
              </div>
            </div>
          </div>

          <!-- Profile Tab -->
          <div id="tab-profile" class="account-tab-panel" style="display:none">
            <div style="background:var(--bg-card);border-radius:20px;border:1px solid var(--border-color);padding:32px;box-shadow:var(--shadow-card)">
              <h2 style="font-size:18px;font-weight:700;margin-bottom:24px">👤 Profile Information</h2>

              <!-- Avatar -->
              <div style="display:flex;align-items:center;gap:20px;margin-bottom:32px">
                <div style="width:100px;height:100px;background:var(--grad-primary);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:2.5rem;font-weight:900;color:white;font-family:var(--font-display)">J</div>
                <div>
                  <button class="btn btn-secondary" onclick="Toast.info('Upload Profile Picture', 'Image selection overlay triggered.')">Change Photo</button>
                  <div style="font-size:12px;color:var(--text-muted);margin-top:6px">JPG, PNG, GIF up to 5MB</div>
                </div>
              </div>

              <div class="form-grid" style="gap:20px">
                <div class="form-group">
                  <label class="form-label">First Name</label>
                  <input type="text" class="form-control" value="John">
                </div>
                <div class="form-group">
                  <label class="form-label">Last Name</label>
                  <input type="text" class="form-control" value="Doe">
                </div>
                <div class="form-group form-full">
                  <label class="form-label">Email</label>
                  <input type="email" class="form-control" value="john@example.com">
                </div>
                <div class="form-group form-full">
                  <label class="form-label">Phone</label>
                  <input type="tel" class="form-control" value="+1 (555) 000-0000">
                </div>
                <div class="form-group form-full">
                  <label class="form-label">Date of Birth</label>
                  <input type="date" class="form-control" value="1990-01-15">
                </div>
                <div class="form-group form-full">
                  <label class="form-label">Gender</label>
                  <select class="form-select">
                    <option>Male</option>
                    <option>Female</option>
                    <option>Other</option>
                    <option>Prefer not to say</option>
                  </select>
                </div>
              </div>

              <div style="margin-top:28px;display:flex;gap:12px">
                <button class="btn btn-primary" onclick="Toast.success('Profile Updated!', 'Your changes have been saved.')">Save Changes</button>
                <button class="btn btn-secondary" onclick="showTab('orders')">Cancel</button>
              </div>
            </div>
          </div>

          <!-- Wishlist Tab -->
          <div id="tab-wishlist-account" class="account-tab-panel" style="display:none">
            <div style="background:var(--bg-card);border-radius:20px;border:1px solid var(--border-color);overflow:hidden;box-shadow:var(--shadow-card)">
              <div style="padding:20px 24px;border-bottom:1px solid var(--border-color)">
                <span style="font-size:18px;font-weight:700">❤️ My Wishlist</span>
              </div>
              <div style="padding:24px">
                <a href="<?php echo esc_url( home_url( '/wishlist' ) ); ?>" class="btn btn-primary">View Full Wishlist →</a>
              </div>
            </div>
          </div>

          <!-- Addresses Tab -->
          <div id="tab-addresses" class="account-tab-panel" style="display:none">
            <div style="background:var(--bg-card);border-radius:20px;border:1px solid var(--border-color);padding:32px;box-shadow:var(--shadow-card)">
              <h2 style="font-size:18px;font-weight:700;margin-bottom:24px">📍 My Addresses</h2>
              <div class="grid-2" style="gap:20px">
                <div style="border:2px solid var(--clr-primary);border-radius:16px;padding:20px;position:relative;background:var(--clr-primary-soft)">
                  <div style="position:absolute;top:12px;right:12px"><span class="badge" style="background:var(--clr-primary);color:white;font-size:10px">DEFAULT</span></div>
                  <div style="font-weight:700;margin-bottom:8px">Home</div>
                  <div style="font-size:14px;color:var(--text-secondary);line-height:1.6">John Doe<br>123 Main Street<br>New York, NY 10001<br>United States</div>
                  <div style="display:flex;gap:8px;margin-top:16px">
                    <button class="btn btn-sm btn-secondary" onclick="Toast.info('Address edit', 'Edit address overlay.')">Edit</button>
                    <button class="btn btn-sm btn-danger-outline" onclick="Toast.warning('Remove Address', 'Are you sure you want to remove this address?')">Remove</button>
                  </div>
                </div>
                <div style="border:2px dashed var(--border-color);border-radius:16px;padding:20px;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:12px;text-align:center;cursor:pointer" onclick="Toast.info('Add Address', 'Address form would open here.')">
                  <div style="font-size:2rem">+</div>
                  <div style="font-weight:600">Add New Address</div>
                </div>
              </div>
            </div>
          </div>

          <!-- Security Tab -->
          <div id="tab-security" class="account-tab-panel" style="display:none">
            <div style="background:var(--bg-card);border-radius:20px;border:1px solid var(--border-color);padding:32px;box-shadow:var(--shadow-card)">
              <h2 style="font-size:18px;font-weight:700;margin-bottom:24px">🔒 Security Settings</h2>
              <div style="display:flex;flex-direction:column;gap:20px">
                <div class="form-group">
                  <label class="form-label">Current Password</label>
                  <input type="password" class="form-control" placeholder="••••••••">
                </div>
                <div class="form-group">
                  <label class="form-label">New Password</label>
                  <input type="password" class="form-control" placeholder="Min. 8 characters">
                </div>
                <div class="form-group">
                  <label class="form-label">Confirm New Password</label>
                  <input type="password" class="form-control" placeholder="Repeat new password">
                </div>
                <button class="btn btn-primary" onclick="Toast.success('Password Updated!', 'Your password has been changed successfully.')">Update Password</button>
              </div>
            </div>
          </div>

          <!-- Returns Tab -->
          <div id="tab-returns" class="account-tab-panel" style="display:none">
            <div style="background:var(--bg-card);border-radius:20px;border:1px solid var(--border-color);padding:32px;box-shadow:var(--shadow-card)">
              <h2 style="font-size:18px;font-weight:700;margin-bottom:24px">🔄 Returns & Refunds</h2>
              <div class="empty-state">
                <span class="empty-state-icon">🔄</span>
                <h3 class="empty-state-title">No Active Returns</h3>
                <p class="empty-state-text">All your returns will appear here. You can initiate a return from the Orders section.</p>
              </div>
            </div>
          </div>

          <!-- Payments Tab -->
          <div id="tab-payments" class="account-tab-panel" style="display:none">
            <div style="background:var(--bg-card);border-radius:20px;border:1px solid var(--border-color);padding:32px;box-shadow:var(--shadow-card)">
              <h2 style="font-size:18px;font-weight:700;margin-bottom:24px">💳 Payment Methods</h2>
              <div style="border:2px solid var(--border-color);border-radius:16px;padding:20px;display:flex;align-items:center;gap:16px;margin-bottom:12px">
                <div style="font-size:2rem">💳</div>
                <div style="flex:1"><div style="font-weight:600">Visa •••• 4242</div><div style="font-size:13px;color:var(--text-muted)">Expires 12/27</div></div>
                <span class="badge" style="background:var(--clr-success-soft);color:var(--clr-success)">Default</span>
                <button class="btn btn-sm btn-danger-outline" onclick="Toast.warning('Remove Card', 'Remove this card from secure storage?')">Remove</button>
              </div>
              <button class="btn btn-outline" onclick="Toast.info('Add Card', 'Card form would open here.')">+ Add New Card</button>
            </div>
          </div>

          <!-- Notifications Tab -->
          <div id="tab-notifications" class="account-tab-panel" style="display:none">
            <div style="background:var(--bg-card);border-radius:20px;border:1px solid var(--border-color);padding:32px;box-shadow:var(--shadow-card)">
              <h2 style="font-size:18px;font-weight:700;margin-bottom:24px">🔔 Notification Preferences</h2>
              <div style="display:flex;flex-direction:column;gap:20px">
                <div style="display:flex;align-items:center;justify-content:space-between;padding:16px;background:var(--bg-secondary);border-radius:12px">
                  <div>
                    <div style="font-weight:600">Order Updates</div>
                    <div style="font-size:13px;color:var(--text-muted)">Shipping, delivery confirmations</div>
                  </div>
                  <label class="toggle-switch">
                    <input type="checkbox" checked>
                    <span class="toggle-slider"></span>
                  </label>
                </div>
                <div style="display:flex;align-items:center;justify-content:space-between;padding:16px;background:var(--bg-secondary);border-radius:12px">
                  <div>
                    <div style="font-weight:600">Promotional Emails</div>
                    <div style="font-size:13px;color:var(--text-muted)">Sales, new arrivals, exclusive offers</div>
                  </div>
                  <label class="toggle-switch">
                    <input type="checkbox" checked>
                    <span class="toggle-slider"></span>
                  </label>
                </div>
                <div style="display:flex;align-items:center;justify-content:space-between;padding:16px;background:var(--bg-secondary);border-radius:12px">
                  <div>
                    <div style="font-weight:600">Price Drops</div>
                    <div style="font-size:13px;color:var(--text-muted)">Wishlist items go on sale</div>
                  </div>
                  <label class="toggle-switch">
                    <input type="checkbox">
                    <span class="toggle-slider"></span>
                  </label>
                </div>
                <button class="btn btn-primary" onclick="Toast.success('Preferences Saved!')">Save Preferences</button>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</main>

<?php get_footer(); ?>

<script>
function showTab(name) {
  document.querySelectorAll('.account-tab-panel').forEach(p => p.style.display = 'none');
  document.querySelectorAll('.account-nav-link').forEach(l => l.classList.remove('active'));

  const panelMap = {
    'orders': 'tab-orders',
    'wishlist': 'tab-wishlist-account',
    'profile': 'tab-profile',
    'addresses': 'tab-addresses',
    'payments': 'tab-payments',
    'returns': 'tab-returns',
    'notifications': 'tab-notifications',
    'security': 'tab-security',
  };

  const panel = document.getElementById(panelMap[name]);
  if (panel) panel.style.display = 'block';

  const navBtn = document.getElementById(`nav-${name}`);
  if (navBtn) navBtn.classList.add('active');
}
</script>
