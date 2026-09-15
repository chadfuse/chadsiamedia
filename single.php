<?php
/**
 * The template for displaying all single posts
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

<?php while (have_posts()) : the_post(); 
    $post_id = get_the_ID();
    $categories = get_the_category();
    $primary_cat = !empty($categories) ? $categories[0]->name : 'Engineering';
    $cat_link = !empty($categories) ? get_category_link($categories[0]->term_id) : '#';
    
    // Reading Time Calculation
    $raw_content = get_the_content();
    $word_count = str_word_count(strip_tags($raw_content));
    $read_time = max(1, ceil($word_count / 220)) . ' min read';

    $featured_img_url = get_the_post_thumbnail_url($post_id, 'large');
    if (!$featured_img_url) {
        $featured_img_url = 'https://chadsia.com/wp-content/uploads/2026/08/Defensible-Legal-1024x565.png';
    }

    $author_name = get_the_author_meta('display_name') ?: 'Chad Sia';
    $pub_date = get_the_date('M j, Y');
    $pub_date_iso = get_the_date('c');
    $mod_date_iso = get_the_modified_date('c');
?>

<!-- Structured Data (Schema.org / BlogPosting) -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BlogPosting",
  "headline": "<?php echo esc_attr(get_the_title()); ?>",
  "image": "<?php echo esc_url($featured_img_url); ?>",
  "datePublished": "<?php echo esc_attr($pub_date_iso); ?>",
  "dateModified": "<?php echo esc_attr($mod_date_iso); ?>",
  "author": {
    "@type": "Person",
    "name": "Chad Sia",
    "url": "https://chadsia.com/about-me/",
    "image": "https://chadsia.com/wp-content/uploads/2024/10/Chad-Sia.png"
  },
  "publisher": {
    "@type": "ProfessionalService",
    "name": "Chad Sia Media",
    "url": "https://chadsia.com"
  },
  "description": "<?php echo esc_attr(wp_strip_all_tags(get_the_excerpt())); ?>"
}
</script>

<div class="cs-core-wrapper">
  
  <!-- Article Hero Header -->
  <header class="cs-post-header">
    <div class="cs-header-blob"></div>
    <div class="cs-core-container">
      <div class="cs-post-header-inner">
        
        <div class="cs-post-eyebrow">
          <a href="<?php echo esc_url($cat_link); ?>"><?php echo esc_html($primary_cat); ?></a>
        </div>

        <h1 class="cs-post-title"><?php the_title(); ?></h1>

        <div class="cs-post-meta">
          <div class="cs-meta-item">
            <img src="https://chadsia.com/wp-content/uploads/2024/10/Chad-Sia.png" alt="Chad Sia" class="cs-meta-avatar" />
            <span>By <strong><?php echo esc_html($author_name); ?></strong></span>
          </div>
          <div class="cs-meta-item">
            <i class="fa-regular fa-calendar"></i>
            <span><?php echo esc_html($pub_date); ?></span>
          </div>
          <div class="cs-meta-item">
            <i class="fa-regular fa-clock"></i>
            <span><?php echo esc_html($read_time); ?></span>
          </div>
        </div>

      </div>
    </div>
  </header>

  <!-- Article Main Content -->
  <main class="cs-core-container">
    <article class="cs-prose-container">
      
      <?php if ($featured_img_url): ?>
        <div class="cs-post-featured-media">
          <img src="<?php echo esc_url($featured_img_url); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" loading="eager" />
        </div>
      <?php endif; ?>

      <div class="cs-prose-body">
        <?php the_content(); ?>
      </div>

      <!-- Author Bio Box -->
      <div class="cs-author-box">
        <img src="https://chadsia.com/wp-content/uploads/2026/09/chad-sia.jpg" alt="Chad Sia" class="cs-author-avatar" width="100" height="100" loading="lazy" />
        <div class="cs-author-info">
          <div class="cs-eyebrow" style="margin-bottom: 4px;">Author &amp; Architect</div>
          <h3>Chad Sia</h3>
          <span class="cs-author-role">Senior Front-End Architect &amp; Custom WordPress Engineer (17+ Years Experience)</span>
          <p>
            Chad Sia specializes in building sub-second web platforms, bespoke WordPress architectures, headless CMS migrations, and high-converting acquisition funnels for global founders and brands.
          </p>
        </div>
      </div>

      <!-- Prev / Next Post Navigation -->
      <?php
      $prev_post = get_previous_post();
      $next_post = get_next_post();
      if ($prev_post || $next_post):
      ?>
      <nav class="cs-post-nav" aria-label="Post Navigation">
        <?php if ($prev_post): ?>
          <a href="<?php echo esc_url(get_permalink($prev_post->ID)); ?>" class="cs-nav-card cs-nav-prev">
            <span class="cs-nav-label"><i class="fa-solid fa-arrow-left"></i> Previous Article</span>
            <span class="cs-nav-title"><?php echo esc_html(get_the_title($prev_post->ID)); ?></span>
          </a>
        <?php else: ?>
          <div></div>
        <?php endif; ?>

        <?php if ($next_post): ?>
          <a href="<?php echo esc_url(get_permalink($next_post->ID)); ?>" class="cs-nav-card cs-nav-next" style="text-align: right;">
            <span class="cs-nav-label">Next Article <i class="fa-solid fa-arrow-right"></i></span>
            <span class="cs-nav-title"><?php echo esc_html(get_the_title($next_post->ID)); ?></span>
          </a>
        <?php endif; ?>
      </nav>
      <?php endif; ?>

    </article>

    <!-- Related Articles Section -->
    <?php
    $related_query = new WP_Query([
        'post_type' => 'post',
        'posts_per_page' => 3,
        'post__not_in' => [$post_id],
        'ignore_sticky_posts' => 1
    ]);

    if ($related_query->have_posts()):
    ?>
    <section style="margin-top: 60px; padding-top: 50px; border-top: 1px solid var(--cs-core-border);">
      <div style="text-align: center; margin-bottom: 40px;">
        <div class="cs-post-eyebrow">Further Reading</div>
        <h2 style="font-size: 28px; font-weight: 800; color: #111827; margin: 0;">More Engineering Insights</h2>
      </div>

      <div class="cs-archive-grid">
        <?php while ($related_query->have_posts()) : $related_query->the_post(); 
            $rel_cats = get_the_category();
            $rel_cat = !empty($rel_cats) ? $rel_cats[0]->name : 'Engineering';
            $rel_img = get_the_post_thumbnail_url(get_the_ID(), 'medium_large') ?: 'https://chadsia.com/wp-content/uploads/2026/08/Defensible-Legal-1024x565.png';
        ?>
          <article class="cs-article-card">
            <div class="cs-article-media">
              <img src="<?php echo esc_url($rel_img); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" loading="lazy" />
              <span class="cs-article-badge"><?php echo esc_html($rel_cat); ?></span>
            </div>
            <div class="cs-article-body">
              <div class="cs-article-meta-row">
                <span><i class="fa-regular fa-calendar"></i> <?php echo esc_html(get_the_date('M j, Y')); ?></span>
              </div>
              <h3 class="cs-article-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
              <p class="cs-article-excerpt"><?php echo esc_html(wp_trim_words(get_the_excerpt(), 18)); ?></p>
              <a href="<?php the_permalink(); ?>" class="cs-article-link">
                <span>Read Article</span>
                <i class="fa-solid fa-chevron-right"></i>
              </a>
            </div>
          </article>
        <?php endwhile; wp_reset_postdata(); ?>
      </div>
    </section>
    <?php endif; ?>

    <!-- Discovery Consultation Banner -->
    <section class="cs-cta-box" style="margin-top: 70px; margin-bottom: 20px;">
      <div class="cs-eyebrow" style="color: #818cf8 !important; margin-bottom: 12px;">
        Need Custom WordPress Architecture?
      </div>
      <h2>Let’s Build a Sub-Second Web Experience</h2>
      <p>
        Ready to optimize your Core Web Vitals, build a bespoke custom theme, or scale your platform? Connect directly with Senior Architect Chad Sia.
      </p>
      <div style="display: flex; gap: 14px; justify-content: center; flex-wrap: wrap;">
        <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="cs-btn">
          Start Project Discovery <i class="fa-solid fa-arrow-right"></i>
        </a>
        <a href="<?php echo esc_url(home_url('/portfolio/')); ?>" class="cs-btn" style="background: rgba(255,255,255,0.08) !important; color: #ffffff !important; border-color: rgba(255,255,255,0.2) !important;">
          View Live Portfolio
        </a>
      </div>
    </section>

  </main>

</div>

<?php endwhile; ?>

<?php
get_footer();
