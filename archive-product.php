<?php
/**
 * The template for displaying product archive (shop) page
 *
 * @package RStore
 */

get_header(); ?>

<main>

  <!-- Page Hero -->
  <div class="page-hero" style="background:linear-gradient(135deg,var(--bg-secondary),var(--bg-tertiary))">
    <div class="container">
      <nav class="breadcrumb" aria-label="Breadcrumb">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="breadcrumb-item">Home</a>
        <span class="breadcrumb-sep">/</span>
        <span class="breadcrumb-active">Shop</span>
      </nav>
      <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:16px">
        <div>
          <h1 class="page-hero-title">All Products</h1>
          <p class="page-hero-subtitle">Discover <span data-results-count>12</span> amazing products</p>
        </div>
        <!-- Mobile Filter Toggle -->
        <button class="btn btn-outline" id="filter-mobile-toggle" data-toggle-filters style="display:none">
          ⚙ Filters
        </button>
      </div>
    </div>
  </div>

  <div class="section-sm">
    <div class="container">

      <!-- Active Filters -->
      <div class="active-filters" id="active-filters" style="display:none"></div>

      <!-- Shop Layout -->
      <div class="shop-layout">

        <!-- SIDEBAR -->
        <aside class="shop-sidebar" role="complementary" aria-label="Product Filters">

          <!-- Category Filter -->
          <div class="filter-panel open" data-default-open="true">
            <div class="filter-panel-header">
              <span class="filter-panel-title">📁 Categories</span>
              <span class="filter-panel-toggle">▼</span>
            </div>
            <div class="filter-panel-body">
              <div class="filter-panel-content">
                <div style="display:flex;flex-direction:column;gap:4px">
                  <button class="filter-option-label active" data-filter-category="all" style="padding:8px 12px;border-radius:8px;text-align:left;background:var(--clr-primary-soft);color:var(--clr-primary);font-weight:600">🔷 All Categories</button>
                  <button class="filter-option-label" data-filter-category="Electronics" style="padding:8px 12px;border-radius:8px;text-align:left">📱 Electronics</button>
                  <button class="filter-option-label" data-filter-category="Fashion" style="padding:8px 12px;border-radius:8px;text-align:left">👗 Fashion</button>
                  <button class="filter-option-label" data-filter-category="Beauty" style="padding:8px 12px;border-radius:8px;text-align:left">✨ Beauty</button>
                  <button class="filter-option-label" data-filter-category="Sports" style="padding:8px 12px;border-radius:8px;text-align:left">⚽ Sports</button>
                  <button class="filter-option-label" data-filter-category="Home" style="padding:8px 12px;border-radius:8px;text-align:left">🏠 Home & Living</button>
                  <button class="filter-option-label" data-filter-category="Shoes" style="padding:8px 12px;border-radius:8px;text-align:left">👟 Shoes</button>
                  <button class="filter-option-label" data-filter-category="Kitchen" style="padding:8px 12px;border-radius:8px;text-align:left">🍳 Kitchen</button>
                  <button class="filter-option-label" data-filter-category="Furniture" style="padding:8px 12px;border-radius:8px;text-align:left">🪑 Furniture</button>
                </div>
              </div>
            </div>
          </div>

          <!-- Price Range -->
          <div class="filter-panel open">
            <div class="filter-panel-header">
              <span class="filter-panel-title">💰 Price Range</span>
              <span class="filter-panel-toggle">▼</span>
            </div>
            <div class="filter-panel-body">
              <div class="filter-panel-content">
                <div class="price-range-inputs">
                  <div class="price-input-wrap">
                    <span class="price-input-symbol">$</span>
                    <input type="number" class="price-input" value="0" min="0" max="1000" data-price-min placeholder="Min">
                  </div>
                  <div style="display:flex;align-items:center;color:var(--text-muted);font-size:1.2rem">—</div>
                  <div class="price-input-wrap">
                    <span class="price-input-symbol">$</span>
                    <input type="number" class="price-input" value="500" min="0" max="1000" data-price-max placeholder="Max">
                  </div>
                </div>
                <div style="display:flex;justify-content:space-between;font-size:12px;color:var(--text-muted);margin-top:8px">
                  <span data-price-min-display>$0</span>
                  <span data-price-max-display>$500</span>
                </div>
                <input type="range" class="range-slider" min="0" max="500" value="500" data-price-max style="margin-top:8px">
              </div>
            </div>
          </div>

          <!-- Rating Filter -->
          <div class="filter-panel open">
            <div class="filter-panel-header">
              <span class="filter-panel-title">⭐ Rating</span>
              <span class="filter-panel-toggle">▼</span>
            </div>
            <div class="filter-panel-body">
              <div class="filter-panel-content">
                <div class="rating-filter" data-filter-rating="4.5"><div class="rating-filter-stars" style="color:var(--clr-warning)">★★★★★</div><span class="rating-filter-text">4.5+ Stars</span></div>
                <div class="rating-filter" data-filter-rating="4"><div class="rating-filter-stars" style="color:var(--clr-warning)">★★★★</div><span class="rating-filter-text">4+ Stars</span></div>
                <div class="rating-filter" data-filter-rating="3"><div class="rating-filter-stars" style="color:var(--clr-warning)">★★★</div><span class="rating-filter-text">3+ Stars</span></div>
              </div>
            </div>
          </div>

          <!-- Color Filter -->
          <div class="filter-panel">
            <div class="filter-panel-header">
              <span class="filter-panel-title">🎨 Colors</span>
              <span class="filter-panel-toggle">▼</span>
            </div>
            <div class="filter-panel-body">
              <div class="filter-panel-content">
                <div class="color-filters">
                  <div class="color-filter-item"><div class="color-filter-swatch" style="background:#000"></div><span class="color-filter-name">Black</span></div>
                  <div class="color-filter-item"><div class="color-filter-swatch" style="background:#fff;border:1px solid #ccc"></div><span class="color-filter-name">White</span></div>
                  <div class="color-filter-item"><div class="color-filter-swatch" style="background:#FF6B6B"></div><span class="color-filter-name">Red</span></div>
                  <div class="color-filter-item"><div class="color-filter-swatch" style="background:#4FACFE"></div><span class="color-filter-name">Blue</span></div>
                  <div class="color-filter-item"><div class="color-filter-swatch" style="background:#43E97B"></div><span class="color-filter-name">Green</span></div>
                  <div class="color-filter-item"><div class="color-filter-swatch" style="background:#FEE140"></div><span class="color-filter-name">Yellow</span></div>
                  <div class="color-filter-item"><div class="color-filter-swatch" style="background:#6C3FE8"></div><span class="color-filter-name">Purple</span></div>
                  <div class="color-filter-item"><div class="color-filter-swatch" style="background:#FA709A"></div><span class="color-filter-name">Pink</span></div>
                </div>
              </div>
            </div>
          </div>

          <!-- Size Filter -->
          <div class="filter-panel">
            <div class="filter-panel-header">
              <span class="filter-panel-title">📏 Size</span>
              <span class="filter-panel-toggle">▼</span>
            </div>
            <div class="filter-panel-body">
              <div class="filter-panel-content">
                <div class="size-filters">
                  <button class="size-filter-btn">XS</button>
                  <button class="size-filter-btn">S</button>
                  <button class="size-filter-btn active">M</button>
                  <button class="size-filter-btn">L</button>
                  <button class="size-filter-btn">XL</button>
                  <button class="size-filter-btn">XXL</button>
                </div>
              </div>
            </div>
          </div>

          <!-- Clear Filters -->
          <div class="filter-clear-all" data-clear-filters>
            <span class="filter-clear-all-text">Clear All Filters</span>
            <span class="filter-clear-all-count">0</span>
          </div>

        </aside>

        <!-- PRODUCTS AREA -->
        <div>

          <!-- Toolbar -->
          <div class="shop-toolbar">
            <div class="shop-results-count">
              Showing <strong><span data-results-count>12</span> products</strong>
            </div>
            <div class="toolbar-right">
              <!-- View Toggle -->
              <div class="view-toggle">
                <button class="view-btn active" data-view="grid" title="Grid view">
                  <svg width="14" height="14" viewBox="0 0 14 14" fill="currentColor"><rect width="6" height="6"/><rect x="8" width="6" height="6"/><rect y="8" width="6" height="6"/><rect x="8" y="8" width="6" height="6"/></svg>
                </button>
                <button class="view-btn" data-view="list" title="List view">
                  <svg width="14" height="14" viewBox="0 0 14 14" fill="currentColor"><rect width="14" height="3"/><rect y="5.5" width="14" height="3"/><rect y="11" width="14" height="3"/></svg>
                </button>
              </div>
              <!-- Cols Toggle -->
              <div style="display:flex;gap:4px">
                <button class="view-btn" data-cols="2" title="2 columns">2</button>
                <button class="view-btn active" data-cols="3" title="3 columns">3</button>
                <button class="view-btn" data-cols="4" title="4 columns">4</button>
              </div>
              <!-- Sort -->
              <select class="sort-select" data-sort id="sort-select">
                <option value="">Sort: Featured</option>
                <option value="popular">Most Popular</option>
                <option value="newest">Newest First</option>
                <option value="rating">Highest Rated</option>
                <option value="price-asc">Price: Low to High</option>
                <option value="price-desc">Price: High to Low</option>
              </select>
            </div>
          </div>

          <!-- Products Grid -->
          <div class="products-grid cols-3" id="products-grid">
            <!-- Rendered by JavaScript -->
            <div class="skeleton" style="height:400px;border-radius:16px"></div>
            <div class="skeleton" style="height:400px;border-radius:16px"></div>
            <div class="skeleton" style="height:400px;border-radius:16px"></div>
            <div class="skeleton" style="height:400px;border-radius:16px"></div>
            <div class="skeleton" style="height:400px;border-radius:16px"></div>
            <div class="skeleton" style="height:400px;border-radius:16px"></div>
          </div>

          <!-- Pagination -->
          <div class="pagination" role="navigation" aria-label="Pagination">
            <button class="page-btn page-btn-first" disabled>‹</button>
            <button class="page-btn active">1</button>
            <button class="page-btn">2</button>
            <button class="page-btn">3</button>
            <span style="color:var(--text-muted);padding:0 8px">...</span>
            <button class="page-btn">12</button>
            <button class="page-btn page-btn-last">›</button>
          </div>

        </div>
      </div>
    </div>
  </div>

