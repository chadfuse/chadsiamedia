<?php
/**
 * Chad Sia Media - Country Hub Template (e.g. US, UK, AU, PH, CA)
 * Structured Country Landing Page linking to all regional cities in that market.
 */

if (!defined('ABSPATH')) {
    exit;
}

$post_id = get_queried_object_id() ?: get_the_ID();

// 1. Dynamic Experience
$years_exp_str = do_shortcode('[cs_years_experience]') ?: '17+';

// 2. Identify Country from ACF / Post Meta / Slug
$country_name = (function_exists('get_field') ? get_field('country_name', $post_id) : '') ?: get_post_meta($post_id, 'country_name', true);
$country_code = (function_exists('get_field') ? get_field('country_code', $post_id) : '') ?: get_post_meta($post_id, 'country_code', true);
$slug         = (string) get_post_field('post_name', $post_id);

if (!$country_name) {
    if (strpos($slug, 'united-states') !== false || strpos($slug, 'us') !== false) {
        $country_name = 'United States';
        $country_code = 'US';
    } elseif (strpos($slug, 'united-kingdom') !== false || strpos($slug, 'uk') !== false) {
        $country_name = 'United Kingdom';
        $country_code = 'GB';
    } elseif (strpos($slug, 'australia') !== false || strpos($slug, 'au') !== false) {
        $country_name = 'Australia';
        $country_code = 'AU';
    } elseif (strpos($slug, 'canada') !== false || strpos($slug, 'ca') !== false) {
        $country_name = 'Canada';
        $country_code = 'CA';
    } else {
        $country_name = 'Philippines';
        $country_code = 'PH';
    }
}

$hero_kicker = (function_exists('get_field') ? get_field('hero_kicker', $post_id) : '') ?: (get_post_meta($post_id, 'hero_kicker', true) ?: "{$country_name} · Strategic Engineering Hub");
$hero_h1     = (function_exists('get_field') ? get_field('hero_h1', $post_id) : '') ?: (get_post_meta($post_id, 'hero_h1', true) ?: "Custom WordPress Web Design & AI Automation in <span class='cs-highlight'>{$country_name}</span>");
$hero_sub    = (function_exists('get_field') ? get_field('hero_subtitle', $post_id) : '') ?: (get_post_meta($post_id, 'hero_subtitle', true) ?: "Empowering forward-thinking companies across {$country_name} with bespoke WordPress development, sub-second PageSpeed, and AI-driven search visibility engineered to convert visitors into loyal clients.");

// 3. Query All City Location Pages for this Specific Country Hub
$cities_in_country = get_posts([
    'post_type'      => 'page',
    'post_status'    => 'publish',
    'posts_per_page' => -1,
    'post_parent'    => $post_id,
    'orderby'        => 'title',
    'order'          => 'ASC',
]);

// If parent query returned empty, fallback to meta query
if (empty($cities_in_country)) {
    $cities_in_country = get_posts([
        'post_type'      => 'page',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'orderby'        => 'title',
        'order'          => 'ASC',
        'meta_query'     => [
            'relation' => 'AND',
            [
                'key'     => '_wp_page_template',
                'value'   => ['template-location.php', 'page-templates/template-location.php'],
                'compare' => 'IN'
            ],
            [
                'key'     => 'country_name',
                'value'   => $country_name,
                'compare' => 'LIKE'
            ]
        ]
    ]);
}

// 4. Client Reviews
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

// 5. Country FAQs (from ACF or dynamic defaults)
$country_faqs_raw = (function_exists('get_field') ? get_field('country_faqs', $post_id) : []) ?: get_post_meta($post_id, 'country_faqs', true);
$country_faqs = [];

if (!empty($country_faqs_raw) && is_array($country_faqs_raw)) {
    foreach ($country_faqs_raw as $f_item) {
        if (!is_array($f_item)) continue;
        $q = $f_item['q'] ?? ($f_item['question'] ?? ($f_item['faq_question'] ?? ($f_item['title'] ?? '')));
        $a = $f_item['a'] ?? ($f_item['answer'] ?? ($f_item['faq_answer'] ?? ($f_item['content'] ?? '')));
        if (!empty($q) && !empty($a)) {
            $country_faqs[] = ['q' => $q, 'a' => $a];
        }
    }
}

