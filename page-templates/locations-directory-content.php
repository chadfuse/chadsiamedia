<?php
/**
 * Chad Sia Media - Locations Directory Content (Global Hubs & Strategic Markets)
 * Inspired by modern, interactive directory architectures (Qadra Studio style)
 * Features real-time live search, continent/country filter chips, interactive country accordions,
 * dynamic Philippine city links, global capability pillars, authentic portfolio reviews slider, and FAQs.
 */

if (!defined('ABSPATH')) {
    exit;
}

$post_id = get_the_ID() ?: get_queried_object_id();

// 1. Dynamic Experience Calculation (Started 2009)
$years_exp_str = do_shortcode('[cs_years_experience]') ?: '17+';
$start_year    = do_shortcode('[cs_start_year]') ?: '2009';

// 2. Query Live Philippine Location Pages from WordPress
$ph_pages = get_posts([
    'post_type'      => 'page',
    'post_status'    => 'publish',
    'posts_per_page' => -1,
    'post_parent'    => 4670, // Philippines Country Hub ID
    'orderby'        => 'title',
    'order'          => 'ASC'
]);

if (empty($ph_pages)) {
    $ph_pages = get_posts([
        'post_type'      => 'page',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'orderby'        => 'title',
        'order'          => 'ASC',
        'meta_query'     => [
            [
                'key'     => '_wp_page_template',
                'value'   => ['template-location.php', 'page-templates/template-location.php'],
                'compare' => 'IN'
            ]
        ]
    ]);
}

// Build structured list of Philippine cities
$ph_cities = [];
foreach ($ph_pages as $p) {
    $title = get_the_title($p->ID);
    if ($title === 'Locations' || $p->ID == 3984 || $p->ID == 4670) continue;
    $clean_name = (function_exists('get_field') ? get_field('city_name', $p->ID) : '') ?: get_post_meta($p->ID, 'city_name', true);
    if (empty($clean_name)) {
        $clean_name = str_ireplace(['Web Design', 'Web Development', 'in', '·', 'Services'], '', $title);
    }
    $clean_name = trim($clean_name);
    if (!empty($clean_name)) {
        $ph_cities[] = [
            'name' => $clean_name,
            'url'  => get_permalink($p->ID)
        ];
    }
}

// Fallback if none found
if (empty($ph_cities)) {
    $default_ph = ['Bacolod', 'Cebu City', 'Davao City', 'Iloilo City', 'Makati', 'Manila', 'Quezon City', 'Taguig', 'Cagayan de Oro', 'Baguio', 'Angeles City', 'General Santos', 'Dumaguete', 'San Fernando', 'Zamboanga'];
    foreach ($default_ph as $c) {
        $ph_cities[] = [
            'name' => $c,
            'url'  => '/locations/philippines/' . sanitize_title($c) . '/'
        ];
    }
}

// 3. Country & Region Data Structures (Top Strategic Markets)
$countries_directory = [
    [
        'code'      => 'US',
        'name'      => 'United States',
        'continent' => 'Americas',
        'tag'       => 'North America · Primary Market',
        'desc'      => 'Bespoke WordPress engineering, sub-second PageSpeed, and AI automation for US scaling tech startups, B2B enterprises, and modern agencies across all 4 timezones (EST, CST, MST, PST).',
        'hub_url'   => '/locations/united-states/',
        'regions'   => [
            ['name' => 'New York City, NY', 'url' => '/locations/united-states/new-york/', 'highlight' => true],
            ['name' => 'San Francisco & Silicon Valley, CA', 'url' => '/locations/united-states/san-francisco/', 'highlight' => true],
            ['name' => 'Los Angeles, CA', 'url' => '/locations/united-states/los-angeles/', 'highlight' => true],
            ['name' => 'Austin, TX', 'url' => '/locations/united-states/austin/', 'highlight' => true],
            ['name' => 'Chicago, IL', 'url' => '/locations/united-states/chicago/', 'highlight' => false],
            ['name' => 'Seattle, WA', 'url' => '/locations/united-states/seattle/', 'highlight' => false],
            ['name' => 'Miami, FL', 'url' => '/locations/united-states/miami/', 'highlight' => false],
            ['name' => 'Boston, MA', 'url' => '/locations/united-states/boston/', 'highlight' => false],
            ['name' => 'Denver, CO', 'url' => '/locations/united-states/denver/', 'highlight' => false],
            ['name' => 'Atlanta, GA', 'url' => '/locations/united-states/atlanta/', 'highlight' => false],
            ['name' => 'Dallas-Fort Worth, TX', 'url' => '/locations/united-states/dallas/', 'highlight' => false],
            ['name' => 'San Diego, CA', 'url' => '/locations/united-states/san-diego/', 'highlight' => false]
        ]
    ],
    [
        'code'      => 'GB',
        'name'      => 'United Kingdom',
        'continent' => 'Europe',
        'tag'       => 'UK & Western Europe Hub',
        'desc'      => 'High-converting digital architecture and custom WordPress solutions built to UK accessibility standards (WCAG) and sub-second European CDN performance.',
        'hub_url'   => '/locations/united-kingdom/',
        'regions'   => [
            ['name' => 'London', 'url' => '/locations/united-kingdom/london/', 'highlight' => true],
            ['name' => 'Manchester', 'url' => '/locations/united-kingdom/manchester/', 'highlight' => true],
            ['name' => 'Birmingham', 'url' => '/locations/united-kingdom/birmingham/', 'highlight' => false],
            ['name' => 'Edinburgh', 'url' => '/locations/united-kingdom/edinburgh/', 'highlight' => true],
            ['name' => 'Bristol', 'url' => '/locations/united-kingdom/bristol/', 'highlight' => false],
            ['name' => 'Leeds', 'url' => '/locations/united-kingdom/leeds/', 'highlight' => false],
            ['name' => 'Glasgow', 'url' => '/locations/united-kingdom/glasgow/', 'highlight' => false],
            ['name' => 'Cambridge', 'url' => '/locations/united-kingdom/cambridge/', 'highlight' => false],
            ['name' => 'Liverpool', 'url' => '/locations/united-kingdom/liverpool/', 'highlight' => false],
            ['name' => 'Oxford', 'url' => '/locations/united-kingdom/oxford/', 'highlight' => false]
        ]
    ],
    [
        'code'      => 'AU',
        'name'      => 'Australia',
        'continent' => 'Asia-Pacific',
        'tag'       => 'Oceania / Trans-Tasman Hub',
        'desc'      => 'Proven track record engineering high-speed front-ends, clean Gutenberg blocks, and scalable web apps for leading Australian businesses and SaaS platforms.',
        'hub_url'   => '/locations/australia/',
        'regions'   => [
            ['name' => 'Sydney, NSW', 'url' => '/locations/australia/sydney/', 'highlight' => true],
            ['name' => 'Melbourne, VIC', 'url' => '/locations/australia/melbourne/', 'highlight' => true],
            ['name' => 'Brisbane, QLD', 'url' => '/locations/australia/brisbane/', 'highlight' => true],
            ['name' => 'Perth, WA', 'url' => '/locations/australia/perth/', 'highlight' => false],
            ['name' => 'Adelaide, SA', 'url' => '/locations/australia/adelaide/', 'highlight' => false],
            ['name' => 'Gold Coast, QLD', 'url' => '/locations/australia/gold-coast/', 'highlight' => false],
            ['name' => 'Canberra, ACT', 'url' => '/locations/australia/canberra/', 'highlight' => false],
            ['name' => 'Newcastle, NSW', 'url' => '/locations/australia/newcastle/', 'highlight' => false],
            ['name' => 'Sunshine Coast, QLD', 'url' => '/locations/australia/sunshine-coast/', 'highlight' => false],
            ['name' => 'Wollongong, NSW', 'url' => '/locations/australia/wollongong/', 'highlight' => false]
        ]
    ],
    [
        'code'      => 'PH',
        'name'      => 'Philippines',
        'continent' => 'Asia-Pacific',
        'tag'       => 'Domestic National Network (' . count($ph_cities) . '+ Cities)',
        'desc'      => 'Full national coverage across Luzon, Visayas, and Mindanao. Deep localized SEO, mobile-first optimization, and high-converting WordPress development.',
        'hub_url'   => '/locations/philippines/',
        'regions'   => $ph_cities
    ],
    [
        'code'      => 'CA',
        'name'      => 'Canada',
        'continent' => 'Americas',
        'tag'       => 'North America · Strategic Tech Hub',
        'desc'      => 'Delivering high-velocity web engineering for tech companies, eCommerce stores, and service leaders across Canada, featuring sub-second load times and custom block architectures.',
        'hub_url'   => '/locations/canada/',
        'regions'   => [
            ['name' => 'Toronto, ON', 'url' => '/locations/canada/toronto/', 'highlight' => true],
            ['name' => 'Vancouver, BC', 'url' => '/locations/canada/vancouver/', 'highlight' => true],
            ['name' => 'Montreal, QC', 'url' => '/locations/canada/montreal/', 'highlight' => false],
            ['name' => 'Calgary, AB', 'url' => '/locations/canada/calgary/', 'highlight' => false]
        ]
    ]
];

