<?php
/**
 * The template for displaying the header
 * Native, lightweight, zero-builder architecture
 *
 * @package ChadSia
 */

if (!defined('ABSPATH')) {
    exit;
}
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script>
    // Neutralize host-level telemetry chains to maximize PageSpeed critical rendering path
    window._trfq = [];
    window._trfd = [];
    try {
        Object.defineProperty(window, '_trfd', { value: { push: function() {} }, writable: false, configurable: true });
        Object.defineProperty(window, '_trfq', { value: { push: function() {} }, writable: false, configurable: true });
    } catch(e) {}
    </script>
    <!-- Google Fonts (Optimized Direct Preconnect & Non-Blocking Load) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&family=JetBrains+Mono:wght@400;500&family=Outfit:wght@500;600;700;800;900&display=swap">
    <!-- Font Awesome (Asynchronous Non-Blocking Preload) -->
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" as="style" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"></noscript>
    <?php if (is_front_page() || is_home()): ?>
    <style id="cs-critical-css">
    <?php 
    $crit_path = get_stylesheet_directory() . '/assets/css/critical-home.css';
    if (file_exists($crit_path)) {
        echo file_get_contents($crit_path);
    }
    ?>
    </style>
    <?php endif; ?>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="cs-site-header" id="site-header">
    <div class="cs-container">
        <div class="cs-header-inner">
            
            <!-- Brand Logo -->
            <a href="<?php echo esc_url(home_url('/')); ?>" class="cs-header-logo" rel="home">
                <img src="https://chadsia.com/wp-content/uploads/2024/10/logo-cds.webp" alt="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" class="cs-header-logo-img cs-logo-white no-lazy" width="160" height="82" fetchpriority="high" loading="eager" decoding="async" data-no-lazy="1">
                <img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/assets/images/logo-chadsia.webp" alt="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" class="cs-header-logo-img cs-logo-dark no-lazy" width="160" height="82" fetchpriority="high" loading="eager" decoding="async" data-no-lazy="1">
            </a>

            <!-- Desktop Navigation -->
            <nav class="cs-nav-desktop-wrap" aria-label="Primary Navigation">
                <?php
                if (has_nav_menu('primary')) {
                    wp_nav_menu([
                        'theme_location' => 'primary',
                        'container'      => false,
                        'menu_class'     => 'cs-desktop-nav',
                        'depth'          => 2,
                        'fallback_cb'    => false,
                    ]);
                } else {
                    // Standard High-Performance Navigation Fallback
                    ?>
                    <ul class="cs-desktop-nav">
                        <!-- 1. Services Mega Menu -->
                        <li class="cs-nav-item cs-has-mega">
                            <a href="<?php echo esc_url(home_url('/services/')); ?>">
                                <span>Services</span>
                                <i class="fa-solid fa-chevron-down cs-nav-arrow"></i>
                            </a>
                            <div class="cs-mega-menu cs-mega-services">
                                <!-- Column 1: WordPress Engineering -->
                                <div class="cs-mega-col">
                                    <div class="cs-mega-col-title">
                                        <i class="fa-brands fa-wordpress"></i>
                                        <span>WordPress Engineering</span>
                                    </div>
                                    <ul class="cs-mega-list">
                                        <li>
                                            <a href="<?php echo esc_url(home_url('/services/custom-wordpress-development/')); ?>" class="cs-mega-item-link">
                                                <span class="cs-mega-item-name">Custom WordPress Themes</span>
                                                <span class="cs-mega-item-desc">Zero-bloat, modular Gutenberg code</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?php echo esc_url(home_url('/services/woocommerce-development/')); ?>" class="cs-mega-item-link">
                                                <span class="cs-mega-item-name">WooCommerce Engineering</span>
                                                <span class="cs-mega-item-desc">High-converting store funnels</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?php echo esc_url(home_url('/services/website-maintenance-support-services/')); ?>" class="cs-mega-item-link">
                                                <span class="cs-mega-item-name">Security &amp; Maintenance</span>
                                                <span class="cs-mega-item-desc">Proactive updates &amp; uptime</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?php echo esc_url(home_url('/services/website-migration/')); ?>" class="cs-mega-item-link">
                                                <span class="cs-mega-item-name">Website Migration</span>
                                                <span class="cs-mega-item-desc">Seamless zero-downtime transfers</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                                <!-- Column 2: Front-End Systems -->
                                <div class="cs-mega-col">
                                    <div class="cs-mega-col-title">
                                        <i class="fa-solid fa-code"></i>
                                        <span>Front-End Systems</span>
                                    </div>
                                    <ul class="cs-mega-list">
                                        <li>
                                            <a href="<?php echo esc_url(home_url('/services/front-end-development/')); ?>" class="cs-mega-item-link">
                                                <span class="cs-mega-item-name">Front-End Development</span>
                                                <span class="cs-mega-item-desc">Figma-to-code pixel fidelity</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?php echo esc_url(home_url('/services/ui-ux-design/')); ?>" class="cs-mega-item-link">
                                                <span class="cs-mega-item-name">UI/UX Design Systems</span>
                                                <span class="cs-mega-item-desc">Intuitive, high-converting product UI</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?php echo esc_url(home_url('/services/landing-page-development/')); ?>" class="cs-mega-item-link">
                                                <span class="cs-mega-item-name">Landing Page Systems</span>
                                                <span class="cs-mega-item-desc">Funnels engineered for conversions</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?php echo esc_url(home_url('/services/website-redesign/')); ?>" class="cs-mega-item-link">
                                                <span class="cs-mega-item-name">Website Redesign</span>
                                                <span class="cs-mega-item-desc">Modernizing legacy web architectures</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                                <!-- Column 3: Speed & Modern Tech -->
                                <div class="cs-mega-col">
                                    <div class="cs-mega-col-title">
                                        <i class="fa-solid fa-bolt"></i>
                                        <span>Speed &amp; Modern Tech</span>
                                    </div>
                                    <ul class="cs-mega-list">
                                        <li>
                                            <a href="<?php echo esc_url(home_url('/services/website-speed-optimization/')); ?>" class="cs-mega-item-link">
                                                <span class="cs-mega-item-name">Speed Optimization</span>
                                                <span class="cs-mega-item-desc">Sub-second Core Web Vitals</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?php echo esc_url(home_url('/services/ai-web-development/')); ?>" class="cs-mega-item-link">
                                                <span class="cs-mega-item-name">AI Web Development</span>
                                                <span class="cs-mega-item-desc">Smart chatbots &amp; dynamic AI apps</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?php echo esc_url(home_url('/services/api-and-third-party-integrations/')); ?>" class="cs-mega-item-link">
                                                <span class="cs-mega-item-name">API &amp; REST Integrations</span>
                                                <span class="cs-mega-item-desc">Custom webhooks &amp; headless data</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?php echo esc_url(home_url('/services/gohighlevel-development/')); ?>" class="cs-mega-item-link">
                                                <span class="cs-mega-item-name">GoHighLevel (GHL)</span>
                                                <span class="cs-mega-item-desc">Custom CRM &amp; funnel pipelines</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                                <!-- Column 4: Callout Sidebar -->
                                <div class="cs-mega-callout">
                                    <div>
                                        <span class="cs-mega-callout-badge">Senior Access</span>
                                        <p class="cs-mega-callout-title">Direct Senior Craft</p>
                                        <p>Eliminate agency overhead. Collaborate directly with a 17+ year web architect.</p>
                                    </div>
                                    <a href="<?php echo esc_url(home_url('/services/')); ?>" class="cs-mega-callout-link">
                                        <span>View All 15 Services</span>
                                        <i class="fa-solid fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </li>

                        <li><a href="<?php echo esc_url(home_url('/portfolio/')); ?>">Portfolio</a></li>
                        <li><a href="<?php echo esc_url(home_url('/about-me/')); ?>">About</a></li>
                        <li><a href="<?php echo esc_url(home_url('/blog/')); ?>">Blog</a></li>

                        <!-- 2. Locations Mega Menu -->
                        <li class="cs-nav-item cs-has-mega">
                            <a href="<?php echo esc_url(home_url('/locations/')); ?>">
                                <span>Locations</span>
                                <i class="fa-solid fa-chevron-down cs-nav-arrow"></i>
                            </a>
                            <div class="cs-mega-menu cs-mega-locations">
                                <!-- US Hub -->
                                <div class="cs-mega-loc-col">
                                    <a href="<?php echo esc_url(home_url('/locations/united-states/')); ?>" class="cs-mega-loc-head">
                                        <i class="fa-solid fa-flag-usa"></i> United States
                                    </a>
                                    <ul class="cs-mega-loc-list">
                                        <li><a href="<?php echo esc_url(home_url('/locations/united-states/new-york/')); ?>">New York</a></li>
                                        <li><a href="<?php echo esc_url(home_url('/locations/united-states/los-angeles/')); ?>">Los Angeles</a></li>
                                        <li><a href="<?php echo esc_url(home_url('/locations/united-states/chicago/')); ?>">Chicago</a></li>
                                        <li><a href="<?php echo esc_url(home_url('/locations/united-states/austin/')); ?>">Austin</a></li>
                                        <li><a href="<?php echo esc_url(home_url('/locations/united-states/miami/')); ?>">Miami</a></li>
                                    </ul>
                                </div>

                                <!-- UK Hub -->
                                <div class="cs-mega-loc-col">
                                    <a href="<?php echo esc_url(home_url('/locations/united-kingdom/')); ?>" class="cs-mega-loc-head">
                                        <i class="fa-solid fa-landmark"></i> United Kingdom
                                    </a>
                                    <ul class="cs-mega-loc-list">
                                        <li><a href="<?php echo esc_url(home_url('/locations/united-kingdom/london/')); ?>">London</a></li>
                                        <li><a href="<?php echo esc_url(home_url('/locations/united-kingdom/manchester/')); ?>">Manchester</a></li>
                                        <li><a href="<?php echo esc_url(home_url('/locations/united-kingdom/birmingham/')); ?>">Birmingham</a></li>
                                        <li><a href="<?php echo esc_url(home_url('/locations/united-kingdom/edinburgh/')); ?>">Edinburgh</a></li>
                                        <li><a href="<?php echo esc_url(home_url('/locations/united-kingdom/bristol/')); ?>">Bristol</a></li>
                                    </ul>
                                </div>

                                <!-- Australia Hub -->
                                <div class="cs-mega-loc-col">
                                    <a href="<?php echo esc_url(home_url('/locations/australia/')); ?>" class="cs-mega-loc-head">
                                        <i class="fa-solid fa-sun"></i> Australia
                                    </a>
                                    <ul class="cs-mega-loc-list">
                                        <li><a href="<?php echo esc_url(home_url('/locations/australia/sydney/')); ?>">Sydney</a></li>
                                        <li><a href="<?php echo esc_url(home_url('/locations/australia/melbourne/')); ?>">Melbourne</a></li>
                                        <li><a href="<?php echo esc_url(home_url('/locations/australia/brisbane/')); ?>">Brisbane</a></li>
                                        <li><a href="<?php echo esc_url(home_url('/locations/australia/perth/')); ?>">Perth</a></li>
                                        <li><a href="<?php echo esc_url(home_url('/locations/australia/adelaide/')); ?>">Adelaide</a></li>
                                    </ul>
                                </div>

                                <!-- Philippines / Global Hub -->
                                <div class="cs-mega-loc-col">
                                    <a href="<?php echo esc_url(home_url('/locations/philippines/')); ?>" class="cs-mega-loc-head">
                                        <i class="fa-solid fa-globe"></i> Philippines &amp; Global
                                    </a>
                                    <ul class="cs-mega-loc-list">
                                        <li><a href="<?php echo esc_url(home_url('/locations/philippines/manila/')); ?>">Manila</a></li>
                                        <li><a href="<?php echo esc_url(home_url('/locations/philippines/cebu-city/')); ?>">Cebu City</a></li>
                                        <li><a href="<?php echo esc_url(home_url('/locations/philippines/bacolod/')); ?>">Bacolod City</a></li>
                                        <li><a href="<?php echo esc_url(home_url('/locations/philippines/davao-city/')); ?>">Davao City</a></li>
                                        <li><a href="<?php echo esc_url(home_url('/locations/philippines/baguio-city/')); ?>">Baguio City</a></li>
                                    </ul>
                                </div>

                                <!-- Footer All Locations Link -->
                                <div class="cs-mega-locations-footer">
                                    <span style="font-size: 0.82rem; color: #6b7280;">Collaborating across global timezones with business-hour overlap.</span>
                                    <a href="<?php echo esc_url(home_url('/locations/')); ?>" class="cs-mega-all-loc-link">
                                        <span>View All 100+ Locations Directory</span>
                                        <i class="fa-solid fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </li>

                        <li><a href="<?php echo esc_url(home_url('/contact/')); ?>">Contact</a></li>
                    </ul>
                    <?php
                }
                ?>
            </nav>

            <!-- Header Actions -->
            <div class="cs-header-actions">
                <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="cs-header-cta">
                    <span>Let’s Talk</span> <i class="fa-solid fa-arrow-right"></i>
                </a>
                <button type="button" class="cs-mobile-toggle" aria-label="Toggle navigation menu">
                    <i class="fa-solid fa-bars"></i>
                </button>
            </div>

        </div>
    </div>
