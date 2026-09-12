<?php
/**
 * Chad Sia Media - Services Directory Hub Content Template
 * Semantic HTML5 Markup for All 15 Specialized Web Engineering Services
 */

if (!defined('ABSPATH')) {
    exit;
}

$css_url = get_stylesheet_directory_uri() . '/assets/css/services-hub-page.css';
$css_ver = file_exists(get_stylesheet_directory() . '/assets/css/services-hub-page.css') ? filemtime(get_stylesheet_directory() . '/assets/css/services-hub-page.css') : '1.0.0';

$services = [
    [
        'slug'     => 'front-end-development',
        'title'    => 'Front-End Development',
        'category' => 'frontend',
        'cat_name' => 'Front-End & UI',
        'icon'     => 'fa-solid fa-code',
        'desc'     => 'Component-driven front-end engineering with modern CSS architectures, reactive state machines, and micro-animations engineered for sub-second speeds.',
        'bullets'  => ['Pixel-perfect Figma-to-HTML/CSS translation', 'Sub-500ms Core Web Vitals optimization', 'Zero builder or framework bloat'],
    ],
    [
        'slug'     => 'custom-wordpress-development',
        'title'    => 'Custom WordPress Development',
        'category' => 'wordpress',
        'cat_name' => 'WordPress & CMS',
        'icon'     => 'fa-brands fa-wordpress-simple',
        'desc'     => 'Enterprise-grade custom WordPress theme architectures, tailored ACF Pro field systems, and headless integrations built without cumbersome page builders.',
        'bullets'  => ['Bespoke PHP/Gutenberg theme engineering', 'Automated Redis caching & database indexing', 'Strict enterprise security hardening'],
    ],
    [
        'slug'     => 'ui-ux-design',
        'title'    => 'UI/UX Design Services',
        'category' => 'frontend',
        'cat_name' => 'Front-End & UI',
        'icon'     => 'fa-solid fa-pen-ruler',
        'desc'     => 'High-converting user interface design and interactive UX flows crafted in Figma, optimized for seamless developer handover and conversion performance.',
        'bullets'  => ['Comprehensive design systems & token sets', 'High-fidelity interactive prototypes', 'Conversion-focused customer journey maps'],
    ],
    [
        'slug'     => 'website-speed-optimization',
        'title'    => 'Website Speed Optimization',
        'category' => 'speed',
        'cat_name' => 'Performance & Speed',
        'icon'     => 'fa-solid fa-bolt',
        'desc'     => 'Comprehensive Core Web Vitals remediation, LCP/CLS optimization, asset minification, and database tuning to achieve sub-second global load times.',
        'bullets'  => ['90+ Google PageSpeed guaranteed scores', 'Critical CSS & script execution deferral', 'Global CDN & edge caching architectures'],
    ],
    [
        'slug'     => 'ai-web-development',
        'title'    => 'Custom Web Application Development',
        'category' => 'apps',
        'cat_name' => 'Web Apps & APIs',
        'icon'     => 'fa-solid fa-layer-group',
        'desc'     => 'Custom web applications, LLM and OpenAI API orchestrations, automated data pipelines, and interactive client portals.',
        'bullets'  => ['Custom API integrations & database models', 'Automated business & data workflows', 'Robust, scalable application architectures'],
    ],
    [
        'slug'     => 'website-redesign',
        'title'    => 'Website Redesign',
        'category' => 'frontend',
        'cat_name' => 'Front-End & UI',
        'icon'     => 'fa-solid fa-wand-magic-sparkles',
        'desc'     => 'Modernizing legacy, slow, or outdated web platforms into sleek, high-converting digital assets engineered for modern search engines and users.',
        'bullets'  => ['Modern dark-mode & high-converting aesthetic', '100% SEO permalink & ranking retention', 'Mobile-first fluid responsive layouts'],
    ],
    [
        'slug'     => 'landing-page-development',
        'title'    => 'Landing Page Development',
        'category' => 'speed',
        'cat_name' => 'Performance & Speed',
        'icon'     => 'fa-solid fa-file-code',
        'desc'     => 'High-converting, hyper-fast landing pages engineered specifically for paid media campaigns, product launches, and lead capture funnels.',
        'bullets'  => ['Instant page load for maximum ad ROI', 'Integrated CRM & email webhooks', 'Conversion-centered UX hierarchy'],
    ],
    [
        'slug'     => 'e-commerce-solutions',
        'title'    => 'E-Commerce Solutions',
        'category' => 'wordpress',
        'cat_name' => 'WordPress & CMS',
        'icon'     => 'fa-solid fa-cart-shopping',
        'desc'     => 'High-throughput e-commerce architectures engineered for rapid product discovery, frictionless 1-click checkouts, and high transaction volumes.',
        'bullets'  => ['Frictionless checkout optimization', 'Custom inventory & warehouse syncs', 'Multi-currency & localization engines'],
    ],
    [
        'slug'     => 'woocommerce-development',
        'title'    => 'WooCommerce Development',
        'category' => 'wordpress',
        'cat_name' => 'WordPress & CMS',
        'icon'     => 'fa-brands fa-shopify',
        'desc'     => 'Tailored WooCommerce theme engineering, custom checkout flows, payment gateway integrations, and lightning-fast product filtering systems.',
        'bullets'  => ['Custom WooCommerce REST API integrations', 'Scalable product catalog query caching', 'Custom subscriptions & memberships'],
    ],
    [
        'slug'     => 'api-and-third-party-integrations',
        'title'    => 'API & Third-Party Integrations',
        'category' => 'apps',
        'cat_name' => 'Web Apps & APIs',
        'icon'     => 'fa-solid fa-network-wired',
        'desc'     => 'Connecting your web platform with enterprise CRMs, Stripe/PayPal payment systems, ERPs, and custom REST/GraphQL microservices.',
        'bullets'  => ['Stripe, HubSpot, and Salesforce connectors', 'Webhook listeners with automatic retries', 'Bi-directional real-time data syncs'],
    ],
    [
        'slug'     => 'website-migration',
        'title'    => 'Website Migration',
        'category' => 'wordpress',
        'cat_name' => 'WordPress & CMS',
        'icon'     => 'fa-solid fa-server',
        'desc'     => 'Zero-downtime migrations across web servers, CMS transitions, database consolidation, and 100% SEO permalink integrity preservation.',
        'bullets'  => ['Zero business disruption or downtime', 'Complete URL redirect mapping & validation', 'DNS, SSL, and CDN switchover execution'],
    ],
    [
        'slug'     => 'cro-landing-pages',
        'title'    => 'CRO Landing Pages',
        'category' => 'speed',
        'cat_name' => 'Performance & Speed',
        'icon'     => 'fa-solid fa-chart-line',
        'desc'     => 'Conversion rate optimized landing pages designed with behavioral psychology, heatmapped UX principles, and A/B split-testing architecture.',
        'bullets'  => ['A/B multivariate testing setup', 'High-intent CTA and form optimizations', 'Instant mobile responsiveness'],
    ],
    [
        'slug'     => 'gohighlevel-development',
        'title'    => 'GoHighLevel Development',
        'category' => 'apps',
        'cat_name' => 'Web Apps & APIs',
        'icon'     => 'fa-solid fa-diagram-project',
        'desc'     => 'Custom GoHighLevel funnel architecture, custom code snapshots, client portal styling, and webhook integrations with external web apps.',
        'bullets'  => ['Custom CSS/JS funnel styling overrides', 'Advanced automation triggers & workflows', 'Client dashboard customization'],
    ],
    [
        'slug'     => 'brand-development-online-presence',
        'title'    => 'Brand Development & Online Presence',
        'category' => 'frontend',
        'cat_name' => 'Front-End & UI',
        'icon'     => 'fa-solid fa-bezier-curve',
        'desc'     => 'Cohesive digital visual identities, modern typography tokens, logo design, and cohesive multi-channel brand presence for market leadership.',
        'bullets'  => ['Digital brand identity guidelines', 'Custom web iconography & typography systems', 'Consistent cross-platform visual tone'],
    ],
    [
        'slug'     => 'website-maintenance-support-services',
        'title'    => 'Website Maintenance & Support',
        'category' => 'speed',
        'cat_name' => 'Performance & Speed',
        'icon'     => 'fa-solid fa-shield-halved',
        'desc'     => 'Proactive 24/7 uptime monitoring, security patching, Core Web Vitals maintenance, offsite backups, and dedicated monthly development sprints.',
        'bullets'  => ['24/7 automated uptime & security checks', 'Weekly staging updates & regression tests', 'Direct senior engineer Slack/Loom access'],
    ],
];
?>