if (empty($country_faqs)) {
    $country_faqs = [
        [
            'q' => "How does Chad Sia Media collaborate with businesses in {$country_name}?",
            'a' => "We provide direct senior engineering access with dedicated timezone overlap for {$country_name} business hours. Collaboration is transparent and fast via Slack, WhatsApp, Google Meet, and live staging sprint links."
        ],
        [
            'q' => "Do you deliver custom WordPress builds or off-the-shelf templates?",
            'a' => "Every website is engineered custom from scratch using clean PHP, vanilla CSS, and custom Gutenberg blocks. Zero slow visual builder plugins (no Elementor or Divi bloat), guaranteeing 90+ Core Web Vitals and sub-second load times."
        ],
        [
            'q' => "What is your typical project timeline for {$country_name} clients?",
            'a' => "Most custom WordPress and AI development sprints are delivered within 2 to 4 weeks, including UX wireframes, custom block development, mobile responsiveness, and deep schema testing."
        ],
        [
            'q' => "How do you ensure search engine and AI Answer Engine visibility in {$country_name}?",
            'a' => "We implement structured Schema.org JSON-LD entity graphs, semantic HTML5, and AI answer capsules optimized for Google AI Overviews, Perplexity, and ChatGPT Search."
        ]
    ];
}
?>

<!-- FontAwesome 6 Free CDN for crisp vector icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- BULLETPROOF INLINE STYLING SYSTEM (Matching Light Theme) -->
<style id="cs-country-hub-styles-inline">
@import url('https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,400..700;1,9..40,400..700&family=Outfit:wght@500;600;700;800&display=swap');