// Calculate total regions
$total_regions_count = 0;
foreach ($countries_directory as $c) {
    $total_regions_count += count($c['regions']);
}

// 4. Portfolio Reviews for Global Directory
$portfolio_reviews = [
    [
        'name'     => 'James T.',
        'role'     => 'Founder & Keynote Speaker',
        'company'  => 'JT Keynote (United States)',
        'initials' => 'JT',
        'rating'   => 5,
        'review'   => 'Working with Chad was a fantastic experience. He transformed our outdated website into a sleek, modern, and responsive platform that has greatly improved our user engagement across US corporate clients.',
        'tag'      => 'Custom WordPress & UI/UX'
    ],
    [
        'name'     => 'SolarPlus Australia',
        'role'     => 'Engineering Partner',
        'company'  => 'SolarPlus Platform (Australia)',
        'initials' => 'SP',
        'rating'   => 5,
        'review'   => 'Chad engineered a responsive, high-speed, and accessible front-end architecture for our Australian solar platform. Sub-second performance, pixel-perfect Figma translation, and seamless user workflows.',
        'tag'      => 'Web App & Front-End Architecture'
    ],
    [
        'name'     => 'Jeff L.',
        'role'     => 'Managing Director',
        'company'  => 'Frasso Inc. (North America)',
        'initials' => 'JL',
        'rating'   => 5,
        'review'   => 'We needed a complete overhaul of our user interface, and Chad delivered beyond our wildest expectations. We’ve seen a 30% increase in customer satisfaction since launching the new site!',
        'tag'      => 'UI/UX & Front-End Engineering'
    ],
    [
        'name'     => 'Janelle Cruz',
        'role'     => 'Operations Lead',
        'company'  => 'SpeakersU Global',
        'initials' => 'JC',
        'rating'   => 5,
        'review'   => 'Working with Chad was seamless across time zones. He quickly understood our international growth goals and delivered a website that brings in consistent qualified leads every single week.',
        'tag'      => 'Lead Funnels & Conversion UX'
    ],
    [
        'name'     => 'Mark Reyes',
        'role'     => 'Founder',
        'company'  => 'Iloilo Food Hub (Philippines)',
        'initials' => 'MR',
        'rating'   => 5,
        'review'   => 'Our website went from outdated to outstanding. Chad’s attention to detail, sub-second speed optimization, and local entity search optimization made a huge difference in our brand visibility.',
        'tag'      => 'Local Entity SEO & Speed'
    ]
];

// 5. FAQs for Global Directory
$directory_faqs = [
    [
        'q' => 'How does Chad Sia Media collaborate with international clients across US, UK, and Australian timezones?',
        'a' => 'We maintain dedicated overlapping communication windows for North American (PST/EST), European (GMT), and Australian (AEST) business hours. Communication is managed transparently through Slack, WhatsApp, Google Meet, and organized sprint dashboards—providing faster turnaround and clearer updates than traditional multi-layered agencies.'
    ],
    [
        'q' => 'Do you build custom WordPress architectures or use pre-made off-the-shelf templates?',
        'a' => 'Every website is engineered custom from the ground up using lightweight PHP, clean HTML5, and bespoke Gutenberg/ACF Pro blocks. We never use bloated multi-purpose themes or heavy visual builders like Elementor or Divi, ensuring pristine code quality, sub-second load times, and complete code ownership.'
    ],
    [
        'q' => 'What performance and Core Web Vitals guarantees do you offer for global sites?',
        'a' => 'All our client builds are optimized for 90+ Google PageSpeed scores, sub-second Time to First Byte (TTFB), and global CDN asset routing. This ensures your international visitors experience instant page rendering regardless of whether they access your site from New York, London, Sydney, or Manila.'
    ],
    [
        'q' => 'How does your AI Automation and Answer Engine Optimization (AEO) work for international businesses?',
        'a' => 'Beyond standard Google SEO, we structure your website data with deep Schema.org JSON-LD entity graphs, semantic markdown, and AI answer capsules. This enables modern AI answer engines like ChatGPT Search, Perplexity AI, and Google AI Overviews to easily cite and recommend your brand for high-intent queries.'
    ],
    [
        'q' => 'What is the typical timeline and process to launch a custom website with Chad Sia Media?',
        'a' => 'Most custom WordPress builds take between 2 to 4 weeks from initial discovery call and Figma design to full deployment and Core Web Vitals testing. You work directly with a senior engineer with ' . $years_exp_str . ' years of direct craft.'
    ]
];
?>

<!-- FontAwesome 6 Free CDN for crisp vector icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- BULLETPROOF INLINE STYLING SYSTEM (Light Aesthetic Matching chadsia.com) -->
<style id="cs-directory-styles-inline">
@import url('https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,400..700;1,9..40,400..700&family=Outfit:wght@500;600;700;800&display=swap');

.cs-dir-wrapper {
  --cs-bg: #f5f5f7;
  --cs-bg-subtle: #f8fafc;
  --cs-border: #e5e7eb;
  --cs-border-light: #edf2f7;
  --cs-primary: #4968f8;
  --cs-primary-hover: #3553eb;
  --cs-primary-light: #eef2ff;
  --cs-primary-text: #1d4ed8;
  --cs-gold: #f59e0b;
  --cs-heading: #111827;
  --cs-heading-dark: #09090b;
  --cs-text: #1f2937;
  --cs-text-muted: #52525b;
  --cs-text-faint: #52525b;
  --cs-font: 'DM Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
  --cs-font-display: 'Outfit', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
  --cs-radius-sm: 8px;
  --cs-radius-md: 12px;
  --cs-radius-lg: 16px;
  --cs-radius-full: 9999px;
  --cs-shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.04);
  --cs-shadow-md: 0 8px 24px -4px rgba(0, 0, 0, 0.06);
  --cs-shadow-lg: 0 20px 40px -8px rgba(0, 0, 0, 0.08);
  --cs-ease: cubic-bezier(0.16, 1, 0.3, 1);

  background: var(--cs-bg);
  color: var(--cs-text);
  font-family: var(--cs-font);
  line-height: 1.65;
  font-size: 16px;
  -webkit-font-smoothing: antialiased;
  padding-bottom: 60px;
  overflow-wrap: break-word;
}

.cs-dir-wrapper h1,
.cs-dir-wrapper h2,
.cs-dir-wrapper h3,
.cs-dir-hero-title,
.cs-dir-sec-title,
.cs-country-title {
  font-family: var(--cs-font-display);
  letter-spacing: -0.02em;
  font-weight: 700;
  overflow-wrap: break-word;
}

/* Clean Eyebrow Typography (No Pill Container) */
.cs-dir-wrapper .cs-badge,
.cs-dir-wrapper .cs-eyebrow {
  display: inline-block;
  font-size: 13px;
  font-weight: 700;
  letter-spacing: normal;
  text-transform: none;
  color: var(--cs-primary-text);
  background: transparent !important;
  padding: 0 !important;
  border-radius: 0 !important;
  margin-bottom: 12px;
  line-height: 1.4;
  box-shadow: none !important;
  border: none !important;
}

