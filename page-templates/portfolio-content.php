<?php
/**
 * Portfolio Page Content Component
 * Clean Semantic HTML5 + Responsive Client-Side Filtering + Native Fullscreen Lightbox
 * 
 * @package ChadSia
 */

// Dynamic Experience Calculation
$current_year = intval(date('Y'));
$founding_year = 2009;
$years_exp = max(17, $current_year - $founding_year);
$years_exp_str = $years_exp . '+ Years';

// Curated Portfolio Projects Dataset
$portfolio_items = [
    // ==========================================
    // 1. WEB PLATFORMS
    // ==========================================
    [
        'id'          => 'solarplus',
        'title'       => 'SolarPlus Platform & Design Engine',
        'client_type' => 'Solar Design, CRM & Quoting System',
        'category'    => 'web-dev',
        'categories'  => ['web-dev', 'ui-ux'],
        'category_name' => 'Web Platform',
        'image_url'   => 'https://chadsia.com/wp-content/uploads/2024/10/Solarplus.webp',
        'full_image_url' => 'https://chadsia.com/wp-content/uploads/2024/10/Solarplus.webp',
        'description' => 'Designed the complete UI/UX and engineered the responsive front-end for SolarPlus—featuring custom WordPress architecture, solar array design tools, CRM workflows, and an interactive quoting engine.',
        'metric'      => 'Custom UI/UX & Quoting Engine',
        'tags'        => ['Solar Design Tool', 'CRM & Quoting System', 'Custom WordPress', 'UI/UX Engineering', 'Front-End Architecture'],
        'live_url'    => 'https://www.solarplus.co/',
        'cta_text'    => 'View Live Platform',
        'is_lightbox' => false
    ],
    [
        'id'          => 'frasso',
        'title'       => 'Frasso Architecture & Web Catalog Design',
        'client_type' => 'Web Catalog & Architecture Studio',
        'category'    => 'web-dev',
        'categories'  => ['web-dev', 'ui-ux'],
        'category_name' => 'Web Catalog & Design',
        'image_url'   => 'https://chadsia.com/wp-content/themes/chadsia/assets/images/frasso-catalog-showcase-1024.webp',
        'full_image_url' => 'https://chadsia.com/wp-content/themes/chadsia/assets/images/frasso-catalog-showcase.webp',
        'description' => 'Architected a bespoke web catalog and portfolio showcase template featuring editorial typography, interactive collection filtering, responsive project showcases, and ultra-fast visual rendering.',
        'metric'      => 'Editorial UI · Sub-Second Speed',
        'tags'        => ['Web Catalog Template', 'Architecture Studio', 'Interactive Showcase', 'Figma to Code', 'Zero Layout Shift'],
        'live_url'    => 'https://chadsia.com/frasso/',
        'cta_text'    => 'View Live Demo',
        'is_lightbox' => false
    ],
    [
        'id'          => 'defensible-legal',
        'title'       => 'Defensible Legal Platform',
        'client_type' => 'Solicitor Directory',
        'category'    => 'web-dev',
        'category_name' => 'Web Platform',
        'image_url'   => 'https://chadsia.com/wp-content/uploads/2026/08/Defensible-Legal-1024x565.png',
        'full_image_url' => 'https://chadsia.com/wp-content/uploads/2026/08/Defensible-Legal.png',
        'description' => 'Architected a bespoke corporate web platform and solicitor directory with sub-second critical path rendering, strict WCAG 2.1 AA accessibility, and zero layout shift.',
        'metric'      => '0.4s FCP · 99 PageSpeed',
        'tags'        => ['Solicitor Directory', 'Semantic HTML5', 'TypeScript', '99 PageSpeed'],
        'live_url'    => 'https://defensiblelegal.co.uk/',
        'cta_text'    => 'View Live Platform',
        'is_lightbox' => false
    ],
    [
        'id'          => 'casa-halo',
        'title'       => 'Casa Halo Luxury Vacation Rental',
        'client_type' => 'Real Estate & Hospitality',
        'category'    => 'web-dev',
        'category_name' => 'Web Platform',
        'image_url'   => 'https://chadsia.com/wp-content/uploads/2025/09/Casa-Halo-Site-1024x546.png',
        'full_image_url' => 'https://chadsia.com/wp-content/uploads/2025/09/Casa-Halo-Site.png',
        'description' => 'Designed and built an ultra-premium booking portal for luxury vacation rental villas with fluid typography, immersive visual storytelling, and direct reservation inquiries.',
        'metric'      => '+34% Direct Bookings',
        'tags'        => ['Vacation Rental Villa', 'Custom WordPress', 'Fluid Typography', 'Sub-Second'],
        'live_url'    => 'https://casahalotulum.com/',
        'cta_text'    => 'View Live Platform',
        'is_lightbox' => false
    ],
    [
        'id'          => 'gypsy-jazz',
        'title'       => 'GypsyJazz Transfusion Club',
        'client_type' => 'Music Academy & Courses',
        'category'    => 'web-dev',
        'category_name' => 'Web Platform',
        'image_url'   => 'https://chadsia.com/wp-content/uploads/2026/08/GypsyJazz-1024x561.png',
        'full_image_url' => 'https://chadsia.com/wp-content/uploads/2026/08/GypsyJazz.png',
        'description' => 'Custom WordPress media and learning platform with gated video masterclasses, music courses, lessons, and fast streaming audio player integration.',
        'metric'      => '98 Mobile Score',
        'tags'        => ['Music Courses & Lessons', 'Custom WordPress', 'Fast Media', 'A11y AA'],
        'live_url'    => 'https://www.gypsyjazztransfusionclub.com/',
        'cta_text'    => 'View Live Platform',
        'is_lightbox' => false
    ],
    [
        'id'          => 'broco-energy',
        'title'       => 'Broco Energy Commercial Platform',
        'client_type' => 'Industrial Fuel & HVAC Services',
        'category'    => 'web-dev',
        'category_name' => 'Web Platform',
        'image_url'   => 'https://chadsia.com/wp-content/uploads/2025/09/Broco-1024x546.png',
        'full_image_url' => 'https://chadsia.com/wp-content/uploads/2025/09/Broco.png',
        'description' => 'Built a high-traffic industrial fuel, commercial HVAC, and energy marketing website with dynamic delivery dispatch forms and commercial quote calculators.',
        'metric'      => '+64% B2B Quote Requests',
        'tags'        => ['Fuel & HVAC Marketing', 'Custom PHP', 'CRM Integration', 'Sub-Second TTFB'],
        'live_url'    => 'https://www.brocoenergy.com/',
        'cta_text'    => 'View Live Platform',
        'is_lightbox' => false
    ],
    [
        'id'          => 'cedarbrook-plumbing',
        'title'       => 'Cedarbrook Plumbing & Home Services',
        'client_type' => 'Residential & Commercial Services',
        'category'    => 'web-dev',
        'category_name' => 'Web Platform',
        'image_url'   => 'https://chadsia.com/wp-content/uploads/2026/08/plumbing-cedar.png',
        'full_image_url' => 'https://chadsia.com/wp-content/uploads/2026/08/plumbing-cedar.png',
        'description' => 'High-velocity local service platform engineered for instant emergency dispatch booking, local GEO schema markup, and 95+ mobile performance.',
        'metric'      => '97 Google PageSpeed',
        'tags'        => ['Local SEO Schema', 'Mobile First', 'Emergency Dispatch', 'Vanilla CSS'],
        'live_url'    => 'https://dsdsites.com/web-designs/cedarbrook/',
        'cta_text'    => 'View Live Demo',
        'is_lightbox' => false
    ],
    [
        'id'          => 'medmate',
        'title'       => 'MedMate Telehealth & Prescription Portal',
        'client_type' => 'HealthTech & Telehealth',
        'category'    => 'web-dev',
        'category_name' => 'Web Platform',
        'image_url'   => 'https://chadsia.com/wp-content/uploads/2024/11/medmate.jpg',
        'full_image_url' => 'https://chadsia.com/wp-content/uploads/2024/11/medmate.jpg',
        'description' => 'Secure telemedicine platform with doctor appointment scheduling, electronic prescription routing, and HIPAA-compliant data encryption.',
        'metric'      => 'HIPAA / GDPR Ready',
        'tags'        => ['Telehealth Portal', 'Secure Booking API', 'HIPAA Architecture', '99 PageSpeed'],
        'live_url'    => '/contact/?service=api-and-third-party-integrations',
        'cta_text'    => 'Request Case Study',
        'is_lightbox' => false
    ],
    [
        'id'          => 'vip-fitness',
        'title'       => 'VIP Fitness Coaching Club',
        'client_type' => 'Fitness & Athletic Training',
        'category'    => 'web-dev',
        'category_name' => 'Web Platform',
        'image_url'   => 'https://chadsia.com/wp-content/uploads/2024/10/vip-Fitness.webp',
        'full_image_url' => 'https://chadsia.com/wp-content/uploads/2024/10/vip-Fitness.webp',
        'description' => 'High-energy fitness coaching and athletic performance training platform with coach booking, class schedule calendars, and mobile-first enrollment.',
        'metric'      => '+40% Member Signups',
        'tags'        => ['Fitness Coaching', 'Class Scheduling', 'Mobile First', 'Fast Load Times'],
        'live_url'    => '/contact/?service=front-end-development',
        'cta_text'    => 'Request Case Study',
        'is_lightbox' => false
    ],

    // ==========================================
    // 2. CONVERSION FUNNELS (CRO LANDING PAGES)
    // ==========================================
    [
        'id'          => 'college-board',
        'title'       => 'College Board SAT & AP Prep Funnel',
        'client_type' => 'EdTech & Standardized Testing',
        'category'    => 'funnels',
        'category_name' => 'Conversion Funnel',
        'image_url'   => 'https://chadsia.com/wp-content/uploads/2025/07/college-board-lp-1024x776.png',
        'full_image_url' => 'https://chadsia.com/wp-content/uploads/2025/07/college-board-lp.png',
        'description' => 'High-converting educational funnel designed for SAT and AP course enrollment with streamlined qualification steps and frictionless mobile checkout.',
        'metric'      => '+38% Conversion Lift',
        'tags'        => ['Conversion Funnel', 'High Intent UX', 'A/B Optimized', 'Sub-Second'],
        'live_url'    => 'https://chadsia.com/wp-content/uploads/2025/07/college-board-lp.png',
        'cta_text'    => 'View Full Build',
        'is_lightbox' => true
    ],
    [
        'id'          => 'mytutor-lp',
        'title'       => 'MyTutor Online Learning Matching Funnel',
        'client_type' => 'EdTech Marketplace',
        'category'    => 'funnels',
        'category_name' => 'Conversion Funnel',
        'image_url'   => 'https://chadsia.com/wp-content/uploads/2025/07/mytutor-lp-527x1024.jpg',
        'full_image_url' => 'https://chadsia.com/wp-content/uploads/2025/07/mytutor-lp.jpg',
        'description' => 'Interactive parent/student matching funnel with subject selector, tutor availability calendar, and trust badge objection-dismantling blocks.',
        'metric'      => '+39% Booking Rate',
        'tags'        => ['EdTech Funnel', 'Dynamic Subject Selector', 'Trust Engineering', 'Sub-Second'],
        'live_url'    => 'https://chadsia.com/wp-content/uploads/2025/07/mytutor-lp.jpg',
        'cta_text'    => 'View Full Build',
        'is_lightbox' => true
    ],
    [
        'id'          => 'investing-shortcuts',
        'title'       => 'Investing Shortcuts Advisory Funnel',
        'client_type' => 'Fintech & Wealth Advisory',
        'category'    => 'funnels',
        'category_name' => 'Conversion Funnel',
        'image_url'   => 'https://chadsia.com/wp-content/uploads/2025/07/investingshortcuts-lp-1024x948.jpg',
        'full_image_url' => 'https://chadsia.com/wp-content/uploads/2025/07/investingshortcuts-lp.jpg',
        'description' => 'Direct-response wealth advisory landing page designed for paid traffic acquisition, interactive portfolio quizzes, and instant newsletter opt-ins.',
        'metric'      => '+45% Lead Capture',
        'tags'        => ['Direct Response', 'Financial Lead Gen', 'Lead Scoring', 'Zero Bloat'],
        'live_url'    => 'https://chadsia.com/wp-content/uploads/2025/07/investingshortcuts-lp.jpg',
        'cta_text'    => 'View Full Build',
        'is_lightbox' => true
    ],
    [
        'id'          => 'onx-maps',
        'title'       => 'OnX Maps Outdoor Trail Navigation Funnel',
        'client_type' => 'GeoTech & Mobile App',
        'category'    => 'funnels',
        'category_name' => 'Conversion Funnel',
        'image_url'   => 'https://chadsia.com/wp-content/uploads/2025/07/onxmaps-lp-601x1024.jpg',
        'full_image_url' => 'https://chadsia.com/wp-content/uploads/2025/07/onxmaps-lp.jpg',
        'description' => 'App install and subscription acquisition funnel with dynamic offline GPS trail simulation cards and deep App Store attribution tracking.',
        'metric'      => '+62% App Installs',
        'tags'        => ['App Acquisition', 'Interactive Previews', 'Branch.io Tracking', 'High Speed'],
        'live_url'    => 'https://chadsia.com/wp-content/uploads/2025/07/onxmaps-lp.jpg',
        'cta_text'    => 'View Full Build',
        'is_lightbox' => true
    ],
    [
        'id'          => 'claim-compass',
        'title'       => 'ClaimCompass Flight Compensation Funnel',
        'client_type' => 'Fintech & Travel Rights',
        'category'    => 'funnels',
        'category_name' => 'Conversion Funnel',
        'image_url'   => 'https://chadsia.com/wp-content/uploads/2025/07/claimcompass-lp-497x1024.jpg',
        'full_image_url' => 'https://chadsia.com/wp-content/uploads/2025/07/claimcompass-lp.jpg',
        'description' => 'High-converting flight compensation claims funnel with multi-step interactive compensation estimator and sub-second mobile page speed.',
        'metric'      => '+42% Claim Submissions',
        'tags'        => ['Conversion Funnel', 'Multi-Step Form', 'A/B Tested', 'Sub-Second FCP'],
        'live_url'    => 'https://chadsia.com/wp-content/uploads/2025/07/claimcompass-lp.jpg',
        'cta_text'    => 'View Full Build',
        'is_lightbox' => true
    ],
    [
        'id'          => 'ooba-loans',
        'title'       => 'Ooba Home Loans Rate Estimator & Funnel',
        'client_type' => 'Fintech & Mortgage Calculator',
        'category'    => 'funnels',
        'category_name' => 'Conversion Funnel',
        'image_url'   => 'https://chadsia.com/wp-content/uploads/2025/07/ooba-lp-686x1024.jpg',
        'full_image_url' => 'https://chadsia.com/wp-content/uploads/2025/07/ooba-lp.jpg',
        'description' => 'Real-time interactive mortgage repayment slider with instant bank qualification estimates and high-intent lead qualification routing.',
        'metric'      => '+46% Qualified Leads',
        'tags'        => ['Fintech Calculator', 'Reactive UI', 'Lead Scoring API', 'Zero Layout Shift'],
        'live_url'    => 'https://chadsia.com/wp-content/uploads/2025/07/ooba-lp.jpg',
        'cta_text'    => 'View Full Build',
        'is_lightbox' => true
    ],
    [
        'id'          => 'tyres-on-the-drive',
        'title'       => 'TyresOnTheDrive Mobile Booking Funnel',
        'client_type' => 'On-Demand Automotive Services',
        'category'    => 'funnels',
        'category_name' => 'Conversion Funnel',
        'image_url'   => 'https://chadsia.com/wp-content/uploads/2025/07/tyresonthedrive-lp-315x1024.jpg',
        'full_image_url' => 'https://chadsia.com/wp-content/uploads/2025/07/tyresonthedrive-lp-scaled.jpg',
        'description' => 'High-intent location-based mobile booking funnel with dynamic vehicle registration lookups and frictionless time-slot selection.',
        'metric'      => '2.8s -> 0.7s LCP',
        'tags'        => ['Mobile Booking', 'Conversion Rate Optimization', 'Vehicle API', 'Zero Bloat'],
        'live_url'    => 'https://chadsia.com/wp-content/uploads/2025/07/tyresonthedrive-lp-scaled.jpg',
        'cta_text'    => 'View Full Build',
        'is_lightbox' => true
    ],
    [
        'id'          => 'twillory-lp',
        'title'       => 'Twillory Performance Apparel Landing Page',
        'client_type' => 'D2C E-Commerce Fashion',
        'category'    => 'funnels',
        'category_name' => 'Conversion Funnel',
        'image_url'   => 'https://chadsia.com/wp-content/uploads/2025/07/twillory-lp-247x1024.jpg',
        'full_image_url' => 'https://chadsia.com/wp-content/uploads/2025/07/twillory-lp-scaled.jpg',
        'description' => 'Direct-response product landing page built for high-spend Meta ad campaigns, dynamic size swatches, and 1-click Apple Pay checkout drawer.',
        'metric'      => '+38% Ad ROAS Lift',
        'tags'        => ['D2C Funnel', 'Direct Response', 'Meta CAPI', 'Instant Drawer Cart'],
        'live_url'    => 'https://chadsia.com/wp-content/uploads/2025/07/twillory-lp-scaled.jpg',
        'cta_text'    => 'View Full Build',
        'is_lightbox' => true
    ],
    [
        'id'          => 'the-listings-lab',
        'title'       => 'The Listings Lab Real Estate Acquisition Funnel',
        'client_type' => 'Real Estate Coaching & Mastermind',
        'category'    => 'funnels',
        'category_name' => 'Conversion Funnel',
        'image_url'   => 'https://chadsia.com/wp-content/uploads/2025/07/thelistingslab-lp-1024x766.jpg',
        'full_image_url' => 'https://chadsia.com/wp-content/uploads/2025/07/thelistingslab-lp.jpg',
        'description' => 'High-ticket real estate mastermind application funnel with high-retention video sales letter (VSL) player and automated calendar qualifier.',
        'metric'      => '+54% Application Rate',
        'tags'        => ['High-Ticket Funnel', 'Video VSL', 'Calendar Booking', 'Fast Loading'],
        'live_url'    => 'https://chadsia.com/wp-content/uploads/2025/07/thelistingslab-lp.jpg',
        'cta_text'    => 'View Full Build',
        'is_lightbox' => true
    ],
    [
        'id'          => 'later-lp',
        'title'       => 'Later Social Growth & Onboarding Funnel',
        'client_type' => 'SaaS Growth & Acquisition',
        'category'    => 'funnels',
        'category_name' => 'Conversion Funnel',
        'image_url'   => 'https://chadsia.com/wp-content/uploads/2025/07/later-lp-1024x1012.jpg',
        'full_image_url' => 'https://chadsia.com/wp-content/uploads/2025/07/later-lp.jpg',
        'description' => 'Engineered high-velocity SaaS acquisition funnel with interactive feature comparison toggle, animated social previews, and 1-click OAuth sign-up.',
        'metric'      => '+51% Trial Signups',
        'tags'        => ['SaaS Onboarding', 'Interactive UI', 'High-Velocity A/B', '99 PageSpeed'],
        'live_url'    => 'https://chadsia.com/wp-content/uploads/2025/07/later-lp.jpg',
        'cta_text'    => 'View Full Build',
        'is_lightbox' => true
    ],
    [
        'id'          => 'simply-business',
        'title'       => 'Simply Business Commercial Insurance Funnel',
        'client_type' => 'InsurTech & B2B Risk Services',
        'category'    => 'funnels',
        'category_name' => 'Conversion Funnel',
        'image_url'   => 'https://chadsia.com/wp-content/uploads/2025/07/simplybussiness-lp-589x1024.png',
        'full_image_url' => 'https://chadsia.com/wp-content/uploads/2025/07/simplybussiness-lp.png',
        'description' => 'Instant small business insurance quote funnel with step-by-step risk profiling, micro-copy trust builders, and real-time premium pricing.',
        'metric'      => '+33% Quote Completion',
        'tags'        => ['InsurTech Funnel', 'Multi-Step Quote', 'Instant Policy Calc', 'WCAG AA'],
        'live_url'    => 'https://chadsia.com/wp-content/uploads/2025/07/simplybussiness-lp.png',
        'cta_text'    => 'View Full Build',
        'is_lightbox' => true
    ],
    [
        'id'          => 'broco-energy-funnel',
        'title'       => 'Broco Energy Commercial Fuel Funnel',
        'client_type' => 'Industrial Fuel & Energy Dispatch',
        'category'    => 'funnels',
        'category_name' => 'Conversion Funnel',
        'image_url'   => 'https://chadsia.com/wp-content/uploads/2025/07/BROCO-ENERGY-411x1024.jpg',
        'full_image_url' => 'https://chadsia.com/wp-content/uploads/2025/07/BROCO-ENERGY.jpg',
        'description' => 'High-conversion commercial fuel delivery and fleet fueling landing page with emergency dispatch CTA triggers and automated zip code pricing.',
        'metric'      => '+64% B2B Inquiries',
        'tags'        => ['B2B Funnel', 'Fuel Dispatch API', 'Emergency Quote', 'Fast TTFB'],
        'live_url'    => 'https://chadsia.com/wp-content/uploads/2025/07/BROCO-ENERGY.jpg',
        'cta_text'    => 'View Full Build',
        'is_lightbox' => true
    ],

    // ==========================================
    // 3. GRAPHIC DESIGN
    // ==========================================
    [
        'id'          => 'gd-creative-leadership',
        'title'       => 'Creative Leadership & Digital Identity System',
        'client_type' => 'Executive Brand Architecture',
        'category'    => 'graphic-design',
        'category_name' => 'Graphic Design',
        'image_url'   => 'https://chadsia.com/wp-content/uploads/2025/07/Creative-Leadership-Chad-Sia.jpg',
        'full_image_url' => 'https://chadsia.com/wp-content/uploads/2025/07/Creative-Leadership-Chad-Sia.jpg',
        'description' => 'Complete digital brand strategy, bespoke typography system, high-contrast digital collateral, and scalable design token architecture.',
        'metric'      => '100% Brand Consistency',
        'tags'        => ['Brand Architecture', 'Design System', 'Typography Rhythms', 'Figma Tokens'],
        'live_url'    => 'https://chadsia.com/wp-content/uploads/2025/07/Creative-Leadership-Chad-Sia.jpg',
        'cta_text'    => 'View Full Graphic',
        'is_lightbox' => true
    ],
    [
        'id'          => 'gd-fc140',
        'title'       => 'FC140 Brand Identity & Logo Suite',
        'client_type' => 'Sports & Athletic Club Identity',
        'category'    => 'graphic-design',
        'category_name' => 'Graphic Design',
        'image_url'   => 'https://chadsia.com/wp-content/uploads/2025/07/FC140-Logo.jpg',
        'full_image_url' => 'https://chadsia.com/wp-content/uploads/2025/07/FC140-Logo.jpg',
        'description' => 'Modern geometric crest and complete vector emblem suite crafted for athletic merchandising, digital platforms, and apparel manufacturing.',
        'metric'      => 'Vector Master Suite',
        'tags'        => ['Logo Design', 'Vector Illustration', 'Brand Identity', 'Style Guide'],
        'live_url'    => 'https://chadsia.com/wp-content/uploads/2025/07/FC140-Logo.jpg',
        'cta_text'    => 'View Full Graphic',
        'is_lightbox' => true
    ],
    [
        'id'          => 'gd-silay-lokal',
        'title'       => 'Silay Lokal Brand Identity & Visual Marks',
        'client_type' => 'Local Heritage & Community Brand',
        'category'    => 'graphic-design',
        'category_name' => 'Graphic Design',
        'image_url'   => 'https://chadsia.com/wp-content/uploads/2025/07/SIlay-Lokal-Logo.jpg',
        'full_image_url' => 'https://chadsia.com/wp-content/uploads/2025/07/SIlay-Lokal-Logo.jpg',
        'description' => 'Distinctive cultural emblem and brand identity system honoring regional craft with flexible lockups for physical and digital collateral.',
        'metric'      => 'Bespoke Typography',
        'tags'        => ['Logo Suite', 'Local Brand', 'Signage Design', 'Merchandise'],
        'live_url'    => 'https://chadsia.com/wp-content/uploads/2025/07/SIlay-Lokal-Logo.jpg',
        'cta_text'    => 'View Full Graphic',
        'is_lightbox' => true
    ],
    [
        'id'          => 'gd-solarplus',
        'title'       => 'Solarplus Commercial Pull-Up Display Banner',
        'client_type' => 'CleanTech & Solar Energy',
        'category'    => 'graphic-design',
        'category_name' => 'Graphic Design',
        'image_url'   => 'https://chadsia.com/wp-content/uploads/2025/07/solarplus-pull-up-banner-Chad-Sia-scaled.jpg',
        'full_image_url' => 'https://chadsia.com/wp-content/uploads/2025/07/solarplus-pull-up-banner-Chad-Sia-scaled.jpg',
        'description' => 'High-impact exhibition pull-up banner designed for clean tech trade shows, featuring clear value proposition hierarchy and 300 DPI print precision.',
        'metric'      => 'Large-Format Print 300 DPI',
        'tags'        => ['Large Format Print', 'Trade Show Banner', 'CleanTech', 'Vector Layout'],
        'live_url'    => 'https://chadsia.com/wp-content/uploads/2025/07/solarplus-pull-up-banner-Chad-Sia-scaled.jpg',
        'cta_text'    => 'View Full Graphic',
        'is_lightbox' => true
    ],
    [
        'id'          => 'gd-usls-aspirants',
        'title'       => 'USLS Aspirants Championship Event Poster',
        'client_type' => 'University Sports & Athletics',
        'category'    => 'graphic-design',
        'category_name' => 'Graphic Design',
        'image_url'   => 'https://chadsia.com/wp-content/uploads/2025/07/aspirants-USLS-Poster-Chad-Sia-scaled.jpg',
        'full_image_url' => 'https://chadsia.com/wp-content/uploads/2025/07/aspirants-USLS-Poster-Chad-Sia-scaled.jpg',
        'description' => 'High-octane collegiate athletics championship poster utilizing bold contrast, dynamic athlete cutouts, and kinetic typographic layout.',
        'metric'      => 'Dynamic Composition',
        'tags'        => ['Event Poster', 'Sports Graphics', 'Photo Manipulation', 'Typography'],
        'live_url'    => 'https://chadsia.com/wp-content/uploads/2025/07/aspirants-USLS-Poster-Chad-Sia-scaled.jpg',
        'cta_text'    => 'View Full Graphic',
        'is_lightbox' => true
    ],
    [
        'id'          => 'gd-lars-peeters',
        'title'       => 'Lars Peeters Creative Campaign Poster',
        'client_type' => 'Creative & Music Artist',
        'category'    => 'graphic-design',
        'category_name' => 'Graphic Design',
        'image_url'   => 'https://chadsia.com/wp-content/uploads/2025/07/Lars-Peeters-Poster-Design-Chad-Sia.jpg',
        'full_image_url' => 'https://chadsia.com/wp-content/uploads/2025/07/Lars-Peeters-Poster-Design-Chad-Sia.jpg',
        'description' => 'Editorial poster artwork combining minimalist geometric grids with moody atmospheric photo treatment for album launch and promotional tour.',
        'metric'      => 'Editorial Art Direction',
        'tags'        => ['Editorial Poster', 'Artist Campaign', 'Visual Hierarchy', 'Print & Digital'],
        'live_url'    => 'https://chadsia.com/wp-content/uploads/2025/07/Lars-Peeters-Poster-Design-Chad-Sia.jpg',
        'cta_text'    => 'View Full Graphic',
        'is_lightbox' => true
    ],
    [
        'id'          => 'gd-banner-ads',
        'title'       => 'Multi-Channel Digital Advertising & Social Banners',
        'client_type' => 'Performance Marketing Collateral',
        'category'    => 'graphic-design',
        'category_name' => 'Graphic Design',
        'image_url'   => 'https://chadsia.com/wp-content/uploads/2025/07/BAnner-Ads-Chad-SIa.jpg',
        'full_image_url' => 'https://chadsia.com/wp-content/uploads/2025/07/BAnner-Ads-Chad-SIa.jpg',
        'description' => 'High-converting digital display advertising suite across standard IAB display sizes and vertical social story formats.',
        'metric'      => 'Omni-Channel Creative',
        'tags'        => ['Digital Banner Ads', 'Meta & Google Ads', 'Conversion Creative', 'A/B Testing'],
        'live_url'    => 'https://chadsia.com/wp-content/uploads/2025/07/BAnner-Ads-Chad-SIa.jpg',
        'cta_text'    => 'View Full Graphic',
        'is_lightbox' => true
    ],
    [
        'id'          => 'gd-black-friday',
        'title'       => 'Black Friday & Promotional Campaign Creative',
        'client_type' => 'E-Commerce & Retail Marketing',
        'category'    => 'graphic-design',
        'category_name' => 'Graphic Design',
        'image_url'   => 'https://chadsia.com/wp-content/uploads/2025/07/Black-Friday-Poster-Chad-Sia.jpg',
        'full_image_url' => 'https://chadsia.com/wp-content/uploads/2025/07/Black-Friday-Poster-Chad-Sia.jpg',
        'description' => 'High-urgency promotional graphics and sales collateral designed for seasonal flash sales, email announcements, and paid advertising.',
        'metric'      => '+58% Campaign CTR',
        'tags'        => ['Retail Campaign', 'Direct Response', 'Social Assets', 'Promo Graphics'],
        'live_url'    => 'https://chadsia.com/wp-content/uploads/2025/07/Black-Friday-Poster-Chad-Sia.jpg',
        'cta_text'    => 'View Full Graphic',
        'is_lightbox' => true
    ],
    [
        'id'          => 'gd-cloud-sia',
        'title'       => 'Cloud Sia Brand Art & Conceptual Poster',
        'client_type' => 'Digital Art & Studio Project',
        'category'    => 'graphic-design',
        'category_name' => 'Graphic Design',
        'image_url'   => 'https://chadsia.com/wp-content/uploads/2025/07/Cloud-Sia-Poster.jpg',
        'full_image_url' => 'https://chadsia.com/wp-content/uploads/2025/07/Cloud-Sia-Poster.jpg',
        'description' => 'Abstract digital art poster featuring custom 3D lighting, dimensional text sculpting, and futuristic cloudscape gradients.',
        'metric'      => '3D & Vector Art',
        'tags'        => ['Digital Poster', 'Creative Direction', '3D Visuals', 'Abstract Art'],
        'live_url'    => 'https://chadsia.com/wp-content/uploads/2025/07/Cloud-Sia-Poster.jpg',
        'cta_text'    => 'View Full Graphic',
        'is_lightbox' => true
    ],
    [
        'id'          => 'gd-stingers',
        'title'       => 'Stingers Athletic Championship Poster',
        'client_type' => 'Sports Team & League Collateral',
        'category'    => 'graphic-design',
        'category_name' => 'Graphic Design',
        'image_url'   => 'https://chadsia.com/wp-content/uploads/2025/07/stingers-champion-Chad-Sia.jpg',
        'full_image_url' => 'https://chadsia.com/wp-content/uploads/2025/07/stingers-champion-Chad-Sia.jpg',
        'description' => 'Championship commemorative poster featuring distressed textures, layered varsity typography, and celebratory action imagery.',
        'metric'      => 'High Energy Visuals',
        'tags'        => ['Sports Poster', 'Team Branding', 'Championship Victory', 'Print Collateral'],
        'live_url'    => 'https://chadsia.com/wp-content/uploads/2025/07/stingers-champion-Chad-Sia.jpg',
        'cta_text'    => 'View Full Graphic',
        'is_lightbox' => true
    ],
    [
        'id'          => 'gd-usls-game-day',
        'title'       => 'USLS Game Day Matchup Social Graphic',
        'client_type' => 'Collegiate Sports Social Media',
        'category'    => 'graphic-design',
        'category_name' => 'Graphic Design',
        'image_url'   => 'https://chadsia.com/wp-content/uploads/2025/07/Usls-game-day-Chad-Sia.jpg',
        'full_image_url' => 'https://chadsia.com/wp-content/uploads/2025/07/Usls-game-day-Chad-Sia.jpg',
        'description' => 'Bold match-day social graphic designed for immediate score announcements, player spotlights, and high-engagement social feeds.',
        'metric'      => 'Real-Time Social Asset',
        'tags'        => ['Social Media Graphic', 'Game Day Poster', 'Collegiate Athletics', 'Speed Layout'],
        'live_url'    => 'https://chadsia.com/wp-content/uploads/2025/07/Usls-game-day-Chad-Sia.jpg',
        'cta_text'    => 'View Full Graphic',
        'is_lightbox' => true
    ],
    [
        'id'          => 'gd-thinking-tools',
        'title'       => 'Creative Thinking Tools Visual Guide & Deck',
        'client_type' => 'Workshop & Educational Deck',
        'category'    => 'graphic-design',
        'category_name' => 'Graphic Design',
        'image_url'   => 'https://chadsia.com/wp-content/uploads/2025/07/Creative-Thinking-Tools-Chad-Sia.jpg',
        'full_image_url' => 'https://chadsia.com/wp-content/uploads/2025/07/Creative-Thinking-Tools-Chad-Sia.jpg',
        'description' => 'Structured educational visual guide breaking down complex ideation frameworks into clean, scannable, and memorable design diagrams.',
        'metric'      => 'Information Architecture',
        'tags'        => ['Infographic Deck', 'Visual Framework', 'Educational Asset', 'Slide Architecture'],
        'live_url'    => 'https://chadsia.com/wp-content/uploads/2025/07/Creative-Thinking-Tools-Chad-Sia.jpg',
        'cta_text'    => 'View Full Graphic',
        'is_lightbox' => true
    ],

    // ==========================================
    // 4. E-COMMERCE
    // ==========================================
    [
        'id'          => 'blusonil',
        'title'       => 'BluSonil Spa & Wellness Platform',
        'client_type' => 'Health and Wellness Spa',
        'category'    => 'ecommerce',
        'category_name' => 'E-Commerce',
        'image_url'   => 'https://chadsia.com/wp-content/uploads/2025/07/BluSonil-1024x546.png',
        'full_image_url' => 'https://chadsia.com/wp-content/uploads/2025/07/BluSonil.png',
        'description' => 'Developed a health and wellness spa platform with sub-second treatment showcase pages, interactive service selection, and streamlined direct booking.',
        'metric'      => '0.6s LCP · 100 SEO',
        'tags'        => ['Health & Wellness Spa', 'Sub-Second LCP', 'Custom PHP', 'Conversion UX'],
        'live_url'    => '/contact/?service=woocommerce-development',
        'cta_text'    => 'Request Case Study',
        'is_lightbox' => false
    ],
    [
        'id'          => 'kirk-allen',
        'title'       => 'Kirk Allen Landscape Supply',
        'client_type' => 'WordPress & WooCommerce Build',
        'category'    => 'ecommerce',
        'categories'  => ['ecommerce', 'web-dev'],
        'category_name' => 'WooCommerce & WordPress',
        'image_url'   => 'https://chadsia.com/wp-content/uploads/2025/07/Kirk-Allen-Landscape-Supply-1024x546.png',
        'full_image_url' => 'https://chadsia.com/wp-content/uploads/2025/07/Kirk-Allen-Landscape-Supply.png',
        'description' => 'Custom WordPress WooCommerce build engineered with dynamic location distance charging, automated delivery zone calculation, cubic yard material calculators, and streamlined checkout.',
        'metric'      => 'Custom Distance Charging',
        'tags'        => ['WordPress & WooCommerce', 'Location Distance Charging', 'Delivery Zone Logic', 'Material Calculator', 'Sub-Second Speed'],
        'live_url'    => 'https://www.kirkallenlandscapesupply.com/',
        'cta_text'    => 'View Live Platform',
        'is_lightbox' => false
    ],
    [
        'id'          => 'badminton-click',
        'title'       => 'BadmintonClick Pro Equipment Store',
        'client_type' => 'Sports Equipment E-Commerce',
        'category'    => 'ecommerce',
        'category_name' => 'E-Commerce',
        'image_url'   => 'https://chadsia.com/wp-content/uploads/2024/10/BadmintonClick.webp',
        'full_image_url' => 'https://chadsia.com/wp-content/uploads/2024/10/BadmintonClick.webp',
        'description' => 'High-volume racquet sports e-commerce platform with faceted attribute filtering, custom stringing tension configurator, and instant search.',
        'metric'      => '+55% Mobile Conversions',
        'tags'        => ['WooCommerce Pro', 'Faceted Filters', 'Custom Configurator', '0.5s Search'],
        'live_url'    => '/contact/?service=woocommerce-development',
        'cta_text'    => 'Request Case Study',
        'is_lightbox' => false
    ],
    [
        'id'          => 'pumpables',
        'title'       => 'Pumpables Maternal Health Devices',
        'client_type' => 'Direct to Consumer E-Commerce',
        'category'    => 'ecommerce',
        'category_name' => 'E-Commerce',
        'image_url'   => 'https://chadsia.com/wp-content/uploads/2024/10/Pumpables.webp',
        'full_image_url' => 'https://chadsia.com/wp-content/uploads/2024/10/Pumpables.webp',
        'description' => 'Global direct-to-consumer store with multi-currency checkout, custom fitting room sizing quiz, and subscription replenishment flows.',
        'metric'      => 'Multi-Currency Global Checkout',
        'tags'        => ['D2C E-Commerce', 'Interactive Sizing Quiz', 'Subscriptions', 'Sub-Second'],
        'live_url'    => '/contact/?service=woocommerce-development',
        'cta_text'    => 'Request Case Study',
        'is_lightbox' => false
    ],

    // ==========================================
    // 5. UI/UX & PRODUCT APPS
    // ==========================================
    [
        'id'          => 'atlas-app',
        'title'       => 'Atlas App Interactive Console',
        'client_type' => 'Live Sports & Betting App',
        'category'    => 'ui-ux',
        'category_name' => 'UI/UX & Product',
        'image_url'   => 'https://chadsia.com/wp-content/uploads/2025/07/Atlas-App-1024x546.png',
        'full_image_url' => 'https://chadsia.com/wp-content/uploads/2025/07/Atlas-App.png',
        'description' => 'Engineered an ultra-responsive betting application and interactive client console with zero-bloat state management and real-time live odds visualizers.',
        'metric'      => 'Real-Time Hydration',
        'tags'        => ['Betting App', 'React / Next.js', 'Mobile First', 'Micro-Interactions'],
        'live_url'    => '/contact/?service=front-end-development',
        'cta_text'    => 'Request Case Study',
        'is_lightbox' => false
    ]
];

