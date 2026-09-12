<?php
/**
 * About Chad Sia Page Content Component
 * Clean Semantic HTML5 + Responsive Design System Architecture
 * 
 * @package ChadSia
 */

// Dynamic Experience Calculation
$current_year = intval(date('Y'));
$founding_year = 2009;
$years_exp = max(17, $current_year - $founding_year);
$years_exp_str = $years_exp . '+ Years';

// Enqueue styles
$css_url = get_stylesheet_directory_uri() . '/assets/css/about-page.css';
$css_ver = file_exists(get_stylesheet_directory() . '/assets/css/about-page.css') ? filemtime(get_stylesheet_directory() . '/assets/css/about-page.css') : '1.0.0';
?>
<!-- Font Awesome Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="<?php echo esc_url($css_url); ?>?v=<?php echo esc_attr($css_ver); ?>" media="all" />

<!-- Structured Data (Schema.org / Person & AboutPage) -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "AboutPage",
  "name": "About Chad Sia | Senior Front-End Architect & WordPress Engineer",
  "description": "Learn about Chad Sia, senior front-end architect and custom WordPress engineer with over <?php echo esc_attr($years_exp); ?> years of experience delivering sub-second web platforms.",
  "url": "https://chadsia.com/about-me/",
  "mainEntity": {
    "@type": "Person",
    "name": "Chad Sia",
    "jobTitle": "Senior Front-End Architect & Full-Stack WordPress Engineer",
    "url": "https://chadsia.com",
    "image": "https://chadsia.com/wp-content/uploads/2024/10/Chad-Sia.png",
    "sameAs": [
      "https://www.linkedin.com/in/chadsiamedia/",
      "https://github.com/chadfuse",
      "https://www.facebook.com/chadsiamedia",
      "https://www.instagram.com/chadsiamedia/"
    ],
    "knowsAbout": [
      "Front-End Engineering",
      "Custom WordPress Development",
      "Core Web Vitals Optimization",
      "Conversion Funnel Architecture",
      "UI/UX Design Systems",
      "TypeScript",
      "React",
      "WooCommerce"
    ],
    "worksFor": {
      "@type": "ProfessionalService",
      "name": "Chad Sia Media",
      "url": "https://chadsia.com"
    }
  }
}
</script>

