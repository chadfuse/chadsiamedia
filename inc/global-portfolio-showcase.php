<?php
/**
 * Global Portfolio Showcase Widget & Helper
 * 
 * Provides a standardized, high-converting portfolio showcase component with real
 * project screenshots, client pills, performance metrics, tags, and action buttons.
 * 
 * Usable across all templates, PHP parts, and shortcodes.
 * 
 * Usage in PHP:
 *   if (function_exists('cs_render_portfolio_showcase')) {
 *       cs_render_portfolio_showcase([
 *           'kicker' => 'Proven Case Studies',
 *           'title'  => 'Featured Portfolio: Real Results & Engineered Speed',
 *           'limit'  => 6
 *       ]);
 *   }
 * 
 * Usage in WordPress Content / Elementor:
 *   [cs_portfolio_showcase kicker="Proven Case Studies" title="Featured Portfolio" limit="6"]
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Returns the definitive curated list of featured portfolio case studies
 */
function cs_get_default_portfolio_items() {
    return [
        [
            'id'           => 'this-spa-wellness',
            'image_url'    => 'https://chadsia.com/wp-content/themes/chadsia/assets/images/this-spa-wellness-showcase.webp?v=20260922',
            'title'        => 'This Spa & Wellness',
            'client_type'  => 'WordPress & Divi Builder Customisation',
            'metric_badge' => 'WordPress Divi Build',
            'description'  => 'Engineered a bespoke WordPress wellness sanctuary website using Divi Builder with custom responsive layouts, interactive treatment menus, and high-converting service booking flows.',
            'tags'         => 'WordPress Development, Divi Builder, Custom CSS, Wellness Sanctuary, Booking Funnel',
            'project_url'  => '/contact/?project=this-spa-wellness',
            'live_url'     => 'https://chadsia.com/this-spa-wellness/',
            'live_text'    => 'View Live Site'
        ],
        [
            'id'           => 'core-fitness',
            'image_url'    => 'https://chadsia.com/wp-content/themes/chadsia/assets/images/core-fitness-showcase.webp?v=20260922',
            'title'        => 'Core Fitness Platform',
            'client_type'  => 'WordPress & Divi Builder Fitness Portal',
            'metric_badge' => 'WordPress Divi Build',
            'description'  => 'Architected a high-energy fitness and personal coaching platform built on WordPress and Divi Builder, featuring custom membership tier funnels, online training showcases, and lead generation.',
            'tags'         => 'WordPress Development, Divi Builder, Fitness Platform, Membership Funnel, High-Converting UI',
            'project_url'  => '/contact/?project=core-fitness',
            'live_url'     => 'https://chadsia.com/core-fitness/',
            'live_text'    => 'View Live Site'
        ],
        [
            'id'           => 'cowper-residences',
            'image_url'    => 'https://chadsia.com/wp-content/themes/chadsia/assets/images/cowper-residences-showcase.webp',
            'title'        => 'Cowper Residences Footscray',
            'client_type'  => 'WordPress Customisation & Real Estate Development',
            'metric_badge' => 'Custom Real Estate Theme',
            'description'  => 'Engineered bespoke WordPress theme customisations for Cowper Residences—a premier multi-residential real estate development in Footscray featuring luxury apartments, SOHOs, and townhouses with interactive floorplans and inquiry registration.',
            'tags'         => 'WordPress Customisation, Real Estate Portal, Interactive Floorplans, Custom Post Types, Lead Engine',
            'project_url'  => '/contact/?project=cowper-residences',
            'live_url'     => 'https://cowperresidences.com.au/',
            'live_text'    => 'View Live Platform'
        ],
        [
            'id'           => 'solarplus',
            'image_url'    => 'https://chadsia.com/wp-content/uploads/2024/10/Solarplus.webp',
            'title'        => 'SolarPlus Platform & Design Engine',
            'client_type'  => 'Solar Design, CRM & Quoting System',
            'metric_badge' => 'Custom UI/UX & Quoting Engine',
            'description'  => 'Designed the end-to-end UI/UX and engineered the responsive front-end for SolarPlus—featuring custom WordPress architecture, solar array design tools, CRM workflows, and automated quotation systems.',
            'tags'         => 'Custom WordPress, Solar Design Tool, CRM & Quoting Engine, UI/UX Engineering, Frontend Architecture',
            'project_url'  => '/contact/?project=solarplus',
            'live_url'     => 'https://www.solarplus.co/',
            'live_text'    => 'View Live Platform'
        ],
        [
            'id'           => 'frasso',
            'image_url'    => 'https://chadsia.com/wp-content/themes/chadsia/assets/images/frasso-catalog-showcase-1024.webp',
            'title'        => 'Frasso Architecture & Web Catalog Design',
            'client_type'  => 'Web Catalog & Architecture Studio',
            'metric_badge' => 'Editorial UI · Sub-Second Speed',
            'description'  => 'Architected a bespoke web catalog and portfolio showcase template featuring editorial typography, interactive collection filtering, responsive project showcases, and ultra-fast visual rendering.',
            'tags'         => 'Web Catalog Template, Architecture Studio, Interactive Showcase, Figma to Code, Zero Layout Shift',
            'project_url'  => '/contact/?project=frasso',
            'live_url'     => 'https://chadsia.com/frasso/',
            'live_text'    => 'View Live Demo'
        ],
        [
            'id'           => 'defensible-legal',
            'image_url'    => 'https://chadsia.com/wp-content/uploads/2026/08/Defensible-Legal-1024x565.png',
            'title'        => 'Defensible Legal Platform',
            'client_type'  => 'Solicitor Directory',
            'metric_badge' => '0.4s FCP · 99 PageSpeed',
            'description'  => 'Architected a bespoke corporate web platform and solicitor directory with sub-second critical path rendering, strict WCAG 2.1 AA accessibility, and zero layout shift.',
            'tags'         => 'Solicitor Directory, Semantic HTML5, TypeScript, 99 PageSpeed',
            'project_url'  => '/contact/?project=defensible-legal',
            'live_url'     => 'https://defensiblelegal.co.uk/',
            'live_text'    => 'View Live Platform'
        ],
        [
            'id'           => 'kirk-allen',
            'image_url'    => 'https://chadsia.com/wp-content/uploads/2025/07/Kirk-Allen-Landscape-Supply-1024x546.png',
            'title'        => 'Kirk Allen Landscape Supply',
            'client_type'  => 'WordPress & WooCommerce Build',
            'metric_badge' => 'Custom Location Distance Charging',
            'description'  => 'Custom WordPress WooCommerce build engineered with dynamic location distance freight charging, cubic yard material calculators, and streamlined bulk checkout.',
            'tags'         => 'WordPress & WooCommerce, Distance Charging API, Custom Freight Logistics, Material Calculator',
            'project_url'  => '/contact/?project=kirk-allen',
            'live_url'     => 'https://www.kirkallenlandscapesupply.com/',
            'live_text'    => 'View Live Platform'
        ],
        [
            'id'           => 'atlas-app',
            'image_url'    => 'https://chadsia.com/wp-content/uploads/2025/07/Atlas-App-1024x546.png',
            'title'        => 'Atlas App',
            'client_type'  => 'Betting App',
            'metric_badge' => 'Real-Time Hydration',
            'description'  => 'Engineered an ultra-responsive betting application and interactive client console with zero-bloat state management and real-time live odds visualizers.',
            'tags'         => 'Betting App, Interactive UI, Modern JS, Custom API',
            'project_url'  => '/contact/?project=atlas-app',
            'live_url'     => 'https://chadsia.com/portfolio/'
        ],
        [
            'id'           => 'casa-halo',
            'image_url'    => 'https://chadsia.com/wp-content/uploads/2025/09/Casa-Halo-Site-1024x546.png',
            'title'        => 'Casa Halo',
            'client_type'  => 'Real Estate for Vacation Rental Villa',
            'metric_badge' => 'Sub-Second Visual LCP',
            'description'  => 'Designed and built an ultra-premium booking portal for luxury vacation rental villas with fluid typography, immersive visual storytelling, and direct reservation inquiries.',
            'tags'         => 'Vacation Rental Villa, Custom WordPress, Fluid Typography, Sub-Second',
            'project_url'  => '/contact/?project=casa-halo',
            'live_url'     => 'https://casahalotulum.com/',
            'live_text'    => 'View Live Platform'
        ],
        [
            'id'           => 'blusonil',
            'image_url'    => 'https://chadsia.com/wp-content/uploads/2025/07/BluSonil-1024x546.png',
            'title'        => 'BluSonil',
            'client_type'  => 'Health and Wellness Spa',
            'metric_badge' => '0.6s LCP · 100 SEO',
            'description'  => 'Developed a health and wellness spa platform with sub-second treatment showcase pages, interactive service selection, and streamlined direct booking.',
            'tags'         => 'Health and Wellness Spa, Sub-second LCP, Conversion UX',
            'project_url'  => '/contact/?project=blusonil',
            'live_url'     => 'https://chadsia.com/portfolio/'
        ],
        [
            'id'           => 'gypsyjazz',
            'image_url'    => 'https://chadsia.com/wp-content/uploads/2026/08/GypsyJazz-1024x561.png',
            'title'        => 'GypsyJazz',
            'client_type'  => 'Music Courses and Lessons',
            'metric_badge' => '100% Core Web Vitals Pass',
            'description'  => 'Custom WordPress media and learning platform with gated video masterclasses, music courses, lessons, and fast streaming audio player integration.',
            'tags'         => 'Music Courses and Lessons, Custom WordPress, Fast Media, A11y AA',
            'project_url'  => '/contact/?project=gypsyjazz',
            'live_url'     => 'https://www.gypsyjazztransfusionclub.com/',
            'live_text'    => 'View Live Platform'
        ],
        [
            'id'           => 'broco-energy',
            'image_url'    => 'https://chadsia.com/wp-content/uploads/2025/09/Broco-1024x546.png',
            'title'        => 'Broco Energy',
            'client_type'  => 'Fuel, HVAC, Marketing Website',
            'metric_badge' => '+64% B2B Quote Requests',
            'description'  => 'Built a high-traffic industrial fuel, commercial HVAC, and energy marketing website with dynamic delivery dispatch forms and commercial quote calculators.',
            'tags'         => 'Fuel & HVAC Marketing, Custom PHP, CRM Integration, Sub-Second TTFB',
            'project_url'  => '/contact/?project=broco-energy',
            'live_url'     => 'https://www.brocoenergy.com/',
            'live_text'    => 'View Live Platform'
        ],
        [
            'id'           => 'vip-fitness',
            'image_url'    => 'https://chadsia.com/wp-content/uploads/2024/10/vip-Fitness.webp',
            'title'        => 'VIP Fitness',
            'client_type'  => 'Fitness Coaching',
            'metric_badge' => '+40% Member Signups',
            'description'  => 'High-energy fitness coaching and athletic performance training platform with coach booking, class schedule calendars, and mobile-first enrollment.',
            'tags'         => 'Fitness Coaching, Class Scheduling, Mobile First, Fast Load Times',
            'project_url'  => '/contact/?project=vip-fitness',
            'live_url'     => 'https://chadsia.com/portfolio/'
        ]
    ];
}

