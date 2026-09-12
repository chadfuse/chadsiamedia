<?php
/**
 * Chad Sia Media - Location & Global Directory Engine
 * Handles routing, template injection, ACF field registration, 301 SEO redirects, and shortcodes.
 */

if (!defined('ABSPATH')) {
    exit;
}

// =========================================================================
// Dynamic Years Calculation & Shortcodes (Started in 2009)
// =========================================================================
if (!function_exists('cs_get_years_experience')) {
    function cs_get_years_experience($start_year = 2009, $suffix = '+') {
        $start = (int) $start_year;
        $current = (int) current_time('Y');
        if ($current < 2009) {
            $current = (int) date('Y');
        }
        $years = max(1, $current - $start);
        return $years . $suffix;
    }
}

// Shortcode definitions (with safety check)
if (!shortcode_exists('cs_years_experience')) {
    add_shortcode('cs_years_experience', function ($atts) {
        $a = shortcode_atts([
            'start'  => 2009,
            'suffix' => '+'
        ], $atts);
        return cs_get_years_experience($a['start'], $a['suffix']);
    });
}

if (!shortcode_exists('cs_years_since')) {
    add_shortcode('cs_years_since', function ($atts) {
        $a = shortcode_atts([
            'start' => 2009
        ], $atts);
        return cs_get_years_experience($a['start'], '');
    });
}

if (!shortcode_exists('cs_start_year')) {
    add_shortcode('cs_start_year', function () {
        return '2009';
    });
}

if (!shortcode_exists('l4-years-in-business')) {
    add_shortcode('l4-years-in-business', function () {
        return cs_get_years_experience(2009, '');
    });
}

// =========================================================================
// Routing Helper Functions
// =========================================================================
function cs_is_country_hub_page(): bool {
    $post_id = get_queried_object_id() ?: get_the_ID();
    $uri = $_SERVER['REQUEST_URI'] ?? '';
    $path = trim(parse_url($uri, PHP_URL_PATH), '/');

    $known_countries = [
        'locations/united-states',
        'locations/united-kingdom',
        'locations/australia',
        'locations/philippines',
        'locations/canada'
    ];
    if (in_array($path, $known_countries)) {
        return true;
    }

    if ($post_id) {
        $parent_id = wp_get_post_parent_id($post_id);
        if ($parent_id == 3984) {
            return true;
        }
        $slug = (string) get_post_field('post_name', $post_id);
        if (in_array($slug, ['united-states', 'united-kingdom', 'australia', 'philippines', 'canada']) && strpos($uri, '/locations/') !== false) {
            return true;
        }
    }

    return false;
}

function cs_is_locations_directory(): bool {
    if (cs_is_country_hub_page()) {
        return false;
    }

    $post_id = get_queried_object_id() ?: get_the_ID();
    $uri = $_SERVER['REQUEST_URI'] ?? '';
    $path = trim(parse_url($uri, PHP_URL_PATH), '/');

    if ($path === 'locations') {
        return true;
    }

    if (!$post_id) {
        return false;
    }
    
    $slug = (string) get_post_field('post_name', $post_id);
    $meta_tpl = get_post_meta($post_id, '_wp_page_template', true);

    return (
        $post_id == 3984 ||
        $slug === 'locations' ||
        $meta_tpl === 'template-locations-directory.php' ||
        $meta_tpl === 'page-templates/template-locations-directory.php'
    );
}

function cs_is_location_page(): bool {
    if (cs_is_locations_directory() || cs_is_country_hub_page() || cs_is_client_discovery_page()) {
        return false;
    }
    
    $post_id = get_queried_object_id() ?: get_the_ID();
    $uri = $_SERVER['REQUEST_URI'] ?? '';
    $path = trim(parse_url($uri, PHP_URL_PATH), '/');

    if ($path === 'locations' || in_array($path, ['locations/united-states', 'locations/united-kingdom', 'locations/australia', 'locations/philippines', 'locations/canada', 'client-discovery'])) {
        return false;
    }

    if (!$post_id) {
        return (strpos($uri, 'web-design-') !== false || strpos($uri, '/locations/') !== false);
    }
    
    $meta_tpl = get_post_meta($post_id, '_wp_page_template', true);
    $parent_id = wp_get_post_parent_id($post_id);
    $slug = (string) get_post_field('post_name', $post_id);

    return (
        $meta_tpl === 'template-location.php' ||
        $meta_tpl === 'page-templates/template-location.php' ||
        in_array($parent_id, [4667, 4668, 4669, 4670, 4671]) ||
        strpos($slug, 'web-design-') === 0 ||
        strpos($slug, 'web-designer-') === 0 ||
        strpos($uri, '/web-design-') !== false ||
        (strpos($uri, '/locations/') !== false && $path !== 'locations')
    );
}

function cs_is_client_discovery_page(): bool {
    $post_id = get_queried_object_id() ?: get_the_ID();
    $uri = $_SERVER['REQUEST_URI'] ?? '';
    $path = trim(parse_url($uri, PHP_URL_PATH), '/');

    if ($path === 'client-discovery' || strpos($path, 'client-discovery') !== false) {
        return true;
    }

    if (!$post_id) {
        return false;
    }

    $slug = (string) get_post_field('post_name', $post_id);
    $meta_tpl = get_post_meta($post_id, '_wp_page_template', true);

    return (
        $slug === 'client-discovery' ||
        $meta_tpl === 'template-client-discovery.php' ||
        $meta_tpl === 'page-templates/template-client-discovery.php'
    );
}

