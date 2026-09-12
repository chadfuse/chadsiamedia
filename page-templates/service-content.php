<?php
/**
 * Single Service Page Content Template
 * 
 * Modular, high-speed, Elementor-free service template with AI platform styling,
 * full ACF integration, and dynamic fallbacks for all services.
 */

if (!defined('ABSPATH')) {
    exit;
}

$post_id = get_the_ID();
$service_title = get_the_title($post_id);
$start_year = 2009;
$current_year = (int) date('Y');
$years_exp = max(1, $current_year - $start_year);
$years_exp_str = function_exists('cs_get_years_experience') ? cs_get_years_experience($start_year) : ($years_exp . '+ Years');

$page_title = get_the_title($post_id);
$post_slug  = get_post_field('post_name', $post_id);

// 1. HERO SECTION DATA
$hero_kicker = (function_exists('get_field') ? (get_field('service_hero_kicker', $post_id) ?: get_field('service_badge', $post_id)) : '') ?: ($page_title . ' · Senior Engineering');
$hero_title  = (function_exists('get_field') ? get_field('service_hero_title', $post_id) : '') ?: ($page_title . ' Engineered for Speed, Scale & ROI');
$hero_lead   = (function_exists('get_field') ? get_field('service_hero_subtitle', $post_id) : '') ?: (get_the_excerpt($post_id) ?: "We engineer lightweight, accessible, and sub-second {$page_title} solutions using modern standards. No bloated themes, zero layout shifts, and 90+ Google PageSpeed guaranteed.");
$hero_btn_text = (function_exists('get_field') ? (get_field('service_hero_btn_text', $post_id) ?: get_field('service_hero_primary_btn_text', $post_id)) : '') ?: 'Book Discovery Call';
$hero_btn_url  = (function_exists('get_field') ? (get_field('service_hero_btn_url', $post_id) ?: get_field('service_hero_primary_btn_url', $post_id)) : '') ?: ('/contact/?service=' . $post_slug);
$hero_sec_text = (function_exists('get_field') ? get_field('service_hero_secondary_text', $post_id) : '') ?: 'Explore Capabilities';
$hero_sec_url  = (function_exists('get_field') ? get_field('service_hero_secondary_url', $post_id) : '') ?: '#capabilities';
$tech_stack_str = (function_exists('get_field') ? get_field('service_tech_stack', $post_id) : '') ?: 'HTML5 / Modern CSS, TypeScript, React / Vue, Tailwind / Vanilla CSS, GSAP Motion, Webpack / Vite';
$tech_stack = array_filter(array_map('trim', explode(',', $tech_stack_str)));

// Resolve Hero Showcase Image
$hero_img = '';
if (function_exists('get_field')) {
    $acf_hero_img = get_field('service_hero_image', $post_id);
    if (!empty($acf_hero_img)) {
        if (is_array($acf_hero_img) && !empty($acf_hero_img['url'])) {
            $hero_img = $acf_hero_img['url'];
        } elseif (is_numeric($acf_hero_img)) {
            $hero_img = wp_get_attachment_image_url($acf_hero_img, 'full');
        } elseif (is_string($acf_hero_img)) {
            $hero_img = $acf_hero_img;
        }
    }
    if (empty($hero_img)) {
        $hero_img = get_field('service_hero_image_url', $post_id);
    }
}
if (empty($hero_img)) {
    $hero_image_map = [
        'front-end-development' => 'https://chadsia.com/wp-content/uploads/2026/08/Defensible-Legal-1024x565.png',
        'custom-wordpress-development' => 'https://chadsia.com/wp-content/uploads/2025/07/Atlas-App-1024x546.png',
        'ai-web-development' => 'https://chadsia.com/wp-content/uploads/2025/09/Casa-Halo-Site-1024x546.png',
        'website-speed-optimization' => 'https://chadsia.com/wp-content/uploads/2026/08/Defensible-Legal-1024x565.png',
        'website-redesign' => 'https://chadsia.com/wp-content/uploads/2025/07/BluSonil-1024x546.png',
        'woocommerce-development' => 'https://chadsia.com/wp-content/uploads/2026/08/GypsyJazz-1024x561.png',
        'landing-page-development' => 'https://chadsia.com/wp-content/uploads/2026/08/funnel-1.jpg',
        'website-migration' => 'https://chadsia.com/wp-content/uploads/2024/10/CRAApartments.webp',
        'api-and-third-party-integrations' => 'https://chadsia.com/wp-content/uploads/2025/07/Atlas-App-1024x546.png',
        'gohighlevel-development' => 'https://chadsia.com/wp-content/uploads/2026/08/Funnel-2.jpg',
        'brand-development-online-presence' => 'https://chadsia.com/wp-content/uploads/2025/09/Casa-Halo-Site-1024x546.png',
        'e-commerce-solutions' => 'https://chadsia.com/wp-content/uploads/2026/08/GypsyJazz-1024x561.png',
        'graphic-funnel-design-services' => 'https://chadsia.com/wp-content/uploads/2026/08/funnel-1.jpg',
        'ui-ux-design' => 'https://chadsia.com/wp-content/uploads/2025/07/Atlas-App-1024x546.png',
        'website-maintenance-support-services' => 'https://chadsia.com/wp-content/uploads/2026/08/Defensible-Legal-1024x565.png',
    ];
    $hero_img = $hero_image_map[$post_slug] ?? 'https://chadsia.com/wp-content/uploads/2026/08/Defensible-Legal-1024x565.png';
}