.cs-dir-wrapper .cs-badge-dot {
  display: none !important;
}

/* Accessible Focus-Visible Navigation (WCAG 2.4.7 AA) */
.cs-dir-wrapper a:focus-visible,
.cs-dir-wrapper button:focus-visible,
.cs-dir-wrapper [type="button"]:focus-visible,
.cs-dir-wrapper [type="submit"]:focus-visible,
.cs-dir-wrapper summary:focus-visible,
.cs-dir-wrapper input:focus-visible {
  outline: 2px solid var(--cs-primary) !important;
  outline-offset: 3px !important;
  border-radius: var(--cs-radius-sm);
}


@media (prefers-reduced-motion: reduce) {
  .cs-dir-wrapper *,
  .cs-dir-wrapper *::before,
  .cs-dir-wrapper *::after {
    animation-duration: 0.01ms !important;
    animation-iteration-count: 1 !important;
    transition-duration: 0.01ms !important;
    scroll-behavior: auto !important;
  }
}

.cs-dir-container {
  max-width: 1240px;
  margin: 0 auto;
  padding: 0 24px;
}

.cs-dir-section-alt {
  background: var(--cs-bg-subtle);
  border-top: 1px solid var(--cs-border);
  border-bottom: 1px solid var(--cs-border);
}

/* Breadcrumbs */
.cs-dir-breadcrumbs {
  padding: 24px 0 12px;
  font-size: 13px;
}
.cs-dir-breadcrumbs ol {
  display: flex;
  gap: 8px;
  align-items: center;
  list-style: none;
  padding: 0;
  margin: 0;
  flex-wrap: wrap;
}
.cs-dir-breadcrumbs li {
  display: flex;
  align-items: center;
  gap: 8px;
  color: var(--cs-text-muted);
}
.cs-dir-breadcrumbs li:not(:last-child)::after {
  content: "/";
  color: var(--cs-text-faint);
  font-size: 11px;
}
.cs-dir-breadcrumbs a {
  color: var(--cs-text-muted);
  text-decoration: none;
  transition: color 0.2s var(--cs-ease);
}
.cs-dir-breadcrumbs a:hover {
  color: var(--cs-primary);
}
.cs-dir-breadcrumbs li[aria-current="page"] {
  color: var(--cs-heading);
  font-weight: 600;
}

/* Badges & Section Titles */
.cs-badge,
.cs-eyebrow {
  display: inline-block;
  font-size: 13px;
  font-weight: 700;
  letter-spacing: normal;
  text-transform: none;
  color: var(--cs-primary-text);
  background: transparent !important;
  padding: 0 !important;
  border-radius: 0 !important;
  margin-bottom: 12px;
  line-height: 1.4;
  box-shadow: none !important;
  border: none !important;
}

.cs-badge-dot {
  display: none !important;
}

.cs-sec-heading-group {
  text-align: center;
  max-width: 780px;
  margin: 0 auto 50px;
}

.cs-sec-title {
  font-size: clamp(28px, 3.5vw, 40px);
  font-weight: 800;
  color: var(--cs-heading);
  line-height: 1.35;
  margin-bottom: 16px;
  letter-spacing: -0.01em;
}

.cs-sec-sub {
  font-size: 17px;
  color: var(--cs-text);
  line-height: 1.65;
  margin: 0 auto;
  max-width: 65ch;
}

.cs-highlight {
  color: var(--cs-primary);
  position: relative;
}

/* Buttons */
.cs-btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 10px;
  font-size: 15px;
  font-weight: 700;
  padding: 14px 28px;
  border-radius: var(--cs-radius-sm);
  text-decoration: none;
  transition: all 0.25s var(--cs-ease);
  cursor: pointer;
  line-height: 1;
}

.cs-btn-primary {
  background: var(--cs-primary);
  color: #ffffff !important;
  border: 1px solid var(--cs-primary);
  box-shadow: 0 4px 14px rgba(73, 104, 248, 0.25);
}
.cs-btn-primary:hover {
  background: var(--cs-primary-hover);
  border-color: var(--cs-primary-hover);
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(73, 104, 248, 0.35);
}

.cs-btn-outline {
  background: #ffffff;
  color: var(--cs-heading);
  border: 1.5px solid var(--cs-border);
}
.cs-btn-outline:hover {
  background: var(--cs-bg-subtle);
  border-color: #cbd5e1;
  color: var(--cs-primary);
  transform: translateY(-2px);
}

.cs-btn-arrow {
  transition: transform 0.2s var(--cs-ease);
}
.cs-btn:hover .cs-btn-arrow {
  transform: translateX(3px);
}

/* Hero Section */
.cs-dir-hero {
  padding: 50px 0 70px;
  text-align: center;
}

.cs-dir-hero-inner {
  max-width: 880px;
  margin: 0 auto;
}

.cs-dir-hero-title {
  font-size: clamp(34px, 4.4vw, 52px);
  font-weight: 800;
  color: var(--cs-heading);
  line-height: 1.15;
  letter-spacing: -0.02em;
  margin: 0 0 20px;
}

.cs-dir-hero-sub {
  font-size: 18px;
  color: var(--cs-text);
  line-height: 1.65;
  margin: 0 auto 32px;
  max-width: 740px;
}

.cs-dir-hero-ctas {
  display: flex;
  gap: 16px;
  justify-content: center;
  align-items: center;
  flex-wrap: wrap;
  margin-bottom: 40px;
}

/* Quick Stats Row in Hero */
.cs-dir-stats-row {
  display: flex;
  justify-content: center;
  gap: 36px;
  padding: 24px 32px;
  background: var(--cs-bg-subtle);
  border: 1px solid var(--cs-border);
  border-radius: var(--cs-radius-md);
  max-width: 760px;
  margin: 0 auto;
  box-shadow: var(--cs-shadow-sm);
  flex-wrap: wrap;
}

.cs-dir-stat-item {
  display: flex;
  flex-direction: column;
  align-items: center;
}

.cs-dir-stat-num {
  font-size: 26px;
  font-weight: 800;
  color: var(--cs-primary);
  line-height: 1.1;
}

.cs-dir-stat-lbl {
  font-size: 12px;
  font-weight: 600;
  color: var(--cs-text-muted);
  text-transform: none;
  letter-spacing: 0.04em;
  margin-top: 4px;
}

/* =========================================================================
   INTERACTIVE DIRECTORY & SEARCH CONTROLS (Qadra Style)
   ========================================================================= */
.cs-dir-engine {
  padding: 80px 0;
}

.cs-dir-controls {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 20px;
  margin-bottom: 36px;
  flex-wrap: wrap;
}

.cs-dir-chips {
  display: flex;
  gap: 8px;
  flex-wrap: wrap;
}

.cs-dir-chip {
  padding: 8px 18px;
  border-radius: 9999px;
  background: #ffffff !important;
  border: 1px solid #e2e8f0 !important;
  color: var(--cs-text) !important;
  font-size: 14px;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.2s var(--cs-ease);
  font-family: var(--cs-font);
}

.cs-dir-chip:hover {
  border-color: var(--cs-primary) !important;
  color: var(--cs-primary) !important;
}

.cs-dir-chip.active,
button.cs-dir-chip.active,
a.cs-dir-chip.active {
  background: var(--cs-primary) !important;
  background-color: var(--cs-primary) !important;
  border-color: var(--cs-primary) !important;
  color: #ffffff !important;
  box-shadow: 0 2px 10px rgba(73, 104, 248, 0.25) !important;
}

.cs-dir-count-badge {
  font-size: 13px;
  font-weight: 700;
  color: var(--cs-text-muted);
  white-space: nowrap;
}

/* Accordion Country List */
.cs-dir-list {
  display: flex;
  flex-direction: column;
  gap: 20px;
}

.cs-country-card {
  background: #ffffff;
  border: 1px solid var(--cs-border);
  border-radius: var(--cs-radius-lg);
  box-shadow: var(--cs-shadow-sm);
  overflow: hidden;
  transition: all 0.3s var(--cs-ease);
}

.cs-country-card:hover {
  box-shadow: var(--cs-shadow-md);
  border-color: #cbd5e1;
}