// =========================================================================
// 301 Permanent SEO Redirect Handler for Legacy Flat Location Slugs
// =========================================================================
add_action('template_redirect', function () {
    $uri = $_SERVER['REQUEST_URI'] ?? '';
    $path = trim(parse_url($uri, PHP_URL_PATH), '/');

    if (empty($path)) {
        return;
    }

    // Check if path is legacy format: web-design-{city} or web-designer-{city} or locations/{legacy_slug}
    $legacy_city = '';
    $is_legacy = false;

    if (preg_match('#^web-design-(.+)$#', $path, $m)) {
        $legacy_city = $m[1];
        $is_legacy = true;
    } elseif (preg_match('#^web-designer-(.+)$#', $path, $m)) {
        $legacy_city = $m[1];
        $is_legacy = true;
    } elseif (preg_match('#^locations/web-design-(.+)$#', $path, $m)) {
        $legacy_city = $m[1];
        $is_legacy = true;
    } elseif (preg_match('#^locations/web-designer-(.+)$#', $path, $m)) {
        $legacy_city = $m[1];
        $is_legacy = true;
    }

    if ($is_legacy && !empty($legacy_city)) {
        // Map of known city slugs to their country hubs
        $us_cities = ['new-york', 'los-angeles', 'san-francisco', 'austin', 'chicago', 'seattle', 'miami', 'boston', 'denver', 'atlanta', 'dallas', 'san-diego'];
        $uk_cities = ['london', 'manchester', 'birmingham', 'edinburgh', 'bristol', 'leeds', 'glasgow', 'cambridge', 'liverpool', 'oxford'];
        $au_cities = ['sydney', 'melbourne', 'brisbane', 'perth', 'adelaide', 'gold-coast', 'canberra', 'newcastle', 'sunshine-coast', 'wollongong'];
        $ca_cities = ['toronto', 'vancouver', 'montreal', 'calgary'];

        $country_slug = 'philippines';
        if (in_array($legacy_city, $us_cities)) {
            $country_slug = 'united-states';
        } elseif (in_array($legacy_city, $uk_cities)) {
            $country_slug = 'united-kingdom';
        } elseif (in_array($legacy_city, $au_cities)) {
            $country_slug = 'australia';
        } elseif (in_array($legacy_city, $ca_cities)) {
            $country_slug = 'canada';
        }

        $clean_city_slug = $legacy_city;
        $target_url = home_url("/locations/{$country_slug}/{$clean_city_slug}/");
        wp_redirect($target_url, 301);
        exit;
    }
}, 1);

// =========================================================================
// Template Path Resolver Helper
// =========================================================================
function cs_get_template_block($file_name) {
    $theme_path = get_stylesheet_directory() . '/page-templates/' . $file_name;
    if (file_exists($theme_path)) {
        return $theme_path;
    }
    $sandbox_path = WP_CONTENT_DIR . '/novamira-sandbox/templates/' . $file_name;
    if (file_exists($sandbox_path)) {
        return $sandbox_path;
    }
    return false;
}

// =========================================================================
// Content Filter Injection
// =========================================================================
add_filter('the_content', function ($content) {
    if (cs_is_country_hub_page()) {
        static $rendered_hub = false;
        if (!$rendered_hub) {
            $rendered_hub = true;
            $block = cs_get_template_block('country-hub-content.php');
            if ($block) {
                ob_start();
                include $block;
                return ob_get_clean();
            }
        }
    } elseif (cs_is_locations_directory()) {
        static $rendered_dir = false;
        if (!$rendered_dir) {
            $rendered_dir = true;
            $block = cs_get_template_block('locations-directory-content.php');
            if ($block) {
                ob_start();
                include $block;
                return ob_get_clean();
            }
        }
    } elseif (cs_is_location_page()) {
        static $rendered_loc = false;
        if (!$rendered_loc) {
            $rendered_loc = true;
            $block = cs_get_template_block('location-content.php');
            if ($block) {
                ob_start();
                include $block;
                return ob_get_clean();
            }
        }
    } elseif (cs_is_client_discovery_page()) {
        static $rendered_disc = false;
        if (!$rendered_disc) {
            $rendered_disc = true;
            $block = cs_get_template_block('client-discovery-content.php');
            if ($block) {
                ob_start();
                include $block;
                return ob_get_clean();
            }
        }
    }
    return $content;
}, 1);

// =========================================================================
// Fallback Template Include
// =========================================================================
add_filter('template_include', function ($template) {
    if (cs_is_country_hub_page()) {
        $tpl = cs_get_template_block('template-country-hub.php');
        if ($tpl) return $tpl;
    } elseif (cs_is_locations_directory()) {
        $tpl = cs_get_template_block('template-locations-directory.php');
        if ($tpl) return $tpl;
    } elseif (cs_is_location_page()) {
        $tpl = cs_get_template_block('template-location.php');
        if ($tpl) return $tpl;
    } elseif (cs_is_client_discovery_page()) {
        $tpl = cs_get_template_block('template-client-discovery.php');
        if ($tpl) return $tpl;
    }
    return $template;
}, 9999);

// =========================================================================
// Enqueue Scoped CSS & JS
// =========================================================================
add_action('wp_enqueue_scripts', function () {
    if (cs_is_location_page() || cs_is_locations_directory() || cs_is_country_hub_page()) {
        wp_enqueue_style(
            'cs-font-awesome',
            'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css',
            [],
            '6.5.1'
        );
        wp_enqueue_style(
            'cs-location-styles',
            get_stylesheet_directory_uri() . '/assets/css/location-page.css',
            ['cs-font-awesome'],
            '2.0.2'
        );
        wp_enqueue_script(
            'cs-location-scripts',
            get_stylesheet_directory_uri() . '/assets/js/location-page.js',
            [],
            '2.0.2',
            true
        );
    }
}, 30);

// =========================================================================
// Rank Math SEO & AEO Dynamic Title & Meta Description Filters
// =========================================================================
add_filter('rank_math/frontend/title', function ($title) {
    $post_id = get_queried_object_id() ?: get_the_ID();
    if (!$post_id) {
        return $title;
    }

    $custom_title = get_post_meta($post_id, 'rank_math_title', true);
    if (!empty($custom_title)) {
        return $custom_title;
    }

    if (cs_is_location_page()) {
        $city = get_post_meta($post_id, 'city_name', true) ?: get_the_title($post_id);
        $city = trim(str_ireplace(['Web Design', 'Web Development', 'in', '·'], '', $city));
        return "Web Design {$city} | WordPress & AI Automation | Chad Sia";
    } elseif (cs_is_country_hub_page()) {
        $country = get_post_meta($post_id, 'country_name', true) ?: get_the_title($post_id);
        $country = trim(str_ireplace(['Web Design', 'Web Development', 'Locations in', 'in'], '', $country));
        return "Web Design & AI Automation {$country} | Chad Sia Media";
    } elseif (cs_is_locations_directory()) {
        return "Global Web Design & AI Automation Locations | Chad Sia Media";
    } elseif (cs_is_client_discovery_page()) {
        return "Client Discovery & Project Intake Questionnaire | Chad Sia Media";
    }

    return $title;
}, 99);

