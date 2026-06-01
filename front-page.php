<?php
/**
 * The template for displaying the front page
 *
 * @package RStore
 */

get_header(); ?>

<main id="main-content">

  <!-- Hero Section -->
  <section class="section-sm" style="background:var(--bg-secondary);padding-top:var(--space-8);padding-bottom:var(--space-8)" aria-label="Featured Promotions">
    <div class="container">
      <div style="display:grid;grid-template-columns:1fr 380px;gap:var(--space-6)">

        <!-- Main Hero Slider -->
        <div class="hero-slide animate-fadeIn" style="min-height:500px;background:linear-gradient(135deg,#0F0F1A 0%,#1A1A2E 40%,#16213E 100%)">
          <div class="blob blob-purple" style="width:400px;height:400px;top:-100px;right:-100px;opacity:0.3"></div>
          <div class="blob blob-pink" style="width:300px;height:300px;bottom:-50px;right:200px;opacity:0.2"></div>
          <div class="hero-overlay" style="background:linear-gradient(to right, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0.3) 70%, transparent 100%)"></div>

          <div style="position:absolute;right:10%;top:50%;transform:translateY(-50%);font-size:12rem;opacity:0.9;animation:float 4s ease-in-out infinite;filter:drop-shadow(0 20px 40px rgba(108,63,232,0.4))">
            🎧
          </div>

          <div class="hero-content">
            <div class="hero-label animate-fadeInLeft delay-100">
              🔥 Best Seller — Limited Time
            </div>
            <h1 class="hero-title animate-fadeInUp delay-200">
              Premium Wireless
              <span class="highlight">Headphones</span>
              Pro X
            </h1>
            <p class="hero-desc animate-fadeInUp delay-300">
              Experience crystal-clear audio with active noise cancellation. 
              40-hour battery life, premium comfort, studio-quality sound.
            </p>
            <div class="hero-actions animate-fadeInUp delay-400">
              <a href="<?php echo esc_url( home_url( '/product' ) ); ?>" class="btn btn-primary btn-lg">
                Shop Now — $129
              </a>
              <div class="hero-price-tag animate-scaleIn delay-500">
                <span class="hero-price-label">Original Price</span>
                <span class="hero-price-value" style="text-decoration:line-through;color:var(--text-muted)">$199</span>
                <span style="font-size:12px;color:var(--clr-success);font-weight:700">Save 35%</span>
              </div>
            </div>
            <div class="slider-controls" style="margin-top:var(--space-6)">
              <div class="slider-dots">
                <div class="slider-dot active"></div>
                <div class="slider-dot"></div>
                <div class="slider-dot"></div>
              </div>
            </div>
          </div>
        </div>

        <!-- Side Promo Cards -->
        <div style="display:flex;flex-direction:column;gap:var(--space-4)">
          <!-- Promo Card 1 -->
          <div class="promo-card reveal" style="background:linear-gradient(135deg,#FF6B6B,#FF8E53);flex:1">
            <div style="position:absolute;right:20px;top:50%;transform:translateY(-50%);font-size:5rem;opacity:0.8;animation:float 3s ease-in-out infinite">
              👟
            </div>
            <div class="promo-card-content">
              <div class="promo-tag" style="color:rgba(255,255,255,0.8)">NEW ARRIVAL</div>
              <div class="promo-title" style="font-size:1.5rem">Running Shoes<br><span style="font-weight:400">Collection</span></div>
              <div class="promo-subtitle">Starting from $89</div>
              <a href="<?php echo esc_url( home_url( '/shop?cat=shoes' ) ); ?>" class="promo-cta">
                Shop Collection →
              </a>
            </div>
          </div>

          <!-- Promo Card 2 -->
          <div class="promo-card reveal delay-200" style="background:linear-gradient(135deg,#6C3FE8,#A855F7);flex:1">
            <div style="position:absolute;right:20px;top:50%;transform:translateY(-50%);font-size:5rem;opacity:0.8;animation:float 3.5s ease-in-out infinite">
              ✨
            </div>
            <div class="promo-card-content">
              <div class="promo-tag" style="color:rgba(255,255,255,0.8)">BEST SELLER</div>
              <div class="promo-title" style="font-size:1.5rem">Beauty &amp;<br><span style="font-weight:400">Skincare</span></div>
              <div class="promo-subtitle">Up to 40% OFF</div>
              <a href="<?php echo esc_url( home_url( '/shop?cat=beauty' ) ); ?>" class="promo-cta">
                Explore Now →
              </a>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- Features Bar -->
  <section class="section-sm" style="padding:var(--space-8) 0;border-bottom:1px solid var(--border-color)" aria-label="Store Features">
    <div class="container">
      <div class="grid-4 stagger-children">
        <div class="feature-box reveal">
          <div class="feature-icon">🚚</div>
          <div class="feature-text">
            <div class="feature-title">Free Shipping</div>
            <div class="feature-desc">On all orders over $100</div>
          </div>
        </div>
        <div class="feature-box reveal">
          <div class="feature-icon">🔄</div>
          <div class="feature-text">
            <div class="feature-title">Easy Returns</div>
            <div class="feature-desc">30-day hassle-free returns</div>
          </div>
        </div>
        <div class="feature-box reveal">
          <div class="feature-icon">🔒</div>
          <div class="feature-text">
            <div class="feature-title">Secure Payment</div>
            <div class="feature-desc">SSL encrypted checkout</div>
          </div>
        </div>
        <div class="feature-box reveal">
          <div class="feature-icon">💬</div>
          <div class="feature-text">
            <div class="feature-title">24/7 Support</div>
            <div class="feature-desc">Always here to help you</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Flash Sale Countdown -->
  <section class="section-sm" style="background:linear-gradient(135deg,#0F0F1A,#1A1A2E);padding:var(--space-12) 0;overflow:hidden;position:relative" aria-label="Flash Sale">
    <div class="blob blob-purple" style="width:500px;height:500px;top:-200px;left:-100px;opacity:0.15"></div>
    <div class="blob blob-pink" style="width:400px;height:400px;bottom:-200px;right:-100px;opacity:0.1"></div>

    <div class="container" style="position:relative;z-index:1">
      <div style="display:grid;grid-template-columns:1fr auto;align-items:center;gap:var(--space-8)">
        <div class="reveal-left">
          <div class="section-label" style="background:rgba(255,71,87,0.2);color:#FF4757;margin-bottom:var(--space-4)">⚡ Flash Sale</div>
          <h2 style="font-family:var(--font-display);font-size:clamp(1.75rem,3vw,2.5rem);font-weight:900;color:white;margin-bottom:var(--space-3)">
            Deals Ending Soon!
          </h2>
          <p style="color:rgba(255,255,255,0.6);font-size:1rem">Grab these amazing deals before the timer runs out</p>
        </div>

        <div data-countdown="auto" data-countdown-hours="12" class="reveal-right" style="background:rgba(255,255,255,0.06);backdrop-filter:blur(20px);border:1px solid rgba(255,255,255,0.1);border-radius:20px;padding:24px 32px">
          <div style="display:flex;align-items:center;gap:12px">
            <div class="countdown-unit">
              <div class="countdown-value" data-hours style="font-size:3rem;font-weight:900;color:white;line-height:1;font-family:var(--font-display)">00</div>
              <div class="countdown-label" style="color:rgba(255,255,255,0.5);font-size:11px;text-align:center;text-transform:uppercase;margin-top:4px">Hours</div>
            </div>
            <div class="countdown-sep" style="font-size:2.5rem;color:var(--clr-primary);font-weight:900">:</div>
            <div class="countdown-unit">
              <div class="countdown-value" data-minutes style="font-size:3rem;font-weight:900;color:white;line-height:1;font-family:var(--font-display)">00</div>
              <div class="countdown-label" style="color:rgba(255,255,255,0.5);font-size:11px;text-align:center;text-transform:uppercase;margin-top:4px">Minutes</div>
            </div>
            <div class="countdown-sep" style="font-size:2.5rem;color:var(--clr-primary);font-weight:900">:</div>
            <div class="countdown-unit">
              <div class="countdown-value" data-seconds style="font-size:3rem;font-weight:900;color:var(--clr-primary);line-height:1;font-family:var(--font-display)">00</div>
              <div class="countdown-label" style="color:rgba(255,255,255,0.5);font-size:11px;text-align:center;text-transform:uppercase;margin-top:4px">Seconds</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Categories -->
  <section class="section" aria-label="Shop by Category">
    <div class="container">
      <div class="section-header">
        <span class="section-label">Browse</span>
        <h2 class="section-title">Shop by <span class="text-gradient">Category</span></h2>
        <p class="section-subtitle">Explore our wide selection across hundreds of categories</p>
      </div>

      <div class="grid-6 stagger-children">
        <a href="<?php echo esc_url( home_url( '/shop?cat=fashion' ) ); ?>" class="category-card reveal" style="aspect-ratio:2/3;min-height:200px;background:linear-gradient(135deg,#667EEA,#764BA2)">
          <div class="category-card-overlay"></div>
          <div class="category-card-info">
            <div style="font-size:2.5rem;margin-bottom:8px">👗</div>
            <div class="category-card-name">Fashion</div>
            <div class="category-card-count">1,240+ items</div>
            <div class="category-card-arrow">→</div>
          </div>
        </a>
        <a href="<?php echo esc_url( home_url( '/shop?cat=electronics' ) ); ?>" class="category-card reveal delay-100" style="aspect-ratio:2/3;min-height:200px;background:linear-gradient(135deg,#4FACFE,#00F2FE)">
          <div class="category-card-overlay"></div>
          <div class="category-card-info">
            <div style="font-size:2.5rem;margin-bottom:8px">📱</div>
            <div class="category-card-name">Electronics</div>
            <div class="category-card-count">890+ items</div>
            <div class="category-card-arrow">→</div>
          </div>
        </a>
        <a href="<?php echo esc_url( home_url( '/shop?cat=beauty' ) ); ?>" class="category-card reveal delay-200" style="aspect-ratio:2/3;min-height:200px;background:linear-gradient(135deg,#FA709A,#FEE140)">
          <div class="category-card-overlay"></div>
          <div class="category-card-info">
            <div style="font-size:2.5rem;margin-bottom:8px">💄</div>
            <div class="category-card-name">Beauty</div>
            <div class="category-card-count">640+ items</div>
            <div class="category-card-arrow">→</div>
          </div>
        </a>
        <a href="<?php echo esc_url( home_url( '/shop?cat=sports' ) ); ?>" class="category-card reveal delay-300" style="aspect-ratio:2/3;min-height:200px;background:linear-gradient(135deg,#43E97B,#38F9D7)">
          <div class="category-card-overlay"></div>
          <div class="category-card-info">
            <div style="font-size:2.5rem;margin-bottom:8px">⚽</div>
            <div class="category-card-name">Sports</div>
            <div class="category-card-count">450+ items</div>
            <div class="category-card-arrow">→</div>
          </div>
        </a>
        <a href="<?php echo esc_url( home_url( '/shop?cat=home' ) ); ?>" class="category-card reveal delay-400" style="aspect-ratio:2/3;min-height:200px;background:linear-gradient(135deg,#F093FB,#F5576C)">
          <div class="category-card-overlay"></div>
          <div class="category-card-info">
            <div style="font-size:2.5rem;margin-bottom:8px">🏠</div>
            <div class="category-card-name">Home</div>
            <div class="category-card-count">780+ items</div>
            <div class="category-card-arrow">→</div>
          </div>
        </a>
        <a href="<?php echo esc_url( home_url( '/shop?cat=books' ) ); ?>" class="category-card reveal delay-500" style="aspect-ratio:2/3;min-height:200px;background:linear-gradient(135deg,#30CFD0,#5B86E5)">
          <div class="category-card-overlay"></div>
          <div class="category-card-info">
            <div style="font-size:2.5rem;margin-bottom:8px">📚</div>
            <div class="category-card-name">Books</div>
            <div class="category-card-count">320+ items</div>
            <div class="category-card-arrow">→</div>
          </div>
        </a>
      </div>
    </div>
  </section>

  <!-- Featured Products -->
  <section class="section bg-secondary" aria-label="Featured Products" id="featured">
    <div class="container">
      <div class="section-header" style="display:flex;align-items:flex-end;justify-content:space-between;text-align:left;margin-bottom:var(--space-8)">
        <div>
          <span class="section-label">Handpicked</span>
          <h2 class="section-title">Featured <span class="text-gradient">Products</span></h2>
        </div>
        <div style="display:flex;gap:var(--space-2)">
          <button class="btn btn-sm btn-secondary active" data-filter-category="all" style="border-color:var(--clr-primary);color:var(--clr-primary)">All</button>
          <button class="btn btn-sm btn-secondary" data-filter-category="Electronics">Electronics</button>
          <button class="btn btn-sm btn-secondary" data-filter-category="Fashion">Fashion</button>
          <button class="btn btn-sm btn-secondary" data-filter-category="Beauty">Beauty</button>
        </div>
      </div>

      <div class="products-grid cols-4 stagger-children" id="featured-products">
        <!-- Products rendered by JavaScript -->
      </div>

      <div style="text-align:center;margin-top:var(--space-10)">
        <a href="<?php echo esc_url( home_url( '/shop' ) ); ?>" class="btn btn-outline btn-lg">
          View All Products →
        </a>
      </div>
    </div>
  </section>

  <!-- Recently Ordered Ticker -->
  <div style="background:var(--clr-primary-soft);border-top:1px solid var(--border-light);border-bottom:1px solid var(--border-light);padding:10px 0">
    <div class="container" style="display:flex;align-items:center;gap:16px">
      <div style="flex-shrink:0;font-size:12px;font-weight:700;color:var(--clr-primary);white-space:nowrap">🔥 RECENT ORDERS:</div>
      <div data-orders-ticker style="font-size:13px;color:var(--text-secondary)"></div>
    </div>
  </div>

  <!-- Promo Banner - 3 Grid -->
  <section class="section" aria-label="Special Promotions">
    <div class="container">
      <div class="grid-3">
        <div class="promo-card reveal" style="background:linear-gradient(135deg,#FF6B6B,#FF8E53);min-height:300px">
          <div style="position:absolute;right:-10px;bottom:-10px;font-size:8rem;opacity:0.4">👗</div>
          <div class="promo-card-content">
            <div class="promo-tag">LIMITED OFFER</div>
            <div class="promo-title">Women's Fashion<br><span style="font-size:2rem;font-weight:900">50% OFF</span></div>
            <div class="promo-subtitle">Selected styles</div>
            <a href="<?php echo esc_url( home_url( '/shop?cat=women' ) ); ?>" class="promo-cta">Shop Now →</a>
          </div>
        </div>
        <div class="promo-card reveal delay-200" style="background:linear-gradient(135deg,#0F0F1A,#1A1A2E);min-height:300px">
          <div style="position:absolute;right:20px;top:50%;transform:translateY(-50%);font-size:7rem;animation:float 3s ease-in-out infinite">💻</div>
          <div class="promo-card-content">
            <div class="promo-tag" style="color:rgba(255,255,255,0.6)">TECH WEEK</div>
            <div class="promo-title">Latest Electronics</div>
            <div class="promo-subtitle">New arrivals daily</div>
            <a href="<?php echo esc_url( home_url( '/shop?cat=electronics' ) ); ?>" class="promo-cta">Explore →</a>
          </div>
        </div>
        <div class="promo-card reveal delay-400" style="background:linear-gradient(135deg,#6C3FE8,#A855F7);min-height:300px">
          <div style="position:absolute;right:-10px;bottom:-20px;font-size:8rem;opacity:0.5">✨</div>
          <div class="promo-card-content">
            <div class="promo-tag">PREMIUM</div>
            <div class="promo-title">Beauty &amp;<br>Skincare</div>
            <div class="promo-subtitle">Free gift over $80</div>
            <a href="<?php echo esc_url( home_url( '/shop?cat=beauty' ) ); ?>" class="promo-cta">Discover →</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- New Arrivals -->
  <section class="section bg-secondary" aria-label="New Arrivals">
    <div class="container">
      <div class="section-header">
        <span class="section-label">Just In</span>
        <h2 class="section-title">New <span class="text-gradient">Arrivals</span></h2>
        <p class="section-subtitle">Fresh drops every week — be the first to shop</p>
      </div>

      <div class="products-grid cols-4 stagger-children" id="new-arrivals">
        <!-- Rendered by JS -->
      </div>
    </div>
  </section>

  <!-- Stats Section -->
  <section class="section" style="background:linear-gradient(135deg,#6C3FE8,#A855F7,#EC4899);padding:var(--space-16) 0" aria-label="Store Statistics">
    <div class="container">
      <div class="grid-4 stagger-children" style="color:white;text-align:center">
        <div class="reveal">
          <div style="font-family:var(--font-display);font-size:clamp(2rem,4vw,3.5rem);font-weight:900;margin-bottom:8px;line-height:1">
            <span data-counter="50000" data-suffix="+" data-duration="2000">0+</span>
          </div>
          <div style="font-size:1rem;opacity:0.8">Happy Customers</div>
        </div>
        <div class="reveal delay-200">
          <div style="font-family:var(--font-display);font-size:clamp(2rem,4vw,3.5rem);font-weight:900;margin-bottom:8px;line-height:1">
            <span data-counter="12000" data-suffix="+" data-duration="2000">0+</span>
          </div>
          <div style="font-size:1rem;opacity:0.8">Products Available</div>
        </div>
        <div class="reveal delay-400">
          <div style="font-family:var(--font-display);font-size:clamp(2rem,4vw,3.5rem);font-weight:900;margin-bottom:8px;line-height:1">
            <span data-counter="4.9" data-suffix="★" data-duration="2000">0★</span>
          </div>
          <div style="font-size:1rem;opacity:0.8">Average Rating</div>
        </div>
        <div class="reveal delay-600">
          <div style="font-family:var(--font-display);font-size:clamp(2rem,4vw,3.5rem);font-weight:900;margin-bottom:8px;line-height:1">
            <span data-counter="120" data-suffix="+" data-duration="2000">0+</span>
          </div>
          <div style="font-size:1rem;opacity:0.8">Countries Shipped</div>
        </div>
      </div>
    </div>
  </section>

  <!-- Customer Reviews -->
  <section class="section bg-secondary" aria-label="Customer Reviews">
    <div class="container">
      <div class="section-header">
        <span class="section-label">Testimonials</span>
        <h2 class="section-title">What Our <span class="text-gradient">Customers Say</span></h2>
        <p class="section-subtitle">Real reviews from verified buyers worldwide</p>
      </div>

      <div class="grid-3 stagger-children">
        <div class="review-card reveal">
          <div class="review-header">
            <div class="review-avatar" style="background:var(--grad-primary);display:flex;align-items:center;justify-content:center;font-size:1.5rem;font-weight:900;color:white;font-family:var(--font-display)">S</div>
            <div>
              <div class="review-author-name">Sarah M.</div>
              <div class="review-date">May 15, 2026</div>
              <div class="stars" style="margin-top:4px">★★★★★</div>
            </div>
            <div class="review-badge">✓ Verified</div>
          </div>
          <p class="review-text">"Absolutely love everything I've ordered from R store! The quality is amazing, delivery was super fast, and the packaging was gorgeous. Will definitely be a repeat customer! 🌟"</p>
        </div>
        <div class="review-card reveal delay-200">
          <div class="review-header">
            <div class="review-avatar" style="background:linear-gradient(135deg,#FA709A,#FEE140);display:flex;align-items:center;justify-content:center;font-size:1.5rem;font-weight:900;color:white;font-family:var(--font-display)">J</div>
            <div>
              <div class="review-author-name">James K.</div>
              <div class="review-date">April 28, 2026</div>
              <div class="stars" style="margin-top:4px">★★★★★</div>
            </div>
            <div class="review-badge">✓ Verified</div>
          </div>
          <p class="review-text">"The wireless headphones I bought are incredible. The sound quality is out of this world and the noise cancellation works perfectly. Customer service was also very helpful. Highly recommend!"</p>
        </div>
        <div class="review-card reveal delay-400">
          <div class="review-header">
            <div class="review-avatar" style="background:linear-gradient(135deg,#43E97B,#38F9D7);display:flex;align-items:center;justify-content:center;font-size:1.5rem;font-weight:900;color:white;font-family:var(--font-display)">P</div>
            <div>
              <div class="review-author-name">Priya A.</div>
              <div class="review-date">May 3, 2026</div>
              <div class="stars" style="margin-top:4px">★★★★★</div>
            </div>
            <div class="review-badge">✓ Verified</div>
          </div>
          <p class="review-text">"Best online shopping experience I've had! The website is so easy to use, the product descriptions are accurate, and my order arrived 2 days early. The face serum I bought is already showing results!"</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Newsletter -->
  <section style="padding:var(--space-20) 0;background:linear-gradient(135deg,#0F0F1A,#1A1A2E);position:relative;overflow:hidden" aria-label="Newsletter Signup">
    <div class="blob blob-purple" style="width:500px;height:500px;top:-200px;right:-100px;opacity:0.1"></div>
    <div class="blob blob-pink" style="width:400px;height:400px;bottom:-200px;left:-100px;opacity:0.08"></div>

    <div class="container" style="position:relative;z-index:1;text-align:center;max-width:600px">
      <div class="section-label" style="background:rgba(108,63,232,0.2);color:var(--clr-primary-light)">📧 Newsletter</div>
      <h2 style="font-family:var(--font-display);font-size:clamp(1.75rem,3vw,2.5rem);font-weight:900;color:white;margin:var(--space-4) 0">
        Get Exclusive Deals &amp; Updates
      </h2>
      <p style="color:rgba(255,255,255,0.6);margin-bottom:var(--space-8)">
        Join 50,000+ subscribers and get 10% off your first order
      </p>

      <form id="newsletter-form" style="display:flex;gap:12px;max-width:500px;margin:0 auto" onsubmit="handleNewsletter(event)">
        <input type="email" placeholder="Enter your email address..." required
          style="flex:1;height:52px;padding:0 20px;background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.15);border-radius:12px;color:white;font-size:14px;outline:none"
          id="newsletter-email"
        >
        <button type="submit" class="btn btn-primary" style="height:52px;padding:0 28px;flex-shrink:0">Subscribe</button>
      </form>
      <p style="font-size:12px;color:rgba(255,255,255,0.4);margin-top:16px">
        No spam, ever. Unsubscribe anytime.
      </p>
    </div>
  </section>