.cs-country-card.open {
  border-color: rgba(73, 104, 248, 0.4);
  box-shadow: 0 10px 30px -5px rgba(73, 104, 248, 0.08);
}

.cs-country-head {
  width: 100%;
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 24px 28px;
  background: none;
  border: none;
  text-align: left;
  cursor: pointer;
  gap: 20px;
  font-family: var(--cs-font);
  transition: background 0.2s var(--cs-ease);
}

.cs-country-head:hover {
  background: var(--cs-bg-subtle);
}

.cs-country-meta-left {
  display: flex;
  align-items: center;
  gap: 18px;
  flex: 1;
}

.cs-country-mono {
  width: 48px;
  height: 48px;
  border-radius: 12px;
  background: var(--cs-primary-light);
  border: 1.5px solid rgba(73, 104, 248, 0.25);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 16px;
  font-weight: 800;
  color: var(--cs-primary);
  flex-shrink: 0;
  letter-spacing: normal;
}

.cs-country-titles h3 {
  font-size: 20px;
  font-weight: 800;
  color: var(--cs-heading);
  margin: 0 0 4px;
  line-height: 1.35;
}

.cs-country-tag {
  font-size: 12px;
  font-weight: 600;
  color: var(--cs-text-muted);
  text-transform: none;
  letter-spacing: 0.04em;
}

.cs-country-meta-right {
  display: flex;
  align-items: center;
  gap: 16px;
}

.cs-country-count-pill {
  font-size: 12px;
  font-weight: 700;
  color: var(--cs-primary);
  background: var(--cs-primary-light);
  padding: 6px 14px;
  border-radius: var(--cs-radius-full);
  white-space: nowrap;
}

.cs-country-chev {
  width: 36px;
  height: 36px;
  border-radius: 50%;
  border: 1px solid var(--cs-border);
  display: flex;
  align-items: center;
  justify-content: center;
  color: var(--cs-text-muted);
  transition: all 0.3s var(--cs-ease);
  flex-shrink: 0;
}

.cs-country-card.open .cs-country-chev {
  transform: rotate(180deg);
  background: var(--cs-primary);
  border-color: var(--cs-primary);
  color: #ffffff;
}

/* Accordion Panel Body */
.cs-country-body {
  display: none;
  border-top: 1px solid var(--cs-border-light);
}

.cs-country-card.open .cs-country-body {
  display: block !important;
  max-height: none !important;
  height: auto !important;
  overflow: visible !important;
}

.cs-country-content {
  overflow: visible;
  padding: 28px 28px 36px !important;
  background: #ffffff;
}

.cs-country-desc {
  font-size: 15px;
  color: var(--cs-text);
  line-height: 1.65;
  margin: 0 0 24px;
  max-width: 820px;
}

.cs-regions-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
  gap: 12px;
  margin-bottom: 24px;
}

.cs-region-chip {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 12px 16px;
  background: var(--cs-bg-subtle);
  border: 1px solid var(--cs-border);
  border-radius: var(--cs-radius-sm);
  color: var(--cs-heading);
  text-decoration: none;
  font-size: 14px;
  font-weight: 600;
  transition: all 0.2s var(--cs-ease);
}

.cs-region-chip i {
  font-size: 12px;
  color: var(--cs-text-faint);
  transition: transform 0.2s var(--cs-ease), color 0.2s;
}

.cs-region-chip:hover {
  background: var(--cs-primary-light);
  border-color: var(--cs-primary);
  color: var(--cs-primary);
  transform: translateY(-2px);
  box-shadow: var(--cs-shadow-sm);
}

.cs-region-chip:hover span {
  color: var(--cs-primary);
}

.cs-region-chip:hover i {
  color: var(--cs-primary);
  transform: translateX(3px);
}

.cs-region-chip.highlight {
  border-color: rgba(73, 104, 248, 0.4);
  background: #ffffff;
}

.cs-region-chip.highlight i {
  color: var(--cs-primary);
}

.cs-country-hub-badge {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  font-size: 13px;
  font-weight: 700;
  color: var(--cs-primary);
  background: var(--cs-primary-light);
  border: 1px solid rgba(73, 104, 248, 0.3);
  padding: 6px 14px;
  border-radius: var(--cs-radius-full);
  text-decoration: none;
  transition: all 0.2s var(--cs-ease);
}

.cs-country-hub-badge:hover {
  background: var(--cs-primary);
  color: #ffffff;
  border-color: var(--cs-primary);
  transform: translateY(-1px);
}

.cs-country-cta-row {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding-top: 18px;
  border-top: 1px solid var(--cs-border-light);
  flex-wrap: wrap;
  gap: 16px;
}

.cs-country-hub-btn {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  font-size: 14px;
  font-weight: 700;
  color: #ffffff;
  background: var(--cs-primary);
  padding: 10px 20px;
  border-radius: var(--cs-radius-sm);
  text-decoration: none;
  transition: all 0.2s var(--cs-ease);
}

.cs-country-hub-btn:hover {
  background: var(--cs-primary-hover);
  color: #ffffff;
  transform: translateY(-1px);
  box-shadow: var(--cs-shadow-sm);
}

.cs-country-cta-link {
  font-size: 14px;
  font-weight: 700;
  color: var(--cs-primary);
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  gap: 6px;
}

.cs-country-cta-link:hover {
  text-decoration: underline;
}

/* Empty State */
.cs-dir-empty {
  display: none;
  text-align: center;
  padding: 60px 20px;
  background: var(--cs-bg-subtle);
  border: 1px dashed var(--cs-border);
  border-radius: var(--cs-radius-md);
  margin-top: 20px;
}

.cs-dir-empty i {
  font-size: 36px;
  color: var(--cs-text-faint);
  margin-bottom: 16px;
}

.cs-dir-empty h4 {
  font-size: 18px;
  color: var(--cs-heading);
  margin: 0 0 8px;
}

.cs-dir-empty p {
  font-size: 14px;
  color: var(--cs-text-muted);
  margin: 0;
}

/* =========================================================================
   GLOBAL VALUE PROPOSITION (Why Global Clients Choose Chad Sia Media)
   ========================================================================= */
.cs-dir-why {
  padding: 85px 0;
}

.cs-why-grid-4 {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 24px;
}

.cs-why-card {
  background: #ffffff;
  border: 1px solid var(--cs-border);
  border-radius: var(--cs-radius-lg);
  padding: 30px 24px;
  box-shadow: var(--cs-shadow-sm);
  position: relative;
  transition: all 0.3s var(--cs-ease);
}

.cs-why-card:hover {
  transform: translateY(-4px);
  box-shadow: var(--cs-shadow-md);
  border-color: #cbd5e1;
}

.cs-why-badge-num {
  font-size: 12px;
  font-weight: 800;
  color: var(--cs-primary);
  background: var(--cs-primary-light);
  display: inline-block;
  padding: 4px 10px;
  border-radius: var(--cs-radius-full);
  margin-bottom: 16px;
}

.cs-why-card-icon {
  width: 44px;
  height: 44px;
  border-radius: 10px;
  background: var(--cs-primary-light);
  color: var(--cs-primary);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 20px;
  margin-bottom: 16px;
}

.cs-why-card h3 {
  font-size: 18px;
  font-weight: 700;
  color: var(--cs-heading);
  margin: 0 0 10px;
  line-height: 1.3;
}

.cs-why-card p {
  font-size: 14px;
  color: var(--cs-text);
  line-height: 1.6;
  margin: 0;
}

/* =========================================================================
   GLOBAL REVIEWS SLIDER
   ========================================================================= */
.cs-dir-reviews {
  padding: 85px 0;
  position: relative;
  overflow: hidden;
}

.cs-slider-header-wrap {
  display: flex;
  align-items: flex-end;
  justify-content: space-between;
  margin-bottom: 40px;
  gap: 20px;
  flex-wrap: wrap;
}

.cs-slider-controls {
  display: flex;
  align-items: center;
  gap: 12px;
}

.cs-slider-btn {
  width: 46px;
  height: 46px;
  border-radius: 50%;
  border: 1.5px solid var(--cs-border);
  background: #ffffff;
  color: var(--cs-heading);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 16px;
  cursor: pointer;
  transition: all 0.2s var(--cs-ease);
  box-shadow: var(--cs-shadow-sm);
}