// 2. WHAT WE DELIVER (Capabilities)
$what_kicker = (function_exists('get_field') ? get_field('service_what_kicker', $post_id) : '') ?: 'Core Capabilities';
$what_title  = (function_exists('get_field') ? get_field('service_what_title', $post_id) : '') ?: ("Everything You Need for Enterprise-Grade " . $page_title);
$what_sub    = (function_exists('get_field') ? (get_field('service_what_subtitle', $post_id) ?: get_field('service_what_desc', $post_id)) : '') ?: ("Tailored {$page_title} engineering designed for maximum performance, responsiveness, and measurable ROI.");
$capabilities = (function_exists('get_field') ? (get_field('service_capabilities', $post_id) ?: get_field('service_what_cards', $post_id)) : []) ?: [];
if (empty($capabilities)) {
    $capabilities = [
        [
            'icon_class' => 'fa-solid fa-layer-group',
            'title' => 'Design System & Component Architecture',
            'description' => 'Translate complex designs into modular, reusable, pixel-perfect UI components built with strict semantic standards.',
            'deliverables' => "Design Token System (Colors, Typography, Spacing)\nAtomic Reusable UI Components\nZero Layout Shift (CLS < 0.01)\nFull WCAG 2.1 AA Accessibility"
        ],
        [
            'icon_class' => 'fa-solid fa-gauge-high',
            'title' => 'Core Web Vitals & Speed Optimization',
            'description' => 'Every millisecond counts. We optimize critical CSS rendering paths, eliminate render-blocking scripts, and engineer lightweight asset delivery.',
            'deliverables' => "Sub-800ms First Contentful Paint (FCP)\n90+ Mobile & Desktop Google PageSpeed\nOptimized Modern Asset Pipeline (WebP/AVIF)\nClean, Zero-Bloat Vanilla CSS / JS"
        ],
        [
            'icon_class' => 'fa-solid fa-mobile-screen-button',
            'title' => 'Responsive & Cross-Browser Precision',
            'description' => 'Flawless visual and interactive fidelity across every viewport—from high-density 4K displays to mobile devices.',
            'deliverables' => "Fluid Fluid-Typography & Clamp Scaling\nMobile-First Breakpoint Testing\nTouch-Optimized Gestures & Menus\nCross-Browser Compatibility Testing"
        ],
        [
            'icon_class' => 'fa-solid fa-wand-magic-sparkles',
            'title' => 'Dynamic Micro-Interactions & Motion',
            'description' => 'Elevate user engagement with smooth, GPU-accelerated micro-interactions and animations engineered without performance penalties.',
            'deliverables' => "Smooth Scroll & Trigger Animations\nInteractive UI States & Feedback\nHardware-Accelerated CSS Transitions\nMicro-Interactions That Delight Users"
        ],
        [
            'icon_class' => 'fa-solid fa-shield-halved',
            'title' => 'Enterprise Security & Code Quality',
            'description' => 'Rigorous code review standards, sanitization, strict typing, and defensive coding practices to ensure bulletproof reliability.',
            'deliverables' => "Strict Data Sanitization & Nonce Verification\nZero Insecure Dependencies\nAutomated Linting & Quality Gates\nOWASP Top 10 Compliance"
        ],
        [
            'icon_class' => 'fa-solid fa-magnifying-glass-chart',
            'title' => 'Technical SEO & Semantic Schema',
            'description' => 'Built from the ground up for AI search crawlers (AEO/GEO) and Google with automated JSON-LD schemas and rich semantic hierarchy.',
            'deliverables' => "Custom JSON-LD Service Schemas\nSemantic HTML5 Outline Structure\nOpenGraph & Social Meta Optimization\nZero Crawl Errors & Canonical Integrity"
        ]
    ];
}