<div class="cs-about-wrapper">
  
  <!-- =========================================================================
       1. HERO SECTION (Split Story & Portrait Showcase)
       ========================================================================= -->
  <header class="cs-about-hero">
    <div class="cs-about-hero-blob"></div>
    <div class="cs-about-container">
      <div class="cs-about-hero-grid">
        
        <!-- Left: Story & Credentials -->
        <div class="cs-hero-story">
          <div class="cs-eyebrow">
            Senior Front-End Architect · <?php echo esc_html($years_exp_str); ?> Craft
          </div>

          <h1>
            Hi, I’m Chad Sia. I Engineer <span class="cs-gradient-text">Sub-Second Web Platforms</span> That Drive Revenue.
          </h1>

          <p class="cs-hero-lead">
            Independent senior web engineer and front-end architect based in the Philippines, partnering directly with founders, digital agencies, and high-growth brands in the US, UK, Australia, and worldwide.
          </p>

          <p class="cs-hero-bio">
            For more than <?php echo esc_html($years_exp); ?> years, I have specialized in building bespoke WordPress architectures, pixel-perfect design token systems, and high-converting acquisition funnels. I eliminate the bloated agency layers, junior subcontractors, and communication lag—giving you direct senior-level engineering precision from day one.
          </p>

          <div class="cs-hero-actions">
            <a href="/contact/" class="cs-btn-primary">
              <span>Book Discovery Call</span>
              <i class="fa-solid fa-arrow-right"></i>
            </a>
            <a href="/portfolio/" class="cs-btn-secondary">
              <span>Explore Portfolio</span>
              <i class="fa-solid fa-arrow-up-right-from-square"></i>
            </a>
          </div>

          <!-- Quick Stats Bar -->
          <div class="cs-hero-quick-stats">
            <div class="cs-quick-stat">
              <strong class="cs-accent"><?php echo esc_html($years_exp_str); ?></strong>
              <span>Senior Craft</span>
            </div>
            <div class="cs-quick-stat">
              <strong class="cs-primary">100+</strong>
              <span>Platforms Built</span>
            </div>
            <div class="cs-quick-stat">
              <strong>&lt; 0.5s</strong>
              <span>Avg Page Speed</span>
            </div>
          </div>
        </div>

        <!-- Right: Authentic Portrait Browser Shell -->
        <div class="cs-portrait-shell">
          <div class="cs-portrait-header">
            <div class="cs-browser-dots">
              <span></span><span></span><span></span>
            </div>
            <div class="cs-verified-badge">
              <i class="fa-solid fa-circle-check"></i>
              <span>Verified Senior Architect</span>
            </div>
          </div>

          <div class="cs-portrait-img-wrap">
            <img src="https://chadsia.com/wp-content/uploads/2024/10/Chad-Sia.png" alt="Chad Sia - Senior Front-End Architect" loading="eager" />
            
            <!-- Floating Glass Badges -->
            <div class="cs-float-badge cs-float-top-left">
              <div class="cs-float-icon"><i class="fa-solid fa-bolt"></i></div>
              <div class="cs-float-text">
                <strong>99 PageSpeed</strong>
                <small>Sub-Second LCP</small>
              </div>
            </div>

            <div class="cs-float-badge cs-float-bottom-right">
              <div class="cs-float-icon" style="background: rgba(16, 185, 129, 0.2); color: #10b981;"><i class="fa-solid fa-globe"></i></div>
              <div class="cs-float-text">
                <strong>Global Delivery</strong>
                <small>US · UK · AU · Asia</small>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </header>

  <!-- =========================================================================
       2. GLOBAL CLIENT LOGOS MARQUEE (Instant Credibility)
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
       3. CORE ENGINEERING PHILOSOPHY (4 Pillars)
       ========================================================================= -->
  <section class="cs-about-pillars">
    <div class="cs-about-container">
      <div class="cs-sec-heading-group">
        <div class="cs-eyebrow">
          Engineering Philosophy
        </div>
        <h2 class="cs-sec-title">The Four Pillars of My Engineering Craft</h2>
        <p class="cs-sec-sub">
          Every project I take on adheres to strict architectural principles that protect your investment and guarantee outstanding performance.
        </p>
      </div>

      <div class="cs-pillars-grid">
        
        <div class="cs-pillar-card">
          <div class="cs-pillar-icon"><i class="fa-solid fa-user-shield"></i></div>
          <h3>1. Direct Senior Access</h3>
          <p>
            No account managers, no junior developers, and no outsourced shortcuts. You work 1:1 with a <?php echo esc_html($years_exp); ?>-year veteran who understands business goals, UX nuances, and technical execution.
          </p>
        </div>

        <div class="cs-pillar-card">
          <div class="cs-pillar-icon"><i class="fa-solid fa-bolt"></i></div>
          <h3>2. Sub-Second Speed</h3>
          <p>
            Performance is not an afterthought—it is foundational. Every asset is minified, critical CSS paths are optimized, and databases are tuned for sub-second page loads that maximize Google rankings.
          </p>
        </div>

        <div class="cs-pillar-card">
          <div class="cs-pillar-icon"><i class="fa-solid fa-bezier-curve"></i></div>
          <h3>3. Pixel-Perfect Fidelity</h3>
          <p>
            Your designs deserve flawless translation. I match Figma files with microscopic precision—from responsive typography scales to fluid animations and accessible micro-interactions.
          </p>
        </div>

        <div class="cs-pillar-card">
          <div class="cs-pillar-icon"><i class="fa-solid fa-file-code"></i></div>
          <h3>4. Zero Builder Bloat</h3>
          <p>
            I build with clean semantic HTML5, modern CSS tokens, vanilla JavaScript, and native Gutenberg block architectures—eliminating slow page builders and plugin vulnerabilities.
          </p>
        </div>

      </div>
    </div>
  </section>

  <!-- =========================================================================
       4. CAREER MILESTONES / 17+ YEAR JOURNEY
       ========================================================================= -->
  <section class="cs-about-journey">
    <div class="cs-about-container">
      <div class="cs-sec-heading-group">
        <div class="cs-eyebrow">
          Career Milestones
        </div>
        <h2 class="cs-sec-title">17+ Years of Relentless Evolution</h2>
        <p class="cs-sec-sub">
          From crafting hand-coded semantic websites in 2009 to engineering enterprise-grade headless platforms and AI-driven web architectures.
        </p>
      </div>

      <div class="cs-timeline-wrapper">
        <div class="cs-timeline-line"></div>

        <div class="cs-timeline-item">
          <div class="cs-timeline-dot"></div>
          <div class="cs-timeline-content">
            <div class="cs-timeline-header">
              <span class="cs-timeline-year">2009 - 2013</span>
              <span class="cs-timeline-role">Freelance Foundations</span>
            </div>
            <h3>The Genesis of Clean Code &amp; Web Standards</h3>
            <p>
              Began career hand-coding semantic HTML/CSS and PHP websites. Focused on strict cross-browser compatibility, responsive web design principles, and early WordPress theme customization for local and international clients.
            </p>
          </div>
        </div>

        <div class="cs-timeline-item">
          <div class="cs-timeline-dot"></div>
          <div class="cs-timeline-content">
            <div class="cs-timeline-header">
              <span class="cs-timeline-year">2014 - 2018</span>
              <span class="cs-timeline-role">WordPress Engineering</span>
            </div>
            <h3>Custom WordPress Architectures &amp; Global Agency Partnerships</h3>
            <p>
              Transitioned into building bespoke WordPress theme frameworks, custom post-type systems, and ACF Pro architectures. Partnered with high-growth creative agencies across the US, UK, and Australia as their dedicated lead front-end developer.
            </p>
          </div>
        </div>

        <div class="cs-timeline-item">
          <div class="cs-timeline-dot"></div>
          <div class="cs-timeline-content">
            <div class="cs-timeline-header">
              <span class="cs-timeline-year">2019 - 2023</span>
              <span class="cs-timeline-role">High-Velocity Funnels</span>
            </div>
            <h3>Conversion Rate Optimization &amp; Enterprise Platforms</h3>
            <p>
              Engineered high-spending D2C acquisition funnels, custom WooCommerce checkout flows, and sub-second corporate platforms. Implemented rigorous Core Web Vitals optimization pipelines achieving consistent 95+ Google PageSpeed benchmarks.
            </p>
          </div>
        </div>

        <div class="cs-timeline-item">
          <div class="cs-timeline-dot"></div>
          <div class="cs-timeline-content">
            <div class="cs-timeline-header">
              <span class="cs-timeline-year">2024 - Present</span>
              <span class="cs-timeline-role">Modern AI &amp; Architecture</span>
            </div>
            <h3>AI-Enhanced Web Development &amp; AEO Knowledge Graphs</h3>
            <p>
              Engineering next-generation web architectures optimized for AI search crawlers (Answer Engine Optimization), headless CMS APIs, and sub-second enterprise delivery. Continuing direct senior technical advisory for ambitious founders globally.
            </p>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- =========================================================================
       5. TECHNICAL MASTERY & STACK MATRIX
       ========================================================================= -->
  <section class="cs-about-tech">
    <div class="cs-about-container">
      <div class="cs-sec-heading-group">
        <div class="cs-eyebrow">
          Technical Stack
        </div>
        <h2 class="cs-sec-title">Modern Tooling &amp; Technical Mastery</h2>
        <p class="cs-sec-sub">
          A disciplined, modern technology stack chosen for stability, raw rendering speed, and maintainability.
        </p>
      </div>

      <div class="cs-tech-grid">
        
        <div class="cs-tech-col">
          <div class="cs-tech-col-header">
            <i class="fa-brands fa-html5 cs-tech-col-icon"></i>
            <h3>Core Front-End</h3>
          </div>
          <div class="cs-tech-badge-list">
            <span class="cs-tech-badge"><i class="fa-brands fa-html5"></i> Semantic HTML5</span>
            <span class="cs-tech-badge"><i class="fa-brands fa-css3-alt"></i> Modern CSS Tokens</span>
            <span class="cs-tech-badge"><i class="fa-brands fa-js"></i> TypeScript / ES6+</span>
            <span class="cs-tech-badge"><i class="fa-solid fa-mobile-screen"></i> Fluid Responsive</span>
            <span class="cs-tech-badge"><i class="fa-solid fa-universal-access"></i> WCAG 2.1 AA</span>
            <span class="cs-tech-badge"><i class="fa-solid fa-wand-magic-sparkles"></i> GSAP Motion</span>
          </div>
        </div>

        <div class="cs-tech-col">
          <div class="cs-tech-col-header">
            <i class="fa-brands fa-wordpress cs-tech-col-icon"></i>
            <h3>WordPress &amp; PHP</h3>
          </div>
          <div class="cs-tech-badge-list">
            <span class="cs-tech-badge"><i class="fa-brands fa-wordpress"></i> Custom WP Themes</span>
            <span class="cs-tech-badge"><i class="fa-solid fa-cubes"></i> Gutenberg Blocks</span>
            <span class="cs-tech-badge"><i class="fa-brands fa-php"></i> Modern PHP 8.x</span>
            <span class="cs-tech-badge"><i class="fa-solid fa-database"></i> ACF Pro Engine</span>
            <span class="cs-tech-badge"><i class="fa-brands fa-shopify"></i> WooCommerce</span>
            <span class="cs-tech-badge"><i class="fa-solid fa-network-wired"></i> WP REST API</span>
          </div>
        </div>

        <div class="cs-tech-col">
          <div class="cs-tech-col-header">
            <i class="fa-brands fa-react cs-tech-col-icon"></i>
            <h3>Frameworks &amp; UI</h3>
          </div>
          <div class="cs-tech-badge-list">
            <span class="cs-tech-badge"><i class="fa-brands fa-react"></i> React / Next.js</span>
            <span class="cs-tech-badge"><i class="fa-brands fa-vuejs"></i> Vue.js</span>
            <span class="cs-tech-badge"><i class="fa-solid fa-wind"></i> Tailwind CSS</span>
            <span class="cs-tech-badge"><i class="fa-brands fa-figma"></i> Figma Auto-Layout</span>
            <span class="cs-tech-badge"><i class="fa-solid fa-swatchbook"></i> Design Systems</span>
            <span class="cs-tech-badge"><i class="fa-solid fa-bolt"></i> Vite / Webpack</span>
          </div>
        </div>

        <div class="cs-tech-col">
          <div class="cs-tech-col-header">
            <i class="fa-solid fa-gauge-high cs-tech-col-icon"></i>
            <h3>Speed &amp; DevOps</h3>
          </div>
          <div class="cs-tech-badge-list">
            <span class="cs-tech-badge"><i class="fa-solid fa-gauge"></i> Core Web Vitals</span>
            <span class="cs-tech-badge"><i class="fa-solid fa-server"></i> Redis Cache</span>
            <span class="cs-tech-badge"><i class="fa-brands fa-cloudflare"></i> Cloudflare Edge</span>
            <span class="cs-tech-badge"><i class="fa-brands fa-git-alt"></i> Git / GitHub CI</span>
            <span class="cs-tech-badge"><i class="fa-solid fa-magnifying-glass"></i> AEO / SEO Schema</span>
            <span class="cs-tech-badge"><i class="fa-solid fa-shield-halved"></i> OWASP Hardening</span>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- =========================================================================
       6. GLOBAL REMOTE COLLABORATION MODEL
       ========================================================================= -->
  <section class="cs-about-workflow">
    <div class="cs-about-container">
      <div class="cs-sec-heading-group">
        <div class="cs-eyebrow">
          Global Collaboration
        </div>
        <h2 class="cs-sec-title">How We Collaborate Seamlessly Across Borders</h2>
        <p class="cs-sec-sub">
          A frictionless, transparent workflow built for speed, clear accountability, and zero timezone friction.
        </p>
      </div>

      <div class="cs-workflow-grid">
        
        <div class="cs-workflow-card">
          <div class="cs-workflow-icon"><i class="fa-solid fa-clock"></i></div>
          <h3>Timezone Overlap</h3>
          <p>
            Dedicated overlap with US (EST/PST), UK (GMT), and Australian (AEST) business hours for real-time standups, emergency support, and sprint alignments.
          </p>
        </div>

        <div class="cs-workflow-card">
          <div class="cs-workflow-icon"><i class="fa-brands fa-slack"></i></div>
          <h3>Async-First Communication</h3>
          <p>
            Direct access via dedicated Slack channels, detailed Loom video walkthroughs, and GitHub project boards so you always know exact build status.
          </p>
        </div>

        <div class="cs-workflow-card">
          <div class="cs-workflow-icon"><i class="fa-solid fa-rocket"></i></div>
          <h3>Agile Weekly Sprints</h3>
          <p>
            Transparent weekly deliverables, staging server previews, and continuous deployment pipelines that ensure rapid feedback loops and zero surprises.
          </p>
        </div>

      </div>
    </div>
  </section>

  <!-- =========================================================================
       6b. CENTRALIZED GOOGLE REVIEWS WIDGET (Rated 5.0 Trust Badge)
       ========================================================================= -->
  <?php 
  if (function_exists('cs_render_google_reviews')) {
      cs_render_google_reviews([
          'kicker' => 'Client Proof & Trust',
          'title'  => 'Rated 5.0 on Google Reviews'
      ]);
  } elseif (function_exists('cs_render_reviews_slider')) {
      cs_render_reviews_slider();
  }
  ?>

  <!-- =========================================================================
       7. CLOSING DISCOVERY CTA BANNER
       ========================================================================= -->
  <section class="cs-about-cta" style="padding: 40px 0 80px 0;">
    <div class="cs-about-container">
      <div class="cs-cta-box">
        <div class="cs-cta-badge">Direct Senior Engineering Access</div>
        <h2>Ready to Engineer Something Extraordinary?</h2>
        <p>
          Whether you need a sub-second web platform, a custom WordPress architecture, or an enterprise design system, let’s discuss how I can bring senior-level engineering to your next project.
        </p>
        <div class="cs-cta-actions">
          <a href="/contact/" class="cs-btn cs-btn-primary">
            <span>Book Your Discovery Call</span>
            <i class="fa-solid fa-arrow-right"></i>
          </a>
          <a href="/portfolio/" class="cs-btn cs-btn-secondary">
            <span>View Case Studies</span>
          </a>
        </div>
      </div>
    </div>
  </section>

</div>
