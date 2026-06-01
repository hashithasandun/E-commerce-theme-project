<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package RStore
 */
$uri = get_template_directory_uri();
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> data-theme="light">
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>404 - Page Not Found | R store</title>
  <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>🛍</text></svg>">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  
  <link rel="stylesheet" href="<?php echo esc_url( $uri ); ?>/css/main.css">
  <link rel="stylesheet" href="<?php echo esc_url( $uri ); ?>/css/components.css">
  <link rel="stylesheet" href="<?php echo esc_url( $uri ); ?>/css/animations.css">
  <link rel="stylesheet" href="<?php echo esc_url( $uri ); ?>/css/responsive.css">
  <link rel="stylesheet" href="<?php echo esc_url( $uri ); ?>/css/extras.css">
  
  <style>
    body { min-height: 100vh; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, #0F0F1A 0%, #1A1A2E 40%, #16213E 100%); overflow: hidden; }
    .error-wrap { text-align: center; max-width: 600px; padding: 40px; position: relative; z-index: 1; }
    .error-logo { font-family: var(--font-display); font-size: 2rem; font-weight: 900; color: white; margin-bottom: 30px; }
    .error-logo span { color: var(--clr-primary); }
    .error-code { font-family: var(--font-display); font-size: clamp(6rem, 15vw, 10rem); font-weight: 900; background: linear-gradient(135deg, var(--clr-primary), var(--clr-secondary)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; line-height: 1; margin-bottom: 16px; animation: pulse 3s infinite; }
    .error-title { font-family: var(--font-display); font-size: 2rem; font-weight: 800; color: white; margin-bottom: 16px; }
    .error-text { font-size: 1.1rem; color: rgba(255,255,255,0.6); margin-bottom: 40px; }
    .error-search-form { display: flex; gap: 12px; max-width: 480px; margin: 0 auto 40px; }
    .error-search-input { flex: 1; height: 50px; padding: 0 20px; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.2); border-radius: 14px; color: white; font-size: 14px; outline: none; }
    .error-search-input::placeholder { color: rgba(255,255,255,0.4); }
    .quick-links { display: flex; gap: 16px; justify-content: center; flex-wrap: wrap; margin-bottom: 40px; }
    .quick-link-btn { background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1); border-radius: 12px; padding: 10px 20px; color: white; font-size: 14px; font-weight: 600; text-decoration: none; transition: all 0.3s; }
    .quick-link-btn:hover { background: rgba(255,255,255,0.15); border-color: rgba(255,255,255,0.25); transform: translateY(-2px); }
  </style>
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Blobs -->
<div class="blob blob-purple" style="width:600px;height:600px;top:-200px;left:-200px;opacity:0.15;position:fixed"></div>
<div class="blob blob-pink" style="width:500px;height:500px;bottom:-200px;right:-100px;opacity:0.1;position:fixed"></div>

<div class="error-wrap animate-fadeIn">
  <!-- Logo -->
  <div class="error-logo">Shop<span>Zen</span></div>

  <!-- Error Code -->
  <div class="error-code">404</div>

  <!-- Title & Text -->
  <h1 class="error-title">Lost in Space?</h1>
  <p class="error-text">The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.</p>

  <!-- Search -->
  <form class="error-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="GET">
    <input type="search" name="s" class="error-search-input" placeholder="Search for products, categories..." required>
    <button type="submit" class="btn btn-primary" style="height:50px;padding:0 24px;border-radius:14px;flex-shrink:0">Search</button>
  </form>

  <!-- Quick Links -->
  <div class="quick-links">
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="quick-link-btn">🏠 Home</a>
    <a href="<?php echo esc_url( home_url( '/shop' ) ); ?>" class="quick-link-btn">🛍 Shop Catalog</a>
    <a href="<?php echo esc_url( home_url( '/wishlist' ) ); ?>" class="quick-link-btn">❤️ Wishlist</a>
    <a href="<?php echo esc_url( home_url( '/account' ) ); ?>" class="quick-link-btn">👤 My Account</a>
  </div>

  <p style="color:rgba(255,255,255,0.3);font-size:12px">
    If you think this is a mistake, please contact <a href="mailto:support@rstore.com" style="color:var(--clr-primary)">support@rstore.com</a>
  </p>
</div>

<div class="toast-container" id="toast-container"></div>

<?php wp_footer(); ?>
</body>
</html>
