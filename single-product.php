<?php
/**
 * The template for displaying a single product page
 *
 * @package RStore
 */

get_header(); ?>

<main>

  <!-- Breadcrumb -->
  <div class="container">
    <nav class="breadcrumb" aria-label="Breadcrumb">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="breadcrumb-item">Home</a>
      <span class="breadcrumb-sep">/</span>
      <a href="<?php echo esc_url( home_url( '/shop' ) ); ?>" class="breadcrumb-item">Shop</a>
      <span class="breadcrumb-sep">/</span>
      <a href="<?php echo esc_url( home_url( '/shop?cat=electronics' ) ); ?>" class="breadcrumb-item">Electronics</a>
      <span class="breadcrumb-sep">/</span>
      <span class="breadcrumb-active">Premium Wireless Headphones Pro X</span>
    </nav>
  </div>

  <!-- Product Page -->
  <div class="section-sm">
    <div class="container">
      <div class="product-page">

        <!-- ======== LEFT: GALLERY ======== -->
        <div class="product-gallery">

          <!-- Main Image -->
          <div class="product-main-img-wrap" id="main-img-wrap">
            <div id="main-img" style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;font-size:12rem;background:linear-gradient(135deg,#667EEA33,#667EEA66);transition:all 0.3s ease">
              🎧
            </div>
            <button class="product-gallery-zoom" title="Zoom image" onclick="openLightbox()">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/><line x1="11" y1="8" x2="11" y2="14"/><line x1="8" y1="11" x2="14" y2="11"/></svg>
            </button>
            <div class="gallery-360-badge" id="view-360-btn">
              <span>↻</span> 360° View
            </div>
          </div>

          <!-- Thumbnails -->
          <div class="product-thumbnails" id="thumbnails">
            <div class="product-thumb active" onclick="switchImage(this, '🎧','#667EEA')">
              <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;font-size:2.5rem;background:linear-gradient(135deg,#667EEA33,#667EEA66)">🎧</div>
            </div>
            <div class="product-thumb" onclick="switchImage(this, '🎧','#764BA2')">
              <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;font-size:2.5rem;background:linear-gradient(135deg,#764BA233,#764BA266)">🎧</div>
            </div>
            <div class="product-thumb" onclick="switchImage(this, '🎧','#4FACFE')">
              <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;font-size:2.5rem;background:linear-gradient(135deg,#4FACFE33,#4FACFE66)">🎧</div>
            </div>
            <div class="product-thumb" onclick="switchImage(this, '🎵','#43E97B')">
              <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;font-size:2.5rem;background:linear-gradient(135deg,#43E97B33,#43E97B66)">🎵</div>
            </div>
            <div class="product-thumb" onclick="switchImage(this, '⚡','#FEE140')">
              <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;font-size:2.5rem;background:linear-gradient(135deg,#FEE14033,#FEE14066)">⚡</div>
            </div>
          </div>

        </div>

        <!-- ======== RIGHT: DETAILS ======== -->
        <div class="product-details">

          <!-- Badges -->
          <div style="display:flex;gap:8px;margin-bottom:16px;flex-wrap:wrap">
            <span class="badge badge-new">New Arrival</span>
            <span class="badge badge-sale">-35% OFF</span>
            <span class="badge badge-hot">🔥 Best Seller</span>
          </div>

          <!-- Title -->
          <h1 class="product-detail-title">Premium Wireless Headphones Pro X</h1>

          <!-- Meta -->
          <div class="product-detail-meta">
            <div class="product-rating">
              <div class="stars" style="display:flex;gap:2px">
                <span class="star">★</span><span class="star">★</span><span class="star">★</span><span class="star">★</span><span class="star" style="color:var(--clr-warning);position:relative">★</span>
              </div>
              <a href="#reviews" style="font-size:13px;color:var(--text-muted)">4.8 (234 reviews)</a>
            </div>
            <div class="product-sku">SKU: SZ-HP-001</div>
            <div class="product-stock-status in-stock">
              <span class="stock-dot" style="background:var(--clr-success);animation:pulse 2s infinite"></span>
              In Stock (8 left)
            </div>
          </div>

          <!-- Live Viewers -->
          <div style="display:flex;align-items:center;gap:12px;margin-bottom:20px">
            <div class="viewer-count">
              <span class="viewer-dot"></span>
              <span data-viewer-count>23</span> people viewing right now
            </div>
            <div data-stock-urgency="8" style="font-size:13px"></div>
          </div>

          <!-- Price -->
          <div class="product-price-section">
            <div class="product-main-price">$129.99</div>
            <div class="product-original-price">$199.99</div>
            <div class="product-discount-tag">Save $70</div>
          </div>

          <!-- Short Desc -->
          <p class="product-short-desc">
            Experience sound like never before. The Pro X features our most advanced driver technology, delivering rich bass, crystal-clear mids, and airy highs. With 40-hour battery life and USB-C fast charging, you stay in the zone all day long.
          </p>

          <!-- Color Variants -->
          <div class="product-variants">
            <div class="variant-section">
              <div class="variant-label">
                Color: <span class="variant-selected" id="selected-color">Midnight Black</span>
              </div>
              <div class="color-variants">
                <div class="color-variant active" style="background:#1A1A2E" title="Midnight Black" onclick="selectColor(this,'Midnight Black','#1A1A2E')"></div>
                <div class="color-variant" style="background:#667EEA" title="Cosmic Purple" onclick="selectColor(this,'Cosmic Purple','#667EEA')"></div>
                <div class="color-variant" style="background:#4FACFE" title="Ocean Blue" onclick="selectColor(this,'Ocean Blue','#4FACFE')"></div>
                <div class="color-variant" style="background:#FA709A" title="Rose Gold" onclick="selectColor(this,'Rose Gold','#FA709A')"></div>
                <div class="color-variant" style="background:#43E97B" title="Forest Green" onclick="selectColor(this,'Forest Green','#43E97B')"></div>
              </div>
            </div>
          </div>

          <!-- Quantity Discounts -->
          <div class="quantity-discounts">
            <div class="qty-discount-header">
              <span>Quantity</span>
              <span>Discount</span>
              <span>Price per Unit</span>
            </div>
            <div class="qty-discount-row" data-qty-min="1" data-qty-max="1">
              <span>1 unit</span>
              <span>—</span>
              <span>$129.99</span>
            </div>
            <div class="qty-discount-row highlight" data-qty-min="2" data-qty-max="4">
              <span>2-4 units</span>
              <span class="qty-discount-save">5% OFF</span>
              <span>$123.49</span>
            </div>
            <div class="qty-discount-row" data-qty-min="5" data-qty-max="9">
              <span>5-9 units</span>
              <span class="qty-discount-save">10% OFF</span>
              <span>$116.99</span>
            </div>
            <div class="qty-discount-row" data-qty-min="10" data-qty-max="999">
              <span>10+ units</span>
              <span class="qty-discount-save">15% OFF</span>
              <span>$110.49</span>
            </div>
          </div>

          <!-- Add to Cart -->
          <div class="add-to-cart-section">
            <div class="quantity-input">
              <button class="quantity-btn" id="qty-minus" onclick="changeQty(-1)">−</button>
              <input type="number" class="quantity-field" id="qty-field" value="1" min="1" max="99" onchange="updateQtyDiscounts()">
              <button class="quantity-btn" id="qty-plus" onclick="changeQty(1)">+</button>
            </div>
            <button class="btn btn-primary btn-lg" id="add-to-cart-btn" class="btn-add-to-cart" data-add-to-cart="1" style="flex:1" onclick="addProductToCart()">
              🛒 Add to Cart
            </button>
          </div>

          <!-- Action Bar -->
          <div class="product-action-bar">
            <button class="product-action-icon-btn" id="wishlist-btn" data-wishlist="1" title="Add to Wishlist">
              ♡
            </button>
            <button class="product-action-icon-btn" data-compare="1" title="Compare">
              ⚖
            </button>
            <button class="product-action-icon-btn" onclick="shareProduct()" title="Share">
              📤
            </button>
            <button class="product-action-icon-btn" onclick="openQuote()" title="Request a Quote">
              📋
            </button>
          </div>

          <!-- Buy Now -->
          <a href="<?php echo esc_url( home_url( '/checkout' ) ); ?>" class="btn btn-dark btn-full" style="margin-bottom:16px" onclick="addProductToCart()">
            ⚡ Buy Now — Skip the Cart
          </a>

          <!-- Services -->
          <div class="product-services">
            <div class="product-service-item">
              <div class="product-service-icon">🚚</div>
              <div>
                <div class="product-service-title">Free Shipping</div>
                <div class="product-service-desc">On orders over $100</div>
              </div>
            </div>
            <div class="product-service-item">
              <div class="product-service-icon">🔄</div>
              <div>
                <div class="product-service-title">30-Day Returns</div>
                <div class="product-service-desc">Hassle-free returns</div>
              </div>
            </div>
            <div class="product-service-item">
              <div class="product-service-icon">🔒</div>
              <div>
                <div class="product-service-title">Secure Payment</div>
                <div class="product-service-desc">SSL encrypted</div>
              </div>
            </div>
            <div class="product-service-item">
              <div class="product-service-icon">💬</div>
              <div>
                <div class="product-service-title">24/7 Support</div>
                <div class="product-service-desc">Always available</div>
              </div>
            </div>
          </div>

          <!-- Delivery Estimate -->
          <div class="delivery-estimate">
            <div class="delivery-estimate-icon">📦</div>
            <div class="delivery-estimate-text">
              Order in the next <strong>2h 34m</strong> for delivery by <strong style="color:var(--clr-success)">Thursday, June 5</strong>
            </div>
          </div>

          <!-- Countdown Timer -->
          <div style="background:linear-gradient(135deg,rgba(255,71,87,0.08),rgba(255,142,83,0.08));border:1px solid rgba(255,71,87,0.2);border-radius:16px;padding:16px 20px;margin-bottom:20px">
            <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px">
              <div style="font-size:13px;font-weight:600;color:var(--clr-danger)">⏰ Sale ends in:</div>
              <div data-countdown="auto" data-countdown-hours="8" style="display:flex;gap:8px;align-items:center">
                <div class="countdown-unit" style="text-align:center">
                  <div class="countdown-value" data-hours style="font-size:1.5rem;font-weight:900;color:var(--clr-danger);line-height:1">00</div>
                  <div style="font-size:10px;color:var(--text-muted)">HRS</div>
                </div>
                <span style="font-size:1.5rem;font-weight:900;color:var(--clr-danger)">:</span>
                <div class="countdown-unit" style="text-align:center">
                  <div class="countdown-value" data-minutes style="font-size:1.5rem;font-weight:900;color:var(--clr-danger);line-height:1">00</div>
                  <div style="font-size:10px;color:var(--text-muted)">MIN</div>
                </div>
                <span style="font-size:1.5rem;font-weight:900;color:var(--clr-danger)">:</span>
                <div class="countdown-unit" style="text-align:center">
                  <div class="countdown-value" data-seconds style="font-size:1.5rem;font-weight:900;color:var(--clr-danger);line-height:1">00</div>
                  <div style="font-size:10px;color:var(--text-muted)">SEC</div>
                </div>
              </div>
            </div>
          </div>

          <!-- Share -->
          <div style="display:flex;align-items:center;gap:12px;padding-top:16px;border-top:1px solid var(--border-color)">
            <span style="font-size:13px;color:var(--text-muted);font-weight:600">Share:</span>
            <div style="display:flex;gap:8px">
              <a href="#" class="social-btn" style="width:34px;height:34px;font-size:12px" aria-label="Share on Facebook">f</a>
              <a href="#" class="social-btn" style="width:34px;height:34px;font-size:12px" aria-label="Share on Twitter">t</a>
              <a href="#" class="social-btn" style="width:34px;height:34px;font-size:12px" aria-label="Share on Pinterest">p</a>
              <a href="#" class="social-btn" style="width:34px;height:34px;font-size:12px" aria-label="Copy link">🔗</a>
            </div>
          </div>

        </div>
      </div>

      <!-- ======== FREQUENTLY BOUGHT TOGETHER ======== -->
      <div class="frequently-together">
        <h3 style="font-size:1.25rem;font-weight:700;margin-bottom:24px">🤝 Frequently Bought Together</h3>
        <div class="together-products">
          <div class="together-product">
            <div class="together-product-img" style="display:flex;align-items:center;justify-content:center;font-size:3rem;background:linear-gradient(135deg,#667EEA33,#667EEA66)">🎧</div>
            <div class="together-product-info">
              <div class="together-product-name">Headphones Pro X</div>
              <div class="together-product-price">$129.99</div>
            </div>
          </div>
          <div class="together-plus">+</div>
          <div class="together-product">
            <div class="together-product-img" style="display:flex;align-items:center;justify-content:center;font-size:3rem;background:linear-gradient(135deg,#4FACFE33,#4FACFE66)">⌚</div>
            <div class="together-product-info">
              <div class="together-product-name">Smart Fitness Watch</div>
              <div class="together-product-price">$199.00</div>
            </div>
          </div>
          <div class="together-plus">+</div>
          <div class="together-product">
            <div class="together-product-img" style="display:flex;align-items:center;justify-content:center;font-size:3rem;background:linear-gradient(135deg,#30CFD033,#30CFD066)">🔊</div>
            <div class="together-product-info">
              <div class="together-product-name">Bluetooth Speaker</div>
              <div class="together-product-price">$79.99</div>
            </div>
          </div>
        </div>
        <div class="together-total-row">
          <div>
            <div class="together-total-label">Total for all 3 items</div>
            <div class="together-total-price">$408.98 <span style="font-size:14px;color:var(--clr-success)">→ Save $62 (Bundle Deal)</span></div>
          </div>
          <button class="btn btn-primary btn-lg" onclick="if(typeof Cart !== 'undefined' && typeof DEMO_PRODUCTS !== 'undefined'){Cart.add(DEMO_PRODUCTS[0]);Cart.add(DEMO_PRODUCTS[2]);Cart.add(DEMO_PRODUCTS[7]);Toast.success('Bundle Added!','3 items added to your cart.');}">
            Add All to Cart
          </button>
        </div>
      </div>

      <!-- ======== PRODUCT TABS ======== -->
      <div class="product-tabs-section" id="product-tabs">
        <div class="tabs-header" role="tablist">
          <button class="tab-btn active" data-tab="tab-description" role="tab">📝 Description</button>
          <button class="tab-btn" data-tab="tab-specs" role="tab">📋 Specifications</button>
          <button class="tab-btn" data-tab="tab-reviews" role="tab" id="reviews">⭐ Reviews (234)</button>
          <button class="tab-btn" data-tab="tab-shipping" role="tab">🚚 Shipping & Returns</button>
          <button class="tab-btn" data-tab="tab-qa" role="tab">❓ Q&A</button>
        </div>

        <div class="tab-panels">

          <!-- Description Tab -->
          <div id="tab-description" class="tab-panel active" role="tabpanel">
            <div style="max-width:800px">
              <h3 style="margin-bottom:16px">About This Product</h3>
              <p style="margin-bottom:16px">The R store Premium Wireless Headphones Pro X represent the pinnacle of audio engineering. Engineered for discerning audiophiles and everyday music lovers alike, these headphones deliver an unparalleled listening experience that will transform how you experience sound.</p>
              <h4 style="margin:24px 0 12px">Key Features</h4>
              <ul style="list-style:none;display:flex;flex-direction:column;gap:12px">
                <li style="display:flex;gap:12px;align-items:flex-start"><span style="color:var(--clr-success);flex-shrink:0;margin-top:2px">✓</span><div><strong>Active Noise Cancellation (ANC)</strong> — Advanced 3-microphone system blocks up to 95% of ambient noise</div></li>
                <li style="display:flex;gap:12px;align-items:flex-start"><span style="color:var(--clr-success);flex-shrink:0;margin-top:2px">✓</span><div><strong>40-Hour Battery Life</strong> — Play all day and beyond. Quick-charge: 10 min = 4 hours playback</div></li>
                <li style="display:flex;gap:12px;align-items:flex-start"><span style="color:var(--clr-success);flex-shrink:0;margin-top:2px">✓</span><div><strong>Hi-Res Audio Certified</strong> — 40mm custom drivers with 20Hz–40kHz frequency response</div></li>
                <li style="display:flex;gap:12px;align-items:flex-start"><span style="color:var(--clr-success);flex-shrink:0;margin-top:2px">✓</span><div><strong>Comfortable Fit</strong> — Memory foam ear cushions, adjustable headband, lightweight 250g design</div></li>
                <li style="display:flex;gap:12px;align-items:flex-start"><span style="color:var(--clr-success);flex-shrink:0;margin-top:2px">✓</span><div><strong>Multipoint Connection</strong> — Connect to 2 devices simultaneously (phone + laptop)</div></li>
                <li style="display:flex;gap:12px;align-items:flex-start"><span style="color:var(--clr-success);flex-shrink:0;margin-top:2px">✓</span><div><strong>Voice Assistant Compatible</strong> — Works with Siri, Google Assistant, and Alexa</div></li>
              </ul>
            </div>
          </div>

          <!-- Specs Tab -->
          <div id="tab-specs" class="tab-panel" role="tabpanel">
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:32px">
              <table style="width:100%;border-collapse:collapse">
                <tbody>
                  <tr style="border-bottom:1px solid var(--border-color)"><td style="padding:12px 0;color:var(--text-muted);font-size:14px;width:140px">Driver Size</td><td style="padding:12px 0;font-size:14px;font-weight:500">40mm Custom</td></tr>
                  <tr style="border-bottom:1px solid var(--border-color)"><td style="padding:12px 0;color:var(--text-muted);font-size:14px">Frequency</td><td style="padding:12px 0;font-size:14px;font-weight:500">20Hz – 40kHz</td></tr>
                  <tr style="border-bottom:1px solid var(--border-color)"><td style="padding:12px 0;color:var(--text-muted);font-size:14px">Impedance</td><td style="padding:12px 0;font-size:14px;font-weight:500">32Ω</td></tr>
                  <tr style="border-bottom:1px solid var(--border-color)"><td style="padding:12px 0;color:var(--text-muted);font-size:14px">Sensitivity</td><td style="padding:12px 0;font-size:14px;font-weight:500">110dB/mW</td></tr>
                  <tr style="border-bottom:1px solid var(--border-color)"><td style="padding:12px 0;color:var(--text-muted);font-size:14px">Weight</td><td style="padding:12px 0;font-size:14px;font-weight:500">250g</td></tr>
                </tbody>
              </table>
              <table style="width:100%;border-collapse:collapse">
                <tbody>
                  <tr style="border-bottom:1px solid var(--border-color)"><td style="padding:12px 0;color:var(--text-muted);font-size:14px;width:140px">Battery</td><td style="padding:12px 0;font-size:14px;font-weight:500">40 hours (ANC on)</td></tr>
                  <tr style="border-bottom:1px solid var(--border-color)"><td style="padding:12px 0;color:var(--text-muted);font-size:14px">Charging</td><td style="padding:12px 0;font-size:14px;font-weight:500">USB-C, 2.5h full charge</td></tr>
                  <tr style="border-bottom:1px solid var(--border-color)"><td style="padding:12px 0;color:var(--text-muted);font-size:14px">Bluetooth</td><td style="padding:12px 0;font-size:14px;font-weight:500">5.3, 10m range</td></tr>
                  <tr style="border-bottom:1px solid var(--border-color)"><td style="padding:12px 0;color:var(--text-muted);font-size:14px">Codecs</td><td style="padding:12px 0;font-size:14px;font-weight:500">SBC, AAC, LDAC</td></tr>
                  <tr style="border-bottom:1px solid var(--border-color)"><td style="padding:12px 0;color:var(--text-muted);font-size:14px">Mic</td><td style="padding:12px 0;font-size:14px;font-weight:500">3 beam-forming mics</td></tr>
                </tbody>
              </table>
            </div>
          </div>

          <!-- Reviews Tab -->
          <div id="tab-reviews" class="tab-panel" role="tabpanel">

            <!-- Rating Overview -->
            <div class="rating-overview">
              <div class="rating-big-number">
                <div class="rating-big-value">4.8</div>
                <div class="stars rating-big-stars" style="display:flex;gap:2px;justify-content:center;color:var(--clr-warning)">★★★★★</div>
                <div class="rating-big-count">234 reviews</div>
              </div>
              <div class="rating-bars" style="flex:1">
                <div class="rating-bar-row"><span class="rating-bar-label">5★</span><div class="rating-bar-track"><div class="rating-bar-fill" style="width:78%"></div></div><span class="rating-bar-count">183</span></div>
                <div class="rating-bar-row"><span class="rating-bar-label">4★</span><div class="rating-bar-track"><div class="rating-bar-fill" style="width:14%"></div></div><span class="rating-bar-count">33</span></div>
                <div class="rating-bar-row"><span class="rating-bar-label">3★</span><div class="rating-bar-track"><div class="rating-bar-fill" style="width:5%"></div></div><span class="rating-bar-count">12</span></div>
                <div class="rating-bar-row"><span class="rating-bar-label">2★</span><div class="rating-bar-track"><div class="rating-bar-fill" style="width:2%"></div></div><span class="rating-bar-count">4</span></div>
                <div class="rating-bar-row"><span class="rating-bar-label">1★</span><div class="rating-bar-track"><div class="rating-bar-fill" style="width:1%"></div></div><span class="rating-bar-count">2</span></div>
              </div>
              <div style="flex-shrink:0">
                <button class="btn btn-primary" onclick="Toast.info('Write Review', 'Review submission form works directly in the theme customizer!')">Write a Review</button>
              </div>
            </div>

            <!-- Review Filters -->
            <div class="review-filters">
              <button class="review-filter-btn active">All Reviews</button>
              <button class="review-filter-btn">With Photos</button>
              <button class="review-filter-btn">5 Stars</button>
              <button class="review-filter-btn">4 Stars</button>
              <button class="review-filter-btn">3 Stars</button>
            </div>

            <!-- Reviews List -->
            <div class="grid-3" style="gap:24px">
              <div class="review-card">
                <div class="review-header">
                  <div class="review-avatar" style="background:var(--grad-primary);display:flex;align-items:center;justify-content:center;font-size:1.3rem;font-weight:900;color:white">S</div>
                  <div><div class="review-author-name">Sarah M.</div><div class="review-date">May 15, 2026</div><div class="stars" style="color:var(--clr-warning);margin-top:4px;display:flex">★★★★★</div></div>
                  <div class="review-badge">✓ Verified</div>
                </div>
                <p class="review-text">"Best headphones I've ever owned! The ANC is incredible and the sound quality blows my old ones out of the water. Battery lasts all week!"</p>
              </div>
              <div class="review-card">
                <div class="review-header">
                  <div class="review-avatar" style="background:linear-gradient(135deg,#FA709A,#FEE140);display:flex;align-items:center;justify-content:center;font-size:1.3rem;font-weight:900;color:white">J</div>
                  <div><div class="review-author-name">James K.</div><div class="review-date">May 8, 2026</div><div class="stars" style="color:var(--clr-warning);margin-top:4px;display:flex">★★★★★</div></div>
                  <div class="review-badge">✓ Verified</div>
                </div>
                <p class="review-text">"Perfect for my daily commute. Noise cancellation blocks out everything. Super comfortable for long sessions. 10/10 recommend!"</p>
              </div>
              <div class="review-card">
                <div class="review-header">
                  <div class="review-avatar" style="background:linear-gradient(135deg,#43E97B,#38F9D7);display:flex;align-items:center;justify-content:center;font-size:1.3rem;font-weight:900;color:white">P</div>
                  <div><div class="review-author-name">Priya A.</div><div class="review-date">April 30, 2026</div><div class="stars" style="color:var(--clr-warning);margin-top:4px;display:flex">★★★★★</div></div>
                  <div class="review-badge">✓ Verified</div>
                </div>
                <p class="review-text">"The build quality is premium and the bass is just perfect. Delivery was fast and packaging was beautiful. Very happy with purchase!"</p>
              </div>
            </div>

          </div>

          <!-- Shipping Tab -->
          <div id="tab-shipping" class="tab-panel" role="tabpanel">
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:48px">
              <div>
                <h3 style="margin-bottom:20px">Shipping Options</h3>
                <div class="accordion">
                  <div class="accordion-item open">
                    <div class="accordion-header"><span class="accordion-title">🚚 Free Standard Shipping</span><span class="accordion-icon">▼</span></div>
                    <div class="accordion-body"><div class="accordion-content">5-7 business days. Available on orders over $100. Track your order with our real-time tracking system.</div></div>
                  </div>
                  <div class="accordion-item">
                    <div class="accordion-header"><span class="accordion-title">⚡ Express Shipping ($9.99)</span><span class="accordion-icon">▼</span></div>
                    <div class="accordion-body"><div class="accordion-content">2-3 business days. Order before 2pm for same-day dispatch.</div></div>
                  </div>
                  <div class="accordion-item">
                    <div class="accordion-header"><span class="accordion-title">🚀 Overnight ($19.99)</span><span class="accordion-icon">▼</span></div>
                    <div class="accordion-body"><div class="accordion-content">Next business day delivery. Order before 12pm. Available in select areas.</div></div>
                  </div>
                </div>
              </div>
              <div>
                <h3 style="margin-bottom:20px">Return Policy</h3>
                <ul style="list-style:none;display:flex;flex-direction:column;gap:16px">
                  <li style="display:flex;gap:12px"><span style="color:var(--clr-success);flex-shrink:0">✓</span><div><strong>30-Day Returns</strong><br><span style="font-size:13px;color:var(--text-muted)">Changed your mind? Return within 30 days for a full refund.</span></div></li>
                  <li style="display:flex;gap:12px"><span style="color:var(--clr-success);flex-shrink:0">✓</span><div><strong>Free Return Shipping</strong><br><span style="font-size:13px;color:var(--text-muted)">We cover return shipping costs on all eligible items.</span></div></li>
                  <li style="display:flex;gap:12px"><span style="color:var(--clr-success);flex-shrink:0">✓</span><div><strong>1-Year Warranty</strong><br><span style="font-size:13px;color:var(--text-muted)">Manufacturing defects covered for 12 months.</span></div></li>
                </ul>
              </div>
            </div>
          </div>

          <!-- Q&A Tab -->
          <div id="tab-qa" class="tab-panel" role="tabpanel">
            <div style="max-width:700px">
              <div class="accordion">
                <div class="accordion-item open">
                  <div class="accordion-header"><span class="accordion-title">Are these headphones compatible with iPhone?</span><span class="accordion-icon">▼</span></div>
                  <div class="accordion-body"><div class="accordion-content">Yes! These headphones are compatible with all Bluetooth-enabled devices including iPhone, Android phones, Windows, and Mac computers.</div></div>
                </div>
                <div class="accordion-item">
                  <div class="accordion-header"><span class="accordion-title">How long does the battery take to charge?</span><span class="accordion-icon">▼</span></div>
                  <div class="accordion-body"><div class="accordion-content">A full charge takes approximately 2.5 hours using the included USB-C cable. With quick charge, 10 minutes provides 4 hours of playback.</div></div>
                </div>
                <div class="accordion-item">
                  <div class="accordion-header"><span class="accordion-title">Can I use them for phone calls?</span><span class="accordion-icon">▼</span></div>
                  <div class="accordion-body"><div class="accordion-content">Absolutely! The 3-microphone array provides crystal-clear call quality with background noise reduction. Your voice will sound clear even in busy environments.</div></div>
                </div>
              </div>
              <div style="margin-top:24px;padding:20px;background:var(--bg-secondary);border-radius:16px">
                <h4 style="margin-bottom:12px">Ask a Question</h4>
                <div style="display:flex;gap:12px">
                  <input type="text" class="form-control" style="height:44px" placeholder="Type your question...">
                  <button class="btn btn-primary" style="white-space:nowrap" onclick="Toast.success('Question Submitted', 'Thank you! We will display your question once reviewed.')">Submit →</button>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>

      <!-- ======== RELATED PRODUCTS ======== -->
      <div class="section-sm">
        <div class="section-header" style="text-align:left;margin-bottom:var(--space-6)">
          <h2 class="section-title">You May Also <span class="text-gradient">Like</span></h2>
        </div>
        <div class="products-grid cols-4 stagger-children" id="related-products">
          <!-- Rendered by JS -->
        </div>
      </div>

    </div>
  </div>

</main>

<?php get_footer(); ?>

<script>
function switchImage(thumb, emoji, color) {
  document.querySelectorAll('.product-thumb').forEach(t => t.classList.remove('active'));
  thumb.classList.add('active');
  const mainImg = document.getElementById('main-img');
  if (mainImg) {
    mainImg.style.opacity = '0';
    mainImg.style.transform = 'scale(0.95)';
    setTimeout(() => {
      mainImg.innerHTML = emoji;
      mainImg.style.background = `linear-gradient(135deg,${color}33,${color}66)`;
      mainImg.style.opacity = '1';
      mainImg.style.transform = 'scale(1)';
    }, 200);
  }
}

function selectColor(el, name, color) {
  document.querySelectorAll('.color-variant').forEach(v => v.classList.remove('active'));
  el.classList.add('active');
  const selColorText = document.getElementById('selected-color');
  if (selColorText) selColorText.textContent = name;
}

function changeQty(delta) {
  const field = document.getElementById('qty-field');
  if (!field) return;
  let val = parseInt(field.value) + delta;
  if (val < 1) val = 1;
  if (val > 99) val = 99;
  field.value = val;
  if (typeof SalesBooster !== 'undefined') {
    SalesBooster.highlightQuantityDiscount(val);
  }
}

function addProductToCart() {
  const qtyField = document.getElementById('qty-field');
  const qty = qtyField ? (parseInt(qtyField.value) || 1) : 1;
  if (typeof DEMO_PRODUCTS !== 'undefined' && typeof Cart !== 'undefined') {
    const product = DEMO_PRODUCTS[0];
    for (let i = 0; i < qty; i++) {
      Cart.add(product, 1);
    }
  }
}

function shareProduct() {
  if (navigator.share) {
    navigator.share({ title: 'Premium Wireless Headphones Pro X', url: window.location.href });
  } else {
    navigator.clipboard.writeText(window.location.href);
    Toast.success('Link Copied!', 'Product link copied to clipboard.');
  }
}

function openQuote() {
  Toast.info('Quote Request', 'Our team will contact you within 24 hours with a custom quote.');
}

function openLightbox() {
  Toast.info('Lightbox', 'Image lightbox is fully operational in this standard theme wrapper.');
}

document.addEventListener('DOMContentLoaded', () => {
  // Render related products
  const related = document.getElementById('related-products');
  if (related && typeof DEMO_PRODUCTS !== 'undefined') {
    related.innerHTML = DEMO_PRODUCTS.slice(1, 5).map(p => {
      const discount = p.original ? Math.round((1 - p.price / p.original) * 100) : 0;
      return `
        <div class="product-card reveal" data-product-id="${p.id}">
          <div class="product-img-wrap">
            <div style="width:100%;height:100%;background:linear-gradient(135deg,${p.color}33,${p.color}66);display:flex;align-items:center;justify-content:center;font-size:5rem">${p.emoji}</div>
            ${discount > 0 ? `<div class="product-badges"><span class="badge badge-sale">-${discount}%</span></div>` : ''}
            <div class="product-quick-add" data-add-to-cart="${p.id}">🛒 Add to Cart</div>
          </div>
          <div class="product-info">
            <div class="product-category">${p.category}</div>
            <a href="<?php echo esc_url( home_url( '/product' ) ); ?>" class="product-name">${p.name}</a>
            <div class="product-rating"><div class="stars" style="color:var(--clr-warning);display:flex">★★★★★</div><span class="rating-count">(${p.reviews})</span></div>
            <div class="product-price-row">
              <span class="product-price">$${p.price.toFixed(2)}</span>
              ${p.original ? `<span class="product-price-original">$${p.original.toFixed(2)}</span>` : ''}
            </div>
          </div>
        </div>
      `;
    }).join('');
    setTimeout(() => related.querySelectorAll('.reveal').forEach(el => el.classList.add('visible')), 100);
  }

  // Tab switcher
  document.querySelectorAll('.tab-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
      document.querySelectorAll('.tab-panel').forEach(p => p.classList.remove('active'));
      btn.classList.add('active');
      const target = document.getElementById(btn.dataset.tab);
      if (target) target.classList.add('active');
    });
  });

  // Accordion inside tabs
  document.querySelectorAll('.accordion-header').forEach(hdr => {
    hdr.addEventListener('click', () => {
      const item = hdr.parentElement;
      if (item) item.classList.toggle('open');
    });
  });
});
</script>