// 3. WHY CHOOSE US (Differentiators)
$why_kicker = (function_exists('get_field') ? get_field('service_why_kicker', $post_id) : '') ?: 'The Technical Advantage';
$why_title  = (function_exists('get_field') ? get_field('service_why_title', $post_id) : '') ?: ("Why Ambitious Brands Choose Chad Sia for " . $page_title);
$why_items  = (function_exists('get_field') ? (get_field('service_why_items', $post_id) ?: get_field('service_why_cards', $post_id)) : []) ?: [];
if (empty($why_items)) {
    $why_items = [
        [
            'icon_class' => 'fa-solid fa-user-check',
            'title' => 'Direct Senior Access',
            'description' => 'Work directly with Chad Sia (17+ years engineering craft). Zero account managers, zero outsourced junior subcontractors, zero communication lag.',
            'stat_badge' => "{$years_exp_str} Craft"
        ],
        [
            'icon_class' => 'fa-solid fa-bolt',
            'title' => 'Sub-Second Speed Guarantee',
            'description' => 'We engineer lightweight custom architectures guaranteed to achieve 90+ Google PageSpeed scores, reducing bounce rates and boosting conversions.',
            'stat_badge' => '< 0.8s TTFB'
        ],
        [
            'icon_class' => 'fa-solid fa-gem',
            'title' => 'Pixel-Perfect Fidelity',
            'description' => 'Every line of CSS and JavaScript is crafted to mirror your Figma designs with microscopic precision, down to border radii, easing curves, and typographic rhythms.',
            'stat_badge' => '100% Precision'
        ],
        [
            'icon_class' => 'fa-solid fa-file-code',
            'title' => 'Zero Builder Bloat',
            'description' => 'No slow multi-purpose themes or plugin hell. Clean, custom semantic code that gives you complete ownership and flawless scalability.',
            'stat_badge' => '0% Bloat'
        ]
    ];
}

// 4. OTHER SERVICES (Query Sibling Service Pages)
$other_services_query = get_posts([
    'post_type'      => 'page',
    'post_parent'    => 2887, // Parent /services/ page
    'exclude'        => [$post_id],
    'posts_per_page' => 8,
    'post_status'    => 'publish',
    'orderby'        => 'menu_order title',
    'order'          => 'ASC'
]);
$other_services = [];
$service_icons = [
    'ai-web-development' => 'fa-solid fa-robot',
    'website-speed-optimization' => 'fa-solid fa-bolt',
    'landing-page-development' => 'fa-solid fa-layer-group',
    'woocommerce-development' => 'fa-solid fa-cart-shopping',
    'gohighlevel-development' => 'fa-solid fa-chart-line',
    'api-and-third-party-integrations' => 'fa-solid fa-network-wired',
    'website-redesign' => 'fa-solid fa-compass-drafting',
    'website-migration' => 'fa-solid fa-arrow-right-arrow-left',
];
if (!empty($other_services_query)) {
    foreach ($other_services_query as $sp) {
        $icon = $service_icons[$sp->post_name] ?? 'fa-solid fa-code';
        $excerpt = get_the_excerpt($sp->ID) ?: "High-performance {$sp->post_title} engineered for scale and speed.";
        $other_services[] = [
            'title'   => $sp->post_title,
            'summary' => wp_trim_words($excerpt, 16, '...'),
            'link'    => get_permalink($sp->ID),
            'icon'    => $icon
        ];
    }
}
if (empty($other_services)) {
    $other_services = [
        ['title' => 'AI Web Development & Automation', 'summary' => 'Integrate custom AI chatbots, lead capture engines, and automated workflows.', 'link' => '/services/ai-web-development/', 'icon' => 'fa-solid fa-robot'],
        ['title' => 'Website Speed Optimization', 'summary' => 'Achieve sub-second load times and dominate Core Web Vitals.', 'link' => '/services/website-speed-optimization/', 'icon' => 'fa-solid fa-bolt'],
        ['title' => 'High-Converting Landing Pages', 'summary' => 'Precision conversion funnels engineered for paid acquisition and organic authority.', 'link' => '/services/landing-page-development/', 'icon' => 'fa-solid fa-layer-group'],
        ['title' => 'WooCommerce Development', 'summary' => 'High-speed custom e-commerce stores designed for frictionless checkout.', 'link' => '/services/woocommerce-development/', 'icon' => 'fa-solid fa-cart-shopping']
    ];
}

