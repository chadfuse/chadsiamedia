<?php
/**
 * Chad Sia Media - Native Homepage Content Component
 * Clean Semantic HTML5 + Sub-Second Design System + Video Hero
 *
 * @package ChadSia
 */

if (!defined('ABSPATH')) {
    exit;
}

// Video URLs (Primary colored video, fallback relative)
$video_url = get_stylesheet_directory_uri() . '/assets/videos/hero-bg-1.mp4';

// Dynamic Experience
$years_exp = max(17, intval(date('Y')) - 2009);
$years_exp_str = $years_exp . '+ Years';

// Recent Posts for Insights Section
$recent_posts = get_posts([
    'numberposts' => 3,
    'post_status' => 'publish',
    'orderby'     => 'date',
    'order'       => 'DESC'
]);
?>

<!-- Structured Data (Schema.org / ProfessionalService + AggregateRating for AEO & Rich Snippets) -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "ProfessionalService",
  "name": "Chad Sia Media",
  "description": "Bespoke custom WordPress development, senior front-end architecture, and sub-second Core Web Vitals optimization by senior engineer Chad Sia.",
  "url": "https://chadsia.com",
  "logo": "https://chadsia.com/wp-content/uploads/2024/10/logo-cds.webp",
  "image": "https://chadsia.com/wp-content/uploads/2024/10/Chad-Sia.png",
  "telephone": "+639947156382",
  "priceRange": "$$$",
  "founder": {
    "@type": "Person",
    "name": "Chad Sia",
    "jobTitle": "Senior Front-End Architect & Custom WordPress Engineer",
    "url": "https://chadsia.com/about-me/",
    "sameAs": [
      "https://www.linkedin.com/in/chadsiamedia/",
      "https://github.com/chadfuse",
      "https://www.facebook.com/chadsiamedia",
      "https://www.instagram.com/chadsiamedia/"
    ]
  },
  "aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue": "5.0",
    "bestRating": "5",
    "worstRating": "1",
    "ratingCount": "6",
    "reviewCount": "6"
  },
  "hasOfferCatalog": {
    "@type": "OfferCatalog",
    "name": "Core Engineering Disciplines",
    "itemListElement": [
      {
        "@type": "Offer",
        "itemOffered": {
          "@type": "Service",
          "name": "Custom WordPress Theme & Architecture",
          "description": "Zero-bloat, lightweight modular WordPress theme engineering and custom Gutenberg blocks."
        }
      },
      {
        "@type": "Offer",
        "itemOffered": {
          "@type": "Service",
          "name": "Core Web Vitals & Sub-Second Speed Optimization",
          "description": "Full-stack critical rendering path optimization, database indexing, and server-side caching."
        }
      },
      {
        "@type": "Offer",
        "itemOffered": {
          "@type": "Service",
          "name": "Front-End Systems & Figma-to-Code Engineering",
          "description": "Pixel-perfect fluid design tokens, responsive layouts, and interactive micro-animations."
        }
      },
      {
        "@type": "Offer",
        "itemOffered": {
          "@type": "Service",
          "name": "Headless WordPress & API Architecture",
          "description": "Decoupled Next.js / REST API integrations and high-velocity acquisition funnels."
        }
      }
    ]
  },
  "sameAs": [
    "https://www.linkedin.com/in/chadsiamedia/",
    "https://github.com/chadfuse",
    "https://www.facebook.com/chadsiamedia",
    "https://www.instagram.com/chadsiamedia/"
  ],
  "address": {
    "@type": "PostalAddress",
    "addressCountry": "PH"
  }
}
</script>