add_filter('rank_math/frontend/description', function ($description) {
    $post_id = get_queried_object_id() ?: get_the_ID();
    if (!$post_id) {
        return $description;
    }

    $custom_desc = get_post_meta($post_id, 'rank_math_description', true);
    if (!empty($custom_desc)) {
        return $custom_desc;
    }

    if (cs_is_location_page()) {
        $city = get_post_meta($post_id, 'city_name', true) ?: get_the_title($post_id);
        $city = trim(str_ireplace(['Web Design', 'Web Development', 'in', '·'], '', $city));
        $country = get_post_meta($post_id, 'country_name', true) ?: 'Global';
        return "Looking for custom web design in {$city}, {$country}? Chad Sia delivers high-speed WordPress development, modern UI/UX, and smart AI automation.";
    } elseif (cs_is_country_hub_page()) {
        $country = get_post_meta($post_id, 'country_name', true) ?: get_the_title($post_id);
        $country = trim(str_ireplace(['Web Design', 'Web Development', 'Locations in', 'in'], '', $country));
        return "Discover elite bespoke WordPress & AI automation in {$country}. Fast, scalable, high-converting digital platforms engineered by Chad Sia Media.";
    } elseif (cs_is_locations_directory()) {
        return "Explore Chad Sia Media's global web design directory. Serving businesses across the US, UK, Australia, Canada, and Philippines with high-speed WordPress.";
    } elseif (cs_is_client_discovery_page()) {
        return "Submit your website requirements, goals, and tech stack for a comprehensive architectural assessment and estimate from Chad Sia Media.";
    }

    return $description;
}, 99);

add_filter('rank_math/opengraph/facebook/title', function ($title) {
    return apply_filters('rank_math/frontend/title', $title);
}, 99);

add_filter('rank_math/opengraph/facebook/description', function ($description) {
    return apply_filters('rank_math/frontend/description', $description);
}, 99);

add_filter('rank_math/opengraph/twitter/title', function ($title) {
    return apply_filters('rank_math/frontend/title', $title);
}, 99);

add_filter('rank_math/opengraph/twitter/description', function ($description) {
    return apply_filters('rank_math/frontend/description', $description);
}, 99);

// =========================================================================
// Register Page Templates
// =========================================================================
add_filter('theme_page_templates', function ($templates) {
    $templates['template-location.php'] = 'Location Page (SEO / AEO / GEO)';
    $templates['template-locations-directory.php'] = 'Locations Directory (Global Hubs & Markets)';
    $templates['template-country-hub.php'] = 'Country Hub (Strategic Engineering Hubs)';
    $templates['template-client-discovery.php'] = 'Client Discovery (Interactive Brief Workflow)';
    return $templates;
});

add_filter('theme_templates', function ($templates, $theme, $post, $post_type) {
    if ($post_type === 'page') {
        $templates['template-location.php'] = 'Location Page (SEO / AEO / GEO)';
        $templates['template-locations-directory.php'] = 'Locations Directory (Global Hubs & Markets)';
        $templates['template-country-hub.php'] = 'Country Hub (Strategic Engineering Hubs)';
        $templates['template-client-discovery.php'] = 'Client Discovery (Interactive Brief Workflow)';
    }
    return $templates;
}, 10, 4);