</main>

<?php get_footer(); ?>

<script>
  // ============================================================
  // HOMEPAGE SPECIFIC JS
  // ============================================================

  // Render featured products
  function renderProducts(containerId, products) {
    const container = document.getElementById(containerId);
    if (!container) return;

    container.innerHTML = products.map(p => {
      const discount = p.original ? Math.round((1 - p.price / p.original) * 100) : 0;
      return `
        <div class="product-card reveal" data-product-id="${p.id}">
          <div class="product-img-wrap">
            <div style="width:100%;height:100%;background:linear-gradient(135deg,${p.color}33,${p.color}66);display:flex;align-items:center;justify-content:center;font-size:6rem;transition:transform 0.5s ease">
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
            <div class="product-quick-add" data-add-to-cart="${p.id}">🛒 Add to Cart</div>
          </div>
          <div class="product-info">
            <div class="product-category">${p.category}</div>
            <a href="<?php echo esc_url( home_url( '/product' ) ); ?>" class="product-name">${p.name}</a>
            <div class="product-rating">
              <div class="stars">${'★'.repeat(Math.floor(p.rating))}${p.rating % 1 ? '<span class="star half">★</span>' : ''}${'★'.repeat(5-Math.ceil(p.rating))}</div>
              <span class="rating-count">(${p.reviews})</span>
            </div>
            <div class="product-price-row">
              <span class="product-price">$${p.price.toFixed(2)}</span>
              ${p.original ? `<span class="product-price-original">$${p.original.toFixed(2)}</span>` : ''}
              ${discount > 0 ? `<span class="product-price-discount">-${discount}%</span>` : ''}
            </div>
          </div>
        </div>
      `;
    }).join('');

    // Re-trigger reveal animations
    setTimeout(() => {
      container.querySelectorAll('.reveal').forEach(el => el.classList.add('visible'));
    }, 100);
  }

  // Newsletter handler
  function handleNewsletter(e) {
    e.preventDefault();
    const email = document.getElementById('newsletter-email').value;
    Toast.success('Subscribed! 🎉', `Welcome! Check ${email} for your 10% discount code.`);
    document.getElementById('newsletter-form').reset();
  }

  // Init when DOM ready
  document.addEventListener('DOMContentLoaded', () => {
    if (typeof DEMO_PRODUCTS !== 'undefined') {
      renderProducts('featured-products', DEMO_PRODUCTS.slice(0, 8));
      renderProducts('new-arrivals', DEMO_PRODUCTS.slice(4, 8));
    }

    // Category filter buttons
    document.querySelectorAll('[data-filter-category]').forEach(btn => {
      btn.addEventListener('click', () => {
        document.querySelectorAll('[data-filter-category]').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        btn.style.borderColor = 'var(--clr-primary)';
        btn.style.color = 'var(--clr-primary)';

        const cat = btn.dataset.filterCategory;
        if (typeof DEMO_PRODUCTS !== 'undefined') {
          const filtered = cat === 'all'
            ? DEMO_PRODUCTS
            : DEMO_PRODUCTS.filter(p => p.category === cat);

          renderProducts('featured-products', filtered.slice(0, 8));
        }
      });
    });
  });
</script>
