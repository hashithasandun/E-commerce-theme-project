<?php
/**
 * Template Name: Wishlist Page
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
        <span class="breadcrumb-active">Wishlist</span>
      </nav>
      <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:16px">
        <h1 class="page-hero-title">❤️ My Wishlist</h1>
        <div style="display:flex;gap:12px;align-items:center">
          <button class="btn btn-outline" onclick="addAllToCart()">🛒 Add All to Cart</button>
          <button class="btn btn-danger-outline" onclick="clearWishlist()">Clear Wishlist</button>
        </div>
      </div>
    </div>
  </div>

  <div class="section-sm">
    <div class="container">
      <!-- Wishlist Grid -->
      <div class="wishlist-grid products-grid cols-4" id="wishlist-grid">
        <?php
        $wishlist_ids = array();
        if ( is_user_logged_in() ) {
            $wishlist_ids = get_user_meta( get_current_user_id(), '_rstore_wishlist', true );
            if ( ! is_array( $wishlist_ids ) ) {
                $wishlist_ids = array();
            }
        }

        if ( is_user_logged_in() && ! empty( $wishlist_ids ) && class_exists( 'WooCommerce' ) ) {
            $args = array(
                'post_type'      => 'product',
                'post__in'       => $wishlist_ids,
                'posts_per_page' => -1,
            );
            $wishlist_query = new WP_Query( $args );

            if ( $wishlist_query->have_posts() ) {
                while ( $wishlist_query->have_posts() ) {
                    $wishlist_query->the_post();
                    $product = wc_get_product( get_the_ID() );
                    $price = $product ? $product->get_price() : 0;
                    $image = get_the_post_thumbnail_url( get_the_ID(), 'medium' ) ? get_the_post_thumbnail_url( get_the_ID(), 'medium' ) : wc_placeholder_img_src();
                    ?>
                    <div class="product-card" data-product-id="<?php the_ID(); ?>">
                        <div class="product-img-wrap">
                            <img src="<?php echo esc_url( $image ); ?>" alt="<?php the_title_attribute(); ?>" style="width:100%;height:100%;object-fit:cover">
                            <button class="wishlist-item-remove" onclick="Wishlist.toggle({id: <?php the_ID(); ?>, name: '<?php echo esc_js( get_the_title() ); ?>'}, this)" title="Remove">✕</button>
                            <div class="product-badges">
                                <?php if ( $product && $product->is_on_sale() ) : ?>
                                    <span class="badge badge-sale">Sale</span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="product-info">
                            <div class="product-category">
                                <?php
                                $categories = get_the_terms( get_the_ID(), 'product_cat' );
                                if ( $categories && ! is_wp_error( $categories ) ) {
                                    echo esc_html( $categories[0]->name );
                                } else {
                                    echo 'Category';
                                }
                                ?>
                            </div>
                            <h3 class="product-name"><?php the_title(); ?></h3>
                            <div class="product-price-row">
                                <span class="product-price"><?php echo $product ? $product->get_price_html() : ''; ?></span>
                            </div>
                            <button class="btn btn-primary btn-full mt-auto" style="margin-top:16px" onclick="RStore.addToCart(<?php the_ID(); ?>, '<?php echo esc_js( get_the_title() ); ?>', <?php echo esc_js( $price ); ?>, '<?php echo esc_url( $image ); ?>')">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                    <?php
                }
                wp_reset_postdata();
            }
        }
        // Guest localStorage fallback rendering is triggered by javascript inside Wishlist.renderPage()
        ?>
      </div>

      <!-- Recommended -->
      <div style="margin-top:64px">
        <div class="section-header" style="text-align:left;margin-bottom:32px">
          <h2 class="section-title">You Might Also <span class="text-gradient">Love</span></h2>
          <p class="section-subtitle">Based on your wishlist</p>
        </div>
        <div class="products-grid cols-4" id="recommended-products">
          <!-- Rendered by JS -->
        </div>
      </div>
    </div>
  </div>
</main>

<?php get_footer(); ?>

<script>
function addAllToCart() {
  if (typeof Wishlist !== 'undefined' && typeof Cart !== 'undefined') {
    if (Wishlist.items.length === 0) { Toast.info('Wishlist Empty', 'Add items to your wishlist first.'); return; }
    Wishlist.items.forEach(item => {
      // Add items dynamically to the shopping cart
      if (item.id) {
        var card = document.querySelector(`.wishlist-grid .product-card[data-product-id="${item.id}"]`);
        var name = card ? card.querySelector('.product-name')?.textContent.trim() : 'Product';
        var price = card ? card.querySelector('.product-price')?.textContent.replace(/[^0-9.]/g, '') : '0.00';
        var image = card ? card.querySelector('.product-img-wrap img')?.src : '';
        RStore.addToCart(item.id, name, price, image);
      }
    });
    Toast.success('All Added! 🛒', 'Items have been added to your cart.');
  }
}

function clearWishlist() {
  if (typeof Wishlist !== 'undefined') {
    if (!confirm('Clear your entire wishlist?')) return;
    if (window.rstore_vars && window.rstore_vars.is_logged_in) {
      var ajaxUrl = window.rstore_vars.ajax_url || '/wp-admin/admin-ajax.php';
      var formData = new FormData();
      formData.append('action', 'rstore_clear_wishlist');
      fetch(ajaxUrl, { method: 'POST', body: formData })
        .then(res => res.json())
        .then(res => {
          if (res.success) {
            Wishlist.items = [];
            Toast.info('Wishlist Cleared');
            setTimeout(() => { location.reload(); }, 600);
          }
        });
    } else {
      Wishlist.items = [];
      Wishlist.saveLocal();
      Toast.info('Wishlist Cleared');
      Wishlist.renderPage();
    }
  }
}

document.addEventListener('DOMContentLoaded', () => {
  // Render local guest items if user is not logged in
  const originalGrid = document.querySelector('.wishlist-grid');
  if (originalGrid && typeof Wishlist !== 'undefined' && (!window.rstore_vars || !window.rstore_vars.is_logged_in)) {
    Wishlist.renderPage();
  }

  // Recommended
  const rec = document.getElementById('recommended-products');
  if (rec && typeof DEMO_PRODUCTS !== 'undefined') {
    rec.innerHTML = DEMO_PRODUCTS.slice(0, 4).map(p => `
      <div class="product-card reveal" data-product-id="${p.id}">
        <div class="product-img-wrap">
          <div style="width:100%;height:100%;background:linear-gradient(135deg,${p.color}33,${p.color}66);display:flex;align-items:center;justify-content:center;font-size:5rem">${p.emoji}</div>
          <div class="product-badges">${p.original ? `<span class="badge badge-sale">-${Math.round((1-p.price/p.original)*100)}%</span>` : ''}</div>
          <div class="product-actions">
            <button class="product-action-btn" data-wishlist="${p.id}" title="Wishlist">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
              </svg>
            </button>
          </div>
          <div class="product-quick-add" data-add-to-cart="${p.id}">🛒 Add to Cart</div>
        </div>
        <div class="product-info">
          <div class="product-category">${p.category}</div>
          <a href="#" class="product-name">${p.name}</a>
          <div class="product-price-row" style="margin-top:8px">
            <span class="product-price">$${p.price.toFixed(2)}</span>
            ${p.original ? `<span class="product-price-original">$${p.original.toFixed(2)}</span>` : ''}
          </div>
        </div>
      </div>
    `).join('');
    setTimeout(() => rec.querySelectorAll('.reveal').forEach(el => el.classList.add('visible')), 100);
  }
});
</script>