// Enqueue styles
$css_url = get_stylesheet_directory_uri() . '/assets/css/portfolio-page.css';
$css_ver = file_exists(get_stylesheet_directory() . '/assets/css/portfolio-page.css') ? filemtime(get_stylesheet_directory() . '/assets/css/portfolio-page.css') : '2.0.0';
?>
<!-- Font Awesome Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="<?php echo esc_url($css_url); ?>?v=<?php echo esc_attr($css_ver); ?>" media="all" />

<!-- Structured Data (Schema.org / CollectionPage & ItemList) -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "CollectionPage",
  "name": "Featured Portfolio & Case Studies | Chad Sia Media",
  "description": "Explore enterprise web platforms, custom WordPress architectures, high-converting CRO funnels, graphic designs, and sub-second web applications engineered for global founders.",
  "url": "https://chadsia.com/portfolio/",
  "publisher": {
    "@type": "ProfessionalService",
    "name": "Chad Sia Media",
    "url": "https://chadsia.com"
  },
  "mainEntity": {
    "@type": "ItemList",
    "numberOfItems": <?php echo count($portfolio_items); ?>,
    "itemListElement": [
      <?php 
      $schema_elements = [];
      foreach ($portfolio_items as $index => $item) {
          $schema_elements[] = json_encode([
              '@type' => 'CreativeWork',
              'position' => $index + 1,
              'name' => $item['title'],
              'description' => $item['description'],
              'image' => $item['full_image_url'] ?? $item['image_url'],
              'genre' => $item['client_type']
          ], JSON_UNESCAPED_SLASHES);
      }
      echo implode(",\n      ", $schema_elements);
      ?>
    ]
  }
}
</script>