// =========================================================================
// Register ACF Field Groups for Location Pages & Country Hubs
// =========================================================================
add_action('acf/init', function () {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }

    // 1. Comprehensive Location Page Field Group
    acf_add_local_field_group([
        'key' => 'group_cs_location_page',
        'title' => 'Location Page Settings (SEO / AEO / GEO)',
        'fields' => [
            // Tab 1: Geographic & Entity Data
            [
                'key' => 'field_tab_geo',
                'label' => 'Geographic & Entity Data',
                'type' => 'tab',
            ],
            [
                'key' => 'field_city_name',
                'label' => 'City Name',
                'name' => 'city_name',
                'type' => 'text',
                'placeholder' => 'New York City',
            ],
            [
                'key' => 'field_province_state',
                'label' => 'Province / State / Region',
                'name' => 'province_state',
                'type' => 'text',
                'placeholder' => 'New York',
            ],
            [
                'key' => 'field_country_name',
                'label' => 'Country',
                'name' => 'country_name',
                'type' => 'text',
                'default_value' => 'United States',
            ],
            [
                'key' => 'field_wikidata_url',
                'label' => 'Wikidata / Wikipedia Entity URL',
                'name' => 'wikidata_url',
                'type' => 'url',
                'placeholder' => 'https://www.wikidata.org/wiki/Q60',
            ],
            [
                'key' => 'field_aeo_direct_answer',
                'label' => 'AEO Direct Answer Summary',
                'name' => 'aeo_direct_answer',
                'type' => 'textarea',
                'rows' => 3,
                'instructions' => 'Concise, authoritative summary cited by AI Answer Engines (Perplexity, ChatGPT Search, Google AI Overviews).',
            ],

            // Tab 2: Hero Section
            [
                'key' => 'field_tab_hero',
                'label' => 'Hero Section',
                'type' => 'tab',
            ],
            [
                'key' => 'field_hero_kicker',
                'label' => 'Eyebrow / Kicker',
                'name' => 'hero_kicker',
                'type' => 'text',
            ],
            [
                'key' => 'field_hero_h1',
                'label' => 'Hero H1 Heading (HTML allowed)',
                'name' => 'hero_h1',
                'type' => 'text',
            ],
            [
                'key' => 'field_hero_subtitle',
                'label' => 'Hero Subtitle',
                'name' => 'hero_subtitle',
                'type' => 'textarea',
                'rows' => 3,
            ],
            [
                'key' => 'field_hero_primary_cta_text',
                'label' => 'Primary CTA Button Text',
                'name' => 'hero_primary_cta_text',
                'type' => 'text',
                'default_value' => 'Book a Discovery Call',
            ],
            [
                'key' => 'field_hero_primary_cta_url',
                'label' => 'Primary CTA Button URL',
                'name' => 'hero_primary_cta_url',
                'type' => 'text',
                'default_value' => '/contact/',
            ],
            [
                'key' => 'field_hero_secondary_cta_text',
                'label' => 'Secondary CTA Button Text',
                'name' => 'hero_secondary_cta_text',
                'type' => 'text',
                'default_value' => 'Explore What We Do',
            ],
            [
                'key' => 'field_hero_secondary_cta_url',
                'label' => 'Secondary CTA Button URL',
                'name' => 'hero_secondary_cta_url',
                'type' => 'text',
                'default_value' => '#what-we-do',
            ],
            [
                'key' => 'field_hero_stat_num',
                'label' => 'Floating Card Main Stat',
                'name' => 'hero_stat_num',
                'type' => 'text',
                'default_value' => 'Sub-Second TTFB',
            ],
            [
                'key' => 'field_hero_stat_lbl',
                'label' => 'Floating Card Stat Label',
                'name' => 'hero_stat_lbl',
                'type' => 'text',
                'default_value' => '90+ Google PageSpeed Guarantee',
            ],

            // Tab 3: Credibility Stats
            [
                'key' => 'field_tab_stats',
                'label' => 'Stats Bar',
                'type' => 'tab',
            ],
            [
                'key' => 'field_stats_items',
                'label' => 'Credibility Stats',
                'name' => 'stats_items',
                'type' => 'repeater',
                'layout' => 'table',
                'button_label' => 'Add Stat Item',
                'sub_fields' => [
                    [
                        'key' => 'field_stat_num',
                        'label' => 'Number / Metric',
                        'name' => 'number_stat',
                        'type' => 'text',
                    ],
                    [
                        'key' => 'field_stat_lbl',
                        'label' => 'Label',
                        'name' => 'label_stat',
                        'type' => 'text',
                    ],
                ],
            ],

            // Tab 4: Who We Are & Who We Serve
            [
                'key' => 'field_tab_who',
                'label' => 'Who Section',
                'type' => 'tab',
            ],
            [
                'key' => 'field_who_kicker',
                'label' => 'Who Section Kicker',
                'name' => 'who_kicker',
                'type' => 'text',
                'default_value' => '2. Who We Are',
            ],
            [
                'key' => 'field_who_title',
                'label' => 'Who Section Heading',
                'name' => 'who_title',
                'type' => 'text',
            ],
            [
                'key' => 'field_who_lead',
                'label' => 'Who Section Lead Paragraph',
                'name' => 'who_lead',
                'type' => 'textarea',
                'rows' => 3,
            ],
            [
                'key' => 'field_who_body',
                'label' => 'Who Section Supporting Paragraph',
                'name' => 'who_body',
                'type' => 'textarea',
                'rows' => 3,
            ],
            [
                'key' => 'field_who_highlights',
                'label' => 'Who Highlights (Pills)',
                'name' => 'who_highlights',
                'type' => 'repeater',
                'layout' => 'table',
                'button_label' => 'Add Highlight Pill',
                'sub_fields' => [
                    [
                        'key' => 'field_who_hl_strong',
                        'label' => 'Bold Text',
                        'name' => 'strong_text',
                        'type' => 'text',
                    ],
                    [
                        'key' => 'field_who_hl_label',
                        'label' => 'Subtitle / Label',
                        'name' => 'label_text',
                        'type' => 'text',
                    ],
                ],
            ],
            [
                'key' => 'field_who_target_title',
                'label' => 'Who We Partner With Heading',
                'name' => 'who_target_title',
                'type' => 'text',
            ],
            [
                'key' => 'field_who_target_sub',
                'label' => 'Who We Partner With Subtitle',
                'name' => 'who_target_sub',
                'type' => 'textarea',
                'rows' => 2,
            ],
            [
                'key' => 'field_who_target_items',
                'label' => 'Target Industries List',
                'name' => 'who_target_items',
                'type' => 'repeater',
                'layout' => 'block',
                'button_label' => 'Add Target Industry',
                'sub_fields' => [
                    [
                        'key' => 'field_target_icon',
                        'label' => 'FontAwesome Icon Class',
                        'name' => 'icon_class',
                        'type' => 'text',
                        'placeholder' => 'fa-solid fa-building',
                    ],
                    [
                        'key' => 'field_target_title',
                        'label' => 'Industry Name',
                        'name' => 'title',
                        'type' => 'text',
                    ],
                    [
                        'key' => 'field_target_desc',
                        'label' => 'Description',
                        'name' => 'description',
                        'type' => 'textarea',
                        'rows' => 2,
                    ],
                ],
            ],

            // Tab 5: Why Choose Us
            [
                'key' => 'field_tab_why',
                'label' => 'Why Choose Us',
                'type' => 'tab',
            ],
            [
                'key' => 'field_why_kicker',
                'label' => 'Why Section Kicker',
                'name' => 'why_kicker',
                'type' => 'text',
                'default_value' => '3. Why Choose Us',
            ],
            [
                'key' => 'field_why_title',
                'label' => 'Why Section Title',
                'name' => 'why_title',
                'type' => 'text',
            ],
            [
                'key' => 'field_why_subtitle',
                'label' => 'Why Section Subtitle',
                'name' => 'why_subtitle',
                'type' => 'textarea',
                'rows' => 2,
            ],
            [
                'key' => 'field_why_cards',
                'label' => 'Why Choose Us Cards',
                'name' => 'why_cards',
                'type' => 'repeater',
                'layout' => 'block',
                'button_label' => 'Add Why Card',
                'sub_fields' => [
                    [
                        'key' => 'field_why_card_num',
                        'label' => 'Number Badge',
                        'name' => 'card_number',
                        'type' => 'text',
                        'placeholder' => '01',
                    ],
                    [
                        'key' => 'field_why_card_icon',
                        'label' => 'FontAwesome Icon Class',
                        'name' => 'icon_class',
                        'type' => 'text',
                        'placeholder' => 'fa-solid fa-bolt',
                    ],
                    [
                        'key' => 'field_why_card_title',
                        'label' => 'Card Heading',
                        'name' => 'title',
                        'type' => 'text',
                    ],
                    [
                        'key' => 'field_why_card_desc',
                        'label' => 'Card Description',
                        'name' => 'description',
                        'type' => 'textarea',
                        'rows' => 3,
                    ],
                ],
            ],

            // Tab 6: Where We Operate
            [
                'key' => 'field_tab_where',
                'label' => 'Where We Operate',
                'type' => 'tab',
            ],
            [
                'key' => 'field_where_kicker',
                'label' => 'Where Section Kicker',
                'name' => 'where_kicker',
                'type' => 'text',
                'default_value' => '4. Where We Operate',
            ],
            [
                'key' => 'field_where_title',
                'label' => 'Where Section Title',
                'name' => 'where_title',
                'type' => 'text',
            ],
            [
                'key' => 'field_local_story',
                'label' => 'Local Story Paragraph 1 (Tailored Narrative)',
                'name' => 'local_section_story',
                'type' => 'textarea',
                'rows' => 4,
            ],
            [
                'key' => 'field_where_secondary_story',
                'label' => 'Local Story Paragraph 2',
                'name' => 'where_secondary_story',
                'type' => 'textarea',
                'rows' => 3,
            ],
            [
                'key' => 'field_where_features',
                'label' => 'Local Market Value Pillars',
                'name' => 'where_features',
                'type' => 'repeater',
                'layout' => 'block',
                'button_label' => 'Add Feature Card',
                'sub_fields' => [
                    [
                        'key' => 'field_where_feat_icon',
                        'label' => 'FontAwesome Icon Class',
                        'name' => 'icon_class',
                        'type' => 'text',
                        'placeholder' => 'fa-solid fa-location-dot',
                    ],
                    [
                        'key' => 'field_where_feat_title',
                        'label' => 'Feature Title',
                        'name' => 'title',
                        'type' => 'text',
                    ],
                    [
                        'key' => 'field_where_feat_desc',
                        'label' => 'Feature Description',
                        'name' => 'description',
                        'type' => 'textarea',
                        'rows' => 2,
                    ],
                ],
            ],

            // Tab 7: FAQs
            [
                'key' => 'field_tab_faqs',
                'label' => 'FAQs',
                'type' => 'tab',
            ],
            [
                'key' => 'field_faqs_kicker',
                'label' => 'FAQs Kicker',
                'name' => 'faqs_kicker',
                'type' => 'text',
                'default_value' => 'Common Inquiries',
            ],
            [
                'key' => 'field_faqs_title',
                'label' => 'FAQs Heading',
                'name' => 'faqs_title',
                'type' => 'text',
                'default_value' => 'Frequently Asked Questions',
            ],
            [
                'key' => 'field_faqs_subtitle',
                'label' => 'FAQs Subtitle',
                'name' => 'faqs_subtitle',
                'type' => 'textarea',
                'rows' => 2,
            ],
            [
                'key' => 'field_location_faqs',
                'label' => 'Location FAQs',
                'name' => 'location_faqs',
                'type' => 'repeater',
                'layout' => 'block',
                'button_label' => 'Add FAQ',
                'sub_fields' => [
                    [
                        'key' => 'field_faq_q',
                        'label' => 'Question',
                        'name' => 'question',
                        'type' => 'text',
                    ],
                    [
                        'key' => 'field_faq_a',
                        'label' => 'Answer',
                        'name' => 'answer',
                        'type' => 'textarea',
                        'rows' => 3,
                    ],
                ],
            ],

            // Tab 8: Bottom CTA Banner
            [
                'key' => 'field_tab_cta',
                'label' => 'Bottom CTA Banner',
                'type' => 'tab',
            ],
            [
                'key' => 'field_cta_kicker',
                'label' => 'CTA Kicker',
                'name' => 'cta_kicker',
                'type' => 'text',
                'default_value' => "Let's Build Together",
            ],
            [
                'key' => 'field_cta_title',
                'label' => 'CTA Heading',
                'name' => 'cta_title',
                'type' => 'text',
            ],
            [
                'key' => 'field_cta_desc',
                'label' => 'CTA Description',
                'name' => 'cta_desc',
                'type' => 'textarea',
                'rows' => 3,
            ],
            [
                'key' => 'field_cta_btn_text',
                'label' => 'CTA Button Text',
                'name' => 'cta_btn_text',
                'type' => 'text',
                'default_value' => 'Book Your Discovery Call',
            ],
            [
                'key' => 'field_cta_btn_url',
                'label' => 'CTA Button URL',
                'name' => 'cta_btn_url',
                'type' => 'text',
                'default_value' => '/contact/',
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'page-templates/template-location.php',
                ],
            ],
            [
                [
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'template-location.php',
                ],
            ],
        ],
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
    ]);

    // 2. Country Hub Field Group
    acf_add_local_field_group([
        'key' => 'group_cs_country_hub',
        'title' => 'Country Hub Settings',
        'fields' => [
            [
                'key' => 'field_ch_country_name',
                'label' => 'Country Name',
                'name' => 'country_name',
                'type' => 'text',
            ],
            [
                'key' => 'field_ch_country_code',
                'label' => 'Country Code (e.g. US, UK, AU, CA, PH)',
                'name' => 'country_code',
                'type' => 'text',
            ],
            [
                'key' => 'field_ch_hero_kicker',
                'label' => 'Hero Kicker',
                'name' => 'hero_kicker',
                'type' => 'text',
            ],
            [
                'key' => 'field_ch_hero_h1',
                'label' => 'Hero H1 Heading',
                'name' => 'hero_h1',
                'type' => 'text',
            ],
            [
                'key' => 'field_ch_hero_sub',
                'label' => 'Hero Subtitle',
                'name' => 'hero_subtitle',
                'type' => 'textarea',
                'rows' => 3,
            ],
            [
                'key' => 'field_ch_faqs',
                'label' => 'Country FAQs',
                'name' => 'country_faqs',
                'type' => 'repeater',
                'layout' => 'block',
                'button_label' => 'Add FAQ',
                'sub_fields' => [
                    [
                        'key' => 'field_ch_faq_q',
                        'label' => 'Question',
                        'name' => 'q',
                        'type' => 'text',
                    ],
                    [
                        'key' => 'field_ch_faq_a',
                        'label' => 'Answer',
                        'name' => 'a',
                        'type' => 'textarea',
                        'rows' => 3,
                    ],
                ],
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'page-templates/template-country-hub.php',
                ],
            ],
            [
                [
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'template-country-hub.php',
                ],
            ],
        ],
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
    ]);
});

