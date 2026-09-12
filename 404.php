<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package ChadSia
 */

get_header();

// Enqueue Core Templates CSS
$css_url = get_stylesheet_directory_uri() . '/assets/css/core-templates.css';
$css_ver = file_exists(get_stylesheet_directory() . '/assets/css/core-templates.css') ? filemtime(get_stylesheet_directory() . '/assets/css/core-templates.css') : '1.0.0';
?>
<!-- Font Awesome Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="<?php echo esc_url($css_url); ?>?v=<?php echo esc_attr($css_ver); ?>" media="all" />

<div class="cs-core-wrapper">
  
  <header class="cs-404-hero">
    <div class="cs-header-blob"></div>
    <div class="cs-core-container">
      <div class="cs-post-header-inner">
        
        <div class="cs-404-glitch">404</div>
        
        <div class="cs-post-eyebrow">
          <span>Page Not Found or Relocated</span>
        </div>

        <h1 class="cs-post-title">Looking for Something Specific?</h1>

        <p style="font-size: 18px; color: var(--cs-core-text); max-width: 600px; margin: 0 auto 32px; line-height: 1.6;">
          The URL you requested may have been moved, updated, or does not exist. Use the search box below or jump to one of our core destinations.
        </p>

        <!-- Search Form -->
        <div class="cs-404-search-box">
          <form role="search" method="get" class="cs-search-form" action="<?php echo esc_url(home_url('/')); ?>">
            <input type="search" class="cs-search-input" placeholder="Search articles, services, or case studies..." value="<?php echo get_search_query(); ?>" name="s" required />
            <button type="submit" class="cs-search-btn">Search</button>
          </form>
        </div>

        <!-- Quick Jump Navigation Cards -->
        <div class="cs-quick-links-grid">
          
          <a href="/" class="cs-quick-link-card">
            <i class="fa-solid fa-house"></i>
            <strong>Homepage</strong>
            <span>Return to Main Site</span>
          </a>

          <a href="/services/front-end-development/" class="cs-quick-link-card">
            <i class="fa-solid fa-layer-group"></i>
            <strong>15 Services</strong>
            <span>Explore Capabilities</span>
          </a>

          <a href="/portfolio/" class="cs-quick-link-card">
            <i class="fa-solid fa-briefcase"></i>
            <strong>Portfolio</strong>
            <span>View Featured Builds</span>
          </a>

          <a href="/about-me/" class="cs-quick-link-card">
            <i class="fa-solid fa-user-check"></i>
            <strong>About Chad Sia</strong>
            <span>17+ Years Experience</span>
          </a>

        </div>

      </div>
    </div>
  </header>

  <!-- CTA Conversion Section -->
  <section class="cs-core-cta-sec" style="padding: 0 0 80px 0;">
    <div class="cs-core-container">
      <div class="cs-cta-box">
        <div class="cs-cta-badge">Direct Senior Engineering</div>
        <h2>Need a Custom WordPress Solution Instead?</h2>
        <p>
          Skip the guesswork. Work directly with a senior engineer with 17+ years of architectural experience to build, optimize, or scale your web platform.
        </p>
        <div class="cs-cta-actions">
          <a href="/contact/" class="cs-btn cs-btn-primary">
            Start Your Project <i class="fa-solid fa-arrow-right"></i>
          </a>
          <a href="/services/front-end-development/" class="cs-btn cs-btn-secondary">
            Explore 15 Services
          </a>
        </div>
      </div>
    </div>
  </section>

</div>

<?php
get_footer();