</header>

<!-- Mobile Navigation Drawer -->
<div class="cs-drawer-overlay"></div>
<aside class="cs-mobile-drawer" aria-label="Mobile Navigation">
    <div class="cs-drawer-header">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="cs-header-logo">
            <img src="https://chadsia.com/wp-content/uploads/2024/10/logo-cds.webp" alt="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" class="cs-header-logo-img" width="697" height="359" style="height: 34px; width: auto;">
        </a>
        <button type="button" class="cs-drawer-close" aria-label="Close navigation menu">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>

    <ul class="cs-mobile-nav">
        <!-- Services Accordion -->
        <li class="cs-mobile-has-sub">
            <div class="cs-mobile-link-row">
                <a href="<?php echo esc_url(home_url('/services/')); ?>"><span>Services (15 Capabilities)</span></a>
                <button type="button" class="cs-mobile-sub-toggle" aria-label="Toggle Services submenu">
                    <i class="fa-solid fa-chevron-down"></i>
                </button>
            </div>
            <ul class="cs-mobile-sub-menu">
                <li><a href="<?php echo esc_url(home_url('/services/custom-wordpress-development/')); ?>">Custom WordPress Themes</a></li>
                <li><a href="<?php echo esc_url(home_url('/services/figma-to-wordpress/')); ?>">Figma to WordPress Code</a></li>
                <li><a href="<?php echo esc_url(home_url('/services/speed-optimization/')); ?>">Sub-Second Speed Tuning</a></li>
                <li><a href="<?php echo esc_url(home_url('/services/core-web-vitals/')); ?>">Core Web Vitals Remediation</a></li>
                <li><a href="<?php echo esc_url(home_url('/services/headless-wordpress/')); ?>">Headless &amp; REST APIs</a></li>
                <li><a href="<?php echo esc_url(home_url('/services/woocommerce-development/')); ?>">WooCommerce Engineering</a></li>
                <li><a href="<?php echo esc_url(home_url('/services/')); ?>" style="color: var(--cs-primary) !important; font-weight: 700 !important;">Explore All 15 Services &rarr;</a></li>
            </ul>
        </li>

        <li><a href="<?php echo esc_url(home_url('/portfolio/')); ?>"><span>Portfolio</span> <i class="fa-solid fa-chevron-right" style="font-size: 0.8rem; opacity: 0.5;"></i></a></li>
        <li><a href="<?php echo esc_url(home_url('/about-me/')); ?>"><span>About Chad</span> <i class="fa-solid fa-chevron-right" style="font-size: 0.8rem; opacity: 0.5;"></i></a></li>
        <li><a href="<?php echo esc_url(home_url('/blog/')); ?>"><span>Blog &amp; Insights</span> <i class="fa-solid fa-chevron-right" style="font-size: 0.8rem; opacity: 0.5;"></i></a></li>

        <!-- Locations Accordion -->
        <li class="cs-mobile-has-sub">
            <div class="cs-mobile-link-row">
                <a href="<?php echo esc_url(home_url('/locations/')); ?>"><span>Locations Directory</span></a>
                <button type="button" class="cs-mobile-sub-toggle" aria-label="Toggle Locations submenu">
                    <i class="fa-solid fa-chevron-down"></i>
                </button>
            </div>
            <ul class="cs-mobile-sub-menu">
                <li><a href="<?php echo esc_url(home_url('/locations/united-states/')); ?>">United States Hub</a></li>
                <li><a href="<?php echo esc_url(home_url('/locations/united-kingdom/')); ?>">United Kingdom Hub</a></li>
                <li><a href="<?php echo esc_url(home_url('/locations/australia/')); ?>">Australia Hub</a></li>
                <li><a href="<?php echo esc_url(home_url('/locations/philippines/')); ?>">Philippines &amp; Global Hub</a></li>
                <li><a href="<?php echo esc_url(home_url('/locations/')); ?>" style="color: var(--cs-primary) !important; font-weight: 700 !important;">All 100+ Locations &rarr;</a></li>
            </ul>
        </li>

        <li><a href="<?php echo esc_url(home_url('/contact/')); ?>"><span>Contact</span> <i class="fa-solid fa-chevron-right" style="font-size: 0.8rem; opacity: 0.5;"></i></a></li>
    </ul>

    <div style="margin-top: auto; padding-top: 24px;">
        <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="cs-btn cs-btn-primary" style="width: 100%; justify-content: center; border-radius: 8px;">
            <span>Start a Project</span> <i class="fa-solid fa-arrow-right"></i>
        </a>
        <div style="display: flex; flex-direction: column; gap: 8px; text-align: center; margin-top: 16px; font-size: 0.88rem; color: var(--cs-text-light-muted);">
            <!--email_off--><a href="mailto:hello@chadsia.com" style="color: inherit; text-decoration: none;"><i class="fa-regular fa-envelope"></i> hello@chadsia.com</a><!--/email_off-->
            <a href="tel:+639947156382" style="color: inherit; text-decoration: none;"><i class="fa-solid fa-phone"></i> +63 9947156382</a>
        </div>
        <div style="display: flex; justify-content: center; gap: 12px; margin-top: 16px;">
            <a href="https://www.facebook.com/chadsiamedia" target="_blank" rel="noopener noreferrer" class="cs-social-icon" aria-label="Facebook Page"><i class="fa-brands fa-facebook-f"></i></a>
            <a href="https://www.linkedin.com/in/chadsiamedia/" target="_blank" rel="noopener noreferrer" class="cs-social-icon" aria-label="LinkedIn Profile"><i class="fa-brands fa-linkedin-in"></i></a>
            <a href="https://www.instagram.com/chadsiamedia/" target="_blank" rel="noopener noreferrer" class="cs-social-icon" aria-label="Instagram Profile"><i class="fa-brands fa-instagram"></i></a>
            <a href="https://github.com/chadfuse" target="_blank" rel="noopener noreferrer" class="cs-social-icon" aria-label="GitHub Profile"><i class="fa-brands fa-github"></i></a>
        </div>
    </div>
</aside>
