<?php
/**
 * Programmatic ACF Field Group for Location Pages (SEO / AEO / GEO)
 */

if (!defined('ABSPATH')) {
    exit;
}

add_action('acf/init', function () {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }

    acf_add_local_field_group([
        'key' => 'group_cs_location_page',
        'title' => 'Location Page Settings (SEO / AEO / GEO)',
        'fields' => [
            // TAB 1: GEO & ENTITY METADATA
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
                'placeholder' => 'Chad Sia Media provides full-stack WordPress web design, custom development, and AI-driven SEO services for businesses in Bacolod City and Negros Occidental...',
            ],

            // TAB 2: HERO
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
                'label' => 'Hero H1 Heading (HTML allowed for highlight)',
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

            // TAB 3: STATS
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
                        'placeholder' => '10+',
                    ],
                    [
                        'key' => 'field_stat_lbl',
                        'label' => 'Label',
                        'name' => 'label_stat',
                        'type' => 'text',
                        'placeholder' => 'Years Experience',
                    ],
                ],
            ],

            // TAB 4: SERVICES
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
                        'rows' => 3,
                    ],
                    [
                        'key' => 'field_svc_link',
                        'label' => 'Link URL (Service Silo)',
                        'name' => 'service_link',
                        'type' => 'text',
                    ],
                ],
            ],

            // TAB 5: LOCAL STORY
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
                'tabs' => 'visual',
                'toolbar' => 'basic',
                'media_upload' => 0,
            ],

            // TAB 6: FAQS
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
                        'rows' => 3,
                    ],
                ],
            ],

            // TAB 7: NEARBY LOCATIONS
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
        'label_placement' => 'top',
    ]);
});
