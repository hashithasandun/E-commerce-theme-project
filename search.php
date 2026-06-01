<?php
/**
 * The template for displaying search results pages
 *
 * @package RStore
 */

get_header(); ?>

<main>
  <!-- Breadcrumb -->
  <div class="container">
    <nav class="breadcrumb">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="breadcrumb-item">Home</a>
      <span class="breadcrumb-sep">/</span>
      <span class="breadcrumb-active">Search Results</span>
    </nav>
  </div>

  <div class="page-hero" style="background:linear-gradient(135deg,var(--bg-secondary),var(--bg-tertiary))">
    <div class="container">
      <h1 class="page-hero-title">🔍 Search Results</h1>
      <p style="color:var(--text-muted);margin-top:8px" id="search-meta-text">Searching for products...</p>
    </div>
  </div>

  <div class="section-sm">
    <div class="container">
      <!-- Search Input Panel -->
      <div class="glass-card" style="padding: 24px; margin-bottom: 40px;">
        <form id="page-search-form" style="display:flex;gap:12px;width:100%;max-width:600px" onsubmit="event.preventDefault();">
          <input type="search" id="page-search-input" placeholder="Type keywords here..." class="notify-input" style="flex:1;background:var(--bg-secondary);border:1px solid var(--border-color);color:var(--text-main);height:50px;border-radius:12px" required value="<?php echo esc_attr( get_search_query() ); ?>">
          <button type="submit" class="btn btn-primary" style="height:50px;padding:0 24px;border-radius:12px" onclick="triggerSearch()">Search</button>
        </form>
      </div>

      <!-- Shop Grid Layout -->
      <div class="shop-layout" style="display:grid;grid-template-columns:1fr;gap:40px">
        <!-- Products Area -->
        <div class="products-area">
          <div class="shop-toolbar" style="margin-bottom:24px;display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:16px">
            <div class="toolbar-results" style="font-size:14px;color:var(--text-muted)">
              Showing <span style="font-weight:700;color:var(--text-main)" id="search-count">0</span> products
            </div>
            
            <div style="display:flex;align-items:center;gap:16px">
              <!-- Grid controls -->
              <div class="grid-controls hide-mobile" style="display:flex;gap:4px">
                <button class="view-btn active" data-view="grid" title="Grid View" style="padding:6px;border-radius:6px;background:var(--bg-secondary);border:1px solid var(--border-color);cursor:pointer">🎛️</button>
                <button class="view-btn" data-view="list" title="List View" style="padding:6px;border-radius:6px;background:var(--bg-secondary);border:1px solid var(--border-color);cursor:pointer">☰</button>
              </div>
            </div>
          </div>

          <!-- Product Grid -->
          <div class="products-grid cols-4" id="search-grid">
            <!-- Populated dynamically by search scripts -->
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<?php get_footer(); ?>

<script>
function renderStars(rating) {
  return '★'.repeat(Math.floor(rating)) + (rating % 1 ? '<span class="star half">★</span>' : '') + '★'.repeat(5 - Math.ceil(rating));
}

function triggerSearch() {
  const q = document.getElementById('page-search-input')?.value.trim() || '';
  const urlParams = new URLSearchParams(window.location.search);
  urlParams.set('s', q);
  window.history.replaceState({}, '', `${window.location.pathname}?${urlParams.toString()}`);
  performSearch(q);
}

document.addEventListener('DOMContentLoaded', () => {
  const urlParams = new URLSearchParams(window.location.search);
  const initialQuery = urlParams.get('s') || urlParams.get('q') || '<?php echo esc_js( get_search_query() ); ?>';
  
  const searchInput = document.getElementById('page-search-input');
  if (searchInput) searchInput.value = initialQuery;

  performSearch(initialQuery);

  const searchForm = document.getElementById('page-search-form');
  if (searchForm) {
    searchForm.addEventListener('submit', (e) => {
      e.preventDefault();
      triggerSearch();
    });
  }
});

function performSearch(query) {
  const grid = document.getElementById('search-grid');
  const countEl = document.getElementById('search-count');
  const metaText = document.getElementById('search-meta-text');
  
  if (!grid) return;

  if (!query) {
    metaText.textContent = 'Please enter a search query above.';
    if (countEl) countEl.textContent = '0';
    grid.innerHTML = `
      <div class="empty-state" style="grid-column: 1/-1; padding: 60px 0;">
        <span class="empty-state-icon">🔍</span>
        <h2 class="empty-state-title">Let's find something!</h2>
        <p class="empty-state-text">Type keywords in the search bar above to browse our catalog.</p>
      </div>
    `;
    return;
  }

  if (metaText) {
    metaText.innerHTML = `Showing search results for: <strong>"${query}"</strong>`;
  }

  if (typeof DEMO_PRODUCTS !== 'undefined') {
    const results = DEMO_PRODUCTS.filter(p =>
      p.name.toLowerCase().includes(query.toLowerCase()) ||
      p.category.toLowerCase().includes(query.toLowerCase())
    );

    if (countEl) {
      countEl.textContent = results.length;
    }

    if (results.length === 0) {
      grid.innerHTML = `
        <div class="empty-state" style="grid-column: 1/-1; padding: 60px 0;">
          <span class="empty-state-icon">🔍</span>
          <h2 class="empty-state-title">No matches found</h2>
          <p class="empty-state-text">We couldn't find any products matching "${query}". Try searching with different keywords.</p>
          <button class="btn btn-outline mt-4" onclick="document.getElementById('page-search-input').value=''; performSearch('')">Reset Search</button>
        </div>
      `;
      return;
    }

    grid.innerHTML = results.map(p => {
      const discount = p.original ? Math.round((1 - p.price / p.original) * 100) : 0;
      return `
        <div class="product-card reveal visible" data-product-id="${p.id}">
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
              <button class="product-action-btn" onclick="window.location='<?php echo esc_url( home_url( '/product' ) ); ?>'" title="Quick View">👁</button>
            </div>
            <div class="product-quick-add" data-add-to-cart="${p.id}">
              🛒 Add to Cart
            </div>
          </div>
          <div class="product-info">
            <div class="product-category">${p.category}</div>
            <a href="<?php echo esc_url( home_url( '/product' ) ); ?>" class="product-name">${p.name}</a>
            <div class="product-rating">
              <div class="stars" style="color:var(--clr-warning);display:flex">${renderStars(p.rating)}</div>
              <span class="rating-count">(${p.reviews})</span>
            </div>
            <div class="product-price-row">
              <span class="product-price">$${p.price.toFixed(2)}</span>
              ${p.original ? `<span class="product-price-original">$${p.original.toFixed(2)}</span>` : ''}
            </div>
          </div>
        </div>
      `;
    }).join('');
  }
}
</script>
