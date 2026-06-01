<?php
/**
 * Template Name: Maintenance Page
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
  <title>Maintenance Mode | R store</title>
  <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>🛍</text></svg>">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  
  <link rel="stylesheet" href="<?php echo esc_url( $uri ); ?>/css/main.css">
  <link rel="stylesheet" href="<?php echo esc_url( $uri ); ?>/css/animations.css">
  
  <style>
    body { min-height: 100vh; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, #0F0F1A 0%, #1A1A2E 40%, #16213E 100%); overflow: hidden; }
    .maintenance-wrap { text-align: center; max-width: 600px; padding: 40px; position: relative; z-index: 1; }
    .maintenance-logo { font-family: var(--font-display); font-size: 2rem; font-weight: 900; color: white; margin-bottom: 40px; }
    .maintenance-logo span { color: var(--clr-primary); }
    .maintenance-icon { font-size: 8rem; margin-bottom: 32px; animation: float 4s ease-in-out infinite; display: block; }
    .maintenance-title { font-family: var(--font-display); font-size: clamp(2rem,5vw,3.5rem); font-weight: 900; color: white; margin-bottom: 16px; }
    .maintenance-subtitle { font-size: 1.1rem; color: rgba(255,255,255,0.6); margin-bottom: 48px; }
    .countdown-row { display: flex; gap: 24px; justify-content: center; margin-bottom: 48px; }
    .countdown-block { background: rgba(255,255,255,0.06); backdrop-filter: blur(20px); border: 1px solid rgba(255,255,255,0.1); border-radius: 20px; padding: 20px 28px; text-align: center; min-width: 90px; }
    .countdown-num { font-family: var(--font-display); font-size: 3rem; font-weight: 900; color: white; line-height: 1; }
    .countdown-lbl { font-size: 11px; color: rgba(255,255,255,0.4); text-transform: uppercase; letter-spacing: 1px; margin-top: 6px; }
    .notify-form { display: flex; gap: 12px; max-width: 420px; margin: 0 auto 32px; }
    .notify-input { flex: 1; height: 52px; padding: 0 20px; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.2); border-radius: 14px; color: white; font-size: 14px; outline: none; font-family: var(--font-body); }
    .notify-input::placeholder { color: rgba(255,255,255,0.4); }
    .social-links { display: flex; gap: 12px; justify-content: center; }
    .social-link { width: 44px; height: 44px; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.15); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: rgba(255,255,255,0.6); font-size: 13px; font-weight: 700; cursor: pointer; transition: all 0.3s; }
    .social-link:hover { background: var(--clr-primary); border-color: var(--clr-primary); color: white; transform: translateY(-3px); }
    .progress-ring { display: flex; align-items: center; justify-content: center; margin-bottom: 40px; }
    .progress-ring-track { stroke: rgba(255,255,255,0.1); }
    .progress-ring-fill { stroke: var(--clr-primary); stroke-linecap: round; transform: rotate(-90deg); transform-origin: center; transition: stroke-dashoffset 1s ease; }
    .progress-pct { font-family: var(--font-display); font-size: 2rem; font-weight: 900; fill: white; }
    .progress-lbl { font-size: 0.75rem; fill: rgba(255,255,255,0.5); }
  </style>
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Blobs -->
<div class="blob blob-purple" style="width:600px;height:600px;top:-200px;left:-200px;opacity:0.15;position:fixed"></div>
<div class="blob blob-pink" style="width:500px;height:500px;bottom:-200px;right:-100px;opacity:0.1;position:fixed"></div>

<div class="maintenance-wrap animate-fadeIn">

  <!-- Logo -->
  <div class="maintenance-logo">Shop<span>Zen</span></div>

  <!-- Icon -->
  <span class="maintenance-icon">🔧</span>

  <!-- Title -->
  <h1 class="maintenance-title">We're Upgrading!</h1>
  <p class="maintenance-subtitle">We're making some exciting improvements to give you a better shopping experience. We'll be back very soon!</p>

  <!-- Progress Ring -->
  <div class="progress-ring">
    <svg width="150" height="150" viewBox="0 0 150 150">
      <circle class="progress-ring-track" cx="75" cy="75" r="60" fill="none" stroke-width="8"/>
      <circle class="progress-ring-fill" id="progress-ring" cx="75" cy="75" r="60" fill="none" stroke-width="8"
        stroke-dasharray="377" stroke-dashoffset="94"/>
      <text x="75" y="68" text-anchor="middle" class="progress-pct" font-family="Outfit, sans-serif">75%</text>
      <text x="75" y="88" text-anchor="middle" class="progress-lbl" font-family="Inter, sans-serif">Complete</text>
    </svg>
  </div>

  <!-- Countdown -->
  <div class="countdown-row" data-countdown="auto" data-countdown-hours="48">
    <div class="countdown-block">
      <div class="countdown-num" data-days>00</div>
      <div class="countdown-lbl">Days</div>
    </div>
    <div class="countdown-block">
      <div class="countdown-num" data-hours>00</div>
      <div class="countdown-lbl">Hours</div>
    </div>
    <div class="countdown-block">
      <div class="countdown-num" data-minutes>00</div>
      <div class="countdown-lbl">Minutes</div>
    </div>
    <div class="countdown-block">
      <div class="countdown-num" data-seconds>00</div>
      <div class="countdown-lbl">Seconds</div>
    </div>
  </div>

  <!-- Notify -->
  <p style="color:rgba(255,255,255,0.5);font-size:14px;margin-bottom:16px">Get notified when we're back:</p>
  <form class="notify-form" onsubmit="handleNotify(event)">
    <input type="email" class="notify-input" placeholder="Enter your email..." id="notify-email" required>
    <button type="submit" class="btn btn-primary" style="height:52px;padding:0 24px;flex-shrink:0">Notify Me</button>
  </form>

  <!-- Socials -->
  <div class="social-links">
    <div class="social-link">f</div>
    <div class="social-link">t</div>
    <div class="social-link">ig</div>
    <div class="social-link">▶</div>
  </div>

  <p style="color:rgba(255,255,255,0.25);font-size:12px;margin-top:32px">
    Need urgent help? <a href="mailto:support@rstore.com" style="color:var(--clr-primary)">support@rstore.com</a>
  </p>
  <p style="color:rgba(255,255,255,0.2);font-size:11px;margin-top:8px">
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" style="color:rgba(255,255,255,0.3)">← Return to Home</a>
  </p>

</div>

<div class="toast-container" id="toast-container"></div>

<?php wp_footer(); ?>
<script>
function handleNotify(e) {
  e.preventDefault();
  const email = document.getElementById('notify-email').value;
  if (typeof Toast !== 'undefined') {
    Toast.show({
      title: 'You\'re on the list! 🎉',
      message: `We'll email ${email} the moment we launch.`,
      type: 'success',
      duration: 5000,
      icon: '🔔'
    });
  }
  e.target.reset();
}
</script>
</body>
</html>