.cs-hub-wrapper {
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

.cs-hub-wrapper h1,
.cs-hub-wrapper h2,
.cs-hub-wrapper h3,
.cs-hub-hero-title,
.cs-hub-sec-title,
.cs-hub-city-name {
  font-family: var(--cs-font-display);
  letter-spacing: -0.02em;
  font-weight: 700;
  overflow-wrap: break-word;
}

/* Clean Eyebrow Typography (No Pill Container) */
.cs-hub-wrapper .cs-badge,
.cs-hub-wrapper .cs-eyebrow {
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

.cs-hub-wrapper .cs-badge-dot {
  display: none !important;
}

/* Accessible Focus-Visible Navigation (WCAG 2.4.7 AA) */
.cs-hub-wrapper a:focus-visible,
.cs-hub-wrapper button:focus-visible,
.cs-hub-wrapper [type="button"]:focus-visible,
.cs-hub-wrapper [type="submit"]:focus-visible,
.cs-hub-wrapper summary:focus-visible {
  outline: 2px solid var(--cs-primary) !important;
  outline-offset: 3px !important;
  border-radius: var(--cs-radius-sm);
}

.cs-hub-wrapper button:not(:focus-visible),
.cs-hub-wrapper [type="button"]:not(:focus-visible),
.cs-hub-wrapper [type="submit"]:not(:focus-visible) {
  background-color: transparent;
  border-color: transparent;
  color: inherit;
  outline: none;
}

@media (prefers-reduced-motion: reduce) {
  .cs-hub-wrapper *,
  .cs-hub-wrapper *::before,
  .cs-hub-wrapper *::after {
    animation-duration: 0.01ms !important;
    animation-iteration-count: 1 !important;
    transition-duration: 0.01ms !important;
    scroll-behavior: auto !important;
  }
}

.cs-hub-container {
  max-width: 1240px;
  margin: 0 auto;
  padding: 0 24px;
}

.cs-hub-section-alt {
  background: var(--cs-bg-subtle);
  border-top: 1px solid var(--cs-border);
  border-bottom: 1px solid var(--cs-border);
}

/* Breadcrumbs */
.cs-hub-breadcrumbs {
  padding: 24px 0 12px;
  font-size: 13px;
}
.cs-hub-breadcrumbs ol {
  display: flex;
  gap: 8px;
  align-items: center;
  list-style: none;
  padding: 0;
  margin: 0;
  flex-wrap: wrap;
}
.cs-hub-breadcrumbs li {
  display: flex;
  align-items: center;
  gap: 8px;
  color: var(--cs-text-muted);
}
.cs-hub-breadcrumbs li:not(:last-child)::after {
  content: "/";
  color: var(--cs-text-faint);
  font-size: 11px;
}
.cs-hub-breadcrumbs a {
  color: var(--cs-text-muted);
  text-decoration: none;
  transition: color 0.2s var(--cs-ease);
}
.cs-hub-breadcrumbs a:hover {
  color: var(--cs-primary);
}
.cs-hub-breadcrumbs li[aria-current="page"] {
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
.cs-hub-hero {
  padding: 50px 0 70px;
  text-align: center;
}

.cs-hub-hero-inner {
  max-width: 880px;
  margin: 0 auto;
}

.cs-hub-hero-title {
  font-size: clamp(34px, 4.4vw, 52px);
  font-weight: 800;
  color: var(--cs-heading);
  line-height: 1.15;
  letter-spacing: -0.02em;
  margin: 0 0 20px;
}

.cs-hub-hero-sub {
  font-size: 18px;
  color: var(--cs-text);
  line-height: 1.65;
  margin: 0 auto 32px;
  max-width: 740px;
}

.cs-hub-hero-ctas {
  display: flex;
  gap: 16px;
  justify-content: center;
  align-items: center;
  flex-wrap: wrap;
  margin-bottom: 40px;
}

.cs-hub-stats-row {
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

.cs-hub-stat-item {
  display: flex;
  flex-direction: column;
  align-items: center;
}

.cs-hub-stat-num {
  font-size: 26px;
  font-weight: 800;
  color: var(--cs-primary);
  line-height: 1.1;
}

.cs-hub-stat-lbl {
  font-size: 12px;
  font-weight: 600;
  color: var(--cs-text-muted);
  text-transform: none;
  letter-spacing: 0.04em;
  margin-top: 4px;
}

/* Regional Cities Grid */
.cs-hub-cities {
  padding: 85px 0;
}

.cs-cities-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
  gap: 18px;
  margin-bottom: 30px;
}

.cs-city-card {
  background: #ffffff;
  border: 1px solid var(--cs-border);
  border-radius: var(--cs-radius-md);
  padding: 20px 22px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  text-decoration: none;
  transition: all 0.25s var(--cs-ease);
  box-shadow: var(--cs-shadow-sm);
}

.cs-city-card-left {
  display: flex;
  align-items: center;
  gap: 14px;
}

.cs-city-card-icon {
  width: 40px;
  height: 40px;
  border-radius: 10px;
  background: var(--cs-primary-light);
  color: var(--cs-primary);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 16px;
  flex-shrink: 0;
  transition: all 0.25s var(--cs-ease);
}

.cs-city-card h4,
.cs-city-card h3,
.cs-city-card .cs-hub-city-name,
.cs-city-card .cs-hub-switch-name {
  font-size: 16px;
  font-weight: 700;
  color: var(--cs-heading);
  margin: 0 0 2px;
  line-height: 1.3;
}

.cs-city-card span {
  font-size: 12px;
  color: var(--cs-text-muted);
  display: block;
}

.cs-city-arrow {
  color: var(--cs-text-faint);
  font-size: 14px;
  transition: transform 0.2s var(--cs-ease), color 0.2s;
}

.cs-city-card:hover {
  border-color: var(--cs-primary);
  background: var(--cs-primary);
  transform: translateY(-3px);
  box-shadow: var(--cs-shadow-md);
}

.cs-city-card:hover .cs-city-card-icon {
  background: #ffffff;
  color: var(--cs-primary);
}

.cs-city-card:hover h4,
.cs-city-card:hover h3,
.cs-city-card:hover .cs-hub-city-name,
.cs-city-card:hover .cs-hub-switch-name,
.cs-city-card:hover span,
.cs-city-card:hover .cs-city-arrow {
  color: #ffffff;
}

.cs-city-card:hover .cs-city-arrow {
  transform: translateX(4px);
}

/* Other Global Countries Section */
.cs-hub-other-countries {
  padding: 85px 0;
}

/* Why Section */
.cs-hub-why {
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

/* Reviews Slider */
.cs-hub-reviews {
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

/* FAQs */
.cs-hub-faqs {
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
  transition: border-color 0.2s var(--cs-ease), box-shadow 0.2s var(--cs-ease);
}

.cs-faq-item:hover {
  border-color: #cbd5e1;
  box-shadow: 0 4px 16px -2px rgba(0, 0, 0, 0.08);
}

.cs-faq-q {
  font-size: 19px;
  font-weight: 800;
  color: var(--cs-heading);
  margin: 0 0 12px;
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

.cs-faq-body {
  display: block !important;
  padding: 0;
  margin: 0;
}

.cs-faq-content,
.cs-faq-content p,
.cs-faq-content span,
.cs-faq-content div {
  color: #374151;
  font-size: 16px;
  line-height: 1.7;
  padding: 0;
  margin: 0;
}

/* CTA Box */
.cs-hub-cta-banner {
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

/* Responsive */
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
  .cs-cities-grid {
    grid-template-columns: 1fr;
  }
  .cs-hub-stats-row {
    gap: 20px;
  }
}
@media (max-width: 640px) {
  .cs-why-grid-4 {
    grid-template-columns: 1fr;
  }
  .cs-hub-hero-ctas {
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

<!-- JSON-LD SCHEMAS -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@graph": [
    {
      "@type": "ProfessionalService",
      "@id": "<?php echo esc_url(get_permalink($post_id)); ?>#service",
      "name": "Chad Sia Media - <?php echo esc_attr($country_name); ?>",
      "url": "<?php echo esc_url(get_permalink($post_id)); ?>",
      "logo": "https://chadsia.com/wp-content/uploads/2024/10/logo-cds.webp",
      "image": "https://chadsia.com/wp-content/uploads/2026/05/AI-development-coding-1779610288.jpg",
      "telephone": "+639985456310",
      "email": "contact@chadsia.com",
      "description": "High-performance WordPress web design, custom front-end development, and AI automation across <?php echo esc_attr($country_name); ?>.",
      "areaServed": {
        "@type": "Country",
        "name": "<?php echo esc_attr($country_name); ?>"
      }
    },
    {
      "@type": "BreadcrumbList",
      "itemListElement": [
        {
          "@type": "ListItem",
          "position": 1,
          "name": "Home",
          "item": "<?php echo esc_url(home_url('/')); ?>"
        },
        {
          "@type": "ListItem",
          "position": 2,
          "name": "Locations",
          "item": "<?php echo esc_url(home_url('/locations/')); ?>"
        },
        {
          "@type": "ListItem",
          "position": 3,
          "name": "<?php echo esc_attr($country_name); ?>",
          "item": "<?php echo esc_url(get_permalink($post_id)); ?>"
        }
      ]
    },
    {
      "@type": "FAQPage",
      "mainEntity": [
        <?php 
        $faq_schema = [];
        foreach ($country_faqs as $f) {
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

<div class="cs-hub-wrapper">
  <!-- BREADCRUMBS -->
  <nav class="cs-hub-breadcrumbs" aria-label="Breadcrumbs">
    <div class="cs-hub-container">
      <ol>
        <li><a href="<?php echo esc_url(home_url('/')); ?>">Home</a></li>
        <li><a href="<?php echo esc_url(home_url('/locations/')); ?>">Locations</a></li>
        <li aria-current="page"><?php echo esc_html($country_name); ?></li>
      </ol>
    </div>
  </nav>

  <!-- HERO SECTION -->
  <header class="cs-hub-hero">
    <div class="cs-hub-container cs-hub-hero-inner">
      <div class="cs-eyebrow"><?php echo esc_html($hero_kicker); ?></div>

      <h1 class="cs-hub-hero-title">
        <?php echo wp_kses_post($hero_h1); ?>
      </h1>

      <p class="cs-hub-hero-sub">
        <?php echo esc_html($hero_sub); ?>
      </p>

      <div class="cs-hub-hero-ctas">
        <a href="/contact/" class="cs-btn cs-btn-primary">
          Book a Discovery Call <i class="fa-solid fa-arrow-right cs-btn-arrow"></i>
        </a>
        <a href="#cities" class="cs-btn cs-btn-outline">
          Explore Regional Cities <i class="fa-solid fa-location-dot"></i>
        </a>
      </div>

      <div class="cs-hub-stats-row">
        <div class="cs-hub-stat-item">
          <span class="cs-hub-stat-num"><?php echo esc_html($years_exp_str); ?></span>
          <span class="cs-hub-stat-lbl">Years Experience</span>
        </div>
        <div class="cs-hub-stat-item">
          <span class="cs-hub-stat-num">&lt; 0.8s</span>
          <span class="cs-hub-stat-lbl">Average TTFB</span>
        </div>
        <div class="cs-hub-stat-item">
          <span class="cs-hub-stat-num"><?php echo count($cities_in_country); ?>+</span>
          <span class="cs-hub-stat-lbl">Strategic Cities</span>
        </div>
        <div class="cs-hub-stat-item">
          <span class="cs-hub-stat-num">90+</span>
          <span class="cs-hub-stat-lbl">PageSpeed Score</span>
        </div>
      </div>
    </div>
  </header>

  <!-- REGIONAL CITIES GRID -->
  <section class="cs-hub-cities cs-hub-section-alt" id="cities">
    <div class="cs-hub-container">
      <div class="cs-sec-heading-group">
        <div class="cs-eyebrow">Regional Presence</div>
        <h2 class="cs-sec-title">Cities &amp; Regional Hubs in <?php echo esc_html($country_name); ?></h2>
        <p class="cs-sec-sub">Select your city below to explore localized web design, speed optimization, and AI solutions.</p>
      </div>

      <?php if (!empty($cities_in_country)): ?>
        <div class="cs-cities-grid">
          <?php foreach ($cities_in_country as $cp): 
              $city_title = get_the_title($cp->ID);
              $clean_city = get_post_meta($cp->ID, 'city_name', true) ?: str_ireplace(['Web Design', 'Web Development', 'in', '·'], '', $city_title);
              $clean_city = trim($clean_city);
              $prov = get_post_meta($cp->ID, 'province_state', true) ?: $country_name;
          ?>
            <a href="<?php echo esc_url(get_permalink($cp->ID)); ?>" class="cs-city-card">
              <div class="cs-city-card-left">
                <div class="cs-city-card-icon"><i class="fa-solid fa-location-dot"></i></div>
                <div>
                  <h3 class="cs-hub-city-name"><?php echo esc_html($clean_city ?: $city_title); ?></h3>
                  <span><?php echo esc_html($prov); ?></span>
                </div>
              </div>
              <i class="fa-solid fa-arrow-right cs-city-arrow"></i>
            </a>
          <?php endforeach; ?>
        </div>
      <?php else: ?>
        <p style="text-align: center; color: var(--cs-text-muted);">Regional city pages are actively being provisioned for <?php echo esc_html($country_name); ?>.</p>
      <?php endif; ?>
    </div>
  </section>

  <!-- WHY SECTION -->
  <section class="cs-hub-why">
    <div class="cs-hub-container">
      <div class="cs-sec-heading-group">
        <div class="cs-eyebrow">Engineering Standards</div>
        <h2 class="cs-sec-title">Why <?php echo esc_html($country_name); ?> Businesses Choose Chad Sia Media</h2>
        <p class="cs-sec-sub">Bespoke technical craft engineered for conversion, scalability, and measurable growth.</p>
      </div>

      <div class="cs-why-grid-4">
        <div class="cs-why-card">
          <div class="cs-why-badge-num">01</div>
          <div class="cs-why-card-icon"><i class="fa-solid fa-bolt"></i></div>
          <h3>Sub-Second Speed Guarantee</h3>
          <p>Zero multi-purpose theme bloat. Clean PHP and HTML5 engineered to pass Google Core Web Vitals and load in under 800ms.</p>
        </div>

        <div class="cs-why-card">
          <div class="cs-why-badge-num">02</div>
          <div class="cs-why-card-icon"><i class="fa-solid fa-microchip"></i></div>
          <h3>AI &amp; Answer Engine SEO</h3>
          <p>Structured schema markup and semantic entities tailored for AI search engines like ChatGPT, Perplexity, and Google AI Overviews.</p>
        </div>

        <div class="cs-why-card">
          <div class="cs-why-badge-num">03</div>
          <div class="cs-why-card-icon"><i class="fa-solid fa-clock"></i></div>
          <h3>Timezone Overlap</h3>
          <p>Flexible communication windows aligned with <?php echo esc_html($country_name); ?> business hours. Transparent updates and zero lag.</p>
        </div>

        <div class="cs-why-card">
          <div class="cs-why-badge-num">04</div>
          <div class="cs-why-card-icon"><i class="fa-solid fa-shield-halved"></i></div>
          <h3>100% Code Ownership</h3>
          <p>You own all code, designs, and data outright. No recurring proprietary page builder fees and zero vendor lock-in.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- CENTRALIZED GOOGLE REVIEWS WIDGET -->
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

  <!-- FAQS SECTION -->
  <section class="cs-hub-faqs">
    <div class="cs-hub-container">
      <div class="cs-sec-heading-group">
        <div class="cs-eyebrow">Common Inquiries</div>
        <h2 class="cs-sec-title">Frequently Asked Questions</h2>
        <p class="cs-sec-sub">Clear answers regarding our web design and AI process for <?php echo esc_html($country_name); ?> businesses.</p>
      </div>

      <div class="cs-faq-list">
        <?php foreach ($country_faqs as $index => $faq): ?>
          <div class="cs-faq-item">
            <h3 class="cs-faq-q"><?php echo esc_html($faq['q']); ?></h3>
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

  <!-- OTHER GLOBAL MARKETS -->
  <section class="cs-hub-other-countries cs-hub-section-alt">
    <div class="cs-hub-container">
      <div class="cs-sec-heading-group">
        <div class="cs-eyebrow">Global Presence</div>
        <h2 class="cs-sec-title">Explore Other Strategic Country Hubs</h2>
        <p class="cs-sec-sub">Discover our localized web design, engineering, and AI capabilities across international markets.</p>
      </div>

      <?php
      $sibling_countries = [
          ['name' => 'United States', 'code' => 'US', 'url' => '/locations/united-states/', 'tag' => '12 Strategic Cities', 'desc' => 'New York, San Francisco, Austin, Los Angeles, and nationwide.'],
          ['name' => 'United Kingdom', 'code' => 'GB', 'url' => '/locations/united-kingdom/', 'tag' => '10 Strategic Cities', 'desc' => 'London, Manchester, Edinburgh, Birmingham, and nationwide.'],
          ['name' => 'Australia', 'code' => 'AU', 'url' => '/locations/australia/', 'tag' => '10 Strategic Cities', 'desc' => 'Sydney, Melbourne, Brisbane, Perth, and nationwide.'],
          ['name' => 'Philippines', 'code' => 'PH', 'url' => '/locations/philippines/', 'tag' => '60+ Regional Hubs', 'desc' => 'Metro Manila, Cebu, Davao, Iloilo, and nationwide.'],
          ['name' => 'Canada', 'code' => 'CA', 'url' => '/locations/canada/', 'tag' => '4 Strategic Cities', 'desc' => 'Toronto, Vancouver, Montreal, and Calgary.'],
      ];
      ?>

      <div class="cs-cities-grid">
        <?php foreach ($sibling_countries as $sc): 
            $is_current = ($sc['name'] === $country_name);
        ?>
          <a href="<?php echo esc_url($sc['url']); ?>" class="cs-city-card <?php echo $is_current ? 'is-active' : ''; ?>" style="<?php echo $is_current ? 'border-color: var(--cs-primary); background: var(--cs-primary-light);' : ''; ?>">
            <div class="cs-city-card-left">
              <div class="cs-city-card-icon" style="<?php echo $is_current ? 'background: var(--cs-primary); color: #ffffff;' : ''; ?>">
                <span style="font-weight: 800; font-size: 14px;"><?php echo esc_html($sc['code']); ?></span>
              </div>
              <div>
                <h3 class="cs-hub-switch-name"><?php echo esc_html($sc['name']); ?> <?php echo $is_current ? '<span style="font-size:11px; color:var(--cs-primary); font-weight:700;">(Current Hub)</span>' : ''; ?></h3>
                <span><?php echo esc_html($sc['tag']); ?></span>
              </div>
            </div>
            <i class="fa-solid fa-arrow-right cs-city-arrow"></i>
          </a>
        <?php endforeach; ?>
      </div>

      <div style="text-align: center; margin-top: 24px;">
        <a href="/locations/" class="cs-btn cs-btn-outline" style="display: inline-flex;">
          <i class="fa-solid fa-globe"></i> View Full Global Locations Directory
        </a>
      </div>
    </div>
  </section>

  <!-- CTA BANNER -->
  <section class="cs-hub-cta-banner">
    <div class="cs-hub-container">
      <div class="cs-cta-box">
        <h2>Ready to Scale Your Business in <?php echo esc_html($country_name); ?>?</h2>
        <p>Let’s build a lightning-fast, high-converting WordPress website engineered to outpace your competition.</p>
        <a href="/contact/" class="cs-btn cs-btn-primary">
          Book Your Discovery Call <i class="fa-solid fa-arrow-right cs-btn-arrow"></i>
        </a>
      </div>
    </div>
  </section>
</div>

<script id="cs-country-hub-scripts-inline">
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
  function initHubScripts() {
    // 1. FAQ Accordion (Delegated & Idempotent Fallback)
    if (!window.__csFaqAccordionInitialized) {
      window.__csFaqAccordionInitialized = true;
      document.addEventListener('click', function(e) {
        var btn = e.target.closest('.cs-faq-btn');
        if (btn) {
          e.preventDefault();
          csToggleFaq(btn);
        }
      });
    }

    // 2. Reviews Slider
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
    document.addEventListener('DOMContentLoaded', initHubScripts);
  } else {
    initHubScripts();
  }
})();
</script>
