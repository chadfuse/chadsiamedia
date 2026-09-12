<?php
/**
 * Chad Sia Media - Location Content Block (SEO / AEO / GEO)
 * Structured "What, Who, Why, Reviews, Where" Framework
 * Clean, High-Converting Light Theme Matching chadsia.com
 * Includes FontAwesome 6 Icons, Dynamic 2009+ Calculation, Dynamic Services, Global Reviews Slider
 */

if (!defined('ABSPATH')) {
    exit;
}

$post_id = get_the_ID() ?: get_queried_object_id();

// 1. Dynamic Experience Calculation via Registered Shortcode (Started 2009)
$start_year    = do_shortcode('[cs_start_year]') ?: '2009';
$years_exp_str = do_shortcode('[cs_years_experience]') ?: '17+';

// 2. ACF Fields & Metadata Extraction with intelligent detection
$city_raw     = (function_exists('get_field') ? get_field('city_name', $post_id) : '') ?: get_post_meta($post_id, 'city_name', true);
if (empty($city_raw)) {
    $city_raw = get_the_title($post_id);
}
$city         = trim(str_ireplace(['Web Design', 'Web Development', 'in', '·', 'Services'], '', $city_raw));
$country      = (function_exists('get_field') ? get_field('country_name', $post_id) : '') ?: get_post_meta($post_id, 'country_name', true);
$slug         = (string) get_post_field('post_name', $post_id);

if (empty($country)) {
    $us_slugs = ['new-york', 'los-angeles', 'san-francisco', 'austin', 'chicago', 'seattle', 'miami', 'boston', 'denver', 'atlanta', 'dallas', 'san-diego'];
    $uk_slugs = ['london', 'manchester', 'birmingham', 'edinburgh', 'bristol', 'leeds', 'glasgow', 'cambridge', 'liverpool', 'oxford'];
    $au_slugs = ['sydney', 'melbourne', 'brisbane', 'perth', 'adelaide', 'gold-coast', 'canberra', 'newcastle', 'sunshine-coast', 'wollongong'];
    $ca_slugs = ['toronto', 'vancouver', 'montreal', 'calgary'];
    
    foreach ($us_slugs as $s) {
        if (strpos($slug, $s) !== false) { $country = 'United States'; break; }
    }
    if (empty($country)) {
        foreach ($uk_slugs as $s) {
            if (strpos($slug, $s) !== false) { $country = 'United Kingdom'; break; }
        }
    }
    if (empty($country)) {
        foreach ($au_slugs as $s) {
            if (strpos($slug, $s) !== false) { $country = 'Australia'; break; }
        }
    }
    if (empty($country)) {
        foreach ($ca_slugs as $s) {
            if (strpos($slug, $s) !== false) { $country = 'Canada'; break; }
        }
    }
    if (empty($country)) {
        $country = 'Philippines';
    }
}

$province     = (function_exists('get_field') ? get_field('province_state', $post_id) : '') ?: get_post_meta($post_id, 'province_state', true);
if (empty($province)) {
    $province = $country;
}

$country_hub_urls = [
    'United States'  => '/locations/united-states/',
    'United Kingdom' => '/locations/united-kingdom/',
    'Australia'      => '/locations/australia/',
    'Canada'         => '/locations/canada/',
    'Philippines'    => '/locations/philippines/',
];
$country_hub_url = $country_hub_urls[$country] ?? '/locations/';

$wikidata_url = (function_exists('get_field') ? get_field('wikidata_url', $post_id) : '') ?: 'https://en.wikipedia.org/wiki/' . urlencode($city);
$aeo_answer   = (function_exists('get_field') ? get_field('aeo_direct_answer', $post_id) : '') ?: "Chad Sia Media delivers high-performance WordPress web design, custom development, and AI-powered SEO solutions for businesses in {$city}, {$province}, {$country}, and international clients.";

// Hero Section Fields
$hero_kicker        = (function_exists('get_field') ? get_field('hero_kicker', $post_id) : '') ?: "WordPress Web Design · {$city}";
$hero_h1            = (function_exists('get_field') ? get_field('hero_h1', $post_id) : '') ?: "Custom WordPress Web Design & AI Automation in <span class='cs-highlight'>{$city}</span>";
$hero_sub           = (function_exists('get_field') ? get_field('hero_subtitle', $post_id) : '') ?: "Empowering {$city} businesses with bespoke WordPress development, sub-second PageSpeed, and AI-driven search visibility engineered to convert visitors into loyal clients.";
$primary_cta_text   = (function_exists('get_field') ? get_field('hero_primary_cta_text', $post_id) : '') ?: 'Book a Discovery Call';
$primary_cta_url    = (function_exists('get_field') ? get_field('hero_primary_cta_url', $post_id) : '') ?: '/contact/';
$secondary_cta_text = (function_exists('get_field') ? get_field('hero_secondary_cta_text', $post_id) : '') ?: 'Explore What We Do';
$secondary_cta_url  = (function_exists('get_field') ? get_field('hero_secondary_cta_url', $post_id) : '') ?: '#what-we-do';
$hero_stat_num      = (function_exists('get_field') ? get_field('hero_stat_num', $post_id) : '') ?: 'Sub-Second TTFB';
$hero_stat_lbl      = (function_exists('get_field') ? get_field('hero_stat_lbl', $post_id) : '') ?: '90+ Google PageSpeed Guarantee';

// Helper function to strip any legacy numbers from eyebrow text
$cs_clean_eyebrow = function($str) {
    return preg_replace('/^\d+\.\s*/', '', trim((string)$str));
};
$hero_kicker = $cs_clean_eyebrow($hero_kicker);

// Stats Bar
$stats = (function_exists('get_field') ? get_field('stats_items', $post_id) : []) ?: [];
if (empty($stats)) {
    $stats = [
        ['number_stat' => $years_exp_str, 'label_stat' => 'Years of Craft (Since 2009)'],
        ['number_stat' => '< 0.8s', 'label_stat' => 'Average Page Load Time'],
        ['number_stat' => '100%', 'label_stat' => 'Zero Builder Bloat & Code Ownership'],
        ['number_stat' => '90+', 'label_stat' => 'Google PageSpeed Score']
    ];
}

// Who Section Fields
$who_kicker    = $cs_clean_eyebrow((function_exists('get_field') ? get_field('who_kicker', $post_id) : '') ?: 'Senior Engineering Leadership');
$who_title     = (function_exists('get_field') ? get_field('who_title', $post_id) : '') ?: "{$years_exp_str} Years of Direct Senior Engineering Expertise";
$who_lead      = (function_exists('get_field') ? get_field('who_lead', $post_id) : '') ?: "Founded by Chad Sia in {$start_year}, Chad Sia Media is a specialized WordPress engineering & AI development consultancy. We eliminate the layers of project managers and outsourced junior developers common in traditional agencies.";
$who_body      = (function_exists('get_field') ? get_field('who_body', $post_id) : '') ?: "When you partner with us, you work directly with a senior developer who understands both technical architecture and business growth strategies. Every line of code is written with precision, speed, and long-term scalability in mind.";
$who_highlights = (function_exists('get_field') ? get_field('who_highlights', $post_id) : []) ?: [];
if (empty($who_highlights)) {
    $who_highlights = [
        ['strong_text' => "{$years_exp_str} Years", 'label_text' => 'WordPress Craft'],
        ['strong_text' => 'Direct Access', 'label_text' => 'Zero Middle-Men'],
        ['strong_text' => '100% Custom', 'label_text' => 'No Slow Templates']
    ];
}
$who_target_title = (function_exists('get_field') ? get_field('who_target_title', $post_id) : '') ?: "Who We Partner With in {$city}";
$who_target_sub   = (function_exists('get_field') ? get_field('who_target_sub', $post_id) : '') ?: "Our solutions are designed specifically for businesses that demand measurable ROI and superior digital performance:";

// Why Section Fields
$why_kicker    = $cs_clean_eyebrow((function_exists('get_field') ? get_field('why_kicker', $post_id) : '') ?: 'The Technical Advantage');
$why_title     = (function_exists('get_field') ? get_field('why_title', $post_id) : '') ?: "Engineered for Speed, Search Visibility & Conversions";
$why_subtitle  = (function_exists('get_field') ? get_field('why_subtitle', $post_id) : '') ?: "We build custom digital architectures optimized for real business metrics, not just aesthetics.";

// Where Section Fields
$where_kicker          = $cs_clean_eyebrow((function_exists('get_field') ? get_field('where_kicker', $post_id) : '') ?: 'Regional Market Presence');
$where_title           = (function_exists('get_field') ? get_field('where_title', $post_id) : '') ?: "Strategic Web & AI Engineering for {$city}";
$local_story           = (function_exists('get_field') ? get_field('local_section_story', $post_id) : '') ?: "As {$city} rapidly expands its commercial and digital footprint, businesses require more than generic website builders. Chad Sia Media provides senior-level engineering that delivers lightning-fast load times, flawless responsiveness, and structured AI search optimization.";
$where_secondary_story = (function_exists('get_field') ? get_field('where_secondary_story', $post_id) : '') ?: "Whether you operate locally in {$city}, {$province}, or serve clients across {$country} and globally, our custom architectures ensure your brand stands out with authority.";