/**
 * Portfolio Showcase styles are integrated directly into theme master style.css
 */

/**
 * Renders the Portfolio Showcase Component
 * 
 * @param array $args Customization options
 */
function cs_render_portfolio_showcase($args = []) {
    $defaults = [
        'kicker'        => 'Proven Case Studies',
        'title'         => 'Featured Portfolio: Real Results & Engineered Speed',
        'subtitle'      => '',
        'items'         => [],
        'limit'         => 6,
        'show_footer'   => true,
        'footer_text'   => 'Looking for more live enterprise builds and custom engineering benchmarks?',
        'view_all_text' => 'View Complete Work Portfolio',
        'view_all_url'  => '/portfolio/',
        'class'         => '',
    ];

    $config = wp_parse_args($args, $defaults);

    // If no items provided or empty array passed, use canonical default curated items
    if (empty($config['items'])) {
        $config['items'] = cs_get_default_portfolio_items();
    }

    if (!empty($config['limit']) && count($config['items']) > $config['limit']) {
        $config['items'] = array_slice($config['items'], 0, (int)$config['limit']);
    }

    // Load template part
    $template_file = locate_template('template-parts/global-portfolio-showcase.php');
    if ($template_file) {
        set_query_var('cs_portfolio_args', $config);
        load_template($template_file, false);
    } else {
        // Fallback inline rendering if template part file is missing
        cs_render_portfolio_showcase_html($config);
    }
}