<div class="cs-home-wrapper">

  <!-- =========================================================================
       1. HERO SECTION (Full-Height Cinematic Video Hero + High-Contrast Narrative)
       ========================================================================= -->
  <header class="cs-home-hero">
    
    <!-- Background Hero Media Layer -->
    <div class="cs-home-video-wrap no-lazy" data-no-lazy="1">
      <picture class="cs-hero-bg-picture">
        <source media="(max-width: 768px)" srcset="<?php echo esc_url(get_stylesheet_directory_uri() . '/assets/images/chadsiabg-mobile.webp'); ?>" type="image/webp">
        <img src="<?php echo esc_url(get_stylesheet_directory_uri() . '/assets/images/chadsiabg.webp'); ?>" 
             alt="" 
             fetchpriority="high" 
             decoding="async" 
             class="cs-hero-bg-img no-lazy" 
             data-no-lazy="1" 
             width="1600" 
             height="871">
      </picture>
      <video class="cs-home-video-bg no-lazy" autoplay muted loop playsinline preload="none" data-no-lazy="1" data-src="<?php echo esc_url($video_url); ?>">
      </video>
      <div class="cs-home-video-overlay"></div>
    </div>

    <div class="cs-home-container">
      <div class="cs-home-hero-content">
        
        <div class="cs-eyebrow cs-hero-eyebrow">
          Senior Front-End Architect · <?php echo esc_html($years_exp_str); ?> Craft
        </div>

        <h1 class="cs-home-hero-title">
          Engineering Sub-Second <span class="cs-mask-wipe-wrap"><span class="cs-mask-wipe-text">Web Platforms</span><span class="cs-mask-wipe-badge" aria-hidden="true">Web Platforms</span></span> That Drive <span class="cs-rect-mask">Real Revenue.</span>
        </h1>

        <p class="cs-home-hero-subtitle">
          Bespoke WordPress architectures &amp; sub-second speed. Direct engineer access.
        </p>

        <div class="cs-home-hero-actions">
          <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="cs-btn cs-btn-primary">
            <span>Start Project Discovery</span>
            <i class="fa-solid fa-arrow-right"></i>
          </a>
          <a href="<?php echo esc_url(home_url('/portfolio/')); ?>" class="cs-btn cs-btn-secondary">
            <span>Explore Featured Builds</span>
            <i class="fa-solid fa-arrow-up-right-from-square"></i>
          </a>
        </div>

      </div>
    </div>
  </header>

  <!-- =========================================================================
       2. GLOBAL CLIENT LOGO CAROUSEL
       ========================================================================= -->
  <?php 
  if (function_exists('cs_render_logo_carousel')) {
      cs_render_logo_carousel([
          'theme'       => 'dark',
          'show_header' => true,
          'kicker'      => 'Proven Track Record',
          'title'       => 'Trusted by Founders, Fast-Growing Enterprises & Ambitious Agencies',
          'speed'       => '38s'
      ]);
  }
  ?>

  <!-- =========================================================================
       3. CORE ENGINEERING DISCIPLINES (4 Pillars & 15 Services)
       ========================================================================= -->
  <section class="cs-home-services">
    <div class="cs-home-container">
      <div class="cs-sec-heading-group">
        <div class="cs-eyebrow">
          Full-Cycle Capabilities
        </div>
        <h2 class="cs-sec-title">Engineered for Raw Speed, Precision & Growth</h2>
        <p class="cs-sec-sub">
          Whether building from scratch, modernizing legacy architectures, or tuning Core Web Vitals, every line of code is tailored for maximum performance.
        </p>
      </div>

      <div class="cs-home-services-grid">
        
        <!-- Service 1: Custom WordPress Development -->
        <div class="cs-home-service-card">
          <div class="cs-service-icon-box">
            <i class="fa-brands fa-wordpress-simple"></i>
          </div>
          <h3>Custom WordPress Development</h3>
          <p>
            Bespoke PHP 8.x theme frameworks, tailored ACF Pro field architectures, and Gutenberg block systems built with zero bulky page builders.
          </p>
          <ul class="cs-service-bullets">
            <li><i class="fa-solid fa-check"></i> Bespoke theme engineering &amp; clean PHP</li>
            <li><i class="fa-solid fa-check"></i> Zero Elementor/builder bloat</li>
            <li><i class="fa-solid fa-check"></i> Tailored ACF Pro admin workflows</li>
          </ul>
          <a href="<?php echo esc_url(home_url('/services/custom-wordpress-development/')); ?>" class="cs-service-link">
            Explore WordPress Architecture <i class="fa-solid fa-arrow-right"></i>
          </a>
        </div>

        <!-- Service 2: Front-End & UI/UX Engineering -->
        <div class="cs-home-service-card">
          <div class="cs-service-icon-box">
            <i class="fa-solid fa-code"></i>
          </div>
          <h3>Front-End &amp; UI Engineering</h3>
          <p>
            Microscopic Figma-to-code translation, semantic HTML5 tokens, and fluid responsive layouts engineered for accessibility and sub-second rendering.
          </p>
          <ul class="cs-service-bullets">
            <li><i class="fa-solid fa-check"></i> 100% Figma-to-code fidelity</li>
            <li><i class="fa-solid fa-check"></i> Fluid CSS token design systems</li>
            <li><i class="fa-solid fa-check"></i> Accessible WCAG 2.1 AA compliance</li>
          </ul>
          <a href="<?php echo esc_url(home_url('/services/front-end-development/')); ?>" class="cs-service-link">
            Explore Front-End Systems <i class="fa-solid fa-arrow-right"></i>
          </a>
        </div>

        <!-- Service 3: Website Speed Optimization -->
        <div class="cs-home-service-card">
          <div class="cs-service-icon-box">
            <i class="fa-solid fa-bolt"></i>
          </div>
          <h3>Website Speed Optimization</h3>
          <p>
            Rigorous Core Web Vitals remediation, LCP/CLS optimization, asset deferral pipelines, and database tuning to achieve sub-second global load times.
          </p>
          <ul class="cs-service-bullets">
            <li><i class="fa-solid fa-check"></i> 90+ Mobile Google PageSpeed score</li>
            <li><i class="fa-solid fa-check"></i> Sub-500ms global server response</li>
            <li><i class="fa-solid fa-check"></i> Critical CSS &amp; asset minification</li>
          </ul>
          <a href="<?php echo esc_url(home_url('/services/website-speed-optimization/')); ?>" class="cs-service-link">
            Explore Speed Tuning <i class="fa-solid fa-arrow-right"></i>
          </a>
        </div>

        <!-- Service 4: Web Applications & APIs -->
        <div class="cs-home-service-card">
          <div class="cs-service-icon-box">
            <i class="fa-solid fa-layer-group"></i>
          </div>
          <h3>Web Applications &amp; APIs</h3>
          <p>
            Custom application dashboards, headless CMS architectures, REST API orchestrations, and high-converting acquisition funnels.
          </p>
          <ul class="cs-service-bullets">
            <li><i class="fa-solid fa-check"></i> Headless WordPress &amp; REST APIs</li>
            <li><i class="fa-solid fa-check"></i> WooCommerce custom checkout flows</li>
            <li><i class="fa-solid fa-check"></i> Modern TypeScript &amp; React integration</li>
          </ul>
          <a href="<?php echo esc_url(home_url('/services/ai-web-development/')); ?>" class="cs-service-link">
            Explore Web Applications <i class="fa-solid fa-arrow-right"></i>
          </a>
        </div>

      </div>

      <div class="cs-services-hub-cta">
        <a href="<?php echo esc_url(home_url('/services/')); ?>" class="cs-btn cs-btn-secondary">
          <span>View All 15 Specialized Services</span>
          <i class="fa-solid fa-arrow-right"></i>
        </a>
      </div>
    </div>
  </section>

  <!-- =========================================================================
       4. FEATURED WORK & LIVE CASE STUDIES
       ========================================================================= -->
  <?php 
  if (function_exists('cs_render_portfolio_showcase')) {
      cs_render_portfolio_showcase([
          'kicker'        => 'Proven Results',
          'title'         => 'Featured Platforms & Live Builds',
          'subtitle'      => 'A curated selection of enterprise WordPress platforms, custom web applications, and high-velocity conversion builds.',
          'show_footer'   => true,
          'view_all_url'  => '/portfolio/',
          'view_all_text' => 'View Complete Work Portfolio'
      ]);
  }
  ?>

  <!-- =========================================================================
       5. WHY WORK DIRECTLY WITH CHAD SIA (The Senior Advantage)
       ========================================================================= -->
  <section class="cs-home-why">
    <div class="cs-home-container">
      <div class="cs-sec-heading-group">
        <div class="cs-eyebrow">
          The Senior Advantage
        </div>
        <h2 class="cs-sec-title">Why Global Brands Work Directly With Me</h2>
        <p class="cs-sec-sub">
          Eliminate the agency markup, junior subcontractors, and broken promises. Get senior engineering excellence from day one.
        </p>
      </div>

      <div class="cs-why-cards-grid">
        
        <div class="cs-why-feature-card">
          <div class="cs-why-icon"><i class="fa-solid fa-user-check"></i></div>
          <h3>1-on-1 Direct Engineering</h3>
          <p>
            You collaborate directly with a senior engineer with <?php echo esc_html($years_exp_str); ?> of real craft. No account managers playing telephone, no outsourced junior code.
          </p>
        </div>

        <div class="cs-why-feature-card">
          <div class="cs-why-icon"><i class="fa-solid fa-bolt-lightning"></i></div>
          <h3>Sub-Second Speed by Default</h3>
          <p>
            Performance is engineered into every architectural decision. Assets are minified, SQL queries indexed, and caching fine-tuned for instant page rendering.
          </p>
        </div>

        <div class="cs-why-feature-card">
          <div class="cs-why-icon"><i class="fa-solid fa-bezier-curve"></i></div>
          <h3>Figma-to-Code Fidelity</h3>
          <p>
            Pixel-perfect implementation of your design tokens, fluid typography scales, micro-interactions, and responsive layouts across every breakpoint.
          </p>
        </div>

        <div class="cs-why-feature-card">
          <div class="cs-why-icon"><i class="fa-solid fa-shield-halved"></i></div>
          <h3>Zero Builder Bloat</h3>
          <p>
            Clean, modular PHP and lightweight CSS without the heavy baggage of drag-and-drop builders. Clean codebases that are easy to maintain and scale.
          </p>
        </div>

      </div>
    </div>
  </section>

  <!-- =========================================================================
       6. GOOGLE REVIEWS WIDGET (Rated 5.0 on Google Reviews)
       ========================================================================= -->
  <?php 
  if (function_exists('cs_render_google_reviews')) {
      cs_render_google_reviews([
          'kicker' => 'Verified Client Reviews',
          'title'  => 'Rated 5.0 on Google Reviews'
      ]);
  } elseif (function_exists('cs_render_reviews_slider')) {
      cs_render_reviews_slider();
  }
  ?>

  <!-- =========================================================================
       7. GLOBAL STRATEGIC MARKETS & HUBS
       ========================================================================= -->
  <section class="cs-home-locations">
    <div class="cs-home-container">
      <div class="cs-locations-banner">
        <div class="cs-locations-text">
          <div class="cs-eyebrow cs-eyebrow-dark">
            Global Presence
          </div>
          <h2>Collaborating Across Global Timezones</h2>
          <p>
            Delivering high-performance WordPress platforms and front-end engineering for agencies and founders in the US, UK, Australia, Singapore, and worldwide with full business-hour overlap.
          </p>
          <div class="cs-locations-links">
            <a href="<?php echo esc_url(home_url('/locations/united-states/')); ?>" class="cs-loc-tag">United States</a>
            <a href="<?php echo esc_url(home_url('/locations/united-kingdom/')); ?>" class="cs-loc-tag">United Kingdom</a>
            <a href="<?php echo esc_url(home_url('/locations/australia/')); ?>" class="cs-loc-tag">Australia</a>
            <a href="<?php echo esc_url(home_url('/locations/philippines/')); ?>" class="cs-loc-tag">Philippines</a>
            <a href="<?php echo esc_url(home_url('/locations/')); ?>" class="cs-loc-tag" style="background: rgba(73, 104, 248, 0.25); color: #ffffff; border-color: #4968f8;">View All Locations &rarr;</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- =========================================================================
       7. LATEST TECHNICAL INSIGHTS (Blog Feed)
       ========================================================================= -->
  <?php if (!empty($recent_posts)): ?>
  <section class="cs-home-blog">
    <div class="cs-home-container">
      <div class="cs-sec-heading-group">
        <div class="cs-eyebrow">
          Technical Publication
        </div>
        <h2 class="cs-sec-title">Latest Insights &amp; Architectural Breakdowns</h2>
        <p class="cs-sec-sub">
          Practical guides on Core Web Vitals, custom WordPress engineering, and modern front-end performance.
        </p>
      </div>

      <div class="cs-home-blog-grid">
        <?php foreach ($recent_posts as $p): 
            $p_cats = get_the_category($p->ID);
            $p_cat = !empty($p_cats) ? $p_cats[0]->name : 'Engineering';
            $p_thumb = get_the_post_thumbnail_url($p->ID, 'medium_large') ?: 'https://chadsia.com/wp-content/uploads/2026/08/Defensible-Legal-1024x565.png';
            $p_date = get_the_date('M j, Y', $p->ID);
        ?>
          <article class="cs-home-blog-card">
            <div class="cs-home-blog-media">
              <a href="<?php echo esc_url(get_permalink($p->ID)); ?>">
                <img src="<?php echo esc_url($p_thumb); ?>" alt="<?php echo esc_attr($p->post_title); ?>" loading="lazy" />
              </a>
              <span class="cs-home-blog-cat"><?php echo esc_html($p_cat); ?></span>
            </div>
            <div class="cs-home-blog-body">
              <span class="cs-home-blog-date"><?php echo esc_html($p_date); ?></span>
              <h3><a href="<?php echo esc_url(get_permalink($p->ID)); ?>"><?php echo esc_html($p->post_title); ?></a></h3>
              <p><?php echo esc_html(wp_trim_words($p->post_content, 16)); ?></p>
              <a href="<?php echo esc_url(get_permalink($p->ID)); ?>" class="cs-home-blog-link">
                Read Breakdown <i class="fa-solid fa-arrow-right"></i>
              </a>
            </div>
          </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <!-- =========================================================================
       8. CLOSING CONVERSION CTA BOX (Dark Background #0b0f17)
       ========================================================================= -->
  <section class="cs-home-cta-section">
    <div class="cs-home-container">
      <div class="cs-cta-box">
        <div class="cs-eyebrow cs-eyebrow-dark">Direct Senior Engineering Access</div>
        <h2>Ready to Build a High-Performance Web Platform?</h2>
        <p>
          Skip the agency overhead and contractor lag. Partner directly with senior architect Chad Sia for custom WordPress themes, sub-second speed optimization, and pixel-perfect front-end engineering.
        </p>
        <div class="cs-cta-actions">
          <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="cs-btn cs-btn-primary">
            <span>Start Your Project Discovery</span>
            <i class="fa-solid fa-arrow-right"></i>
          </a>
          <a href="https://calendly.com/hello-chadsia/30min" target="_blank" rel="noopener noreferrer" class="cs-btn cs-btn-secondary">
            <span>Schedule 30-Min Intro Call</span>
            <i class="fa-regular fa-calendar"></i>
          </a>
        </div>
      </div>
    </div>
  </section>

</div>

<script>
/**
 * Chad Sia Media - Performance & Hero Mask Reveal Orchestration
 */
(function() {
  function initHeroMedia() {
    // 1. Deferred Background Video Loader (Only load on desktop screens > 768px to keep mobile sub-second)
    var videoBg = document.querySelector('.cs-home-video-bg');
    if (videoBg && videoBg.dataset.src && !videoBg.querySelector('source') && window.innerWidth > 768) {
      var source = document.createElement('source');
      source.src = videoBg.dataset.src;
      source.type = 'video/mp4';
      videoBg.appendChild(source);
      videoBg.load();
      var playPromise = videoBg.play();
      if (playPromise !== undefined) {
        playPromise.catch(function() {});
      }
    }

    // 2. Trigger Mask Reveal & Unreveal Sequence
    var badges = document.querySelectorAll('.cs-mask-wipe-badge');
    badges.forEach(function(badge) {
      badge.classList.add('is-revealing');
    });
    document.body.classList.add('cs-page-loaded');
  }

  if (document.readyState === 'complete') {
    setTimeout(initHeroMedia, 300);
  } else {
    window.addEventListener('load', function() {
      setTimeout(initHeroMedia, 300);
    });
  }
})();
</script>