// FAQs Section Fields
$faqs_kicker   = $cs_clean_eyebrow((function_exists('get_field') ? get_field('faqs_kicker', $post_id) : '') ?: 'Common Inquiries');
$who_target_items = (function_exists('get_field') ? get_field('who_target_items', $post_id) : []) ?: [];
if (empty($who_target_items)) {
    $who_target_items = [
        ['icon_class' => 'fa-solid fa-building', 'title' => 'B2B & Scaling Enterprises', 'description' => 'Custom portals, CRM integrations, and automated lead capture.'],
        ['icon_class' => 'fa-solid fa-cart-shopping', 'title' => 'E-Commerce & Retail Brands', 'description' => 'High-speed WooCommerce stores engineered for maximum cart conversion.'],
        ['icon_class' => 'fa-solid fa-stethoscope', 'title' => 'Professional & Healthcare Practices', 'description' => 'High-trust websites with online scheduling and localized entity SEO.'],
        ['icon_class' => 'fa-solid fa-rocket', 'title' => 'Tech Startups & BPOs', 'description' => 'Modern, dynamic digital presence built to attract international clients.']
    ];
}

// Why Section Fields
$why_kicker    = (function_exists('get_field') ? get_field('why_kicker', $post_id) : '') ?: 'The Technical Advantage';
$why_title     = (function_exists('get_field') ? get_field('why_title', $post_id) : '') ?: "Why {$city} Businesses Choose Chad Sia Media";
$why_subtitle  = (function_exists('get_field') ? get_field('why_subtitle', $post_id) : '') ?: 'How our bespoke engineering beats generic agency templates and heavy page builders.';
$why_cards     = (function_exists('get_field') ? get_field('why_cards', $post_id) : []) ?: [];
if (empty($why_cards)) {
    $why_cards = [
        ['card_number' => '01', 'icon_class' => 'fa-solid fa-bolt', 'title' => 'Sub-Second Speed Guarantee', 'description' => 'We build with clean HTML5 and custom PHP. Zero multi-purpose theme bloat, ensuring your site achieves 90+ Core Web Vitals and sub-second load times.'],
        ['card_number' => '02', 'icon_class' => 'fa-solid fa-microchip', 'title' => 'AI & Answer Engine Optimization', 'description' => 'We structure your content and schema markup for AI search engines like Perplexity, ChatGPT, and Google AI Overviews to ensure maximum entity authority.'],
        ['card_number' => '03', 'icon_class' => 'fa-solid fa-chart-line', 'title' => 'Conversion-Engineered UX', 'description' => 'Every layout, button, and navigation flow is crafted using behavioral psychology and CRO best practices to turn passive visitors into paying inquiries.'],
        ['card_number' => '04', 'icon_class' => 'fa-solid fa-shield-halved', 'title' => '100% Ownership & Zero Lock-In', 'description' => 'You own all your code, database, and assets outright. No recurring proprietary builder fees, no vendor lock-in, and total freedom to scale.']
    ];
}

// Where Section Fields
$where_kicker          = (function_exists('get_field') ? get_field('where_kicker', $post_id) : '') ?: 'Regional Market Presence';
$where_title           = (function_exists('get_field') ? get_field('where_title', $post_id) : '') ?: "Local Market Presence in {$city}, {$province}";
$local_story           = (function_exists('get_field') ? get_field('local_section_story', $post_id) : '') ?: "As {$city} rapidly accelerates its digital infrastructure and commercial ecosystem, businesses require more than generic website templates. Chad Sia Media bridges bespoke technical craft, sub-second PageSpeed engineering, and structured AI search visibility to help companies dominate both local markets and global opportunities.";
$where_secondary_story = (function_exists('get_field') ? get_field('where_secondary_story', $post_id) : '') ?: "Whether your business operates from prime commercial corridors, BPO and tech parks, or serves international markets from {$city}, we engineer local digital authority that establishes you as the market leader.";
$where_features        = (function_exists('get_field') ? get_field('where_features', $post_id) : []) ?: [];
if (empty($where_features)) {
    $where_features = [
        ['icon_class' => 'fa-solid fa-location-dot', 'title' => 'Regional Coverage', 'description' => "Providing custom web design, SEO, and AI integration across {$city}, {$province}, and neighboring commercial hubs."],
        ['icon_class' => 'fa-solid fa-globe', 'title' => 'Global Standards', 'description' => "Combining deep local market understanding with Silicon Valley-grade speed, modern typography, and robust WordPress engineering."],
        ['icon_class' => 'fa-solid fa-handshake', 'title' => 'Seamless Collaboration', 'description' => "Direct communication via Slack, Google Meet, or WhatsApp with transparent sprint updates and rapid turnaround."]
    ];
}

// FAQs Section Fields
$faqs_kicker   = (function_exists('get_field') ? get_field('faqs_kicker', $post_id) : '') ?: 'Common Inquiries';
$faqs_title    = (function_exists('get_field') ? get_field('faqs_title', $post_id) : '') ?: 'Frequently Asked Questions';
$faqs_subtitle = (function_exists('get_field') ? get_field('faqs_subtitle', $post_id) : '') ?: "Clear answers regarding our web design process, AI tools, timelines, and technical standards in {$city}.";
$faqs_raw      = (function_exists('get_field') ? get_field('location_faqs', $post_id) : []) ?: get_post_meta($post_id, 'location_faqs', true);
$faqs = [];

if (!empty($faqs_raw) && is_array($faqs_raw)) {
    foreach ($faqs_raw as $f_item) {
        if (!is_array($f_item)) continue;
        $q = $f_item['question'] ?? ($f_item['location_faq_question'] ?? ($f_item['faq_question'] ?? ($f_item['title'] ?? '')));
        $a = $f_item['answer'] ?? ($f_item['location_faq_answer'] ?? ($f_item['faq_answer'] ?? ($f_item['content'] ?? '')));
        if (!empty($q) && !empty($a)) {
            $faqs[] = ['question' => $q, 'answer' => $a];
        }
    }
}

if (empty($faqs)) {
    $faqs = [
        [
            'question' => "What sets Chad Sia Media apart from traditional web design agencies in {$city}?",
            'answer'   => "Unlike traditional agencies that use slow pre-made templates and junior subcontractors, you work directly with a senior engineer with {$years_exp_str} years of hands-on WordPress craft. We engineer custom, zero-bloat code built for sub-second speeds and measurable conversions."
        ],
        [
            'question' => "Who is this web design and development service for?",
            'answer'   => "Our services are engineered for ambitious business owners, scaling service companies, healthcare providers, B2B enterprises, and modern startups in {$city}, {$province} that demand a high-performance digital presence that generates real revenue."
        ],
        [
            'question' => "Where are your web design services available?",
            'answer'   => "While we specifically serve businesses across {$city}, {$province}, and {$country}, our high-performance web engineering consultancy serves scaling clients across the United States, United Kingdom, Australia, Canada, and the Philippines."
        ],
        [
            'question' => "Why is sub-second website speed and AEO critical for {$city} businesses?",
            'answer'   => "Over 53% of mobile visitors abandon websites that take longer than 3 seconds to load. Furthermore, modern AI search engines (Google AI Overviews, Perplexity, ChatGPT) favor ultra-fast websites with clean semantic HTML and structured schema data."
        ]
    ];
}

// Bottom CTA Banner Fields
$cta_kicker   = (function_exists('get_field') ? get_field('cta_kicker', $post_id) : '') ?: "Let's Build Together";
$cta_title    = (function_exists('get_field') ? get_field('cta_title', $post_id) : '') ?: "Ready to Dominate {$city} with a High-Performance Digital Platform?";
$cta_desc     = (function_exists('get_field') ? get_field('cta_desc', $post_id) : '') ?: "No sales pressure. No junior account managers. Just an honest, direct architectural consult on how to outpace your local and global competition.";
$cta_btn_text = (function_exists('get_field') ? get_field('cta_btn_text', $post_id) : '') ?: "Book Your Discovery Call";
$cta_btn_url  = (function_exists('get_field') ? get_field('cta_btn_url', $post_id) : '') ?: "/contact/";

