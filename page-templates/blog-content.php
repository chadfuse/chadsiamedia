<?php
/**
 * Chad Sia Media - Blog Hub Content Template
 * Semantic HTML5 Markup for High-Converting Engineering Publication
 */

if (!defined('ABSPATH')) {
    exit;
}

$css_url = get_stylesheet_directory_uri() . '/assets/css/blog-page.css';
$css_ver = file_exists(get_stylesheet_directory() . '/assets/css/blog-page.css') ? filemtime(get_stylesheet_directory() . '/assets/css/blog-page.css') : '1.0.0';
$avatar_url = 'https://chadsia.com/wp-content/uploads/2026/03/Chad-Sia.png';

// Categories for filter pills
$categories = get_categories([
    'orderby' => 'count',
    'order'   => 'DESC',
    'number'  => 6,
    'hide_empty' => true
]);

// Pagination setup
$paged = (get_query_var('paged')) ? get_query_var('paged') : ((get_query_var('page')) ? get_query_var('page') : 1);

// Featured post query (only on first page)
$featured_post_id = 0;
if ($paged == 1) {
    $featured_query = new WP_Query([
        'posts_per_page' => 1,
        'post_status'    => 'publish',
        'ignore_sticky_posts' => 1
    ]);
    if ($featured_query->have_posts()) {
        $featured_query->the_post();
        $featured_post_id = get_the_ID();
        $feat_cats = get_the_category();
        $feat_cat_name = !empty($feat_cats) ? esc_html($feat_cats[0]->name) : 'Engineering';
        $feat_cat_link = !empty($feat_cats) ? esc_url(get_category_link($feat_cats[0]->term_id)) : '#';
        $feat_words = str_word_count(strip_tags(get_the_content()));
        $feat_read_time = max(1, ceil($feat_words / 220));
        $feat_thumb = has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'large') : 'https://chadsia.com/wp-content/uploads/2024/10/Wordpress-Development.jpg';
        $feat_title = get_the_title();
        $feat_permalink = get_permalink();
        $feat_date = get_the_date('M j, Y');
        $feat_excerpt = get_the_excerpt();
        wp_reset_postdata();
    }
}

// Main posts query
$args = [
    'post_type'      => 'post',
    'post_status'    => 'publish',
    'paged'          => $paged,
    'posts_per_page' => 9,
];
if ($featured_post_id > 0 && $paged == 1) {
    $args['post__not_in'] = [$featured_post_id];
}
$main_query = new WP_Query($args);
?>

<!-- Font Awesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="<?php echo esc_url($css_url); ?>?v=<?php echo esc_attr($css_ver); ?>" media="all" />

<!-- Structured Data (Schema.org / Blog) -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Blog",
  "name": "Chad Sia Media Engineering Blog",
  "description": "Practical technical guides, performance architecture benchmarks, and custom WordPress engineering insights by Chad Sia.",
  "url": "https://chadsia.com/blog/",
  "publisher": {
    "@type": "Person",
    "name": "Chad Sia",
    "url": "https://chadsia.com/about-me/",
    "jobTitle": "Senior Front-End Architect & WordPress Engineer"
  }
}
</script>