// 5. FEATURED PORTFOLIO CARDS (Global Showcase)
$portfolio_kicker = (function_exists('get_field') ? get_field('service_portfolio_kicker', $post_id) : '') ?: 'Proven Case Studies';
$portfolio_title  = (function_exists('get_field') ? get_field('service_portfolio_title', $post_id) : '') ?: 'Featured Portfolio: Real Results & Engineered Speed';
$portfolio_items  = (function_exists('get_field') ? get_field('service_portfolio_items', $post_id) : []) ?: [];
if (empty($portfolio_items) && function_exists('cs_get_default_portfolio_items')) {
    $portfolio_items = cs_get_default_portfolio_items();
}

// 6. OUR PROCESS
$process_kicker = (function_exists('get_field') ? get_field('service_process_kicker', $post_id) : '') ?: 'Engineering Roadmap';
$process_title  = (function_exists('get_field') ? get_field('service_process_title', $post_id) : '') ?: 'A Transparent, 4-Step Engineering Workflow';
$process_steps  = (function_exists('get_field') ? get_field('service_process_steps', $post_id) : []) ?: [];
if (empty($process_steps)) {
    $process_steps = [
        [
            'step_num' => '01',
            'title' => 'Architecture & UX Audit',
            'description' => 'We review your Figma designs, technical stack, and performance requirements to define component hierarchy, tokens, and data contracts.',
            'deliverables' => "Design System Token Audit\nComponent Hierarchy Map"
        ],
        [
            'step_num' => '02',
            'title' => 'Rapid Component Prototyping',
            'description' => 'We build interactive component sandboxes with semantic HTML5, CSS tokens, and responsive state handling for rapid client feedback.',
            'deliverables' => "Pixel-Perfect UI Sandbox\nMicro-Interaction Demos"
        ],
        [
            'step_num' => '03',
            'title' => 'Performance & API Integration',
            'description' => 'We integrate dynamic APIs, connect WordPress hooks, optimize asset loading pipelines, and test across all browser viewports.',
            'deliverables' => "Sub-Second Load Tuning\nCross-Device Responsiveness"
        ],
        [
            'step_num' => '04',
            'title' => 'QA, Lighthouse 95+ & Handover',
            'description' => 'Rigorous Core Web Vitals audit, WCAG accessibility validation, clean documentation, and seamless production deployment.',
            'deliverables' => "Lighthouse 95+ Report\n100% Codebase Ownership"
        ]
    ];
}

// 7. WHO SECTION
$who_kicker = (function_exists('get_field') ? get_field('service_who_kicker', $post_id) : '') ?: 'Senior Engineering Leadership';
$who_title  = (function_exists('get_field') ? get_field('service_who_title', $post_id) : '') ?: "Direct Collaboration with a Senior Developer ({$years_exp_str})";
$who_body   = (function_exists('get_field') ? get_field('service_who_body', $post_id) : '') ?: "Founded by Chad Sia in {$start_year}, Chad Sia Media provides specialized {$page_title} and digital architecture for brands that demand measurable ROI. We eliminate the layers of project managers and outsourced junior developers common in traditional agencies. When you work with us, you partner directly with a senior engineer who understands both pixel precision and business growth.";

// 8. FAQS SECTION
$faqs = (function_exists('get_field') ? get_field('service_faqs', $post_id) : []) ?: [];
if (empty($faqs)) {
    $faqs = [
        [
            'question' => "What technologies and frameworks do you use for {$page_title}?",
            'answer'   => "We specialize in modern semantic HTML5, modern CSS3 (Vanilla, CSS Grid, Flexbox, Tailwind CSS), modern JavaScript (ES6+, TypeScript), and lightweight architectures tailored specifically to {$page_title}."
        ],
        [
            'question' => "How do you ensure sub-second page speeds and 90+ Google PageSpeed scores?",
            'answer'   => "We write 100% custom, zero-bloat code without multi-purpose page builder bloat. We optimize the critical rendering path, eliminate layout shifts (CLS), inline essential CSS, defer non-critical assets, and serve modern WebP/AVIF image formats."
        ],
        [
            'question' => "Can you tailor this solution to our specific tech stack and requirements?",
            'answer'   => "Yes, every architecture is customized to your exact business objectives, API integrations, third-party tooling, and workflow requirements."
        ],
        [
            'question' => "How does direct senior developer collaboration work?",
            'answer'   => "You communicate directly with Chad Sia via dedicated Slack/email channels and video strategy sprints. This eliminates the miscommunication, delays, and markups of traditional agencies, ensuring your project is built with senior precision from day one."
        ]
    ];
}