// 4. Global Core Engineering Services (What We Deliver - Static/Global)
$queried_services = get_posts([
    'post_type'      => 'service',
    'post_status'    => 'publish',
    'posts_per_page' => 4,
    'orderby'        => 'menu_order',
    'order'          => 'ASC'
]);

    if (!empty($queried_services)) {
        $services = [];
        $service_icon_classes = ['fa-brands fa-wordpress', 'fa-solid fa-robot', 'fa-solid fa-layer-group', 'fa-solid fa-gauge-high'];
        foreach ($queried_services as $idx => $sp) {
            $excerpt = get_the_excerpt($sp->ID) ?: wp_trim_words(strip_shortcodes(get_post_field('post_content', $sp->ID)), 22);
            $services[] = [
                'service_title'   => get_the_title($sp->ID),
                'service_summary' => $excerpt ?: "High-performance {$sp->post_title} engineered for {$city} businesses.",
                'service_link'    => get_permalink($sp->ID),
                'icon_class'      => $service_icon_classes[$idx % count($service_icon_classes)],
                'features'        => ['Custom Architecture', 'Mobile-First Responsive', '90+ Core Web Vitals']
            ];
        }
    } else {
        $services = [
            [
                'service_title'   => 'Custom WordPress Development',
                'service_summary' => "Lightweight, clean-coded WordPress architecture tailored to your specific business workflows—free from slow multi-purpose themes.",
                'service_link'    => '/services/custom-wordpress-development/',
                'icon_class'      => 'fa-brands fa-wordpress',
                'features'        => ['Bespoke Gutenberg & Theme Engine', 'Custom Post Types & ACF Pro', 'WooCommerce Scalability']
            ],
            [
                'service_title'   => 'AI Web Development & Automation',
                'service_summary' => "Integrate custom AI chatbots, automatic lead qualification, and CRM automations that nurture customers 24/7.",
                'service_link'    => '/services/ai-web-development/',
                'icon_class'      => 'fa-solid fa-robot',
                'features'        => ['Custom LLM & OpenAI Chatbots', 'GoHighLevel & Webhook Workflows', 'Automated Lead Routing']
            ],
            [
                'service_title'   => 'High-Converting Landing Pages',
                'service_summary' => "Pixel-perfect, mobile-first websites designed with user psychology, high-trust visual cues, and focused conversion funnels.",
                'service_link'    => '/services/landing-page-development/',
                'icon_class'      => 'fa-solid fa-layer-group',
                'features'        => ['Figma-to-Code Precision', 'Conversion Rate Optimization (CRO)', 'Frictionless Mobile UX']
            ],
            [
                'service_title'   => 'Website Speed Optimization',
                'service_summary' => "Dominate Google search results and AI answer engines across {$city} with deep semantic schema and sub-second load times.",
                'service_link'    => '/services/website-speed-optimization/',
                'icon_class'      => 'fa-solid fa-gauge-high',
                'features'        => ['Structured JSON-LD Schema', 'Sub-Second Server Response (TTFB)', 'AEO Search Optimization']
            ]
        ];
    }

// 5. Portfolio Client Reviews Data
$portfolio_reviews = [
    [
        'name'     => 'James T.',
        'role'     => 'Founder & Keynote Speaker',
        'company'  => 'JT Keynote',
        'initials' => 'JT',
        'rating'   => 5,
        'review'   => 'Working with Chad was a fantastic experience. He transformed our outdated website into a sleek, modern, and responsive platform that has greatly improved our user engagement. His attention to detail and creativity really brought our vision to life.',
        'tag'      => 'Custom WordPress & UI/UX'
    ],
    [
        'name'     => 'Jeff L.',
        'role'     => 'Managing Director',
        'company'  => 'Frasso Inc.',
        'initials' => 'JL',
        'rating'   => 5,
        'review'   => 'We needed a complete overhaul of our user interface, and Chad delivered beyond our wildest expectations. His ability to understand user experience and translate that into a functional, beautiful design was amazing. We’ve seen a 30% increase in customer satisfaction since launching the new site!',
        'tag'      => 'UI/UX & Front-End Engineering'
    ],
    [
        'name'     => 'Janelle Cruz',
        'role'     => 'Operations Lead',
        'company'  => 'SpeakersU',
        'initials' => 'JC',
        'rating'   => 5,
        'review'   => 'Working with Chad was seamless. He quickly understood our goals and delivered a website that not only looks great but brings in consistent leads every single week.',
        'tag'      => 'Lead Funnels & Conversion UX'
    ],
    [
        'name'     => 'Mark Reyes',
        'role'     => 'Founder',
        'company'  => 'Iloilo Food Hub',
        'initials' => 'MR',
        'rating'   => 5,
        'review'   => 'Our website went from outdated to outstanding. Chad’s attention to detail, sub-second speed optimization, and local insight made a huge difference in how we present ourselves online.',
        'tag'      => 'Local Entity SEO & Speed'
    ],
    [
        'name'     => 'SolarPlus Australia',
        'role'     => 'Engineering Partner',
        'company'  => 'SolarPlus Web App',
        'initials' => 'SP',
        'rating'   => 5,
        'review'   => 'Chad engineered a responsive, high-speed, and accessible front-end architecture for our Australian solar platform. Sub-second performance, pixel-perfect Figma translation, and seamless user workflows.',
        'tag'      => 'Web App & Front-End Architecture'
    ]
];

// 6. Dynamic Related Locations in the SAME Country Hub
$parent_country_id = wp_get_post_parent_id($post_id);
$dynamic_related = [];

if ($parent_country_id && in_array($parent_country_id, [4667, 4668, 4669, 4670, 4671])) {
    $dynamic_related = get_posts([
        'post_type'      => 'page',
        'post_status'    => 'publish',
        'posts_per_page' => 12,
        'post_parent'    => $parent_country_id,
        'post__not_in'   => [$post_id],
        'orderby'        => 'title',
        'order'          => 'ASC'
    ]);
}

if (empty($dynamic_related)) {
    $dynamic_related = get_posts([
        'post_type'      => 'page',
        'post_status'    => 'publish',
        'posts_per_page' => 12,
        'post__not_in'   => [$post_id],
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
                'value'   => $country,
                'compare' => 'LIKE'
            ]
        ]
    ]);
}
?>

<!-- FontAwesome 6 Free CDN for crisp vector icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- BULLETPROOF INLINE STYLING SYSTEM (No AI-slop side borders) -->
<style id="cs-location-styles-inline">
/**
 * Chad Sia Media - Location Page Design System
 * Inspired by modern AI Platform Architecture (uupm.cc/demo/ai-chatbot-platform)
 * Primary Brand Color: #4968F8 (replaces #6366f1) | Secondary Status: #10B981
 * Typography: Space Grotesk (Headings) & DM Sans (Body)
 */

@import url('https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,400..700;1,9..40,400..700&family=Outfit:wght@500;600;700;800&display=swap');