.cs-slider-btn:hover:not(:disabled) {
  background: var(--cs-primary);
  border-color: var(--cs-primary);
  color: #ffffff;
  transform: translateY(-2px);
  box-shadow: var(--cs-shadow-md);
}

.cs-slider-btn:disabled {
  opacity: 0.4;
  cursor: not-allowed;
}

.cs-reviews-viewport {
  overflow: hidden;
  width: 100%;
}

.cs-reviews-track {
  display: flex;
  gap: 24px;
  transition: transform 0.45s var(--cs-ease);
  will-change: transform;
}

.cs-review-card {
  flex: 0 0 calc((100% - 48px) / 3);
  background: #ffffff;
  border: 1px solid var(--cs-border);
  border-radius: var(--cs-radius-lg);
  padding: 32px 28px;
  box-shadow: var(--cs-shadow-sm);
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  box-sizing: border-box;
  transition: transform 0.25s var(--cs-ease), box-shadow 0.25s var(--cs-ease);
}

.cs-review-card:hover {
  transform: translateY(-3px);
  box-shadow: var(--cs-shadow-md);
}

.cs-review-stars {
  display: flex;
  gap: 4px;
  color: var(--cs-gold);
  font-size: 14px;
  margin-bottom: 16px;
}

.cs-review-text {
  font-size: 15px;
  color: var(--cs-text);
  line-height: 1.65;
  margin: 0 0 24px;
  flex-grow: 1;
}

.cs-review-author {
  display: flex;
  align-items: center;
  gap: 14px;
  border-top: 1px solid var(--cs-border-light);
  padding-top: 18px;
}

.cs-author-avatar {
  width: 44px;
  height: 44px;
  border-radius: 50%;
  background: var(--cs-primary-light);
  color: var(--cs-primary);
  font-weight: 800;
  font-size: 15px;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
}

.cs-author-meta strong {
  display: block;
  font-size: 15px;
  font-weight: 700;
  color: var(--cs-heading);
  line-height: 1.35;
}

.cs-author-meta span {
  display: block;
  font-size: 12px;
  color: var(--cs-text-muted);
}

.cs-review-tag {
  display: inline-block;
  font-size: 11px;
  font-weight: 700;
  text-transform: none;
  letter-spacing: normal;
  color: var(--cs-primary);
  background: var(--cs-primary-light);
  padding: 3px 8px;
  border-radius: 4px;
  margin-top: 4px;
}

.cs-slider-dots {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  margin-top: 32px;
}

.cs-slider-dot {
  width: 10px;
  height: 10px;
  border-radius: 50%;
  background: var(--cs-border);
  border: none;
  padding: 0;
  cursor: pointer;
  transition: all 0.25s var(--cs-ease);
}

.cs-slider-dot.active {
  width: 24px;
  border-radius: 10px;
  background: var(--cs-primary);
}

/* =========================================================================
   FAQS SECTION
   ========================================================================= */
.cs-dir-faqs {
  padding: 85px 0;
}

.cs-faq-list {
  max-width: 860px;
  margin: 0 auto;
  display: flex;
  flex-direction: column;
  gap: 20px;
}

.cs-faq-item {
  background: #ffffff;
  border: 1px solid var(--cs-border);
  border-radius: 20px;
  box-shadow: 0 2px 8px -2px rgba(0, 0, 0, 0.05);
  padding: 32px 36px;
  overflow: hidden;
  margin-bottom: 0;
  transition: all 0.25s var(--cs-ease);
}

.cs-faq-item:hover {
  border-color: #cbd5e1;
  box-shadow: 0 4px 16px -2px rgba(0, 0, 0, 0.08);
}

.cs-faq-btn {
  width: 100%;
  padding: 0 0 12px 0;
  margin: 0;
  display: block;
  background: none;
  border: none;
  cursor: default;
  pointer-events: none;
  text-align: left;
  font-family: var(--cs-font);
  box-sizing: border-box;
  line-height: 1.35;
  height: auto;
  min-height: auto;
  white-space: normal;
}

.cs-faq-q {
  font-size: 19px;
  font-weight: 800;
  color: var(--cs-heading);
  margin: 0 0 12px 0;
  padding: 0;
  line-height: 1.35;
  letter-spacing: -0.01em;
  font-family: var(--cs-font-display);
  text-align: left;
  display: block;
}

.cs-faq-icon {
  display: none !important;
}

.cs-faq-body,
.cs-faq-item.active .cs-faq-body {
  display: block !important;
  padding: 0;
  margin: 0;
}

.cs-faq-content {
  padding: 0;
  margin: 0;
  font-size: 16px;
  color: #374151;
  line-height: 1.7;
}