<!-- Font Awesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="<?php echo esc_url($css_url); ?>?v=<?php echo esc_attr($css_ver); ?>" media="all" />

<!-- Structured Data (Schema.org / Service Directory) -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "ProfessionalService",
  "name": "Chad Sia Media Web Engineering Services",
  "description": "Full-cycle web architecture, custom WordPress engineering, front-end development, and speed optimization.",
  "url": "https://chadsia.com/services/",
  "provider": {
    "@type": "Person",
    "name": "Chad Sia",
    "url": "https://chadsia.com/about-me/"
  },
  "hasOfferCatalog": {
    "@type": "OfferCatalog",
    "name": "Chad Sia Engineering Services",
    "itemListElement": [
      <?php 
      $schema_items = [];
      foreach ($services as $idx => $s) {
          $schema_items[] = json_encode([
              "@type" => "Offer",
              "itemOffered" => [
                  "@type" => "Service",
                  "name"  => $s['title'],
                  "url"   => home_url('/services/' . $s['slug'] . '/')
              ]
          ]);
      }
      echo implode(',', $schema_items);
      ?>
    ]
  }
}
</script>

<div class="cs-srv-hub-wrapper">

  <div class="cs-srv-blob-top"></div>

  <div class="cs-srv-hub-container">

    <!-- Hero Header -->
    <header class="cs-srv-hero">
      <div class="cs-srv-badge">
        Comprehensive Web Solutions
      </div>
      <h1 class="cs-srv-title">
        Full-Cycle Web Architecture, Custom WordPress & <span class="gradient-text">Front-End Engineering</span>
      </h1>
      <p class="cs-srv-subtitle">
        15 specialized technical services engineered for high-growth businesses, global agencies, and enterprise brands requiring sub-second performance and pixel-perfect execution.
      </p>

      <!-- Stats Bar -->
      <div class="cs-srv-stats-grid">
        <div class="cs-srv-stat-card">
          <div class="cs-srv-stat-num">15</div>
          <div class="cs-srv-stat-label">Core Capabilities</div>
        </div>
        <div class="cs-srv-stat-card">
          <div class="cs-srv-stat-num">&lt; 0.5s</div>
          <div class="cs-srv-stat-label">Target Global Speed</div>
        </div>
        <div class="cs-srv-stat-card">
          <div class="cs-srv-stat-num">17+</div>
          <div class="cs-srv-stat-label">Years Engineering Craft</div>
        </div>
        <div class="cs-srv-stat-card">
          <div class="cs-srv-stat-num">100+</div>
          <div class="cs-srv-stat-label">Platforms Built</div>
        </div>
      </div>

      <!-- Filter Tabs -->
      <div class="cs-srv-filters">
        <button type="button" class="cs-srv-filter-btn active" data-filter="all">All 15 Services</button>
        <button type="button" class="cs-srv-filter-btn" data-filter="frontend">Front-End & UI</button>
        <button type="button" class="cs-srv-filter-btn" data-filter="wordpress">WordPress & CMS</button>
        <button type="button" class="cs-srv-filter-btn" data-filter="speed">Performance & Speed</button>
        <button type="button" class="cs-srv-filter-btn" data-filter="apps">Web Apps &amp; APIs</button>
      </div>
    </header>

    <!-- 15 Services Grid -->
    <section class="cs-srv-grid">
      <?php foreach ($services as $srv) : ?>
        <article class="cs-srv-card" data-category="<?php echo esc_attr($srv['category']); ?>">
          <div class="cs-srv-card-icon-wrap">
            <i class="<?php echo esc_attr($srv['icon']); ?>"></i>
          </div>
          <div class="cs-srv-card-cat"><?php echo esc_html($srv['cat_name']); ?></div>
          <h2 class="cs-srv-card-title">
            <a href="<?php echo esc_url(home_url('/services/' . $srv['slug'] . '/')); ?>"><?php echo esc_html($srv['title']); ?></a>
          </h2>
          <p class="cs-srv-card-desc"><?php echo esc_html($srv['desc']); ?></p>
          <ul class="cs-srv-card-bullets">
            <?php foreach ($srv['bullets'] as $b) : ?>
              <li><i class="fa-solid fa-check"></i> <?php echo esc_html($b); ?></li>
            <?php endforeach; ?>
          </ul>
          <div class="cs-srv-card-footer">
            <a href="<?php echo esc_url(home_url('/services/' . $srv['slug'] . '/')); ?>" class="cs-srv-card-link">
              Explore Capability <i class="fa-solid fa-arrow-right"></i>
            </a>
          </div>
        </article>
      <?php endforeach; ?>
    </section>

    <!-- 4 Engineering Pillars -->
    <section class="cs-srv-pillars-section">
      <div class="cs-srv-section-header">
        <div class="cs-srv-badge"><i class="fa-solid fa-award"></i> The Chad Sia Advantage</div>
        <h2 class="cs-srv-section-title">Engineered For Longevity & High Conversion</h2>
        <p class="cs-srv-section-sub">
          Every project is built directly by a senior architect without junior handoffs, bloated plugins, or fragile workarounds.
        </p>
      </div>

      <div class="cs-srv-pillars-grid">
        <div class="cs-srv-pillar-card">
          <i class="fa-solid fa-user-gear cs-srv-pillar-icon"></i>
          <h3 class="cs-srv-pillar-title">Direct Senior Access</h3>
          <p class="cs-srv-pillar-desc">Collaborate 1-on-1 with a 17+ year engineer. No agency account manager telephone games.</p>
        </div>
        <div class="cs-srv-pillar-card">
          <i class="fa-solid fa-gauge-high cs-srv-pillar-icon"></i>
          <h3 class="cs-srv-pillar-title">Sub-Second Speed</h3>
          <p class="cs-srv-pillar-desc">Every line of code is measured against Core Web Vitals to deliver sub-500ms response times.</p>
        </div>
        <div class="cs-srv-pillar-card">
          <i class="fa-solid fa-gem cs-srv-pillar-icon"></i>
          <h3 class="cs-srv-pillar-title">Zero Builder Bloat</h3>
          <p class="cs-srv-pillar-desc">Semantic HTML5, lean modern CSS, and clean PHP. No messy visual builders degrading your codebase.</p>
        </div>
        <div class="cs-srv-pillar-card">
          <i class="fa-solid fa-vector-square cs-srv-pillar-icon"></i>
          <h3 class="cs-srv-pillar-title">Pixel-Perfect Fidelity</h3>
          <p class="cs-srv-pillar-desc">Flawless translation from Figma designs to responsive browser execution across all device sizes.</p>
        </div>
      </div>
    </section>

  </div><!-- .cs-srv-hub-container -->

  <!-- Global Featured Portfolio Showcase Widget -->
  <?php if (function_exists('cs_render_portfolio_showcase')) { cs_render_portfolio_showcase(); } ?>

  <!-- Global Client Logo Carousel -->
  <?php if (function_exists('cs_render_logo_carousel')) { cs_render_logo_carousel(); } ?>

  <!-- Centralized Google Reviews Widget -->
  <?php if (function_exists('cs_render_google_reviews')) { cs_render_google_reviews(['kicker' => 'Engineering Excellence Proof', 'title' => 'Rated 5.0 on Google Reviews']); } ?>

  <!-- Technical FAQs -->
  <div class="cs-srv-hub-container" style="margin-top: 60px;">
    <section class="cs-srv-faq-section">
      <div class="cs-srv-section-header">
        <div class="cs-srv-badge"><i class="fa-solid fa-circle-question"></i> Client FAQ</div>
        <h2 class="cs-srv-section-title">Frequently Asked Questions</h2>
        <p class="cs-srv-section-sub">
          Straightforward answers on working models, timelines, code handovers, and ongoing support.
        </p>
      </div>

      <div class="cs-faq-item active">
        <div class="cs-faq-header">
          <h3 class="cs-faq-q">How do we get started on a project?</h3>
          <i class="fa-solid fa-chevron-down cs-faq-toggle"></i>
        </div>
        <div class="cs-faq-body" style="display: block;">
          We begin with a 15-minute technical discovery call or by reviewing your Figma designs and project specifications. Once scope and milestones are confirmed, we kick off development within a dedicated weekly sprint.
        </div>
      </div>

      <div class="cs-faq-item">
        <div class="cs-faq-header">
          <h3 class="cs-faq-q">Do you work on fixed-price projects or hourly retainers?</h3>
          <i class="fa-solid fa-chevron-down cs-faq-toggle"></i>
        </div>
        <div class="cs-faq-body">
          We offer both: fixed-scope delivery for defined builds (redesigns, custom themes, landing pages) and dedicated monthly sprint retainers for ongoing feature development, speed optimization, and technical maintenance.
        </div>
      </div>

      <div class="cs-faq-item">
        <div class="cs-faq-header">
          <h3 class="cs-faq-q">What makes your custom WordPress development different from agencies?</h3>
          <i class="fa-solid fa-chevron-down cs-faq-toggle"></i>
        </div>
        <div class="cs-faq-body">
          Unlike most agencies that rely on heavy multi-plugin page builders, we write clean, bespoke PHP templates with custom ACF fields and modular CSS. The result is a lightning-fast site that loads in under 0.5s, scores 95+ on Google PageSpeed, and never breaks during core updates.
        </div>
      </div>

      <div class="cs-faq-item">
        <div class="cs-faq-header">
          <h3 class="cs-faq-q">Can you collaborate across our timezone?</h3>
          <i class="fa-solid fa-chevron-down cs-faq-toggle"></i>
        </div>
        <div class="cs-faq-body">
          Yes! We maintain active daily overlap with clients across North America (US EST/PST), the United Kingdom (GMT), Australia (AEST), and Asia-Pacific. Communication happens async-first via Slack, Loom video walkthroughs, and Jira/GitHub.
        </div>
      </div>

      <div class="cs-faq-item">
        <div class="cs-faq-header">
          <h3 class="cs-faq-q">Do I own 100% of the code and assets after completion?</h3>
          <i class="fa-solid fa-chevron-down cs-faq-toggle"></i>
        </div>
        <div class="cs-faq-body">
          Absolutely. Full intellectual property, repository commits, design files, and database backups belong entirely to you with zero vendor lock-in.
        </div>
      </div>
    </section>

    <!-- Closing Consultation Banner -->
    <section class="cs-cta-box" style="margin-top: 50px; margin-bottom: 20px;">
      <div class="cs-eyebrow" style="color: #818cf8 !important; margin-bottom: 12px;">
        Next-Generation Web Engineering
      </div>
      <h2>Have a Project That Demands Technical Excellence?</h2>
      <p>
        Let’s discuss your architecture, timeline, and goals directly. Book a 15-minute introductory technical discovery call with Chad Sia.
      </p>
      <div style="display: flex; gap: 14px; justify-content: center; flex-wrap: wrap;">
        <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="cs-btn">
          Start Your Project Discovery <i class="fa-solid fa-arrow-right"></i>
        </a>
        <a href="<?php echo esc_url(home_url('/portfolio/')); ?>" class="cs-btn" style="background: rgba(255,255,255,0.08) !important; color: #ffffff !important; border-color: rgba(255,255,255,0.2) !important;">
          View Portfolio & Case Studies
        </a>
      </div>
    </section>
  </div>

