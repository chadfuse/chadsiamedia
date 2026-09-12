<?php
/**
 * The template for displaying all pages
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

<?php while (have_posts()) : the_post(); ?>

<!-- Structured Data (Schema.org / WebPage) -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebPage",
  "name": "<?php echo esc_attr(get_the_title()); ?>",
  "url": "<?php echo esc_url(get_permalink()); ?>",
  "publisher": {
    "@type": "ProfessionalService",
    "name": "Chad Sia Media",
    "url": "https://chadsia.com"
  }
}
</script>

<div class="cs-core-wrapper">
  
  <!-- Page Hero Header -->
  <header class="cs-post-header">
    <div class="cs-header-blob"></div>
    <div class="cs-core-container">
      <div class="cs-post-header-inner">
        <h1 class="cs-post-title"><?php the_title(); ?></h1>
      </div>
    </div>
  </header>

  <!-- Page Body Content -->
  <main class="cs-core-container">
    <article class="cs-prose-container">
      <div class="cs-prose-body">
        <?php the_content(); ?>
      </div>
    </article>
  </main>

  <!-- CTA Conversion Section -->
  <section class="cs-core-cta-sec" style="padding: 40px 0 80px 0;">
    <div class="cs-core-container">
      <div class="cs-cta-box">
        <div class="cs-cta-badge">Direct Senior Engineering</div>
        <h2>Ready to Build a High-Performance Web Platform?</h2>
        <p>
          Skip the bloat and fragmented agency overhead. Partner directly with Chad Sia for custom WordPress architectures, sub-second performance, and pixel-perfect front-end engineering.
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

<?php endwhile; ?>

<?php
get_footer();