:root {
  /* Surface & Base */
  --cs-bg: #f5f5f7;
  --cs-bg-subtle: #ffffff;
  --cs-bg-card: #ffffff;
  --cs-border: #e5e7eb;
  --cs-border-light: #f1f5f9;
  
  /* Brand Colors */
  --cs-primary: #4968f8;
  --cs-primary-dark: #3553eb;
  --cs-primary-light: #eef2ff;
  --cs-primary-text: #1d4ed8;
  --cs-primary-accent: #818cf8;
  --cs-secondary: #10b981;
  --cs-gold: #f59e0b;
  
  /* Gradients (for backgrounds and containers only) */
  --cs-gradient-primary: linear-gradient(135deg, #4968f8 0%, #818cf8 100%);
  --cs-gradient-banner: linear-gradient(135deg, #4968f8 0%, #596dd6 100%);
  
  /* High-Contrast Typography */
  --cs-heading: #111827;
  --cs-heading-dark: #09090b;
  --cs-text: #1f2937;
  --cs-text-muted: #52525b;
  --cs-text-faint: #6b7280;
  
  /* Typography Families */
  --cs-font: 'DM Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
  --cs-font-display: 'Outfit', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
  
  /* Radii & Shadows */
  --cs-radius-sm: 8px;
  --cs-radius-md: 12px;
  --cs-radius-lg: 16px;
  --cs-radius-xl: 20px;
  --cs-radius-full: 9999px;
  
  --cs-shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.04);
  --cs-shadow-md: 0 4px 20px -2px rgba(0, 0, 0, 0.05), 0 2px 6px -1px rgba(0, 0, 0, 0.02);
  --cs-shadow-lg: 0 12px 32px -4px rgba(73, 104, 248, 0.12), 0 4px 12px -2px rgba(0, 0, 0, 0.04);
  --cs-shadow-hover: 0 16px 36px -4px rgba(73, 104, 248, 0.18);
  
  --cs-ease: cubic-bezier(0.16, 1, 0.3, 1);
}

/* =========================================================================
   Base Wrapper & Global Layout
   ========================================================================= */
.cs-loc-wrapper {
  background: var(--cs-bg);
  color: var(--cs-text);
  font-family: var(--cs-font);
  line-height: 1.65;
  font-size: 16px;
  -webkit-font-smoothing: antialiased;
  padding-bottom: 60px;
  overflow-wrap: break-word;
}

.cs-loc-wrapper h1,
.cs-loc-wrapper h2,
.cs-loc-wrapper h3,
.cs-hero-title,
.cs-sec-title,
.cs-card-title {
  font-family: var(--cs-font-display);
  letter-spacing: -0.02em;
  font-weight: 700;
  line-height: 1.35;
  color: var(--cs-heading);
  overflow-wrap: break-word;
}

/* Accessible Focus-Visible Navigation (WCAG 2.4.7 AA) */
.cs-loc-wrapper a:focus-visible,
.cs-loc-wrapper button:focus-visible,
.cs-loc-wrapper [type="button"]:focus-visible,
.cs-loc-wrapper [type="submit"]:focus-visible,
.cs-loc-wrapper summary:focus-visible,
.cs-loc-wrapper input:focus-visible,
.cs-loc-wrapper select:focus-visible,
.cs-loc-wrapper textarea:focus-visible {
  outline: 2px solid var(--cs-primary) !important;
  outline-offset: 3px !important;
  border-radius: var(--cs-radius-sm);
}

.cs-loc-wrapper button:not(:focus-visible),
.cs-loc-wrapper [type="button"]:not(:focus-visible),
.cs-loc-wrapper [type="submit"]:not(:focus-visible) {
  background-color: transparent;
  border-color: transparent;
  color: inherit;
  outline: none;
}

/* Motion Accessibility (WCAG 2.3.3) */
@media (prefers-reduced-motion: reduce) {
  .cs-loc-wrapper *,
  .cs-loc-wrapper *::before,
  .cs-loc-wrapper *::after {
    animation-duration: 0.01ms !important;
    animation-iteration-count: 1 !important;
    transition-duration: 0.01ms !important;
    scroll-behavior: auto !important;
  }
}

.cs-loc-container {
  max-width: 1240px;
  margin: 0 auto;
  padding: 0 24px;
}

.cs-section-alt {
  background: var(--cs-bg-subtle);
  border-top: 1px solid var(--cs-border);
  border-bottom: 1px solid var(--cs-border);
}

/* =========================================================================
   Signature AI Platform Utilities (Gradients, Text, Animations)
   ========================================================================= */
.gradient-primary {
  background: var(--cs-gradient-primary) !important;
}

.gradient-text,
.cs-highlight {
  color: var(--cs-primary);
  font-weight: 800;
  display: inline;
}

@keyframes typing-dot {
  0%, 60%, 100% { transform: translateY(0); opacity: 0.4; }
  30% { transform: translateY(-4px); opacity: 1; }
}

.typing-dot {
  display: inline-block;
  width: 6px;
  height: 6px;
  border-radius: 50%;
  background-color: var(--cs-primary);
  animation: typing-dot 1.4s ease-in-out infinite;
}
.typing-dot:nth-child(2) { animation-delay: 0.2s; }
.typing-dot:nth-child(3) { animation-delay: 0.4s; }

@keyframes pulse-status {
  0%, 100% { transform: scale(1); opacity: 1; }
  50% { transform: scale(1.2); opacity: 0.7; }
}

.status-dot-live {
  display: inline-block;
  width: 8px;
  height: 8px;
  border-radius: 50%;
  background-color: var(--cs-secondary);
  box-shadow: 0 0 8px rgba(16, 185, 129, 0.5);
  animation: pulse-status 2s ease-in-out infinite;
}

/* =========================================================================
   Breadcrumbs & Eyebrow
   ========================================================================= */
.cs-loc-breadcrumbs {
  padding: 24px 0 12px;
  font-size: 13px;
}
.cs-loc-breadcrumbs ol {
  display: flex;
  gap: 8px;
  align-items: center;
  list-style: none;
  padding: 0;
  margin: 0;
  flex-wrap: wrap;
}
.cs-loc-breadcrumbs li {
  display: flex;
  align-items: center;
  gap: 8px;
  color: var(--cs-text-muted);
}
.cs-loc-breadcrumbs li:not(:last-child)::after {
  content: "/";
  color: var(--cs-text-muted);
  font-size: 11px;
}
.cs-loc-breadcrumbs a {
  color: var(--cs-text-muted);
  font-weight: 500;
  text-decoration: none;
  transition: color 0.2s var(--cs-ease);
}
.cs-loc-breadcrumbs a:hover {
  color: var(--cs-primary-text);
}
.cs-loc-breadcrumbs li[aria-current="page"] {
  color: var(--cs-heading);
  font-weight: 600;
}

.cs-eyebrow,
.cs-badge {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  font-size: 14px;
  font-weight: 600;
  letter-spacing: normal;
  text-transform: none !important;
  color: var(--cs-primary-text);
  margin-bottom: 12px;
  line-height: 1.4;
  background: transparent !important;
  padding: 0 !important;
  border-radius: 0 !important;
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
  font-size: clamp(28px, 3.4vw, 38px);
  font-weight: 800;
  color: var(--cs-heading);
  line-height: 1.35;
  letter-spacing: -0.02em;
  margin: 0 0 16px;
}

.cs-sec-desc,
.cs-sec-sub {
  font-size: 17px;
  color: var(--cs-text-muted);
  line-height: 1.65;
  margin: 0 auto;
  max-width: 65ch;
}

/* =========================================================================
   Buttons & CTAs (Rounded 12px, Smooth Glow Lift)
   ========================================================================= */
.cs-btn,
.btn-primary,
.btn-secondary {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 10px;
  font-size: 15px;
  font-weight: 600;
  padding: 14px 28px;
  border-radius: var(--cs-radius-md);
  text-decoration: none;
  transition: transform 0.2s var(--cs-ease), box-shadow 0.2s var(--cs-ease), background 0.2s var(--cs-ease), border-color 0.2s var(--cs-ease);
  cursor: pointer;
  line-height: 1.4;
}

.cs-btn-primary,
.btn-primary {
  background: var(--cs-primary);
  color: #ffffff !important;
  border: 1px solid var(--cs-primary);
  box-shadow: 0 4px 14px rgba(73, 104, 248, 0.25);
}
.cs-btn-primary:hover,
.btn-primary:hover {
  background: var(--cs-primary-dark);
  border-color: var(--cs-primary-dark);
  color: #ffffff !important;
  transform: translateY(-2px);
  box-shadow: 0 8px 24px rgba(73, 104, 248, 0.35);
}

.cs-btn-outline,
.btn-secondary {
  background: #ffffff;
  color: var(--cs-heading);
  border: 2px solid var(--cs-border);
}
.cs-btn-outline:hover,
.btn-secondary:hover {
  background: #ffffff;
  border-color: var(--cs-primary);
  color: var(--cs-primary);
  transform: translateY(-2px);
  box-shadow: 0 4px 14px rgba(73, 104, 248, 0.1);
}

.cs-btn-arrow {
  transition: transform 0.2s var(--cs-ease);
}
.cs-btn:hover .cs-btn-arrow,
.btn-primary:hover .cs-btn-arrow {
  transform: translateX(4px);
}

/* =========================================================================
   Hero Section & Interactive AI Simulation Card
   ========================================================================= */
.cs-loc-hero {
  padding: 40px 0 60px;
}

.cs-hero-grid {
  display: grid;
  grid-template-columns: 1.15fr 0.85fr;
  gap: 50px;
  align-items: center;
}

.cs-hero-title {
  font-size: clamp(34px, 4.4vw, 52px);
  font-weight: 800;
  color: var(--cs-heading);
  line-height: 1.35;
  letter-spacing: -0.02em;
  margin: 0 0 20px;
}

.cs-hero-sub {
  font-size: 18px;
  color: var(--cs-text-muted);
  line-height: 1.65;
  margin: 0 0 28px;
  max-width: 65ch;
}

/* Interactive AI Assistant / AEO Simulator Card */
.cs-aeo-card {
  background: #ffffff;
  border: 1px solid var(--cs-border);
  border-radius: var(--cs-radius-lg);
  padding: 0;
  margin-bottom: 32px;
  box-shadow: var(--cs-shadow-md);
  overflow: hidden;
  transition: border-color 0.2s var(--cs-ease), box-shadow 0.2s var(--cs-ease);
}

.cs-aeo-card:hover {
  border-color: var(--cs-primary);
  box-shadow: var(--cs-shadow-lg);
}

.cs-aeo-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 12px 18px;
  background: #ffffff;
  border-bottom: 1px solid var(--cs-border);
  font-size: 13px;
  font-weight: 600;
  color: var(--cs-heading);
}

.cs-aeo-header-left {
  display: flex;
  align-items: center;
  gap: 8px;
}

.cs-aeo-header-left i {
  color: var(--cs-primary);
  font-size: 14px;
}

.cs-aeo-status {
  display: flex;
  align-items: center;
  gap: 6px;
  font-size: 12px;
  font-weight: 600;
  color: var(--cs-secondary);
}

.cs-aeo-body {
  padding: 20px 22px;
  display: flex;
  flex-direction: column;
  gap: 14px;
  background: var(--cs-bg);
}

.cs-chat-bubble-ai {
  background: #ffffff;
  border: 1px solid var(--cs-border);
  border-radius: var(--cs-radius-md);
  padding: 14px 18px;
  display: flex;
  gap: 12px;
  align-items: flex-start;
  box-shadow: var(--cs-shadow-sm);
}

.cs-chat-avatar {
  width: 32px;
  height: 32px;
  border-radius: var(--cs-radius-sm);
  background: var(--cs-gradient-primary);
  color: #ffffff;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 13px;
  flex-shrink: 0;
}

.cs-aeo-text {
  font-size: 15px;
  color: var(--cs-text);
  line-height: 1.65;
  margin: 0;
  font-weight: 500;
}

.cs-chat-typing-row {
  display: flex;
  align-items: center;
  gap: 6px;
  padding-left: 44px;
}

.cs-hero-ctas {
  display: flex;
  gap: 16px;
  flex-wrap: wrap;
}

.cs-hero-media {
  position: relative;
}