/**
 * Direct HTML rendering fallback
 */
function cs_render_portfolio_showcase_html($config) {
    $items = $config['items'];
    $kicker = $config['kicker'];
    $title = $config['title'];
    $subtitle = $config['subtitle'];
    $show_footer = $config['show_footer'];
    $footer_text = $config['footer_text'];
    $view_all_text = $config['view_all_text'];
    $view_all_url = $config['view_all_url'];
    $extra_class = $config['class'];
    ?>
    <section class="cs-global-portfolio-sec cs-service-portfolio <?php echo esc_attr($extra_class); ?>">
      <div class="cs-service-container">
        <div class="cs-sec-heading-group">
          <?php if (!empty($kicker)): ?>
          <div class="cs-eyebrow">
            <?php echo esc_html($kicker); ?>
          </div>
          <?php endif; ?>
          <h2 class="cs-sec-title"><?php echo esc_html($title); ?></h2>
          <?php if (!empty($subtitle)): ?>
            <p class="cs-sec-subtitle"><?php echo esc_html($subtitle); ?></p>
          <?php endif; ?>
        </div>

        <div class="cs-portfolio-grid">
          <?php foreach ($items as $port): 
              $p_title = $port['title'] ?? '';
              $p_client = $port['client_type'] ?? '';
              $p_metric = $port['metric_badge'] ?? '';
              $p_desc = $port['description'] ?? '';
              $p_tags_raw = $port['tags'] ?? '';
              if (is_array($p_tags_raw)) {
                  $p_tags = $p_tags_raw;
              } else {
                  $p_tags = array_filter(array_map('trim', explode(',', $p_tags_raw)));
              }
              $p_url = $port['project_url'] ?? '/contact/';
              $p_live = !empty($port['live_url']) ? $port['live_url'] : '';
              $p_live_text = $port['live_text'] ?? '';
              
              // Resolve image URL
              $p_img = '';
              if (!empty($port['image'])) {
                  if (is_array($port['image']) && !empty($port['image']['url'])) {
                      $p_img = $port['image']['url'];
                  } elseif (is_numeric($port['image'])) {
                      $p_img = wp_get_attachment_image_url($port['image'], 'large');
                  } elseif (is_string($port['image'])) {
                      $p_img = $port['image'];
                  }
              }
              if (empty($p_img) && !empty($port['image_url'])) {
                  $p_img = $port['image_url'];
              }
              if (empty($p_title)) continue;
          ?>
            <div class="cs-portfolio-card">
              <?php if (!empty($p_img)): ?>
                <div class="cs-portfolio-media">
                  <img src="<?php echo esc_url($p_img); ?>" alt="<?php echo esc_attr($p_title); ?>" loading="lazy" />
                  <div class="cs-portfolio-media-overlay"></div>
                </div>
              <?php endif; ?>

              <div class="cs-portfolio-body">
                <?php if (empty($p_img) && (!empty($p_client) || !empty($p_metric))): ?>
                  <div class="cs-portfolio-meta">
                    <span class="cs-portfolio-client"><?php echo esc_html($p_client); ?></span>
                    <?php if (!empty($p_metric)): ?>
                      <span class="cs-portfolio-metric-badge"><?php echo esc_html($p_metric); ?></span>
                    <?php endif; ?>
                  </div>
                <?php endif; ?>

                <h3><?php echo esc_html($p_title); ?></h3>
                <p><?php echo esc_html(wp_strip_all_tags($p_desc)); ?></p>

                <?php if (!empty($p_tags)): ?>
                <div class="cs-portfolio-tags">
                  <?php foreach ($p_tags as $tag): ?>
                    <span class="cs-port-tag"><?php echo esc_html($tag); ?></span>
                  <?php endforeach; ?>
                </div>
                <?php endif; ?>

                <div class="cs-portfolio-actions">
                  <a href="<?php echo esc_url($p_url); ?>" class="cs-portfolio-btn">
                    Discuss Similar Architecture <i class="fa-solid fa-arrow-right"></i>
                  </a>
                  <?php if (!empty($p_live)): 
                    $live_btn_label = !empty($p_live_text) ? $p_live_text : ((strpos($p_live, 'chadsia.com/portfolio') !== false) ? 'Explore Portfolio' : 'View Live Demo');
                  ?>
                    <a href="<?php echo esc_url($p_live); ?>" class="cs-portfolio-live-link" target="_blank" rel="noopener noreferrer">
                      <span><?php echo esc_html($live_btn_label); ?></span> <i class="fa-solid fa-arrow-up-right-from-square"></i>
                    </a>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>

        <?php if ($show_footer): ?>
        <div class="cs-portfolio-cta-footer">
          <p><?php echo esc_html($footer_text); ?></p>
          <a href="<?php echo esc_url($view_all_url); ?>" class="cs-portfolio-view-all-btn">
            <?php echo esc_html($view_all_text); ?> <i class="fa-solid fa-arrow-right"></i>
          </a>
        </div>
        <?php endif; ?>
      </div>
    </section>
    <?php
}

/**
 * Shortcode handler for [cs_portfolio_showcase]
 */
add_shortcode('cs_portfolio_showcase', function ($atts) {
    $a = shortcode_atts([
        'kicker'        => 'Proven Case Studies',
        'title'         => 'Featured Portfolio: Real Results & Engineered Speed',
        'subtitle'      => '',
        'limit'         => 6,
        'show_footer'   => 'true',
        'footer_text'   => 'Looking for more live enterprise builds and custom engineering benchmarks?',
        'view_all_text' => 'View Complete Work Portfolio',
        'view_all_url'  => '/portfolio/',
        'class'         => '',
    ], $atts, 'cs_portfolio_showcase');

    $a['show_footer'] = filter_var($a['show_footer'], FILTER_VALIDATE_BOOLEAN);

    ob_start();
    cs_render_portfolio_showcase($a);
    return ob_get_clean();
});
