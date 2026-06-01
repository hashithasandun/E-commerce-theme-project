<?php
/**
 * The main template file
 * Falls back to showing landing sections.
 */
get_header(); ?>

<main>
  <div class="page-hero" style="background:linear-gradient(135deg,var(--bg-secondary),var(--bg-tertiary))">
    <div class="container">
      <h1 class="page-hero-title"><?php single_post_title(); ?></h1>
      <p class="page-hero-subtitle">Premium blog posts and updates from R store.</p>
    </div>
  </div>

  <div class="section-sm">
    <div class="container">
      <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap:32px">
        <?php
        if ( have_posts() ) :
          while ( have_posts() ) : the_post();
            ?>
            <div class="glass-card" style="padding: 32px">
              <span style="font-size:12px; color:var(--clr-primary); font-weight:700; text-transform:uppercase; letter-spacing:1px"><?php the_category( ', ' ); ?></span>
              <h2 style="font-family:var(--font-display); font-size:1.5rem; font-weight:800; margin-top:8px; margin-bottom:12px">
                <a href="<?php the_permalink(); ?>" style="color:var(--text-main); text-decoration:none"><?php the_title(); ?></a>
              </h2>
              <div style="font-size:14px; opacity:0.8; line-height:1.6; margin-bottom:20px"><?php the_excerpt(); ?></div>
              <a href="<?php the_permalink(); ?>" class="btn btn-sm btn-outline">Read More →</a>
            </div>
            <?php
          endwhile;
        else :
          ?>
          <div class="empty-state" style="grid-column: 1/-1">
            <span class="empty-state-icon">📄</span>
            <h2 class="empty-state-title">No posts found</h2>
            <p class="empty-state-text">Sorry, no matching updates were posted yet.</p>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-primary">Return to Home</a>
          </div>
          <?php
        endif;
        ?>
      </div>
    </div>
  </div>
</main>

<?php get_footer(); ?>