.cs-hero-img-wrap {
  position: relative;
  border-radius: var(--cs-radius-xl);
  overflow: hidden;
  box-shadow: var(--cs-shadow-lg);
  border: 1px solid var(--cs-border);
  background: #ffffff;
}

.cs-hero-img-wrap img {
  width: 100%;
  height: auto;
  display: block;
  object-fit: cover;
  transition: transform 0.6s var(--cs-ease);
}

.cs-hero-img-wrap:hover img {
  transform: scale(1.02);
}

.cs-floating-stat {
  position: absolute;
  bottom: -20px;
  left: -20px;
  background: #ffffff;
  padding: 16px 20px;
  border-radius: var(--cs-radius-lg);
  box-shadow: var(--cs-shadow-lg);
  border: 1px solid var(--cs-border);
  display: flex;
  align-items: center;
  gap: 14px;
}

.cs-stat-icon {
  width: 44px;
  height: 44px;
  border-radius: var(--cs-radius-md);
  background: var(--cs-gradient-primary);
  color: #ffffff;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 18px;
}

.cs-stat-info strong {
  display: block;
  font-size: 16px;
  font-weight: 800;
  color: var(--cs-heading);
  line-height: 1.35;
}

.cs-stat-info span {
  font-size: 12px;
  color: var(--cs-text-muted);
}

/* =========================================================================
   Stats Bar Grid
   ========================================================================= */
.cs-loc-stats-sec {
  padding: 50px 0;
  background: var(--cs-bg-subtle);
  border-top: 1px solid var(--cs-border);
  border-bottom: 1px solid var(--cs-border);
}

.cs-stats-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 24px;
}

.cs-stat-card {
  background: #ffffff;
  border: 1px solid var(--cs-border);
  border-radius: var(--cs-radius-lg);
  padding: 24px 20px;
  text-align: center;
  box-shadow: var(--cs-shadow-sm);
  transition: transform 0.25s var(--cs-ease), box-shadow 0.25s var(--cs-ease), border-color 0.25s var(--cs-ease);
}

.cs-stat-card:hover {
  transform: translateY(-3px);
  border-color: var(--cs-primary);
  box-shadow: var(--cs-shadow-md);
}

.cs-stat-card-num {
  font-family: var(--cs-font-display);
  font-size: 34px;
  font-weight: 800;
  color: var(--cs-primary);
  line-height: 1.35;
  margin-bottom: 6px;
}

.cs-stat-card-lbl {
  font-size: 14px;
  font-weight: 600;
  color: var(--cs-heading);
}

/* =========================================================================
   1. WHAT SECTION (Capabilities & Services Grid)
   ========================================================================= */
.cs-loc-services {
  padding: 85px 0;
}

.cs-services-grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 30px;
}

.cs-service-card {
  background: #ffffff;
  border: 1px solid var(--cs-border);
  border-radius: var(--cs-radius-xl);
  padding: 36px;
  box-shadow: var(--cs-shadow-sm);
  transition: transform 0.25s var(--cs-ease), box-shadow 0.25s var(--cs-ease), border-color 0.25s var(--cs-ease);
  display: flex;
  flex-direction: column;
}

.cs-service-card:hover {
  transform: translateY(-4px);
  box-shadow: var(--cs-shadow-hover);
  border-color: var(--cs-primary);
}

.cs-service-top {
  display: flex;
  align-items: center;
  gap: 16px;
  margin-bottom: 20px;
}

.cs-service-icon-box {
  width: 52px;
  height: 52px;
  border-radius: var(--cs-radius-md);
  background: rgba(73, 104, 248, 0.1);
  color: var(--cs-primary);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 22px;
  flex-shrink: 0;
  transition: background 0.2s var(--cs-ease), color 0.2s var(--cs-ease);
}

.cs-service-card:hover .cs-service-icon-box {
  background: var(--cs-primary);
  color: #ffffff;
}

.cs-service-card h3 {
  font-size: 22px;
  font-weight: 700;
  color: var(--cs-heading);
  margin: 0;
  line-height: 1.35;
}

.cs-service-desc {
  font-size: 15px;
  color: var(--cs-text);
  line-height: 1.65;
  margin: 0 0 24px;
  max-width: 65ch;
}

.cs-service-features {
  list-style: none;
  padding: 0;
  margin: 0 0 28px;
  display: flex;
  flex-direction: column;
  gap: 12px;
  flex-grow: 1;
}

.cs-service-features li {
  display: flex;
  align-items: flex-start;
  gap: 10px;
  font-size: 14px;
  color: var(--cs-heading);
  font-weight: 500;
}

.cs-feature-check {
  color: var(--cs-secondary);
  font-size: 14px;
  line-height: 1.4;
}

.cs-service-link {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  font-size: 14px;
  font-weight: 700;
  color: var(--cs-primary);
  text-decoration: none;
  transition: gap 0.2s var(--cs-ease), color 0.2s var(--cs-ease);
}
.cs-service-link:hover {
  gap: 12px;
  color: var(--cs-primary-dark);
}

/* =========================================================================
   2. WHO SECTION (Direct Senior Engineering Expertise)
   ========================================================================= */
.cs-loc-who {
  padding: 85px 0;
}

.cs-who-grid {
  display: grid;
  grid-template-columns: 1.15fr 0.85fr;
  gap: 50px;
  align-items: flex-start;
}

.cs-who-lead {
  font-size: 18px;
  color: var(--cs-heading);
  font-weight: 600;
  line-height: 1.6;
  margin: 0 0 16px;
}

.cs-who-profile p {
  font-size: 16px;
  color: var(--cs-text);
  line-height: 1.7;
  margin: 0 0 20px;
  max-width: 65ch;
}

.cs-who-highlights {
  display: flex;
  gap: 16px;
  flex-wrap: wrap;
  margin-top: 28px;
}

.cs-who-highlight-pill {
  background: #ffffff;
  border: 1px solid var(--cs-border);
  border-radius: var(--cs-radius-lg);
  padding: 16px 22px;
  flex: 1;
  min-width: 140px;
  box-shadow: var(--cs-shadow-sm);
  transition: border-color 0.2s, transform 0.2s;
}

.cs-who-highlight-pill:hover {
  border-color: var(--cs-primary);
  transform: translateY(-2px);
}

.cs-who-highlight-pill strong {
  display: block;
  font-family: var(--cs-font-display);
  font-size: 20px;
  color: var(--cs-primary);
  font-weight: 800;
  line-height: 1.35;
}

.cs-who-highlight-pill span {
  font-size: 13px;
  color: var(--cs-heading);
  font-weight: 600;
}

.cs-who-target-box {
  background: #ffffff;
  border: 1px solid var(--cs-border);
  border-radius: var(--cs-radius-xl);
  padding: 36px;
  box-shadow: var(--cs-shadow-md);
}

.cs-who-target-box h3 {
  font-size: 22px;
  font-weight: 800;
  color: var(--cs-heading);
  margin: 0 0 12px;
  line-height: 1.35;
}

.cs-who-target-box > p {
  font-size: 15px;
  color: var(--cs-text-muted);
  margin: 0 0 24px;
}

.cs-target-list {
  list-style: none;
  padding: 0;
  margin: 0;
  display: flex;
  flex-direction: column;
  gap: 18px;
}

.cs-target-list li {
  display: flex;
  align-items: flex-start;
  gap: 14px;
}

.cs-target-icon {
  width: 38px;
  height: 38px;
  border-radius: var(--cs-radius-md);
  background: rgba(73, 104, 248, 0.1);
  color: var(--cs-primary);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 16px;
  flex-shrink: 0;
}

.cs-target-list strong {
  display: block;
  font-size: 15px;
  font-weight: 700;
  color: var(--cs-heading);
  margin-bottom: 2px;
  line-height: 1.35;
}

.cs-target-list span {
  font-size: 13px;
  color: var(--cs-text);
  line-height: 1.5;
}

/* =========================================================================
   3. WHY SECTION (Feature Cards & Pillars)
   ========================================================================= */
.cs-loc-why {
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
  border-radius: var(--cs-radius-xl);
  padding: 30px 24px;
  box-shadow: var(--cs-shadow-sm);
  position: relative;
  transition: transform 0.25s var(--cs-ease), box-shadow 0.25s var(--cs-ease), border-color 0.25s var(--cs-ease);
}

.cs-why-card:hover {
  transform: translateY(-4px);
  box-shadow: var(--cs-shadow-hover);
  border-color: var(--cs-primary);
}

.cs-why-badge-num {
  font-size: 12px;
  font-weight: 800;
  color: var(--cs-primary);
  background: rgba(73, 104, 248, 0.08);
  display: inline-block;
  padding: 4px 10px;
  border-radius: var(--cs-radius-full);
  margin-bottom: 16px;
}

.cs-why-card-icon {
  width: 46px;
  height: 46px;
  border-radius: var(--cs-radius-md);
  background: rgba(73, 104, 248, 0.1);
  color: var(--cs-primary);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 20px;
  margin-bottom: 16px;
  transition: background 0.2s, color 0.2s;
}

.cs-why-card:hover .cs-why-card-icon {
  background: var(--cs-primary);
  color: #ffffff;
}