@keyframes csFaqSlide {
  from {
    opacity: 0;
    transform: translateY(-4px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.cs-faq-content,
.cs-faq-content p,
.cs-faq-content span,
.cs-faq-content div {
  padding: 0;
  margin: 0;
  font-size: 15px;
  color: #54595f !important;
  line-height: 1.7;
  visibility: visible !important;
  opacity: 1 !important;
}

.cs-faq-content {
  padding: 0 26px 22px;
}

/* =========================================================================
   BOTTOM CTA BANNER
   ========================================================================= */
.cs-dir-cta-banner {
  padding: 80px 0 20px;
}

.cs-cta-box {
  background: linear-gradient(135deg, #4968f8 0%, #596dd6 100%) !important;
  border-radius: 24px !important;
  padding: 64px 40px;
  text-align: center;
  color: #ffffff;
  position: relative;
  overflow: hidden;
  box-shadow: 0 20px 45px -10px rgba(73, 104, 248, 0.35);
}

.cs-cta-box .cs-eyebrow,
.cs-cta-box .cs-badge {
  color: #ffffff !important;
  background: transparent !important;
  font-size: 14px;
  font-weight: 600;
  margin-bottom: 14px;
  opacity: 0.95;
}

.cs-cta-box h2 {
  font-size: clamp(28px, 3.5vw, 42px);
  font-weight: 800;
  color: #ffffff !important;
  margin: 0 0 16px;
  letter-spacing: -0.02em;
  line-height: 1.3;
}

.cs-cta-box p {
  font-size: 18px;
  color: #ffffff !important;
  max-width: 65ch;
  margin: 0 auto 32px;
  line-height: 1.6;
  opacity: 0.95;
}

.cs-cta-box .cs-btn,
.cs-cta-box .cs-btn-primary,
.cs-cta-box a.cs-btn,
.cs-cta-box a.cs-btn-primary {
  background: #ffffff !important;
  color: #4968f8 !important;
  border: 2px solid #ffffff !important;
  font-weight: 700 !important;
  font-size: 16px !important;
  padding: 15px 36px !important;
  border-radius: 12px !important;
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12) !important;
  display: inline-flex !important;
  align-items: center !important;
  justify-content: center !important;
  gap: 10px !important;
  text-decoration: none !important;
  transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1) !important;
}

.cs-cta-box .cs-btn *,
.cs-cta-box a.cs-btn *,
.cs-cta-box .cs-btn-primary * {
  color: #4968f8 !important;
}

.cs-cta-box .cs-btn:hover,
.cs-cta-box .cs-btn:focus,
.cs-cta-box .cs-btn:active,
.cs-cta-box .cs-btn-primary:hover,
.cs-cta-box .cs-btn-primary:focus,
.cs-cta-box .cs-btn-primary:active,
.cs-cta-box a.cs-btn:hover,
.cs-cta-box a.cs-btn:focus,
.cs-cta-box a.cs-btn:active,
.cs-cta-box a.cs-btn-primary:hover,
.cs-cta-box a.cs-btn-primary:focus,
.cs-cta-box a.cs-btn-primary:active {
  background: #ffffff !important;
  color: #1e3a8a !important;
  border-color: #ffffff !important;
  transform: translateY(-2px) !important;
  box-shadow: 0 12px 28px rgba(0, 0, 0, 0.22) !important;
}

.cs-cta-box .cs-btn:hover *,
.cs-cta-box .cs-btn:focus *,
.cs-cta-box a.cs-btn:hover *,
.cs-cta-box a.cs-btn:focus *,
.cs-cta-box .cs-btn-primary:hover *,
.cs-cta-box .cs-btn-primary:focus * {
  color: #1e3a8a !important;
}

.cs-cta-box .cs-btn .cs-btn-arrow,
.cs-cta-box .cs-btn i,
.cs-cta-box a i {
  color: #4968f8 !important;
  transition: transform 0.2s ease, color 0.2s ease !important;
}

.cs-cta-box .cs-btn:hover .cs-btn-arrow,
.cs-cta-box .cs-btn:hover i,
.cs-cta-box a:hover i {
  color: #1e3a8a !important;
  transform: translateX(4px) !important;
}

/* Responsive Breakpoints */
@media (max-width: 1024px) {
  .cs-review-card {
    flex: 0 0 calc((100% - 24px) / 2);
  }
}

@media (max-width: 1080px) {
  .cs-why-grid-4 {
    grid-template-columns: repeat(2, 1fr);
  }
}

@media (max-width: 768px) {
  .cs-review-card {
    flex: 0 0 100%;
  }
  .cs-country-head {
    flex-direction: column;
    align-items: flex-start;
    gap: 14px;
    padding: 20px;
  }
  .cs-country-meta-right {
    width: 100%;
    justify-content: space-between;
  }
  .cs-country-content {
    padding: 20px;
  }
  .cs-regions-grid {
    grid-template-columns: 1fr;
  }
  .cs-dir-controls {
    flex-direction: column;
    align-items: stretch;
  }
  .cs-dir-stats-row {
    gap: 20px;
  }
}

@media (max-width: 640px) {
  .cs-why-grid-4 {
    grid-template-columns: 1fr;
  }
  .cs-dir-hero-ctas {
    flex-direction: column;
  }
  .cs-btn {
    width: 100%;
  }
  .cs-cta-box {
    padding: 40px 20px;
  }
}
</style>

<!-- DYNAMIC JSON-LD SCHEMAS (Global ProfessionalService + Breadcrumbs + FAQPage) -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@graph": [
    {
      "@type": "ProfessionalService",
      "@id": "https://chadsia.com/locations/#service",
      "name": "Chad Sia Media - Global Web Design & AI Automation",
      "url": "https://chadsia.com/locations/",
      "logo": "https://chadsia.com/wp-content/uploads/2024/10/logo-cds.webp",
      "image": "https://chadsia.com/wp-content/uploads/2026/05/AI-development-coding-1779610288.jpg",
      "telephone": "+639985456310",
      "email": "contact@chadsia.com",
      "description": "Chad Sia Media delivers bespoke WordPress web design, high-speed front-end development, and AI automation for ambitious companies in the United States, United Kingdom, Australia, and the Philippines.",
      "areaServed": [
        {"@type": "Country", "name": "United States"},
        {"@type": "Country", "name": "United Kingdom"},
        {"@type": "Country", "name": "Australia"},
        {"@type": "Country", "name": "Philippines"},
        {"@type": "Country", "name": "Canada"},
        {"@type": "Country", "name": "Singapore"}
      ]
    },
    {
      "@type": "BreadcrumbList",
      "itemListElement": [
        {
          "@type": "ListItem",
          "position": 1,
          "name": "Home",
          "item": "https://chadsia.com/"
        },
        {
          "@type": "ListItem",
          "position": 2,
          "name": "Locations & Strategic Markets",
          "item": "https://chadsia.com/locations/"
        }
      ]
    },
    {
      "@type": "FAQPage",
      "mainEntity": [
        <?php 
        $faq_schema = [];
        foreach ($directory_faqs as $f) {
            $faq_schema[] = json_encode([
                "@type" => "Question",
                "name" => $f['q'],
                "acceptedAnswer" => [
                    "@type" => "Answer",
                    "text" => $f['a']
                ]
            ]);
        }
        echo implode(',', $faq_schema);
        ?>
      ]
    }
  ]
}
</script>

