<?php
/**
 * The template for displaying archive pages
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

<!-- Structured Data (Schema.org / CollectionPage) -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "CollectionPage",
  "name": "<?php echo esc_attr(wp_strip_all_tags(get_the_archive_title())); ?>",
  "url": "<?php echo esc_url(get_pagenum_link()); ?>",
  "publisher": {
    "@type": "ProfessionalService",
    "name": "Chad Sia Media",
    "url": "https://chadsia.com"
  }
}
</script>

<div class="cs-core-wrapper">
  
  <!-- Archive Hero Header -->
  <header class="cs-archive-hero">
    <div class="cs-header-blob"></div>
    <div class="cs-core-container">
      <div class="cs-post-header-inner">
        
        <div class="cs-post-eyebrow">
          <i class="fa-solid fa-newspaper"></i>
          <span>Engineering Insights &amp; Articles</span>
        </div>

        <h1 class="cs-post-title">
          <?php the_archive_title(); ?>
        </h1>

        <?php if (get_the_archive_description()): ?>
          <div style="font-size: 17px; color: var(--cs-core-text); max-width: 650px; margin: 0 auto; line-height: 1.6;">
            <?php the_archive_description(); ?>
          </div>
        <?php else: ?>
          <p style="font-size: 17px; color: var(--cs-core-text); max-width: 650px; margin: 0 auto; line-height: 1.6;">
            Deep technical deep-dives on sub-second front-end engineering, custom WordPress architectures, performance tuning, and AI web development.
          </p>
        <?php endif; ?>

      </div>
    </div>
  </header>

  <!-- Articles Grid Section -->
  <main class="cs-core-container">
    <?php if (have_posts()) : ?>
      
      <div class="cs-archive-grid">
        <?php while (have_posts()) : the_post(); 
            $cats = get_the_category();
            $cat_name = !empty($cats) ? $cats[0]->name : 'Engineering';
            $img_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
            if (!$img_url) {
                $img_url = 'https://chadsia.com/wp-content/uploads/2026/08/Defensible-Legal-1024x565.png';
            }
            $pub_date = get_the_date('M j, Y');
        ?>
          <article class="cs-article-card" id="post-<?php the_ID(); ?>">
            <div class="cs-article-media">
              <img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" loading="lazy" />
              <span class="cs-article-badge"><?php echo esc_html($cat_name); ?></span>
            </div>
            
            <div class="cs-article-body">
              <div class="cs-article-meta-row">
                <span><i class="fa-regular fa-calendar"></i> <?php echo esc_html($pub_date); ?></span>
                <span>•</span>
                <span>By Chad Sia</span>
              </div>
              
              <h2 class="cs-article-title">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
              </h2>
              
              <p class="cs-article-excerpt">
                <?php echo esc_html(wp_trim_words(get_the_excerpt(), 20)); ?>
              </p>
              
              <a href="<?php the_permalink(); ?>" class="cs-article-link">
                <span>Read Full Article</span>
                <i class="fa-solid fa-arrow-right"></i>
              </a>
            </div>
          </article>
        <?php endwhile; ?>
      </div>

      <div class="cs-pagination">
        <?php
        echo paginate_links([
            'prev_text' => '<i class="fa-solid fa-chevron-left"></i>',
            'next_text' => '<i class="fa-solid fa-chevron-right"></i>',
            'type'      => 'plain',
        ]);
        ?>
      </div>

      <!-- Discovery Consultation Banner -->
      <section class="cs-cta-box" style="margin-top: 70px; margin-bottom: 20px;">
        <div class="cs-eyebrow" style="color: #818cf8 !important; margin-bottom: 12px;">
          Senior Front-End Architecture
        </div>
        <h2>Looking for Technical Leadership on Your Next Build?</h2>
        <p>
          Collaborate directly with 17+ year engineer Chad Sia for custom WordPress themes, API integrations, and sub-second speed optimization.
        </p>
        <div style="display: flex; gap: 14px; justify-content: center; flex-wrap: wrap;">
          <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="cs-btn">
            Start Project Discovery <i class="fa-solid fa-arrow-right"></i>
          </a>
          <a href="<?php echo esc_url(home_url('/portfolio/')); ?>" class="cs-btn" style="background: rgba(255,255,255,0.08) !important; color: #ffffff !important; border-color: rgba(255,255,255,0.2) !important;">
            View Work Portfolio
          </a>
        </div>
      </section>

    <?php else : ?>
      <div style="text-align: center; padding: 60px 0;">
        <h2 style="font-size: 24px; color: #111827; margin-bottom: 12px;">No Articles Found</h2>
        <p style="color: var(--cs-core-text);">There are no published articles matching this criteria.</p>
        <a href="/" class="cs-btn" style="margin-top: 20px;">Return to Homepage</a>
      </div>
    <?php endif; ?>
  </main>

</div>

<?php
get_footer();