<div class="cs-portfolio-wrapper">
  
  <!-- =========================================================================
       1. HERO SECTION
       ========================================================================= -->
  <header class="cs-portfolio-hero">
    <div class="cs-hero-glow-blob"></div>
    <div class="cs-portfolio-container">
      <div class="cs-hero-content">
        <div class="cs-portfolio-eyebrow">
          <span>Engineering Showcase · Live Builds</span>
        </div>
        
        <h1 class="cs-portfolio-title">
          Proven Engineering &amp; <span class="cs-gradient-text">Digital Craft</span>
        </h1>
        
        <p class="cs-portfolio-subtitle">
          Explore enterprise web platforms, custom WordPress architectures, high-converting funnels, graphic designs, and sub-second web applications built for founders, leading brands, and fast-growing organizations.
        </p>

        <!-- Impact Metrics Bar -->
        <div class="cs-portfolio-stats">
          <div class="cs-stat-item">
            <span class="cs-stat-number cs-accent-metric">100+</span>
            <span class="cs-stat-label">Projects Launched</span>
          </div>
          <div class="cs-stat-divider"></div>
          <div class="cs-stat-item">
            <span class="cs-stat-number cs-primary-metric">&lt; 0.5s</span>
            <span class="cs-stat-label">Avg Initial Load Time</span>
          </div>
          <div class="cs-stat-divider"></div>
          <div class="cs-stat-item">
            <span class="cs-stat-number">98%</span>
            <span class="cs-stat-label">PageSpeed Avg Score</span>
          </div>
          <div class="cs-stat-divider"></div>
          <div class="cs-stat-item">
            <span class="cs-stat-number cs-accent-metric"><?php echo esc_html($years_exp_str); ?></span>
            <span class="cs-stat-label">Senior Craft</span>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- =========================================================================
       2. CATEGORY FILTER TABS
       ========================================================================= -->
  <section class="cs-filter-section">
    <div class="cs-portfolio-container">
      <div class="cs-filter-pills" role="tablist" aria-label="Portfolio Category Filters">
        <button type="button" class="cs-filter-btn active" data-filter="all" role="tab" aria-selected="true">
          <i class="fa-solid fa-grid-2"></i>
          <span>All Builds</span>
          <span class="cs-filter-count"><?php echo count($portfolio_items); ?></span>
        </button>
        <button type="button" class="cs-filter-btn" data-filter="web-dev" role="tab" aria-selected="false">
          <i class="fa-solid fa-code"></i>
          <span>Web Platforms</span>
          <span class="cs-filter-count"><?php echo count(array_filter($portfolio_items, fn($i) => in_array('web-dev', (array)($i['categories'] ?? [$i['category']])))); ?></span>
        </button>
        <button type="button" class="cs-filter-btn" data-filter="funnels" role="tab" aria-selected="false">
          <i class="fa-solid fa-bullseye"></i>
          <span>Conversion Funnels</span>
          <span class="cs-filter-count"><?php echo count(array_filter($portfolio_items, fn($i) => in_array('funnels', (array)($i['categories'] ?? [$i['category']])))); ?></span>
        </button>
        <button type="button" class="cs-filter-btn" data-filter="graphic-design" role="tab" aria-selected="false">
          <i class="fa-solid fa-palette"></i>
          <span>Graphic Designs</span>
          <span class="cs-filter-count"><?php echo count(array_filter($portfolio_items, fn($i) => in_array('graphic-design', (array)($i['categories'] ?? [$i['category']])))); ?></span>
        </button>
        <button type="button" class="cs-filter-btn" data-filter="ecommerce" role="tab" aria-selected="false">
          <i class="fa-solid fa-bag-shopping"></i>
          <span>E-Commerce</span>
          <span class="cs-filter-count"><?php echo count(array_filter($portfolio_items, fn($i) => in_array('ecommerce', (array)($i['categories'] ?? [$i['category']])))); ?></span>
        </button>
        <button type="button" class="cs-filter-btn" data-filter="ui-ux" role="tab" aria-selected="false">
          <i class="fa-solid fa-wand-magic-sparkles"></i>
          <span>UI/UX &amp; Apps</span>
          <span class="cs-filter-count"><?php echo count(array_filter($portfolio_items, fn($i) => in_array('ui-ux', (array)($i['categories'] ?? [$i['category']])))); ?></span>
        </button>
      </div>
    </div>
  </section>

  <!-- =========================================================================
       3. PORTFOLIO SHOWCASE CARDS GRID
       ========================================================================= -->
  <main class="cs-portfolio-grid-section">
    <div class="cs-portfolio-container">
      <div class="cs-portfolio-grid" id="csPortfolioGrid">
        <?php foreach ($portfolio_items as $index => $item): 
          $full_img = !empty($item['full_image_url']) ? $item['full_image_url'] : $item['image_url'];
          $is_lightbox = !empty($item['is_lightbox']);
          $cats_attr = !empty($item['categories']) ? implode(' ', (array)$item['categories']) : $item['category'];
        ?>
          <article class="cs-portfolio-card" data-category="<?php echo esc_attr($cats_attr); ?>" id="project-<?php echo esc_attr($item['id']); ?>" data-index="<?php echo esc_attr($index); ?>">
            
            <!-- Card Media Container -->
            <div class="cs-card-media">
              <img src="<?php echo esc_url($item['image_url']); ?>" alt="<?php echo esc_attr($item['title']); ?>" loading="lazy" />
              <div class="cs-card-media-overlay"></div>
              
              <!-- Floating Badges -->
              <div class="cs-media-badges">
                <span class="cs-client-badge"><?php echo esc_html($item['category_name']); ?></span>
                <?php if (!empty($item['metric'])): ?>
                  <span class="cs-metric-chip">
                    <i class="fa-solid fa-bolt"></i>
                    <?php echo esc_html($item['metric']); ?>
                  </span>
                <?php endif; ?>
              </div>

              <!-- Quick Expand Lightbox Overlay Button -->
              <button type="button" 
                      class="cs-media-expand-btn cs-lightbox-trigger" 
                      aria-label="View fullscreen image for <?php echo esc_attr($item['title']); ?>"
                      data-full-image="<?php echo esc_url($full_img); ?>"
                      data-title="<?php echo esc_attr($item['title']); ?>"
                      data-category="<?php echo esc_attr($item['category_name']); ?>"
                      data-metric="<?php echo esc_attr($item['metric'] ?? ''); ?>"
                      data-desc="<?php echo esc_attr($item['description']); ?>"
                      data-id="<?php echo esc_attr($item['id']); ?>">
                <i class="fa-solid fa-expand"></i>
                <span>Preview</span>
              </button>
            </div>

            <!-- Card Body -->
            <div class="cs-card-body">
              <div class="cs-card-client-tag"><?php echo esc_html($item['client_type']); ?></div>
              <h2 class="cs-card-title"><?php echo esc_html($item['title']); ?></h2>
              <p class="cs-card-desc"><?php echo esc_html($item['description']); ?></p>

              <!-- Tech Tags -->
              <?php if (!empty($item['tags'])): ?>
                <div class="cs-tech-tags">
                  <?php foreach ($item['tags'] as $tag): ?>
                    <span class="cs-tech-tag"><?php echo esc_html($tag); ?></span>
                  <?php endforeach; ?>
                </div>
              <?php endif; ?>

              <!-- Card Footer / Actions -->
              <div class="cs-card-footer">
                <?php if ($is_lightbox): ?>
                  <!-- Lightbox Trigger Button for Funnels & Graphic Designs -->
                  <button type="button" 
                          class="cs-card-link cs-lightbox-trigger"
                          data-full-image="<?php echo esc_url($full_img); ?>"
                          data-title="<?php echo esc_attr($item['title']); ?>"
                          data-category="<?php echo esc_attr($item['category_name']); ?>"
                          data-metric="<?php echo esc_attr($item['metric'] ?? ''); ?>"
                          data-desc="<?php echo esc_attr($item['description']); ?>"
                          data-id="<?php echo esc_attr($item['id']); ?>">
                    <span><?php echo esc_html($item['cta_text']); ?></span>
                    <i class="fa-solid fa-expand"></i>
                  </button>
                <?php else: ?>
                  <!-- External/Live Link for Web Platforms -->
                  <a href="<?php echo esc_url($item['live_url']); ?>" class="cs-card-link" <?php echo (strpos($item['live_url'], 'http') === 0) ? 'target="_blank" rel="noopener noreferrer"' : ''; ?>>
                    <span><?php echo esc_html($item['cta_text']); ?></span>
                    <i class="fa-solid fa-arrow-up-right-from-square"></i>
                  </a>
                <?php endif; ?>
                
                <a href="/contact/?project=<?php echo esc_attr($item['id']); ?>" class="cs-card-btn">
                  <span>Start Similar Build</span>
                  <i class="fa-solid fa-chevron-right"></i>
                </a>
              </div>
            </div>

          </article>
        <?php endforeach; ?>
      </div>

      <!-- =========================================================================
           4. CLOSING CTA BANNER
           ========================================================================= -->
      <div class="cs-portfolio-cta">
        <div class="cs-portfolio-cta-box">
          <h2>Have a Project in Mind? Let’s Build Something Extraordinary.</h2>
          <p>
            Whether you need a sub-second web platform, bespoke WordPress engineering, high-converting acquisition funnels, or high-impact graphic collateral, we engineer solutions built to scale.
          </p>
          <div class="cs-cta-btn-group">
            <a href="/contact/" class="cs-cta-primary-btn">
              <span>Book Your Discovery Call</span>
              <i class="fa-solid fa-arrow-right"></i>
            </a>
            <a href="/services/front-end-development/" class="cs-cta-secondary-btn">
              <span>Explore All 15 Services</span>
              <i class="fa-solid fa-layer-group"></i>
            </a>
          </div>
        </div>
      </div>

    </div>
  </main>

  <!-- =========================================================================
       5. NATIVE HIGH-RES LIGHTBOX MODAL
       ========================================================================= -->
  <div class="cs-lightbox-modal" id="csLightboxModal" role="dialog" aria-modal="true" aria-hidden="true" aria-label="Portfolio Full Image Preview">
    <div class="cs-lightbox-backdrop" id="csLightboxBackdrop"></div>
    
    <div class="cs-lightbox-dialog">
      <!-- Top Action Bar -->
      <div class="cs-lightbox-header">
        <div class="cs-lightbox-meta">
          <span class="cs-lightbox-badge" id="csLightboxBadge">Conversion Funnel</span>
          <span class="cs-lightbox-metric" id="csLightboxMetric">+38% Conversion Lift</span>
        </div>
        
        <div class="cs-lightbox-actions">
          <a href="#" id="csLightboxCta" class="cs-lightbox-cta-btn">
            <span>Start Similar Build</span>
            <i class="fa-solid fa-arrow-right"></i>
          </a>
          <button type="button" class="cs-lightbox-close-btn" id="csLightboxClose" aria-label="Close Lightbox">
            <i class="fa-solid fa-xmark"></i>
          </button>
        </div>
      </div>

      <!-- Main Image Viewport with Scrollable / Pan Capabilities -->
      <div class="cs-lightbox-viewport" id="csLightboxViewport">
        <div class="cs-lightbox-loader" id="csLightboxLoader">
          <i class="fa-solid fa-circle-notch fa-spin"></i>
        </div>
        <img src="" alt="" id="csLightboxImg" class="cs-lightbox-img" />
      </div>

      <!-- Navigation Arrows -->
      <button type="button" class="cs-lightbox-nav prev" id="csLightboxPrev" aria-label="Previous Project">
        <i class="fa-solid fa-chevron-left"></i>
      </button>
      <button type="button" class="cs-lightbox-nav next" id="csLightboxNext" aria-label="Next Project">
        <i class="fa-solid fa-chevron-right"></i>
      </button>

      <!-- Bottom Info Bar -->
      <div class="cs-lightbox-footer">
        <h3 id="csLightboxTitle" class="cs-lightbox-title">Project Title</h3>
        <p id="csLightboxDesc" class="cs-lightbox-desc">Project Description</p>
      </div>
    </div>
  </div>