// =========================================================================
// Transactional Mail Dispatcher (Brevo REST API / Native Dispatch)
// =========================================================================
function cs_send_transactional_email($to_email, $to_name, $subject, $html_body, $reply_to_email = '', $reply_to_name = '') {
    $api_key = defined('BREVO_API_KEY') ? BREVO_API_KEY : get_option('cs_brevo_api_key', '');

    if (!empty($api_key) && strpos($api_key, 'xkeysib-') === 0) {
        $sender_email = ($to_email === 'hello@chadsia.com' || $to_email === get_option('admin_email')) ? 'chad@navaramarketing.com' : 'hello@chadsia.com';
        $sender_name  = ($to_email === 'hello@chadsia.com' || $to_email === get_option('admin_email')) ? 'Chad Sia Media Leads' : 'Chad Sia';

        $payload = [
            'sender'      => ['name' => $sender_name, 'email' => $sender_email],
            'to'          => [['email' => $to_email, 'name' => $to_name ?: $to_email]],
            'subject'     => $subject,
            'htmlContent' => $html_body,
        ];
        if (!empty($reply_to_email)) {
            $payload['replyTo'] = ['email' => $reply_to_email, 'name' => $reply_to_name ?: $reply_to_email];
        }

        $res = wp_remote_post('https://api.brevo.com/v3/smtp/email', [
            'headers' => [
                'api-key'      => $api_key,
                'Content-Type' => 'application/json',
                'Accept'       => 'application/json',
            ],
            'body'    => json_encode($payload),
            'timeout' => 15,
        ]);

        $code = wp_remote_retrieve_response_code($res);
        if ($code >= 200 && $code < 300) {
            return true;
        }
    }

    // Default WordPress email dispatch
    $headers = [
        'Content-Type: text/html; charset=UTF-8',
        'From: Chad Sia <hello@chadsia.com>',
    ];
    if (!empty($reply_to_email)) {
        $headers[] = 'Reply-To: ' . ($reply_to_name ? $reply_to_name . ' ' : '') . '<' . $reply_to_email . '>';
    }
    return wp_mail($to_email, $subject, $html_body, $headers);
}

// =========================================================================
// Client Discovery Form AJAX Handler
// =========================================================================
add_action('wp_ajax_cs_discovery_submit', 'cs_handle_discovery_submission');
add_action('wp_ajax_nopriv_cs_discovery_submit', 'cs_handle_discovery_submission');

