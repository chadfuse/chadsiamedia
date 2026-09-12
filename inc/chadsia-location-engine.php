<?php
/**
 * Chad Sia Media - Location Engine (Live Sandbox Loader)
 */

if (!defined('ABSPATH')) {
    exit;
}

// 1. Helper function to check if current page is a location page
function cs_is_location_page(): bool {
    $post_id = get_queried_object_id() ?: get_the_ID();
    if (!$post_id) {
        return false;
    }
    
    $meta_tpl = get_post_meta($post_id, '_wp_page_template', true);
    $slug = (string) get_post_field('post_name', $post_id);
    $uri = $_SERVER['REQUEST_URI'] ?? '';

    return (
        $meta_tpl === 'template-location.php' ||
        $meta_tpl === 'page-templates/template-location.php' ||
        strpos($slug, 'web-design-') === 0 ||
        strpos($uri, '/locations/') !== false ||
        strpos($uri, '/web-design-') !== false
    );
}

// 2. Inject Location Content into the_content
add_filter('the_content', function ($content) {
    if (cs_is_location_page()) {
        static $rendered = false;
        if (!$rendered) {
            $rendered = true;
            $block = WP_CONTENT_DIR . '/novamira-sandbox/templates/location-content.php';
            if (file_exists($block)) {
                ob_start();
                include $block;
                return ob_get_clean();
            }
        }
    }
    return $content;
}, 1);

// 3. Fallback for non-Elementor rendering
add_filter('template_include', function ($template) {
    if (cs_is_location_page()) {
        $tpl = WP_CONTENT_DIR . '/novamira-sandbox/templates/template-location.php';
        if (file_exists($tpl)) {
            return $tpl;
        }
    }
    return $template;
}, 9999);

// 4. Enqueue CSS and JS
add_action('wp_enqueue_scripts', function () {
    if (cs_is_location_page()) {
        wp_enqueue_style(
            'cs-location-styles',
            content_url('/themes/chadsia/assets/css/location-page.css'),
            [],
            '1.0.7'
        );
        wp_enqueue_script(
            'cs-location-scripts',
            content_url('/themes/chadsia/assets/js/location-page.js'),
            [],
            '1.0.7',
            true
        );
    }
}, 30);

// 5. Register Page Templates for WP Admin & REST API
add_filter('theme_page_templates', function ($templates) {
    $templates['template-location.php'] = 'Location Page (SEO / AEO / GEO)';
    return $templates;
});

add_filter('theme_templates', function ($templates, $theme, $post, $post_type) {
    if ($post_type === 'page') {
        $templates['template-location.php'] = 'Location Page (SEO / AEO / GEO)';
    }
    return $templates;
}, 10, 4);