</div><!-- .cs-srv-hub-wrapper -->

<!-- Interactive Filter & FAQ Scripts -->
<script>
document.addEventListener('DOMContentLoaded', function () {
  // Category Filter Functionality
  const filterBtns = document.querySelectorAll('.cs-srv-filter-btn');
  const srvCards = document.querySelectorAll('.cs-srv-card');

  filterBtns.forEach(btn => {
    btn.addEventListener('click', function () {
      filterBtns.forEach(b => b.classList.remove('active'));
      this.classList.add('active');
      const filter = this.getAttribute('data-filter');

      srvCards.forEach(card => {
        if (filter === 'all' || card.getAttribute('data-category') === filter) {
          card.style.display = 'flex';
        } else {
          card.style.display = 'none';
        }
      });
    });
  });

  // FAQ Accordion
  const faqItems = document.querySelectorAll('.cs-faq-item');
  faqItems.forEach(item => {
    const header = item.querySelector('.cs-faq-header');
    header.addEventListener('click', function () {
      const isActive = item.classList.contains('active');
      faqItems.forEach(i => {
        i.classList.remove('active');
        i.querySelector('.cs-faq-body').style.display = 'none';
      });
      if (!isActive) {
        item.classList.add('active');
        item.querySelector('.cs-faq-body').style.display = 'block';
      }
    });
  });
});
</script>