<div class="cs-blog-wrapper">
  
  <div class="cs-blog-blob-top"></div>

  <div class="cs-blog-container">

    <!-- Hero Header -->
    <header class="cs-blog-hero">
      <div class="cs-blog-badge">
        Technical Publication & Case Studies
      </div>
      <h1 class="cs-blog-title">
        Front-End Systems, Sub-Second Speed &amp; <span class="gradient-text">WordPress Engineering</span>
      </h1>
      <p class="cs-blog-subtitle">
        Architectural breakdowns, Core Web Vitals optimization techniques, and modern WordPress engineering strategies delivered from 17+ years of building enterprise web platforms.
      </p>

      <!-- Controls & Search -->
      <div class="cs-blog-controls">
        <div class="cs-blog-cats">
          <a href="<?php echo esc_url(home_url('/blog/')); ?>" class="cs-cat-pill active">
            <i class="fa-solid fa-border-all"></i> All Articles
          </a>
          <?php if (!empty($categories)) : foreach ($categories as $cat) : ?>
            <a href="<?php echo esc_url(get_category_link($cat->term_id)); ?>" class="cs-cat-pill">
              <?php echo esc_html($cat->name); ?> <span style="font-size: 0.75rem; opacity: 0.7;">(<?php echo (int) $cat->count; ?>)</span>
            </a>
          <?php endforeach; endif; ?>
        </div>

        <form role="search" method="get" class="cs-blog-search-form" action="<?php echo esc_url(home_url('/')); ?>">
          <input type="search" class="cs-blog-search-input" placeholder="Search architecture, speed..." value="<?php echo get_search_query(); ?>" name="s" required />
          <button type="submit" class="cs-blog-search-btn" aria-label="Search">
            <i class="fa-solid fa-magnifying-glass"></i>
          </button>
        </form>
      </div>
    </header>

    <?php if ($paged == 1 && $featured_post_id > 0) : ?>
      <!-- Spotlight / Featured Article Banner -->
      <section class="cs-spotlight-section">
        <article class="cs-spotlight-card">
          <div class="cs-spotlight-img-wrap">
            <span class="cs-spotlight-badge"><i class="fa-solid fa-star"></i> Featured Article</span>
            <a href="<?php echo esc_url($feat_permalink); ?>" tabindex="-1" aria-hidden="true">
              <img src="<?php echo esc_url($feat_thumb); ?>" alt="<?php echo esc_attr($feat_title); ?>" class="cs-spotlight-img" loading="eager" />
            </a>
          </div>
          <div class="cs-spotlight-content">
            <div class="cs-spotlight-meta">
              <span><i class="fa-regular fa-folder"></i> <a href="<?php echo esc_url($feat_cat_link); ?>" class="cs-spotlight-cat"><?php echo esc_html($feat_cat_name); ?></a></span>
              <span><i class="fa-regular fa-clock"></i> <?php echo (int)$feat_read_time; ?> min read</span>
              <span><i class="fa-regular fa-calendar"></i> <?php echo esc_html($feat_date); ?></span>
            </div>
            <h2 class="cs-spotlight-title">
              <a href="<?php echo esc_url($feat_permalink); ?>"><?php echo esc_html($feat_title); ?></a>
            </h2>
            <p class="cs-spotlight-excerpt">
              <?php echo esc_html(wp_strip_all_tags($feat_excerpt)); ?>
            </p>
            <div class="cs-spotlight-footer">
              <div class="cs-author-chip">
                <img src="<?php echo esc_url($avatar_url); ?>" alt="Chad Sia" class="cs-author-chip-avatar" />
                <span class="cs-author-chip-name">Chad Sia</span>
              </div>
              <a href="<?php echo esc_url($feat_permalink); ?>" class="cs-spotlight-btn">
                Read Article <i class="fa-solid fa-arrow-right"></i>
              </a>
            </div>
          </div>
        </article>
      </section>
    <?php endif; ?>

    <!-- Latest Articles Grid -->
    <section class="cs-articles-section">
      <div class="cs-posts-grid">
        <?php
        if ($main_query->have_posts()) :
            while ($main_query->have_posts()) : $main_query->the_post();
                $post_cats = get_the_category();
                $cat_name = !empty($post_cats) ? esc_html($post_cats[0]->name) : 'Article';
                $cat_link = !empty($post_cats) ? esc_url(get_category_link($post_cats[0]->term_id)) : '#';
                $words = str_word_count(strip_tags(get_the_content()));
                $read_time = max(1, ceil($words / 220));
                $thumb = has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'medium_large') : 'https://chadsia.com/wp-content/uploads/2024/10/Wordpress-Development.jpg';
        ?>
          <article class="cs-post-card">
            <div class="cs-post-card-thumb">
              <a href="<?php echo esc_url($cat_link); ?>" class="cs-post-card-cat"><?php echo esc_html($cat_name); ?></a>
              <a href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>">
                <img src="<?php echo esc_url($thumb); ?>" alt="<?php the_title_attribute(); ?>" class="cs-post-card-img" loading="lazy" />
              </a>
            </div>
            <div class="cs-post-card-body">
              <div class="cs-post-card-meta">
                <span><i class="fa-regular fa-clock"></i> <?php echo (int)$read_time; ?> min read</span>
                <span><i class="fa-regular fa-calendar"></i> <?php echo get_the_date('M j, Y'); ?></span>
              </div>
              <h3 class="cs-post-card-title">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
              </h3>
              <p class="cs-post-card-excerpt">
                <?php echo wp_trim_words(get_the_excerpt(), 18, '...'); ?>
              </p>
              <div class="cs-post-card-footer">
                <div class="cs-author-chip">
                  <img src="<?php echo esc_url($avatar_url); ?>" alt="Chad Sia" class="cs-author-chip-avatar" style="width: 28px; height: 28px;" />
                  <span class="cs-author-chip-name" style="font-size: 0.82rem;">Chad Sia</span>
                </div>
                <a href="<?php the_permalink(); ?>" class="cs-read-link">
                  Read <i class="fa-solid fa-arrow-right"></i>
                </a>
              </div>
            </div>
          </article>
        <?php
            endwhile;
            wp_reset_postdata();
        else :
        ?>
          <div style="grid-column: 1 / -1; text-align: center; padding: 60px 20px; background: var(--cs-blog-surface); border-radius: 20px; border: 1px solid var(--cs-blog-border);">
            <i class="fa-solid fa-newspaper" style="font-size: 2.5rem; color: var(--cs-blog-primary); margin-bottom: 16px;"></i>
            <h3 style="color: #111827; font-size: 1.4rem; margin-bottom: 8px;">No Articles Found</h3>
            <p style="color: var(--cs-blog-text-muted);">Please check back soon or try searching for another topic above.</p>
          </div>
        <?php endif; ?>
      </div>

      <!-- Pagination -->
      <?php if ($main_query->max_num_pages > 1) : ?>
        <nav class="cs-blog-pagination" aria-label="Posts Navigation">
          <?php
          echo paginate_links([
              'total'        => $main_query->max_num_pages,
              'current'      => $paged,
              'prev_text'    => '<i class="fa-solid fa-chevron-left"></i>',
              'next_text'    => '<i class="fa-solid fa-chevron-right"></i>',
              'type'         => 'plain',
              'end_size'     => 2,
              'mid_size'     => 2,
          ]);
          ?>
        </nav>
      <?php endif; ?>
    </section>

    <!-- Technical Newsletter Box -->
    <section class="cs-newsletter-box">
      <div>
        <h3 class="cs-newsletter-title">Stay Ahead of Modern Web Architecture</h3>
        <p class="cs-newsletter-sub">
          Join 2,400+ engineers, product leads, and agency founders receiving actionable breakdowns on sub-second rendering, headless systems, and Core Web Vitals mastery.
        </p>
      </div>
      <form class="cs-newsletter-form" onsubmit="event.preventDefault(); alert('Thank you for subscribing! You will receive our next architectural breakdown directly to your inbox.'); this.reset();">
        <input type="email" class="cs-newsletter-input" placeholder="Enter your business email..." required />
        <button type="submit" class="cs-newsletter-btn">
          Subscribe <i class="fa-solid fa-paper-plane"></i>
        </button>
      </form>
    </section>

  </div><!-- .cs-blog-container -->

  <!-- Global Client Logo Carousel -->
  <?php if (function_exists('cs_render_logo_carousel')) { cs_render_logo_carousel(); } ?>

  <!-- Discovery Consultation Banner -->
  <div class="cs-blog-container" style="margin-top: 60px;">
    <section class="cs-cta-box">
      <div class="cs-eyebrow" style="color: #818cf8 !important; margin-bottom: 12px;">
        <i class="fa-solid fa-gauge-high"></i> High-Speed Web Architecture
      </div>
      <h2>Ready to Scale Your Web Performance & Architecture?</h2>
      <p>
        Let’s review your website’s speed bottlenecks, conversion flow, or planned features with a direct technical audit.
      </p>
      <div style="display: flex; gap: 14px; justify-content: center; flex-wrap: wrap;">
        <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="cs-btn">
          Schedule a Technical Discovery <i class="fa-solid fa-arrow-right"></i>
        </a>
        <a href="<?php echo esc_url(home_url('/services/')); ?>" class="cs-btn" style="background: rgba(255,255,255,0.08) !important; color: #ffffff !important; border-color: rgba(255,255,255,0.2) !important;">
          Explore All 15 Services
        </a>
      </div>
    </section>
  </div>

</div><!-- .cs-blog-wrapper -->