// 9. CTA SECTION
$cta_kicker = (function_exists('get_field') ? get_field('service_cta_kicker', $post_id) : '') ?: 'Get Started Today';
$cta_title  = (function_exists('get_field') ? get_field('service_cta_title', $post_id) : '') ?: ("Ready to Elevate Your " . $page_title . "?");
$cta_desc   = (function_exists('get_field') ? get_field('service_cta_desc', $post_id) : '') ?: ("Let us build a lightning-fast, high-converting {$page_title} architecture engineered to outperform your competitors.");
$cta_btn_text = (function_exists('get_field') ? get_field('service_cta_btn_text', $post_id) : '') ?: 'Book Your Discovery Call';
$cta_btn_url  = (function_exists('get_field') ? get_field('service_cta_btn_url', $post_id) : '') ?: ('/contact/?service=' . $post_slug);

// Enqueue dedicated CSS & Font Awesome Icons
$css_url = get_stylesheet_directory_uri() . '/assets/css/service-page.css';
$css_ver = file_exists(get_stylesheet_directory() . '/assets/css/service-page.css') ? filemtime(get_stylesheet_directory() . '/assets/css/service-page.css') : '1.0.0';
?>
<!-- Font Awesome Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="<?php echo esc_url($css_url); ?>?v=<?php echo esc_attr($css_ver); ?>" media="all" />

<!-- Structured Data (Schema.org / Service) -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Service",
  "name": "<?php echo esc_attr($service_title); ?>",
  "provider": {
    "@type": "ProfessionalService",
    "name": "Chad Sia Media",
    "url": "https://chadsia.com",
    "founder": "Chad Sia",
    "foundingDate": "2009"
  },
  "serviceType": "Web Engineering & Front-End Architecture",
  "description": "<?php echo esc_attr(wp_strip_all_tags($hero_lead)); ?>",
  "areaServed": "Global",
  "offers": {
    "@type": "Offer",
    "priceCurrency": "USD",
    "availability": "https://schema.org/InStock"
  }
}
</script>