.cs-why-card h3 {
  font-size: 18px;
  font-weight: 700;
  color: var(--cs-heading);
  margin: 0 0 10px;
  line-height: 1.35;
}

.cs-why-card p {
  font-size: 14px;
  color: var(--cs-text-muted);
  line-height: 1.6;
  margin: 0;
  max-width: 65ch;
}

/* =========================================================================
   Global Reviews Slider Section
   ========================================================================= */
.cs-loc-reviews {
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
  width: 44px;
  height: 44px;
  border-radius: var(--cs-radius-md);
  border: 1px solid var(--cs-border);
  background: #ffffff;
  color: var(--cs-heading);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 15px;
  cursor: pointer;
  transition: all 0.2s var(--cs-ease);
  box-shadow: var(--cs-shadow-sm);
}

.cs-slider-btn:hover:not(:disabled) {
  background: var(--cs-primary);
  border-color: var(--cs-primary);
  color: #ffffff;
  transform: translateY(-2px);
  box-shadow: 0 6px 18px rgba(73, 104, 248, 0.25);
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
  transform: translate3d(0, 0, 0);
  transition: transform 0.45s var(--cs-ease);
  will-change: transform;
}

.cs-review-card {
  flex: 0 0 calc((100% - 48px) / 3);
  background: #ffffff;
  border: 1px solid var(--cs-border);
  border-radius: var(--cs-radius-xl);
  padding: 32px 28px;
  box-shadow: var(--cs-shadow-sm);
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  box-sizing: border-box;
  transition: transform 0.25s var(--cs-ease), box-shadow 0.25s var(--cs-ease), border-color 0.25s var(--cs-ease);
}

.cs-review-card:hover {
  transform: translateY(-3px);
  border-color: var(--cs-primary);
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
  font-style: normal;
}

.cs-review-author {
  display: flex;
  align-items: center;
  gap: 14px;
  border-top: 1px solid var(--cs-border-light);
  padding-top: 18px;
}

.cs-author-avatar {
  width: 42px;
  height: 42px;
  border-radius: var(--cs-radius-md);
  background: var(--cs-gradient-primary);
  color: #ffffff;
  font-weight: 800;
  font-size: 14px;
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
  background: rgba(73, 104, 248, 0.08);
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
   4. WHERE SECTION (Geo & Verified Entity)
   ========================================================================= */
.cs-loc-where {
  padding: 85px 0;
}

.cs-where-grid {
  display: grid;
  grid-template-columns: 1.1fr 0.9fr;
  gap: 50px;
  align-items: center;
}

.cs-where-copy h2 {
  font-size: clamp(28px, 3.2vw, 38px);
  font-weight: 800;
  color: var(--cs-heading);
  line-height: 1.35;
  margin: 0 0 20px;
}

.cs-where-copy p {
  font-size: 16px;
  color: var(--cs-text);
  line-height: 1.7;
  margin: 0 0 20px;
  max-width: 65ch;
}

.cs-entity-tag {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  font-size: 13px;
  font-weight: 600;
  color: var(--cs-primary);
  background: #ffffff;
  border: 1px solid var(--cs-border);
  padding: 8px 18px;
  border-radius: var(--cs-radius-full);
  text-decoration: none;
  box-shadow: var(--cs-shadow-sm);
  transition: border-color 0.2s, transform 0.2s;
}

.cs-entity-tag:hover {
  border-color: var(--cs-primary);
  transform: translateY(-1px);
}

.cs-where-features {
  display: flex;
  flex-direction: column;
  gap: 18px;
}

.cs-where-feature-card {
  background: #ffffff;
  border: 1px solid var(--cs-border);
  border-radius: var(--cs-radius-lg);
  padding: 22px;
  box-shadow: var(--cs-shadow-sm);
  display: flex;
  gap: 16px;
  align-items: flex-start;
  transition: border-color 0.2s, transform 0.2s;
}

.cs-where-feature-card:hover {
  border-color: var(--cs-primary);
  transform: translateY(-2px);
}

.cs-where-feature-icon {
  width: 40px;
  height: 40px;
  border-radius: var(--cs-radius-md);
  background: rgba(73, 104, 248, 0.1);
  color: var(--cs-primary);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 16px;
  flex-shrink: 0;
}

.cs-where-card-title {
  font-size: 16px;
  font-weight: 700;
  color: var(--cs-heading);
  margin: 0 0 6px;
  line-height: 1.35;
}

.cs-where-feature-card p {
  font-size: 14px;
  color: var(--cs-text-muted);
  margin: 0;
  line-height: 1.55;
  max-width: 65ch;
}

/* =========================================================================
   FAQs Section (High-Performance Accordion)
   ========================================================================= */
.cs-loc-faqs {
  padding: 85px 0;
}

.cs-faq-list {
  max-width: 860px;
  margin: 0 auto;
  display: flex;
  flex-direction: column;
  gap: 16px;
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

.cs-faq-btn {
  width: 100%;
  text-align: left;
  background: none;
  border: none;
  padding: 0 0 12px 0;
  margin: 0;
  display: block;
  cursor: default;
  pointer-events: none;
  font-family: var(--cs-font);
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
}

.cs-faq-icon {
  display: none !important;
}

.cs-faq-body {
  display: block !important;
  grid-template-rows: 1fr;
  padding: 0;
  margin: 0;
}

.cs-faq-content {
  overflow: visible;
  padding: 0;
  margin: 0;
  font-size: 16px;
  color: #374151;
  line-height: 1.7;
}

/* =========================================================================
   Nearby Hubs & Strategic Locations
   ========================================================================= */
.cs-loc-nearby {
  padding: 60px 0;
}

.cs-nearby-chips {
  display: flex;
  flex-wrap: wrap;
  gap: 12px;
  justify-content: center;
}

.cs-nearby-chip {
  background: #ffffff;
  border: 1px solid var(--cs-border);
  border-radius: var(--cs-radius-full);
  padding: 10px 20px;
  font-size: 14px;
  font-weight: 600;
  color: var(--cs-heading);
  text-decoration: none;
  box-shadow: var(--cs-shadow-sm);
  transition: border-color 0.2s, background 0.2s, color 0.2s, transform 0.2s;
  display: inline-flex;
  align-items: center;
  gap: 8px;
}

.cs-nearby-chip i {
  color: var(--cs-primary);
  font-size: 12px;
}

.cs-nearby-chip:hover {
  background: var(--cs-primary);
  border-color: var(--cs-primary);
  color: #ffffff;
  transform: translateY(-2px);
}

.cs-nearby-chip:hover i {
  color: #ffffff;
}

/* =========================================================================
   Bottom CTA Banner (AI Platform Gradient Banner)
   ========================================================================= */
.cs-loc-cta-banner {
  padding: 80px 0 20px;
}

.cs-cta-box {
  background: var(--cs-gradient-banner);
  border-radius: 24px;
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

/* =========================================================================
   Responsive Breakpoints
   ========================================================================= */
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

@media (max-width: 991px) {
  .cs-hero-grid,
  .cs-who-grid,
  .cs-where-grid {
    grid-template-columns: 1fr;
    gap: 40px;
  }
  .cs-stats-grid {
    grid-template-columns: repeat(2, 1fr);
  }
  .cs-services-grid {
    grid-template-columns: 1fr;
  }
  .cs-floating-stat {
    left: 20px;
    bottom: -15px;
  }
}

@media (max-width: 720px) {
  .cs-review-card {
    flex: 0 0 100%;
  }
}

@media (max-width: 640px) {
  .cs-stats-grid,
  .cs-why-grid-4 {
    grid-template-columns: 1fr;
  }
  .cs-hero-ctas {
    flex-direction: column;
  }
  .cs-btn {
    width: 100%;
  }
  .cs-service-card,
  .cs-who-target-box {
    padding: 24px;
  }
  .cs-cta-box {
    padding: 40px 20px;
  }
}

</style>

<!-- DYNAMIC JSON-LD SCHEMAS (SEO + AEO + GEO) -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@graph": [
    {
      "@type": "ProfessionalService",
      "@id": "<?php echo esc_url(get_permalink($post_id)); ?>#service",
      "name": "Chad Sia Media - <?php echo esc_attr($city); ?>",
      "url": "<?php echo esc_url(get_permalink($post_id)); ?>",
      "logo": "https://chadsia.com/wp-content/uploads/2024/10/logo-cds.webp",
      "image": "https://chadsia.com/wp-content/uploads/2026/05/AI-development-coding-1779610288.jpg",
      "telephone": "+639985456310",
      "email": "contact@chadsia.com",
      "description": <?php echo json_encode($aeo_answer); ?>,
      "address": {
        "@type": "PostalAddress",
        "addressLocality": "<?php echo esc_attr($city); ?>",
        "addressRegion": "<?php echo esc_attr($province); ?>",
        "addressCountry": "PH"
      },
      "areaServed": {
        "@type": "AdministrativeArea",
        "name": "<?php echo esc_attr($city); ?>",
        "sameAs": "<?php echo esc_url($wikidata_url); ?>"
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
          "name": "<?php echo esc_attr($country); ?>",
          "item": "<?php echo esc_url(home_url('/locations/' . sanitize_title($country) . '/')); ?>"
        },
        {
          "@type": "ListItem",
          "position": 4,
          "name": "<?php echo esc_attr($city); ?>",
          "item": "<?php echo esc_url(get_permalink($post_id)); ?>"
        }
      ]
    }
    <?php if (!empty($faqs)): ?>,
    {
      "@type": "FAQPage",
      "mainEntity": [
        <?php 
        $faq_schema = [];
        foreach ($faqs as $faq) {
            $faq_schema[] = json_encode([
                "@type" => "Question",
                "name" => $faq['question'] ?? ($faq['location_faq_question'] ?? ''),
                "acceptedAnswer" => [
                    "@type" => "Answer",
                    "text" => $faq['answer'] ?? ($faq['location_faq_answer'] ?? '')
                ]
            ]);
        }
        echo implode(',', $faq_schema);
        ?>
      ]
    }
    <?php endif; ?>
  ]
}
</script>