<div class="cs-dir-wrapper">
  <!-- BREADCRUMBS -->
  <nav class="cs-dir-breadcrumbs" aria-label="Breadcrumbs">
    <div class="cs-dir-container">
      <ol>
        <li><a href="<?php echo esc_url(home_url('/')); ?>">Home</a></li>
        <li aria-current="page">Locations &amp; Global Hubs</li>
      </ol>
    </div>
  </nav>

  <!-- =========================================================================
       HERO SECTION: GLOBAL HUBS & CAPABILITIES
       ========================================================================= -->
  <header class="cs-dir-hero">
    <div class="cs-dir-container cs-dir-hero-inner">
      <div class="cs-eyebrow">Global Reach &amp; Strategic Markets</div>

      <h1 class="cs-dir-hero-title">
        Custom WordPress Web Design &amp; AI Automation <span class="cs-highlight">Worldwide</span>
      </h1>

      <p class="cs-dir-hero-sub">
        Partnering with scaling businesses, tech innovators, and modern brands across the United States, United Kingdom, Australia, and the Philippines. High-converting digital architecture with sub-second PageSpeed and <?php echo esc_html($years_exp_str); ?> years of senior engineering craft.
      </p>

      <div class="cs-dir-hero-ctas">
        <a href="/contact/" class="cs-btn cs-btn-primary">
          Book a Discovery Call <i class="fa-solid fa-arrow-right cs-btn-arrow"></i>
        </a>
        <a href="#directory" class="cs-btn cs-btn-outline">
          Explore Markets Directory <i class="fa-solid fa-globe"></i>
        </a>
      </div>

      <div class="cs-dir-stats-row">
        <div class="cs-dir-stat-item">
          <span class="cs-dir-stat-num"><?php echo esc_html($years_exp_str); ?></span>
          <span class="cs-dir-stat-lbl">Years Experience</span>
        </div>
        <div class="cs-dir-stat-item">
          <span class="cs-dir-stat-num">&lt; 0.8s</span>
          <span class="cs-dir-stat-lbl">Global TTFB Speed</span>
        </div>
        <div class="cs-dir-stat-item">
          <span class="cs-dir-stat-num">5+</span>
          <span class="cs-dir-stat-lbl">Core Countries</span>
        </div>
        <div class="cs-dir-stat-item">
          <span class="cs-dir-stat-num"><?php echo esc_html($total_regions_count); ?>+</span>
          <span class="cs-dir-stat-lbl">Strategic Markets</span>
        </div>
      </div>
    </div>
  </header>

  <!-- =========================================================================
       INTERACTIVE GLOBAL DIRECTORY ENGINE (Live Search + Continent Filter)
       ========================================================================= -->
  <section class="cs-dir-engine cs-dir-section-alt" id="directory">
    <div class="cs-dir-container">
      <div class="cs-sec-heading-group">
        <div class="cs-eyebrow">Countries &amp; Regional Hubs</div>
        <h2 class="cs-sec-title">Explore Where We Build &amp; Scale</h2>
        <p class="cs-sec-sub">Filter by region or search for your city to connect with our remote engineering studio.</p>
      </div>

      <div class="cs-dir-controls">
        <div class="cs-dir-chips" id="dirChips">
          <button type="button" class="cs-dir-chip active" data-filter="all">All Markets</button>
          <button type="button" class="cs-dir-chip" data-filter="united states">United States</button>
          <button type="button" class="cs-dir-chip" data-filter="united kingdom">United Kingdom</button>
          <button type="button" class="cs-dir-chip" data-filter="australia">Australia</button>
          <button type="button" class="cs-dir-chip" data-filter="philippines">Philippines</button>
          <button type="button" class="cs-dir-chip" data-filter="canada">Canada</button>
        </div>

        <div class="cs-dir-count-badge" id="dirCountBadge">
          <?php echo count($countries_directory); ?> Countries · <?php echo $total_regions_count; ?> Hubs
        </div>
      </div>

      <div class="cs-dir-list" id="dirGrid">
        <?php foreach ($countries_directory as $idx => $country): 
            $search_tokens = strtolower($country['name'] . ' ' . $country['code'] . ' ' . $country['continent'] . ' ' . implode(' ', array_column($country['regions'], 'name')));
        ?>
          <div class="cs-country-card <?php echo $idx === 0 ? 'open' : ''; ?>" data-continent="<?php echo esc_attr($country['continent']); ?>" data-country="<?php echo esc_attr(strtolower($country['name'])); ?>" data-search="<?php echo esc_attr($search_tokens); ?>">
            <div class="cs-country-head" role="button" tabindex="0" aria-expanded="<?php echo $idx === 0 ? 'true' : 'false'; ?>">
              <div class="cs-country-meta-left">
                <div class="cs-country-mono"><?php echo esc_html($country['code']); ?></div>
                <div class="cs-country-titles">
                  <h3><?php echo esc_html($country['name']); ?></h3>
                  <span class="cs-country-tag"><?php echo esc_html($country['tag']); ?></span>
                </div>
              </div>
              <div class="cs-country-meta-right">
                <a href="<?php echo esc_url($country['hub_url']); ?>" class="cs-country-hub-badge" onclick="event.stopPropagation();">
                  <span>View <?php echo esc_html($country['name']); ?> Hub</span>
                  <i class="fa-solid fa-arrow-up-right-from-square"></i>
                </a>
                <span class="cs-country-count-pill"><?php echo count($country['regions']); ?> Strategic Hubs</span>
                <div class="cs-country-chev"><i class="fa-solid fa-chevron-down"></i></div>
              </div>
            </div>

            <div class="cs-country-body">
              <div class="cs-country-content">
                <p class="cs-country-desc"><?php echo esc_html($country['desc']); ?></p>

                <div class="cs-regions-grid">
                  <?php foreach ($country['regions'] as $reg): 
                      $is_hl = !empty($reg['highlight']);
                  ?>
                    <a href="<?php echo esc_url($reg['url']); ?>" class="cs-region-chip <?php echo $is_hl ? 'highlight' : ''; ?>" data-rname="<?php echo esc_attr(strtolower($reg['name'])); ?>">
                      <span><?php echo esc_html($reg['name']); ?></span>
                      <i class="fa-solid fa-arrow-up-right-from-square"></i>
                    </a>
                  <?php endforeach; ?>
                </div>

                <div class="cs-country-cta-row">
                  <a href="<?php echo esc_url($country['hub_url']); ?>" class="cs-country-hub-btn">
                    <i class="fa-solid fa-globe"></i> Explore Full <?php echo esc_html($country['name']); ?> Country Hub <i class="fa-solid fa-arrow-right"></i>
                  </a>
                  <a href="/contact/?market=<?php echo esc_attr(strtolower($country['code'])); ?>" class="cs-country-cta-link">
                    Book <?php echo esc_html($country['name']); ?> Discovery Sprint <i class="fa-solid fa-arrow-right"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>

      <div class="cs-dir-empty" id="dirEmpty">
        <i class="fa-solid fa-earth-americas"></i>
        <p class="cs-dir-empty-title">No matching locations found</p>
        <p>Try searching for a different city, state, or country name, or reset the filter.</p>
      </div>
    </div>
  </section>

  <!-- =========================================================================
       GLOBAL ENGINEERING ADVANTAGES (Why Choose Chad Sia Media)
       ========================================================================= -->
  <section class="cs-dir-why">
    <div class="cs-dir-container">
      <div class="cs-sec-heading-group">
        <div class="cs-eyebrow">Global Standards</div>
        <h2 class="cs-sec-title">Why International Brands Partner With Chad Sia Media</h2>
        <p class="cs-sec-sub">Senior craft, direct developer access, and uncompromising speed without bloated agency overhead.</p>
      </div>

      <div class="cs-why-grid-4">
        <div class="cs-why-card">
          <div class="cs-why-badge-num">01</div>
          <div class="cs-why-card-icon"><i class="fa-solid fa-bolt"></i></div>
          <h3>Sub-Second Global Edge</h3>
          <p>Engineered with zero-bloat vanilla PHP and clean CSS. Distributed via global Edge CDNs for instantaneous load times across the Americas, Europe, and Asia.</p>
        </div>

        <div class="cs-why-card">
          <div class="cs-why-badge-num">02</div>
          <div class="cs-why-card-icon"><i class="fa-solid fa-user-gear"></i></div>
          <h3>Direct Senior Craft</h3>
          <p>No account managers or junior subcontractors. You work directly with a senior engineer with <?php echo esc_html($years_exp_str); ?> years of specialized WordPress and AI expertise.</p>
        </div>

        <div class="cs-why-card">
          <div class="cs-why-badge-num">03</div>
          <div class="cs-why-card-icon"><i class="fa-solid fa-clock"></i></div>
          <h3>Timezone Harmony</h3>
          <p>Strategic overlap with US (EST/PST), UK (GMT), and Australian (AEST) business hours. Fast Slack updates, transparent Git commits, and zero communication lag.</p>
        </div>

        <div class="cs-why-card">
          <div class="cs-why-badge-num">04</div>
          <div class="cs-why-card-icon"><i class="fa-solid fa-shield-halved"></i></div>
          <h3>100% Ownership &amp; Freedom</h3>
          <p>You own all your code, database, and assets outright. Zero recurring proprietary builder lock-in fees, clean open-source architecture, and unlimited scalability.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- =========================================================================
       ⭐ CENTRALIZED GOOGLE REVIEWS WIDGET (Rated 5.0 Trust Badge)
       ========================================================================= -->
  <?php 
  if (function_exists('cs_render_google_reviews')) {
      cs_render_google_reviews([
          'kicker' => 'Global Client Proof',
          'title'  => 'Rated 5.0 on Google Reviews'
      ]);
  } elseif (function_exists('cs_render_reviews_slider')) {
      cs_render_reviews_slider();
  }
  ?>

  <!-- =========================================================================
       FAQS SECTION (Global & Regional Inquiries)
       ========================================================================= -->
  <section class="cs-dir-faqs">
    <div class="cs-dir-container">
      <div class="cs-sec-heading-group">
        <div class="cs-eyebrow">Common Questions</div>
        <h2 class="cs-sec-title">Frequently Asked Questions</h2>
        <p class="cs-sec-sub">Everything you need to know about working with Chad Sia Media across international borders.</p>
      </div>

      <div class="cs-faq-list">
        <?php foreach ($directory_faqs as $index => $faq): ?>
          <div class="cs-faq-item <?php echo $index === 0 ? 'active' : ''; ?>">
            <button type="button" class="cs-faq-btn" onclick="csToggleFaq(this)" aria-expanded="<?php echo $index === 0 ? 'true' : 'false'; ?>">
              <h3 class="cs-faq-q"><?php echo esc_html($faq['q']); ?></h3>
              <span class="cs-faq-icon"><i class="fa-solid fa-chevron-down"></i></span>
            </button>
            <div class="cs-faq-body">
              <div class="cs-faq-content">
                <?php echo esc_html($faq['a']); ?>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- =========================================================================
       BOTTOM CALL TO ACTION BANNER
       ========================================================================= -->
  <section class="cs-dir-cta-banner">
    <div class="cs-dir-container">
      <div class="cs-cta-box">
        <h2>Ready to Scale Your Digital Presence Globally?</h2>
        <p>Let’s build a lightning-fast, high-converting WordPress website engineered to outpace your competition in any market.</p>
        <a href="/contact/" class="cs-btn cs-btn-primary">
          Book Your Discovery Call <i class="fa-solid fa-arrow-right cs-btn-arrow"></i>
        </a>
      </div>
    </div>
  </section>
</div>

<script id="cs-directory-scripts-inline">
function csToggleFaq(btn) {
  if (!btn) return;
  var item = btn.closest('.cs-faq-item');
  if (!item) return;
  var list = item.closest('.cs-faq-list') || item.parentElement;
  var isActive = item.classList.contains('active');

  if (list) {
    var activeItems = list.querySelectorAll('.cs-faq-item.active');
    for (var i = 0; i < activeItems.length; i++) {
      if (activeItems[i] !== item) {
        activeItems[i].classList.remove('active');
        var otherBtn = activeItems[i].querySelector('.cs-faq-btn');
        if (otherBtn) otherBtn.setAttribute('aria-expanded', 'false');
      }
    }
  }

  if (isActive) {
    item.classList.remove('active');
    btn.setAttribute('aria-expanded', 'false');
  } else {
    item.classList.add('active');
    btn.setAttribute('aria-expanded', 'true');
  }
}
window.csToggleFaq = csToggleFaq;