</div>

<!-- Client-Side Filtering & Native Lightbox Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
  // 1. Category Filtering Logic
  const filterBtns = document.querySelectorAll('.cs-filter-btn');
  const cards = document.querySelectorAll('.cs-portfolio-card');

  filterBtns.forEach(btn => {
    btn.addEventListener('click', function() {
      const filter = this.getAttribute('data-filter');

      // Update active state
      filterBtns.forEach(b => {
        b.classList.remove('active');
        b.setAttribute('aria-selected', 'false');
      });
      this.classList.add('active');
      this.setAttribute('aria-selected', 'true');

      // Filter cards
      cards.forEach(card => {
        const cat = card.getAttribute('data-category') || '';
        const cats = cat.split(/\s+/);
        if (filter === 'all' || cats.includes(filter)) {
          card.classList.remove('is-hidden');
          card.style.opacity = '0';
          card.style.transform = 'translateY(12px)';
          setTimeout(() => {
            card.style.transition = 'all 0.35s ease';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
          }, 30);
        } else {
          card.classList.add('is-hidden');
        }
      });
    });
  });

  // 2. Fullscreen Native Lightbox Logic
  const modal = document.getElementById('csLightboxModal');
  const backdrop = document.getElementById('csLightboxBackdrop');
  const closeBtn = document.getElementById('csLightboxClose');
  const prevBtn = document.getElementById('csLightboxPrev');
  const nextBtn = document.getElementById('csLightboxNext');
  const lightboxImg = document.getElementById('csLightboxImg');
  const loader = document.getElementById('csLightboxLoader');
  const titleEl = document.getElementById('csLightboxTitle');
  const descEl = document.getElementById('csLightboxDesc');
  const badgeEl = document.getElementById('csLightboxBadge');
  const metricEl = document.getElementById('csLightboxMetric');
  const ctaEl = document.getElementById('csLightboxCta');
  const viewport = document.getElementById('csLightboxViewport');

  let currentGalleryItems = [];
  let currentIndex = 0;

  function collectVisibleItems() {
    const visibleTriggers = [];
    cards.forEach(card => {
      if (!card.classList.contains('is-hidden')) {
        const trigger = card.querySelector('.cs-lightbox-trigger');
        if (trigger) {
          visibleTriggers.push({
            img: trigger.getAttribute('data-full-image'),
            title: trigger.getAttribute('data-title'),
            cat: trigger.getAttribute('data-category'),
            metric: trigger.getAttribute('data-metric'),
            desc: trigger.getAttribute('data-desc'),
            id: trigger.getAttribute('data-id')
          });
        }
      }
    });
    return visibleTriggers;
  }

  function openLightbox(itemData) {
    currentGalleryItems = collectVisibleItems();
    currentIndex = currentGalleryItems.findIndex(i => i.id === itemData.id);
    if (currentIndex === -1) {
      currentGalleryItems = [itemData];
      currentIndex = 0;
    }

    renderLightboxSlide();
    modal.classList.add('is-active');
    modal.setAttribute('aria-hidden', 'false');
    document.body.style.overflow = 'hidden';
  }

  function renderLightboxSlide() {
    if (!currentGalleryItems.length) return;
    const item = currentGalleryItems[currentIndex];
    
    loader.style.display = 'flex';
    lightboxImg.style.opacity = '0';
    lightboxImg.src = item.img;
    lightboxImg.alt = item.title;

    lightboxImg.onload = function() {
      loader.style.display = 'none';
      lightboxImg.style.opacity = '1';
      viewport.scrollTop = 0; // Reset scroll to top of tall images
    };

    titleEl.textContent = item.title || '';
    descEl.textContent = item.desc || '';
    badgeEl.textContent = item.cat || '';
    
    if (item.metric && item.metric.trim() !== '') {
      metricEl.style.display = 'inline-flex';
      metricEl.textContent = item.metric;
    } else {
      metricEl.style.display = 'none';
    }

    if (item.id) {
      ctaEl.href = '/contact/?project=' + encodeURIComponent(item.id);
    } else {
      ctaEl.href = '/contact/';
    }

    // Toggle navigation arrows visibility if only 1 item
    if (currentGalleryItems.length <= 1) {
      prevBtn.style.display = 'none';
      nextBtn.style.display = 'none';
    } else {
      prevBtn.style.display = 'flex';
      nextBtn.style.display = 'flex';
    }
  }

  function closeLightbox() {
    modal.classList.remove('is-active');
    modal.setAttribute('aria-hidden', 'true');
    document.body.style.overflow = '';
    setTimeout(() => {
      lightboxImg.src = '';
    }, 300);
  }

  function showPrev() {
    if (!currentGalleryItems.length) return;
    currentIndex = (currentIndex - 1 + currentGalleryItems.length) % currentGalleryItems.length;
    renderLightboxSlide();
  }

  function showNext() {
    if (!currentGalleryItems.length) return;
    currentIndex = (currentIndex + 1) % currentGalleryItems.length;
    renderLightboxSlide();
  }

  // Trigger click delegation
  document.addEventListener('click', function(e) {
    const trigger = e.target.closest('.cs-lightbox-trigger');
    if (trigger) {
      e.preventDefault();
      const itemData = {
        img: trigger.getAttribute('data-full-image'),
        title: trigger.getAttribute('data-title'),
        cat: trigger.getAttribute('data-category'),
        metric: trigger.getAttribute('data-metric'),
        desc: trigger.getAttribute('data-desc'),
        id: trigger.getAttribute('data-id')
      };
      openLightbox(itemData);
    }
  });

  // Modal Controls
  if (closeBtn) closeBtn.addEventListener('click', closeLightbox);
  if (backdrop) backdrop.addEventListener('click', closeLightbox);
  if (prevBtn) prevBtn.addEventListener('click', showPrev);
  if (nextBtn) nextBtn.addEventListener('click', showNext);

  // Keyboard navigation
  document.addEventListener('keydown', function(e) {
    if (!modal.classList.contains('is-active')) return;
    if (e.key === 'Escape') {
      closeLightbox();
    } else if (e.key === 'ArrowLeft') {
      showPrev();
    } else if (e.key === 'ArrowRight') {
      showNext();
    }
  });
});
</script>