function cs_handle_discovery_submission() {
    // 1. Verify Nonce
    $nonce = $_POST['cs_nonce'] ?? $_POST['nonce'] ?? '';
    if (!wp_verify_nonce($nonce, 'cs_discovery_nonce')) {
        wp_send_json_error(['message' => 'Security token expired. Please refresh the page and try again.'], 403);
    }

    // 2. Honeypot check (anti-spam)
    if (!empty($_POST['website_trap'])) {
        // Silently succeed for bots
        wp_send_json_success(['message' => 'Your brief has been submitted successfully.']);
    }

    // 3. Sanitize inputs (support multiple aliases)
    $full_name       = sanitize_text_field($_POST['client_name'] ?? $_POST['full_name'] ?? '');
    $work_email      = sanitize_email($_POST['client_email'] ?? $_POST['work_email'] ?? '');
    $phone_whatsapp  = sanitize_text_field($_POST['client_phone'] ?? $_POST['phone_whatsapp'] ?? '');
    $preferred_comms = sanitize_text_field($_POST['preferred_channel'] ?? $_POST['preferred_comms'] ?? '');
    $additional_notes= sanitize_textarea_field($_POST['additional_notes'] ?? '');

    $raw_types       = $_POST['project_types'] ?? [];
    if (is_string($raw_types)) {
        $raw_types = explode(',', $raw_types);
    }
    $project_types   = is_array($raw_types) ? array_map('sanitize_text_field', $raw_types) : [];

    $page_count      = sanitize_text_field($_POST['page_count'] ?? '');
    $primary_goal    = sanitize_textarea_field($_POST['primary_goal'] ?? '');
    $company_name    = sanitize_text_field($_POST['company_name'] ?? '');
    $current_website = esc_url_raw($_POST['current_website'] ?? '');
    $target_audience = sanitize_textarea_field($_POST['target_audience'] ?? '');
    $competitors_inspire = sanitize_textarea_field($_POST['inspiration_urls'] ?? $_POST['competitors_inspire'] ?? '');

    $raw_features    = $_POST['features'] ?? $_POST['features_needed'] ?? [];
    if (is_string($raw_features)) {
        $raw_features = explode(',', $raw_features);
    }
    $features_needed = is_array($raw_features) ? array_map('sanitize_text_field', $raw_features) : [];

    $raw_integrations = $_POST['custom_integrations'] ?? $_POST['integrations_needed'] ?? [];
    if (is_string($raw_integrations)) {
        $integrations_str = sanitize_text_field($raw_integrations);
    } elseif (is_array($raw_integrations)) {
        $integrations_str = implode(', ', array_map('sanitize_text_field', $raw_integrations));
    } else {
        $integrations_str = 'None specified';
    }

    $design_status   = sanitize_text_field($_POST['design_status'] ?? '');
    $raw_assets      = $_POST['assets_ready'] ?? $_POST['existing_assets'] ?? [];
    if (is_string($raw_assets)) {
        $raw_assets = explode(',', $raw_assets);
    }
    $existing_assets = is_array($raw_assets) ? array_map('sanitize_text_field', $raw_assets) : [];

    $project_timeline= sanitize_text_field($_POST['timeline'] ?? $_POST['project_timeline'] ?? '');
    // 4. Save Lead directly to WordPress Database (guarantees zero lost leads)
    $lead_post_id = wp_insert_post([
        'post_type'   => 'cs_lead',
        'post_status' => 'publish',
        'post_title'  => ($company_name ?: $full_name) . ' — ' . ($budget_tier ?: '$800 - $1,500 USD') . ' (' . date('M j, Y') . ')',
    ]);

    if ($lead_post_id && !is_wp_error($lead_post_id)) {
        update_post_meta($lead_post_id, '_cs_client_name', $full_name);
        update_post_meta($lead_post_id, '_cs_client_email', $work_email);
        update_post_meta($lead_post_id, '_cs_client_phone', $phone_whatsapp);
        update_post_meta($lead_post_id, '_cs_preferred_channel', $preferred_comms);
        update_post_meta($lead_post_id, '_cs_company_name', $company_name);
        update_post_meta($lead_post_id, '_cs_current_website', $current_website);
        update_post_meta($lead_post_id, '_cs_page_count', $page_count);
        update_post_meta($lead_post_id, '_cs_project_types', $project_types_str);
        update_post_meta($lead_post_id, '_cs_primary_goal', $primary_goal);
        update_post_meta($lead_post_id, '_cs_target_audience', $target_audience);
        update_post_meta($lead_post_id, '_cs_inspiration_urls', $competitors_inspire);
        update_post_meta($lead_post_id, '_cs_features_needed', $features_str);
        update_post_meta($lead_post_id, '_cs_integrations_needed', $integrations_str);
        update_post_meta($lead_post_id, '_cs_design_status', $design_status);
        update_post_meta($lead_post_id, '_cs_existing_assets', $assets_str);
        update_post_meta($lead_post_id, '_cs_project_timeline', $project_timeline);
        update_post_meta($lead_post_id, '_cs_budget_tier', $budget_tier);
        update_post_meta($lead_post_id, '_cs_additional_notes', $additional_notes);
        update_post_meta($lead_post_id, '_cs_ip_address', $_SERVER['REMOTE_ADDR'] ?? '');
    }

    // 5. Construct HTML Email for Chad Sia Team (hello@chadsia.com)
    $to = 'hello@chadsia.com';
    $subject = '🚀 New Client Discovery Brief: ' . ($company_name ?: $full_name) . ' (' . ($budget_tier ?: '$800 - $1,500 USD') . ')';

    $project_types_str = !empty($project_types) ? implode(', ', $project_types) : 'Not specified';
    $features_str = !empty($features_needed) ? implode(', ', $features_needed) : 'None specified';
    $assets_str = !empty($existing_assets) ? implode(', ', $existing_assets) : 'None';

    $email_body = '
    <!DOCTYPE html>
    <html>
    <head>
      <meta charset="utf-8">
      <style>
        body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; line-height: 1.6; color: #333; background: #f8fafc; padding: 20px; }
        .container { max-width: 650px; margin: 0 auto; background: #fff; border-radius: 12px; border: 1px solid #e2e8f0; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
        .header { background: #4968f8; color: #fff; padding: 24px 30px; }
        .header h1 { margin: 0; font-size: 22px; font-weight: 700; color: #ffffff; }
        .header p { margin: 6px 0 0; opacity: 0.9; font-size: 14px; color: #ffffff; }
        .content { padding: 30px; }
        .section { margin-bottom: 24px; padding-bottom: 20px; border-bottom: 1px solid #edf2f7; }
        .section:last-child { border-bottom: none; margin-bottom: 0; padding-bottom: 0; }
        .section-title { font-size: 14px; text-transform: none; letter-spacing: normal; color: #4968f8; font-weight: 700; margin-bottom: 12px; }
        .field-row { margin-bottom: 10px; }
        .label { font-size: 12px; color: #64748b; text-transform: none; font-weight: 600; }
        .value { font-size: 15px; color: #1e293b; font-weight: 500; margin-top: 2px; }
        .highlight { background: #eef2ff; color: #4968f8; padding: 3px 8px; border-radius: 6px; font-weight: 600; display: inline-block; }
        .footer { background: #f1f5f9; padding: 16px 30px; font-size: 12px; color: #64748b; text-align: center; }
      </style>
    </head>
    <body>
      <div class="container">
        <div class="header">
          <h1>🚀 New Client Discovery Brief</h1>
          <p>Submitted via chadsia.com/client-discovery/</p>
        </div>
        <div class="content">
          <div class="section">
            <div class="section-title">👤 Contact Information</div>
            <div class="field-row"><div class="label">Full Name</div><div class="value">' . esc_html($full_name) . '</div></div>
            <div class="field-row"><div class="label">Work Email</div><div class="value"><a href="mailto:' . esc_attr($work_email) . '">' . esc_html($work_email) . '</a></div></div>
            <div class="field-row"><div class="label">Phone / WhatsApp</div><div class="value">' . esc_html($phone_whatsapp ?: 'Not provided') . '</div></div>
            <div class="field-row"><div class="label">Preferred Channel</div><div class="value"><span class="highlight">' . esc_html($preferred_comms ?: 'Email') . '</span></div></div>
          </div>

          <div class="section">
            <div class="section-title">🏢 Project Scope & Overview</div>
            <div class="field-row"><div class="label">Company / Brand</div><div class="value">' . esc_html($company_name ?: 'Not provided') . '</div></div>
            <div class="field-row"><div class="label">Current Website</div><div class="value">' . ($current_website ? '<a href="' . esc_url($current_website) . '" target="_blank">' . esc_html($current_website) . '</a>' : 'None / New Venture') . '</div></div>
            <div class="field-row"><div class="label">Estimated Number of Pages</div><div class="value"><span class="highlight">' . esc_html($page_count ?: '2 - 5 Pages (Starter Site)') . '</span></div></div>
            <div class="field-row"><div class="label">Project Type(s)</div><div class="value"><span class="highlight">' . esc_html($project_types_str) . '</span></div></div>
            <div class="field-row"><div class="label">Primary Goal / Challenge</div><div class="value">' . nl2br(esc_html($primary_goal ?: 'Not specified')) . '</div></div>
            <div class="field-row"><div class="label">Target Audience</div><div class="value">' . nl2br(esc_html($target_audience ?: 'Not specified')) . '</div></div>
            <div class="field-row"><div class="label">Inspiration / Competitors</div><div class="value">' . nl2br(esc_html($competitors_inspire ?: 'None provided')) . '</div></div>
          </div>

          <div class="section">
            <div class="section-title">⚙️ Features & Integrations</div>
            <div class="field-row"><div class="label">Key Functionality</div><div class="value">' . esc_html($features_str) . '</div></div>
            <div class="field-row"><div class="label">Third-Party Integrations</div><div class="value">' . esc_html($integrations_str) . '</div></div>
          </div>

          <div class="section">
            <div class="section-title">🎨 Design & Brand Assets</div>
            <div class="field-row"><div class="label">Design Readiness</div><div class="value"><span class="highlight">' . esc_html($design_status ?: 'Starting from scratch') . '</span></div></div>
            <div class="field-row"><div class="label">Existing Assets Ready</div><div class="value">' . esc_html($assets_str) . '</div></div>
          </div>

          <div class="section">
            <div class="section-title">⏱️ Timeline & Investment</div>
            <div class="field-row"><div class="label">Target Timeline</div><div class="value"><span class="highlight">' . esc_html($project_timeline ?: 'Flexible') . '</span></div></div>
            <div class="field-row"><div class="label">Budget Range</div><div class="value"><span class="highlight" style="background:#dcfce7;color:#15803d;">' . esc_html($budget_tier ?: '$800 - $1,500 USD') . '</span></div></div>
            ' . (!empty($additional_notes) ? '<div class="field-row"><div class="label">Additional Notes</div><div class="value">' . nl2br(esc_html($additional_notes)) . '</div></div>' : '') . '
          </div>
        </div>
        <div class="footer">
          Received on ' . current_time('F j, Y, g:i a') . ' &bull; Chad Sia Media Engine
        </div>
      </div>
    </body>
    </html>';

    $mail_sent = cs_send_transactional_email($to, 'Chad Sia', $subject, $email_body, $work_email, $full_name);
    cs_send_transactional_email('chadfuse@yahoo.com', 'Chad Sia', $subject, $email_body, $work_email, $full_name);

    // 6. Confirmation Email to Client
    $client_subject = 'We received your project brief — Chad Sia Media';
    $client_body = '
    <!DOCTYPE html>
    <html>
    <head>
      <meta charset="utf-8">
      <style>
        body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; line-height: 1.6; color: #333; background: #f8fafc; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background: #fff; border-radius: 12px; border: 1px solid #e2e8f0; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
        .header { background: #4968f8; color: #fff; padding: 28px 30px; text-align: center; }
        .header h1 { margin: 0; font-size: 24px; font-weight: 700; color: #ffffff; }
        .content { padding: 30px; }
        p { margin: 0 0 16px; color: #475569; font-size: 15px; }
        .callout { background: #f1f5f9; border-left: 4px solid #4968f8; padding: 14px 18px; border-radius: 4px; margin: 20px 0; font-size: 14px; color: #334155; }
        .footer { background: #f8fafc; padding: 20px 30px; font-size: 13px; color: #94a3b8; text-align: center; border-top: 1px solid #edf2f7; }
      </style>
    </head>
    <body>
      <div class="container">
        <div class="header">
          <h1>Thank You, ' . esc_html($full_name) . '!</h1>
        </div>
        <div class="content">
          <p>We’ve successfully received your project discovery brief for <strong>' . esc_html($company_name ?: 'your project') . '</strong>.</p>
          <p>Our lead technical and design architects are reviewing your requirements, technical stack preferences, and goals. We will analyze your scope and get back to you within <strong>24 business hours</strong> with initial recommendations and next steps.</p>
          <div class="callout">
            <strong>What happens next?</strong><br>
            1. Brief review and scope assessment.<br>
            2. We’ll reach out via <strong>' . esc_html($preferred_comms ?: 'Email') . '</strong> with tailored feedback or to schedule a discovery call.<br>
            3. Customized proposal and architecture roadmap.
          </div>
          <p>If you have any urgent details or supplemental assets to share in the meantime, simply reply directly to this email or reach us at <a href="mailto:hello@chadsia.com">hello@chadsia.com</a>.</p>
          <p style="margin-bottom:0;">Warm regards,<br><strong>Chad Sia</strong><br>Founder & Principal Architect, Chad Sia Media</p>
        </div>
        <div class="footer">
          &copy; ' . date('Y') . ' Chad Sia Media. All rights reserved. &bull; <a href="https://chadsia.com" style="color:#4968f8;text-decoration:none;">chadsia.com</a>
        </div>
      </div>
    </body>
    </html>';

    cs_send_transactional_email($work_email, $full_name, $client_subject, $client_body, 'hello@chadsia.com', 'Chad Sia');

    wp_send_json_success([
        'message' => 'Your discovery brief has been successfully submitted! We will review your requirements and reach out within 24 hours.',
        'lead_id' => $lead_post_id ?: null,
        'mail_sent' => $mail_sent
    ]);
}

// =========================================================================
// Register Discovery Leads Custom Post Type & Admin View
// =========================================================================
add_action('init', function() {
    register_post_type('cs_lead', [
        'labels' => [
            'name'               => 'Discovery Leads',
            'singular_name'      => 'Discovery Lead',
            'menu_name'          => 'Discovery Leads',
            'all_items'          => 'All Leads',
            'view_item'          => 'View Lead',
            'edit_item'          => 'Lead Details',
            'search_items'       => 'Search Leads',
            'not_found'          => 'No leads submitted yet',
        ],
        'public'             => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'menu_position'      => 25,
        'menu_icon'          => 'dashicons-id-alt',
        'supports'           => ['title'],
        'capability_type'    => 'post',
        'map_meta_cap'       => true,
    ]);
});

// Custom Columns for Discovery Leads
add_filter('manage_cs_lead_posts_columns', function($columns) {
    return [
        'cb'              => '<input type="checkbox" />',
        'title'           => 'Client / Project',
        'client_email'    => 'Email',
        'client_phone'    => 'Phone / Comms',
        'page_count'      => 'Pages',
        'budget_tier'     => 'Budget',
        'date'            => 'Date Submitted',
    ];
});

add_action('manage_cs_lead_posts_custom_column', function($column, $post_id) {
    switch ($column) {
        case 'client_email':
            $email = get_post_meta($post_id, '_cs_client_email', true);
            echo $email ? '<a href="mailto:' . esc_attr($email) . '">' . esc_html($email) . '</a>' : '—';
            break;
        case 'client_phone':
            $phone = get_post_meta($post_id, '_cs_client_phone', true);
            $ch = get_post_meta($post_id, '_cs_preferred_channel', true);
            echo esc_html($phone ?: '—') . ($ch ? ' <span style="color:#64748b;font-size:11px;">(' . esc_html($ch) . ')</span>' : '');
            break;
        case 'page_count':
            echo esc_html(get_post_meta($post_id, '_cs_page_count', true) ?: '—');
            break;
        case 'budget_tier':
            $b = get_post_meta($post_id, '_cs_budget_tier', true);
            echo $b ? '<strong style="color:#15803d;">' . esc_html($b) . '</strong>' : '—';
            break;
    }
}, 10, 2);

// Meta box for Lead Details
add_action('add_meta_boxes', function() {
    add_meta_box('cs_lead_details', 'Submitted Discovery Brief Data', function($post) {
        $meta = get_post_meta($post->ID);
        $get = function($key) use ($meta) {
            return $meta[$key][0] ?? '';
        };
        ?>
        <table class="form-table" style="max-width:800px;">
            <tr><th style="width:200px;">Client Name:</th><td><strong><?php echo esc_html($get('_cs_client_name')); ?></strong></td></tr>
            <tr><th>Work Email:</th><td><a href="mailto:<?php echo esc_attr($get('_cs_client_email')); ?>"><?php echo esc_html($get('_cs_client_email')); ?></a></td></tr>
            <tr><th>Phone / WhatsApp:</th><td><?php echo esc_html($get('_cs_client_phone') ?: 'None'); ?></td></tr>
            <tr><th>Preferred Channel:</th><td><span class="badge" style="background:#eef2ff;color:#4968f8;padding:3px 8px;border-radius:4px;"><?php echo esc_html($get('_cs_preferred_channel')); ?></span></td></tr>
            <tr><th>Company Name:</th><td><?php echo esc_html($get('_cs_company_name') ?: 'None'); ?></td></tr>
            <tr><th>Current Website:</th><td><?php $w = $get('_cs_current_website'); echo $w ? '<a href="' . esc_url($w) . '" target="_blank">' . esc_html($w) . '</a>' : 'None'; ?></td></tr>
            <tr><th>Estimated Pages:</th><td><strong><?php echo esc_html($get('_cs_page_count')); ?></strong></td></tr>
            <tr><th>Project Type(s):</th><td><?php echo esc_html($get('_cs_project_types')); ?></td></tr>
            <tr><th>Primary Goal:</th><td><?php echo nl2br(esc_html($get('_cs_primary_goal'))); ?></td></tr>
            <tr><th>Target Audience:</th><td><?php echo nl2br(esc_html($get('_cs_target_audience'))); ?></td></tr>
            <tr><th>Inspiration URLs:</th><td><?php echo nl2br(esc_html($get('_cs_inspiration_urls'))); ?></td></tr>
            <tr><th>Features Needed:</th><td><?php echo esc_html($get('_cs_features_needed')); ?></td></tr>
            <tr><th>Integrations:</th><td><?php echo esc_html($get('_cs_integrations_needed')); ?></td></tr>
            <tr><th>Design Readiness:</th><td><?php echo esc_html($get('_cs_design_status')); ?></td></tr>
            <tr><th>Assets Ready:</th><td><?php echo esc_html($get('_cs_existing_assets')); ?></td></tr>
            <tr><th>Timeline:</th><td><?php echo esc_html($get('_cs_project_timeline')); ?></td></tr>
            <tr><th>Budget Tier:</th><td><strong style="color:#15803d;font-size:15px;"><?php echo esc_html($get('_cs_budget_tier')); ?></strong></td></tr>
            <tr><th>Additional Notes:</th><td><?php echo nl2br(esc_html($get('_cs_additional_notes'))); ?></td></tr>
            <tr><th>IP Address:</th><td><code><?php echo esc_html($get('_cs_ip_address')); ?></code></td></tr>
        </table>
        <?php
    }, 'cs_lead', 'normal', 'high');
});