<div class="cs-loc-wrapper">
  <!-- BREADCRUMBS -->
  <nav class="cs-loc-breadcrumbs" aria-label="Breadcrumbs">
    <div class="cs-loc-container">
      <ol>
        <li><a href="<?php echo esc_url(home_url('/')); ?>">Home</a></li>
        <li><a href="<?php echo esc_url(home_url('/locations/')); ?>">Locations</a></li>
        <li><a href="<?php echo esc_url(home_url('/locations/' . sanitize_title($country) . '/')); ?>"><?php echo esc_html($country); ?></a></li>
        <li aria-current="page"><?php echo esc_html($city); ?></li>
      </ol>
    </div>
  </nav>

  <!-- HERO SECTION -->
  <header class="cs-loc-hero">
    <div class="cs-loc-container cs-hero-grid">
      <div class="cs-hero-copy">
        <div class="cs-eyebrow"><?php echo esc_html($hero_kicker); ?></div>
        
        <h1 class="cs-hero-title"><?php echo wp_kses_post($hero_h1); ?></h1>
        <p class="cs-hero-sub"><?php echo esc_html(wp_strip_all_tags($hero_sub)); ?></p>
        
        <!-- Direct AEO Answer Block (AI Platform Interactive Assistant) -->
        <div class="cs-aeo-card">
          <div class="cs-aeo-header">
            <div class="cs-aeo-header-left">
              <i class="fa-solid fa-robot"></i>
              <span>Architecture Assistant · Verified</span>
            </div>
            <div class="cs-aeo-status">
              <span class="status-dot-live"></span> Online
            </div>
          </div>
          <div class="cs-aeo-body">
            <div class="cs-chat-bubble-ai">
              <div class="cs-chat-avatar">
                <i class="fa-solid fa-bolt"></i>
              </div>
              <p class="cs-aeo-text"><?php echo esc_html(wp_strip_all_tags($aeo_answer)); ?></p>
            </div>
            <div class="cs-chat-typing-row">
              <span class="typing-dot"></span>
              <span class="typing-dot"></span>
              <span class="typing-dot"></span>
            </div>
          </div>
        </div>

        <div class="cs-hero-ctas">
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="cs-btn cs-btn-primary">
            <?php echo esc_html($primary_cta_text); ?> <i class="fa-solid fa-arrow-right cs-btn-arrow"></i>
          </a>
          <a href="<?php echo esc_url($secondary_cta_url); ?>" class="cs-btn cs-btn-outline">
            <?php echo esc_html($secondary_cta_text); ?>
          </a>
        </div>
      </div>

      <!-- Hero Featured Media / Stock Visual -->
      <div class="cs-hero-media">
        <div class="cs-hero-img-wrap">
          <img src="https://chadsia.com/wp-content/uploads/2026/05/AI-development-coding-1779610288.jpg" alt="<?php echo esc_attr($city); ?> Web Design & Development" width="600" height="420" loading="eager">
        </div>
        <div class="cs-floating-stat">
          <div class="cs-stat-icon">
            <i class="fa-solid fa-gauge-high"></i>
          </div>
          <div class="cs-stat-info">
            <strong><?php echo esc_html($hero_stat_num); ?></strong>
            <span><?php echo esc_html($hero_stat_lbl); ?></span>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- STATS & CREDIBILITY BAR -->
  <?php if (!empty($stats)): ?>
  <section class="cs-loc-stats-sec">
    <div class="cs-loc-container cs-stats-grid">
      <?php foreach ($stats as $stat): 
          $num = trim($stat['number_stat'] ?? '');
          $lbl = trim($stat['label_stat'] ?? '');
          
          // Expand shortcodes in stats or calculate dynamic years
          $num = do_shortcode($num);
          if (stripos($lbl, 'year') !== false || stripos($lbl, 'experience') !== false || stripos($lbl, 'craft') !== false || preg_match('/\b(15|16|17|18|19|20)\+\b/', $num)) {
              $num = $years_exp_str;
              $lbl = 'Years of Craft (Since ' . $start_year . ')';
          }
      ?>
        <div class="cs-stat-card">
          <div class="cs-stat-card-num"><?php echo esc_html($num); ?></div>
          <div class="cs-stat-card-lbl"><?php echo esc_html($lbl); ?></div>
        </div>
      <?php endforeach; ?>
    </div>
  </section>
  <?php endif; ?>

  <!-- =========================================================================
       1. WHAT SECTION: WHAT WE DELIVER (GLOBAL Services & Capabilities)
       ========================================================================= -->
  <section id="what-we-do" class="cs-loc-services cs-section-alt">
    <div class="cs-loc-container">
      <div class="cs-sec-heading-group">
        <div class="cs-eyebrow">What We Deliver</div>
        <h2 class="cs-sec-title">Full-Stack Digital Solutions Engineered for Growth</h2>
        <p class="cs-sec-sub">We don't just build websites—we architect high-converting, lightning-fast digital assets that power business growth in <?php echo esc_html($city); ?>.</p>
      </div>

      <div class="cs-services-grid">
        <?php 
        $default_fa_icons = ['fa-brands fa-wordpress', 'fa-solid fa-robot', 'fa-solid fa-layer-group', 'fa-solid fa-gauge-high'];
        
        foreach ($services as $idx => $srv): 
            $srv_title = $srv['service_title'] ?? ($srv['service_name'] ?? '');
            $srv_desc  = $srv['service_summary'] ?? ($srv['service_desc'] ?? '');
            $srv_url   = !empty($srv['service_link']) ? $srv['service_link'] : (!empty($srv['service_url']) ? $srv['service_url'] : '/services/');
            $features  = $srv['features'] ?? ['Custom Architecture', 'Mobile-First Responsive', '90+ Core Web Vitals'];
            $icon_cls  = !empty($srv['icon_class']) ? trim($srv['icon_class']) : $default_fa_icons[$idx % count($default_fa_icons)];
            if (strpos($icon_cls, 'wordpress') !== false) {
                $icon_cls = 'fa-brands fa-wordpress';
            } elseif (strpos($icon_cls, 'fa-') === false || (strpos($icon_cls, 'fa-solid') === false && strpos($icon_cls, 'fa-brands') === false && strpos($icon_cls, 'fa-regular') === false)) {
                $clean_name = trim(str_replace(['fa-solid', 'fa-brands', 'fa-regular', 'fa '], '', $icon_cls));
                if (strpos($clean_name, 'fa-') !== 0) {
                    $clean_name = 'fa-' . $clean_name;
                }
                $icon_cls = 'fa-solid ' . $clean_name;
            }
        ?>
          <div class="cs-service-card">
            <div class="cs-service-top">
              <div class="cs-service-icon-box">
                <i class="<?php echo esc_attr($icon_cls); ?>"></i>
              </div>
              <h3><?php echo esc_html($srv_title); ?></h3>
            </div>
            <p class="cs-service-desc"><?php echo esc_html(wp_strip_all_tags($srv_desc)); ?></p>
            
            <?php if (!empty($features) && is_array($features)): ?>
              <ul class="cs-service-features">
                <?php foreach ($features as $feat): ?>
                  <li>
                    <i class="fa-solid fa-circle-check cs-feature-check"></i>
                    <span><?php echo esc_html(is_array($feat) ? ($feat['feature_item'] ?? '') : $feat); ?></span>
                  </li>
                <?php endforeach; ?>
              </ul>
            <?php endif; ?>

            <a href="<?php echo esc_url($srv_url); ?>" class="cs-service-link">
              Explore Capability <i class="fa-solid fa-arrow-right"></i>
            </a>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- =========================================================================
       2. WHO SECTION: WHO WE ARE & WHO WE SERVE (Tailored via ACF)
       ========================================================================= -->
  <section class="cs-loc-who">
    <div class="cs-loc-container">
      <div class="cs-who-grid">
        <div class="cs-who-profile">
          <div class="cs-eyebrow"><?php echo esc_html($who_kicker); ?></div>
          <h2 class="cs-sec-title" style="text-align: left;"><?php echo esc_html($who_title); ?></h2>
          <p class="cs-who-lead"><?php echo esc_html(wp_strip_all_tags($who_lead)); ?></p>
          <p><?php echo esc_html(wp_strip_all_tags($who_body)); ?></p>
          
          <?php if (!empty($who_highlights) && is_array($who_highlights)): ?>
          <div class="cs-who-highlights">
            <?php foreach ($who_highlights as $whl): 
                $st = $whl['strong_text'] ?? '';
                $lt = $whl['label_text'] ?? '';
                if (empty($st) && empty($lt)) continue;
            ?>
              <div class="cs-who-highlight-pill">
                <strong><?php echo esc_html($st); ?></strong>
                <span><?php echo esc_html($lt); ?></span>
              </div>
            <?php endforeach; ?>
          </div>
          <?php endif; ?>
        </div>

        <div class="cs-who-target">
          <div class="cs-who-target-box">
            <h3><?php echo esc_html($who_target_title); ?></h3>
            <p><?php echo esc_html(wp_strip_all_tags($who_target_sub)); ?></p>
            
            <?php if (!empty($who_target_items) && is_array($who_target_items)): ?>
            <ul class="cs-target-list">
              <?php foreach ($who_target_items as $titem): 
                  $ticon = $titem['icon_class'] ?? 'fa-solid fa-building';
                  $ttitle = $titem['title'] ?? '';
                  $tdesc = $titem['description'] ?? '';
                  if (empty($ttitle)) continue;
              ?>
                <li>
                  <div class="cs-target-icon"><i class="<?php echo esc_attr($ticon); ?>"></i></div>
                  <div>
                    <strong><?php echo esc_html($ttitle); ?></strong>
                    <span><?php echo esc_html(wp_strip_all_tags($tdesc)); ?></span>
                  </div>
                </li>
              <?php endforeach; ?>
            </ul>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- =========================================================================
       3. WHY SECTION: WHY CHOOSE CHAD SIA MEDIA (Tailored via ACF)
       ========================================================================= -->
  <section class="cs-loc-why cs-section-alt">
    <div class="cs-loc-container">
      <div class="cs-sec-heading-group">
        <div class="cs-eyebrow"><?php echo esc_html($why_kicker); ?></div>
        <h2 class="cs-sec-title"><?php echo esc_html($why_title); ?></h2>
        <p class="cs-sec-sub"><?php echo esc_html(wp_strip_all_tags($why_subtitle)); ?></p>
      </div>

      <?php if (!empty($why_cards) && is_array($why_cards)): ?>
      <div class="cs-why-grid-4">
        <?php foreach ($why_cards as $wcard): 
            $cnum  = $wcard['card_number'] ?? '01';
            $cicon = $wcard['icon_class'] ?? 'fa-solid fa-bolt';
            $ctitle = $wcard['title'] ?? '';
            $cdesc = $wcard['description'] ?? '';
            if (empty($ctitle)) continue;
        ?>
          <div class="cs-why-card">
            <div class="cs-why-badge-num"><?php echo esc_html($cnum); ?></div>
            <div class="cs-why-card-icon"><i class="<?php echo esc_attr($cicon); ?>"></i></div>
            <h3><?php echo esc_html($ctitle); ?></h3>
            <p><?php echo esc_html(wp_strip_all_tags($cdesc)); ?></p>
          </div>
        <?php endforeach; ?>
      </div>
      <?php endif; ?>
    </div>
  </section>

  <!-- =========================================================================
       ⭐ CENTRALIZED GOOGLE REVIEWS WIDGET (Rated 5.0 Trust Badge)
       ========================================================================= -->
  <?php 
  if (function_exists('cs_render_google_reviews')) {
      cs_render_google_reviews([
          'kicker' => 'Client Proof & Reviews',
          'title'  => 'Rated 5.0 on Google Reviews'
      ]);
  } elseif (function_exists('cs_render_reviews_slider')) {
      cs_render_reviews_slider();
  }
  ?>

  <!-- =========================================================================
       4. WHERE SECTION: WHERE WE OPERATE (GEO & Local Entity - Tailored via ACF)
       ========================================================================= -->
  <section class="cs-loc-where cs-section-alt">
    <div class="cs-loc-container cs-where-grid">
      <div class="cs-where-copy">
        <div class="cs-eyebrow"><?php echo esc_html($where_kicker); ?></div>
        <h2><?php echo esc_html($where_title); ?></h2>
        <p><?php echo esc_html(wp_strip_all_tags($local_story)); ?></p>
        <?php if (!empty($where_secondary_story)): ?>
          <p><?php echo esc_html(wp_strip_all_tags($where_secondary_story)); ?></p>
        <?php endif; ?>
        
        <div class="cs-where-tags">
          <a href="<?php echo esc_url($wikidata_url); ?>" target="_blank" rel="noopener noreferrer" class="cs-entity-tag">
            <i class="fa-solid fa-link"></i>
            Verified Geo Entity: <?php echo esc_html($city); ?>, <?php echo esc_html($province); ?>
          </a>
        </div>
      </div>

      <?php if (!empty($where_features) && is_array($where_features)): ?>
      <div class="cs-where-features">
        <?php foreach ($where_features as $wfeat): 
            $ficon = $wfeat['icon_class'] ?? 'fa-solid fa-location-dot';
            $ftitle = $wfeat['title'] ?? '';
            $fdesc = $wfeat['description'] ?? '';
            if (empty($ftitle)) continue;
        ?>
          <div class="cs-where-feature-card">
            <div class="cs-where-feature-icon"><i class="<?php echo esc_attr($ficon); ?>"></i></div>
            <div>
              <h3 class="cs-where-card-title"><?php echo esc_html($ftitle); ?></h3>
              <p><?php echo esc_html(wp_strip_all_tags($fdesc)); ?></p>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
      <?php endif; ?>
    </div>
  </section>

  <!-- FAQS SECTION (Tailored via ACF) -->
  <?php if (!empty($faqs)): ?>
  <section class="cs-loc-faqs">
    <div class="cs-loc-container">
      <div class="cs-sec-heading-group">
        <div class="cs-eyebrow"><?php echo esc_html($faqs_kicker); ?></div>
        <h2 class="cs-sec-title"><?php echo esc_html($faqs_title); ?></h2>
        <p class="cs-sec-sub"><?php echo esc_html(wp_strip_all_tags($faqs_subtitle)); ?></p>
      </div>

      <div class="cs-faq-list">
        <?php foreach ($faqs as $index => $faq): 
            $q = $faq['question'] ?? ($faq['location_faq_question'] ?? ($faq['faq_question'] ?? ($faq['title'] ?? '')));
            $a = $faq['answer'] ?? ($faq['location_faq_answer'] ?? ($faq['faq_answer'] ?? ($faq['content'] ?? '')));
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

  <!-- DYNAMIC NEARBY LOCATIONS (Country-Specific) -->
  <?php if (!empty($dynamic_related)): ?>
  <section class="cs-loc-nearby cs-section-alt">
    <div class="cs-loc-container">
      <div class="cs-sec-heading-group" style="margin-bottom: 30px;">
        <div class="cs-eyebrow">Surrounding Hubs</div>
        <h2 class="cs-sec-title" style="font-size: 26px;">Web Design &amp; Digital Hubs in <?php echo esc_html($country); ?></h2>
        <p class="cs-sec-sub">Explore other regional tech hubs and commercial markets we serve across <?php echo esc_html($country); ?>.</p>
      </div>

      <div class="cs-nearby-chips">
        <?php foreach ($dynamic_related as $rloc): 
            $loc_title = get_the_title($rloc->ID);
            $clean_loc_name = get_post_meta($rloc->ID, 'city_name', true) ?: str_ireplace(['Web Design', 'Web Development', 'in', '·', 'Services'], '', $loc_title);
            $clean_loc_name = trim($clean_loc_name);
        ?>
          <a href="<?php echo esc_url(get_permalink($rloc->ID)); ?>" class="cs-nearby-chip">
            <i class="fa-solid fa-location-dot"></i>
            Web Design in <?php echo esc_html($clean_loc_name ?: $loc_title); ?>
          </a>
        <?php endforeach; ?>
      </div>

      <div style="text-align: center; margin-top: 28px;">
        <a href="<?php echo esc_url($country_hub_url); ?>" class="cs-btn cs-btn-outline" style="display: inline-flex;">
          <i class="fa-solid fa-flag"></i> Explore All <?php echo esc_html($country); ?> Locations &amp; Hubs
        </a>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <!-- 4. BOTTOM CTA BANNER (Discovery Call - Tailored via ACF) -->
  <section class="cs-loc-cta-banner">
    <div class="cs-loc-container">
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

<script id="cs-location-scripts-inline">
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
  function initLocationScripts() {
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

    // 2. Smooth Scroll for In-Page Anchors
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      if (!anchor.dataset.bound) {
        anchor.dataset.bound = 'true';
        anchor.addEventListener('click', function (e) {
          const href = this.getAttribute('href');
          if (href && href.length > 1) {
            const target = document.querySelector(href);
            if (target) {
              e.preventDefault();
              target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
          }
        });
      }
    });

    // 3. Global Reviews Slider
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
    document.addEventListener('DOMContentLoaded', initLocationScripts);
  } else {
    initLocationScripts();
  }
})();
</script>