// 6. Register Programmatic ACF Field Group
add_action('acf/init', function () {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }

    acf_add_local_field_group([
        'key' => 'group_cs_location_page',
        'title' => 'Location Page Settings (SEO / AEO / GEO)',
        'fields' => [
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
                'required' => 1,
                'placeholder' => 'Bacolod',
            ],
            [
                'key' => 'field_province_state',
                'label' => 'Province / State / Region',
                'name' => 'province_state',
                'type' => 'text',
                'placeholder' => 'Negros Occidental',
            ],
            [
                'key' => 'field_country_name',
                'label' => 'Country',
                'name' => 'country_name',
                'type' => 'text',
                'default_value' => 'Philippines',
            ],
            [
                'key' => 'field_wikidata_url',
                'label' => 'Wikidata / Wikipedia Entity URL',
                'name' => 'wikidata_url',
                'type' => 'url',
                'placeholder' => 'https://www.wikidata.org/wiki/Q3813',
            ],
            [
                'key' => 'field_aeo_direct_answer',
                'label' => 'AEO Direct Answer Summary (40-60 words)',
                'name' => 'aeo_direct_answer',
                'type' => 'textarea',
                'rows' => 3,
            ],
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
                'placeholder' => 'Regions · Bacolod City',
            ],
            [
                'key' => 'field_hero_h1',
                'label' => 'Hero H1 Heading',
                'name' => 'hero_h1',
                'type' => 'text',
                'placeholder' => 'Modern Web Design & Digital Growth in <span class="cs-highlight">Bacolod</span>.',
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
                'label' => 'Primary CTA Text',
                'name' => 'hero_primary_cta_text',
                'type' => 'text',
                'default_value' => 'Book a Discovery Call',
            ],
            [
                'key' => 'field_hero_primary_cta_url',
                'label' => 'Primary CTA URL',
                'name' => 'hero_primary_cta_url',
                'type' => 'text',
                'default_value' => '/contact/',
            ],
            [
                'key' => 'field_hero_secondary_cta_text',
                'label' => 'Secondary CTA Text',
                'name' => 'hero_secondary_cta_text',
                'type' => 'text',
                'default_value' => 'Explore Capabilities',
            ],
            [
                'key' => 'field_hero_secondary_cta_url',
                'label' => 'Secondary CTA URL',
                'name' => 'hero_secondary_cta_url',
                'type' => 'text',
                'default_value' => '#services',
            ],
            [
                'key' => 'field_tab_stats',
                'label' => 'Key Stats',
                'type' => 'tab',
            ],
            [
                'key' => 'field_stats_items',
                'label' => 'Stats Items',
                'name' => 'stats_items',
                'type' => 'repeater',
                'layout' => 'table',
                'button_label' => 'Add Stat',
                'sub_fields' => [
                    [
                        'key' => 'field_stat_num',
                        'label' => 'Stat Value',
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
            [
                'key' => 'field_tab_services',
                'label' => 'Service Silos',
                'type' => 'tab',
            ],
            [
                'key' => 'field_services_list',
                'label' => 'Localized Services',
                'name' => 'services',
                'type' => 'repeater',
                'layout' => 'block',
                'button_label' => 'Add Service Card',
                'sub_fields' => [
                    [
                        'key' => 'field_svc_title',
                        'label' => 'Service Title',
                        'name' => 'service_title',
                        'type' => 'text',
                    ],
                    [
                        'key' => 'field_svc_desc',
                        'label' => 'Summary',
                        'name' => 'service_summary',
                        'type' => 'textarea',
                    ],
                    [
                        'key' => 'field_svc_link',
                        'label' => 'Link URL',
                        'name' => 'service_link',
                        'type' => 'text',
                    ],
                ],
            ],
            [
                'key' => 'field_tab_story',
                'label' => 'Local Narrative',
                'type' => 'tab',
            ],
            [
                'key' => 'field_local_story',
                'label' => 'Local Business Story / Why Us',
                'name' => 'local_section_story',
                'type' => 'wysiwyg',
            ],
            [
                'key' => 'field_tab_faqs',
                'label' => 'AEO FAQs',
                'type' => 'tab',
            ],
            [
                'key' => 'field_location_faqs',
                'label' => 'FAQs (Feeds FAQPage Schema)',
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
                        'label' => 'Direct Answer (Optimized for AI summary)',
                        'name' => 'answer',
                        'type' => 'textarea',
                    ],
                ],
            ],
            [
                'key' => 'field_tab_nearby',
                'label' => 'Nearby Regions',
                'type' => 'tab',
            ],
            [
                'key' => 'field_nearby_locations',
                'label' => 'Nearby Areas We Serve',
                'name' => 'nearby_locations',
                'type' => 'repeater',
                'layout' => 'table',
                'button_label' => 'Add Nearby Area',
                'sub_fields' => [
                    [
                        'key' => 'field_nearby_name',
                        'label' => 'Region / City Name',
                        'name' => 'region_name',
                        'type' => 'text',
                    ],
                    [
                        'key' => 'field_nearby_url',
                        'label' => 'Page URL',
                        'name' => 'region_url',
                        'type' => 'text',
                    ],
                ],
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'template-location.php',
                ],
            ],
            [
                [
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'page',
                ],
            ],
        ],
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
    ]);
});