</main>

<?php get_footer(); ?>

<script>
document.addEventListener('DOMContentLoaded', () => {
  // Load products on shop page
  const grid = document.getElementById('products-grid');
  if (grid) {
    setTimeout(() => {
      if (typeof ProductFilters !== 'undefined' && typeof DEMO_PRODUCTS !== 'undefined') {
        ProductFilters.renderProducts(DEMO_PRODUCTS);
      }
    }, 300);
  }

  // Size filter toggle
  document.querySelectorAll('.size-filter-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      btn.classList.toggle('active');
    });
  });

  // Color filter toggle
  document.querySelectorAll('.color-filter-item').forEach(item => {
    item.addEventListener('click', () => {
      item.classList.toggle('active');
    });
  });

  // Pagination
  document.querySelectorAll('.page-btn:not([disabled])').forEach(btn => {
    btn.addEventListener('click', () => {
      document.querySelectorAll('.page-btn').forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });
  });

  // Mobile filter toggle show/hide
  const filterToggle = document.getElementById('filter-mobile-toggle');
  if (filterToggle) filterToggle.style.display = window.innerWidth <= 1024 ? 'flex' : 'none';
  window.addEventListener('resize', () => {
    if (filterToggle) filterToggle.style.display = window.innerWidth <= 1024 ? 'flex' : 'none';
  });
});
</script>