(function() {
  function initDirectoryEngine() {
    // 1. Directory Country Filter Logic
    const chipBtns = document.querySelectorAll('#dirChips .cs-dir-chip');
    const countryCards = document.querySelectorAll('#dirGrid .cs-country-card');
    const emptyState = document.getElementById('dirEmpty');
    const countBadge = document.getElementById('dirCountBadge');

    let currentFilter = 'all';

    function filterDirectory() {
      let visibleCountries = 0;
      let visibleHubs = 0;

      countryCards.forEach(card => {
        const continent = card.dataset.continent || '';
        const countryName = card.dataset.country || '';
        const regionChips = card.querySelectorAll('.cs-region-chip');

        // Check country/continent filter match
        let matchFilter = false;
        const filterLower = currentFilter.toLowerCase();
        if (filterLower === 'all') {
          matchFilter = true;
        } else if (countryName.includes(filterLower) || continent.toLowerCase().includes(filterLower)) {
          matchFilter = true;
        }

        regionChips.forEach(chip => chip.style.display = '');

        if (matchFilter) {
          card.style.display = '';
          visibleCountries++;
          visibleHubs += regionChips.length;
        } else {
          card.style.display = 'none';
        }
      });

      if (emptyState) {
        emptyState.style.display = visibleCountries === 0 ? 'block' : 'none';
      }

      if (countBadge) {
        countBadge.textContent = `${visibleCountries} Countries · ${visibleHubs} Hubs Shown`;
      }
    }

    chipBtns.forEach(btn => {
      btn.addEventListener('click', () => {
        chipBtns.forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        currentFilter = btn.dataset.filter || 'all';
        filterDirectory();
      });
    });

    // 2. Country Accordion Toggle
    countryCards.forEach(card => {
      const head = card.querySelector('.cs-country-head');
      const body = card.querySelector('.cs-country-body');

      if (head && body && !head.dataset.bound) {
        head.dataset.bound = 'true';
        head.addEventListener('click', (e) => {
          if (e.target.closest('a')) return;
          const isOpen = card.classList.contains('open');
          if (isOpen) {
            card.classList.remove('open');
            head.setAttribute('aria-expanded', 'false');
          } else {
            card.classList.add('open');
            head.setAttribute('aria-expanded', 'true');
          }
        });
        head.addEventListener('keydown', (e) => {
          if (e.key === 'Enter' || e.key === ' ') {
            if (e.target.closest('a')) return;
            e.preventDefault();
            head.click();
          }
        });
      }
    });

    // 3. FAQ Accordion (Delegated & Idempotent)
    if (!window.__csFaqAccordionInitialized) {
      window.__csFaqAccordionInitialized = true;
      document.addEventListener('click', (e) => {
        const btn = e.target.closest('.cs-faq-btn');
        if (!btn) return;
        
        e.preventDefault();
        const item = btn.closest('.cs-faq-item');
        if (!item) return;

        const list = item.closest('.cs-faq-list') || item.parentElement;
        const isCurrentlyActive = item.classList.contains('active');

        if (list) {
          list.querySelectorAll('.cs-faq-item.active').forEach(other => {
            if (other !== item) {
              other.classList.remove('active');
              const otherBtn = other.querySelector('.cs-faq-btn');
              if (otherBtn) otherBtn.setAttribute('aria-expanded', 'false');
            }
          });
        }

        if (isCurrentlyActive) {
          item.classList.remove('active');
          btn.setAttribute('aria-expanded', 'false');
        } else {
          item.classList.add('active');
          btn.setAttribute('aria-expanded', 'true');
        }
      });
    }

    // 4. Global Reviews Slider
    const slider = document.querySelector('.cs-reviews-slider');
    if (slider && !slider.dataset.bound) {
      slider.dataset.bound = 'true';
      const track = slider.querySelector('.cs-reviews-track');
      const prevBtn = document.querySelector('.cs-slider-btn.prev');
      const nextBtn = document.querySelector('.cs-slider-btn.next');
      const dotsContainer = slider.querySelector('.cs-slider-dots');
      const cards = slider.querySelectorAll('.cs-review-card');

      if (track && cards.length > 0) {
        let currentIndex = 0;
        let startX = 0;
        let isDragging = false;
        let autoPlayInterval = null;

        const getCardsPerView = () => {
          if (window.innerWidth >= 1024) return 3;
          if (window.innerWidth >= 720) return 2;
          return 1;
        };

        const getMaxIndex = () => {
          const perView = getCardsPerView();
          return Math.max(0, cards.length - perView);
        };

        const updateDots = () => {
          if (!dotsContainer) return;
          dotsContainer.innerHTML = '';
          const maxIndex = getMaxIndex();
          for (let i = 0; i <= maxIndex; i++) {
            const dot = document.createElement('button');
            dot.classList.add('cs-slider-dot');
            if (i === currentIndex) dot.classList.add('active');
            dot.setAttribute('aria-label', `Go to slide ${i + 1}`);
            dot.addEventListener('click', () => {
              goToSlide(i);
              resetAutoPlay();
            });
            dotsContainer.appendChild(dot);
          }
        };

        const updateSlider = () => {
          const maxIndex = getMaxIndex();
          if (currentIndex > maxIndex) currentIndex = maxIndex;
          const card = cards[0];
          const gap = 24;
          const cardWidth = card.offsetWidth + gap;
          const offset = -(currentIndex * cardWidth);
          track.style.transform = `translateX(${offset}px)`;

          if (prevBtn) prevBtn.disabled = currentIndex === 0;
          if (nextBtn) nextBtn.disabled = currentIndex >= maxIndex;

          if (dotsContainer) {
            const dots = dotsContainer.querySelectorAll('.cs-slider-dot');
            dots.forEach((dot, idx) => {
              dot.classList.toggle('active', idx === currentIndex);
            });
          }
        };

        const goToSlide = (index) => {
          const maxIndex = getMaxIndex();
          currentIndex = Math.max(0, Math.min(index, maxIndex));
          updateSlider();
        };

        if (prevBtn) {
          prevBtn.addEventListener('click', () => {
            goToSlide(currentIndex - 1);
            resetAutoPlay();
          });
        }

        if (nextBtn) {
          nextBtn.addEventListener('click', () => {
            const maxIndex = getMaxIndex();
            if (currentIndex >= maxIndex) {
              goToSlide(0);
            } else {
              goToSlide(currentIndex + 1);
            }
            resetAutoPlay();
          });
        }

        track.addEventListener('touchstart', (e) => {
          startX = e.touches[0].clientX;
          isDragging = true;
        }, { passive: true });

        track.addEventListener('touchend', (e) => {
          if (!isDragging) return;
          isDragging = false;
          const endX = e.changedTouches[0].clientX;
          const diffX = startX - endX;
          if (Math.abs(diffX) > 40) {
            if (diffX > 0) {
              goToSlide(currentIndex + 1);
            } else {
              goToSlide(currentIndex - 1);
            }
            resetAutoPlay();
          }
        }, { passive: true });

        const startAutoPlay = () => {
          autoPlayInterval = setInterval(() => {
            const maxIndex = getMaxIndex();
            if (currentIndex >= maxIndex) {
              goToSlide(0);
            } else {
              goToSlide(currentIndex + 1);
            }
          }, 5500);
        };

        const resetAutoPlay = () => {
          clearInterval(autoPlayInterval);
          startAutoPlay();
        };

        slider.addEventListener('mouseenter', () => clearInterval(autoPlayInterval));
        slider.addEventListener('mouseleave', () => startAutoPlay());

        window.addEventListener('resize', () => {
          updateDots();
          updateSlider();
        });

        updateDots();
        updateSlider();
        startAutoPlay();
      }
    }
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initDirectoryEngine);
  } else {
    initDirectoryEngine();
  }
})();
</script>