<div class="cs-service-wrapper">
  
  <!-- =========================================================================
       1. HERO SECTION
       ========================================================================= -->
  <section class="cs-service-hero">
    <div class="cs-service-container">
      <div class="cs-service-hero-grid">
        <div class="cs-hero-content">
          <div class="cs-eyebrow">
            <?php echo esc_html($hero_kicker); ?>
          </div>
          <h1 class="cs-hero-title"><?php echo esc_html($hero_title); ?></h1>
          <p class="cs-hero-lead"><?php echo esc_html(wp_strip_all_tags($hero_lead)); ?></p>
          
          <div class="cs-hero-actions">
            <a href="<?php echo esc_url($hero_btn_url); ?>" class="cs-btn cs-btn-primary">
              <?php echo esc_html($hero_btn_text); ?> <i class="fa-solid fa-arrow-right cs-btn-arrow"></i>
            </a>
            <a href="<?php echo esc_url($hero_sec_url); ?>" class="cs-btn cs-btn-secondary">
              <?php echo esc_html($hero_sec_text); ?>
            </a>
          </div>

          <?php if (!empty($tech_stack)): ?>
          <div class="cs-hero-tech-stack">
            <span class="cs-tech-label">Core Stack:</span>
            <?php foreach ($tech_stack as $tech): ?>
              <span class="cs-tech-chip">
                <i class="fa-solid fa-check"></i>
                <?php echo esc_html($tech); ?>
              </span>
            <?php endforeach; ?>
          </div>
          <?php endif; ?>
        </div>

        <!-- Right Column: Hero Visual Showcase (Browser Chassis) -->
        <div class="cs-hero-showcase-wrapper">
          <div class="cs-hero-browser-mockup">
            <div class="cs-browser-header">
              <div class="cs-browser-dots">
                <span class="cs-dot cs-dot-red"></span>
                <span class="cs-dot cs-dot-yellow"></span>
                <span class="cs-dot cs-dot-green"></span>
              </div>
              <div class="cs-browser-address-bar">
                <i class="fa-solid fa-lock"></i>
                <span>chadsia.com / services / <?php echo esc_html(get_post_field('post_name', $post_id)); ?></span>
              </div>
              <div class="cs-browser-live-badge">
                <span class="cs-live-dot"></span>
                <span>Verified Build</span>
              </div>
            </div>

            <div class="cs-browser-screen">
              <img src="<?php echo esc_url($hero_img); ?>" alt="<?php echo esc_attr($hero_title); ?>" loading="eager" />
              <div class="cs-browser-overlay"></div>
              
              <!-- Floating Glass Badges -->
              <div class="cs-hero-floating-badge cs-badge-top-left">
                <span class="cs-hero-badge-icon"><i class="fa-solid fa-bolt"></i></span>
                <div>
                  <strong>99 PageSpeed</strong>
                  <small>Sub-Second LCP</small>
                </div>
              </div>

              <div class="cs-hero-floating-badge cs-badge-bottom-right">
                <span class="cs-hero-badge-icon" style="background: rgba(16, 185, 129, 0.2); color: #10b981;"><i class="fa-solid fa-shield-halved"></i></span>
                <div>
                  <strong>Senior Engineering</strong>
                  <small><?php echo esc_html($years_exp_str); ?> Veteran Craft</small>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- =========================================================================
       2. CLIENT LOGO MARQUEE (Global Widget with Real Client Logos)
       ========================================================================= -->
  <?php 
  if (function_exists('cs_render_logo_carousel')) {
      cs_render_logo_carousel([
          'theme'       => 'dark',
          'show_header' => true,
          'kicker'      => 'Proven Track Record',
          'title'       => 'Trusted by Leading Brands, Founders & Fast-Growing Enterprises',
          'speed'       => '38s'
      ]);
  }
  ?>

  <!-- =========================================================================
       3. WHAT WE DELIVER (Capabilities Grid)
       ========================================================================= -->
  <section class="cs-service-capabilities" id="capabilities">
    <div class="cs-service-container">
      <div class="cs-sec-heading-group">
        <div class="cs-eyebrow">
          <?php echo esc_html($what_kicker); ?>
        </div>
        <h2 class="cs-sec-title"><?php echo esc_html($what_title); ?></h2>
        <p class="cs-sec-sub"><?php echo esc_html(wp_strip_all_tags($what_sub)); ?></p>
      </div>

      <div class="cs-capabilities-grid">
        <?php foreach ($capabilities as $cap): 
            $c_icon = $cap['icon_class'] ?: 'fa-solid fa-code';
            $c_title = $cap['title'] ?: '';
            $c_desc = $cap['description'] ?: '';
            $c_deliv_raw = $cap['deliverables'] ?: '';
            $c_deliv = array_filter(array_map('trim', explode("\n", $c_deliv_raw)));
            if (empty($c_title)) continue;
        ?>
          <div class="cs-cap-card">
            <div class="cs-cap-icon-box">
              <i class="<?php echo esc_attr($c_icon); ?>"></i>
            </div>
            <h3><?php echo esc_html($c_title); ?></h3>
            <p><?php echo esc_html(wp_strip_all_tags($c_desc)); ?></p>

            <?php if (!empty($c_deliv)): ?>
            <ul class="cs-cap-deliverables">
              <?php foreach ($c_deliv as $d_item): ?>
                <li>
                  <i class="fa-solid fa-circle-check"></i>
                  <span><?php echo esc_html($d_item); ?></span>
                </li>
              <?php endforeach; ?>
            </ul>
            <?php endif; ?>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- =========================================================================
       4. WHY CHOOSE US (Engineering Differentiators)
       ========================================================================= -->
  <section class="cs-service-why">
    <div class="cs-service-container">
      <div class="cs-sec-heading-group">
        <div class="cs-eyebrow">
          <?php echo esc_html($why_kicker); ?>
        </div>
        <h2 class="cs-sec-title"><?php echo esc_html($why_title); ?></h2>
      </div>

      <div class="cs-why-grid">
        <?php foreach ($why_items as $item): 
            $w_icon = $item['icon_class'] ?: 'fa-solid fa-bolt';
            $w_title = $item['title'] ?: '';
            $w_desc = $item['description'] ?: '';
            $w_stat = $item['stat_badge'] ?: '';
            if (empty($w_title)) continue;
        ?>
          <div class="cs-why-card">
            <div class="cs-why-top">
              <div class="cs-why-icon"><i class="<?php echo esc_attr($w_icon); ?>"></i></div>
              <?php if (!empty($w_stat)): ?>
                <span class="cs-why-stat-badge"><?php echo esc_html($w_stat); ?></span>
              <?php endif; ?>
            </div>
            <h3><?php echo esc_html($w_title); ?></h3>
            <p><?php echo esc_html(wp_strip_all_tags($w_desc)); ?></p>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- =========================================================================
       5. OTHER SERVICES CARD CAROUSEL
       ========================================================================= -->
  <?php if (!empty($other_services)): ?>
  <section class="cs-service-carousel-sec">
    <div class="cs-service-container">
      <div class="cs-carousel-header">
        <div>
          <div class="cs-eyebrow">
            Integrated Capabilities
          </div>
          <h2 class="cs-sec-title" style="margin: 0; text-align: left;">Explore Sibling Services</h2>
        </div>
        <div class="cs-carousel-nav">
          <button type="button" class="cs-carousel-btn" id="csServicePrev" aria-label="Previous service"><i class="fa-solid fa-arrow-left"></i></button>
          <button type="button" class="cs-carousel-btn" id="csServiceNext" aria-label="Next service"><i class="fa-solid fa-arrow-right"></i></button>
        </div>
      </div>

      <div class="cs-services-slider" id="csServicesSlider">
        <?php foreach ($other_services as $srv): ?>
          <a href="<?php echo esc_url($srv['link']); ?>" class="cs-service-slider-card">
            <div class="cs-cap-icon-box" style="margin-bottom: 16px;">
              <i class="<?php echo esc_attr($srv['icon']); ?>"></i>
            </div>
            <h4><?php echo esc_html($srv['title']); ?></h4>
            <p><?php echo esc_html($srv['summary']); ?></p>
            <span class="cs-service-card-link">
              Learn More <i class="fa-solid fa-arrow-right"></i>
            </span>
          </a>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <!-- =========================================================================
       6. GLOBAL FEATURED PORTFOLIO CARDS (Proven Case Studies)
       ========================================================================= -->
  <?php 
  if (function_exists('cs_render_portfolio_showcase')) {
      cs_render_portfolio_showcase([
          'kicker'        => $portfolio_kicker,
          'title'         => $portfolio_title,
          'items'         => !empty($portfolio_items) ? $portfolio_items : [],
          'show_footer'   => true,
          'view_all_url'  => '/portfolio/',
          'view_all_text' => 'View Complete Work Portfolio'
      ]);
  } elseif (locate_template('template-parts/global-portfolio-showcase.php')) {
      get_template_part('template-parts/global-portfolio-showcase');
  }
  ?>

  <!-- =========================================================================
       7. OUR PROCESS SECTION (Roadmap)
       ========================================================================= -->
  <section class="cs-service-process">
    <div class="cs-service-container">
      <div class="cs-sec-heading-group">
        <div class="cs-eyebrow">
          <?php echo esc_html($process_kicker); ?>
        </div>
        <h2 class="cs-sec-title"><?php echo esc_html($process_title); ?></h2>
      </div>

      <div class="cs-process-timeline">
        <?php foreach ($process_steps as $step): 
            $s_num = $step['step_num'] ?: '01';
            $s_title = $step['title'] ?: '';
            $s_desc = $step['description'] ?: '';
            $s_deliv_raw = $step['deliverables'] ?: '';
            $s_deliv = array_filter(array_map('trim', explode("\n", $s_deliv_raw)));
            if (empty($s_title)) continue;
        ?>
          <div class="cs-process-step">
            <div class="cs-step-num"><?php echo esc_html($s_num); ?></div>
            <h3><?php echo esc_html($s_title); ?></h3>
            <p><?php echo esc_html(wp_strip_all_tags($s_desc)); ?></p>

            <?php if (!empty($s_deliv)): ?>
            <ul class="cs-step-deliverables">
              <?php foreach ($s_deliv as $d): ?>
                <li>
                  <i class="fa-solid fa-circle-check"></i>
                  <span><?php echo esc_html($d); ?></span>
                </li>
              <?php endforeach; ?>
            </ul>
            <?php endif; ?>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- =========================================================================
       8. WHO SECTION (Direct Senior Access)
       ========================================================================= -->
  <section class="cs-service-who">
    <div class="cs-service-container">
      <div class="cs-who-card-shell">
        <div class="cs-who-text">
          <div class="cs-eyebrow">
            <?php echo esc_html($who_kicker); ?>
          </div>
          <h3><?php echo esc_html($who_title); ?></h3>
          <p><?php echo esc_html($who_body); ?></p>

          <div class="cs-who-highlights">
            <div class="cs-who-hl-item">
              <div class="cs-who-hl-num"><?php echo esc_html($years_exp_str); ?></div>
              <div class="cs-who-hl-lbl">Direct Craft</div>
            </div>
            <div class="cs-who-hl-item">
              <div class="cs-who-hl-num">0%</div>
              <div class="cs-who-hl-lbl">Middle-Men</div>
            </div>
            <div class="cs-who-hl-item">
              <div class="cs-who-hl-num">100%</div>
              <div class="cs-who-hl-lbl">Custom Code</div>
            </div>
          </div>
        </div>

        <div class="cs-who-badge-panel">
          <p class="cs-who-quote">
            "We treat every line of code as an investment in your business speed, security, and conversion metrics."
          </p>
          <div class="cs-who-author-row">
            <div class="cs-who-avatar">CS</div>
            <div class="cs-who-author-info">
              <h4>Chad Sia</h4>
              <span>Founder &amp; Principal Engineer · Since 2009</span>
            </div>
        </div>
      </div>
    </div>
  </section>

  <!-- =========================================================================
       8b. CENTRALIZED GOOGLE REVIEWS WIDGET (Rated 5.0 Trust Badge)
       ========================================================================= -->
  <?php 
  if (function_exists('cs_render_google_reviews')) {
      cs_render_google_reviews([
          'kicker' => 'Verified Client Proof',
          'title'  => 'Rated 5.0 on Google Reviews'
      ]);
  } elseif (function_exists('cs_render_reviews_slider')) {
      cs_render_reviews_slider();
  }
  ?>

  <!-- =========================================================================
       9. FAQS SECTION
       ========================================================================= -->
  <?php if (!empty($faqs)): ?>
  <section class="cs-service-faqs">
    <div class="cs-service-container">
      <div class="cs-sec-heading-group">
        <div class="cs-eyebrow">
          Common Inquiries
        </div>
        <h2 class="cs-sec-title">Frequently Asked Questions</h2>
      </div>

      <div class="cs-faq-list">
        <?php foreach ($faqs as $faq): 
            $q = $faq['question'] ?: '';
            $a = $faq['answer'] ?: '';
            if (empty($q) || empty($a)) continue;
        ?>
          <div class="cs-faq-item">
            <h3 class="cs-faq-q"><?php echo esc_html($q); ?></h3>
            <div class="cs-faq-body">
              <div class="cs-faq-content">
                <?php echo esc_html(wp_strip_all_tags($a)); ?>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <!-- =========================================================================
       10. BOTTOM CTA BANNER
       ========================================================================= -->
  <section class="cs-service-cta-sec">
    <div class="cs-service-container">
      <div class="cs-cta-box">
        <div class="cs-eyebrow" style="color: #ffffff;"><?php echo esc_html($cta_kicker); ?></div>
        <h2><?php echo esc_html($cta_title); ?></h2>
        <p><?php echo esc_html(wp_strip_all_tags($cta_desc)); ?></p>
        <a href="<?php echo esc_url($cta_btn_url); ?>" class="cs-btn cs-btn-primary">
          <?php echo esc_html($cta_btn_text); ?> <i class="fa-solid fa-arrow-right cs-btn-arrow"></i>
        </a>
      </div>
    </div>
  </section>

</div>

<script id="cs-service-scripts">
document.addEventListener('DOMContentLoaded', function() {
  var slider = document.getElementById('csServicesSlider');
  var prevBtn = document.getElementById('csServicePrev');
  var nextBtn = document.getElementById('csServiceNext');

  if (slider && prevBtn && nextBtn) {
    prevBtn.addEventListener('click', function() {
      slider.scrollBy({ left: -360, behavior: 'smooth' });
    });
    nextBtn.addEventListener('click', function() {
      slider.scrollBy({ left: 360, behavior: 'smooth' });
    });
  }
});
</script>
