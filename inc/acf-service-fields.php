<?php
/**
 * ACF Field Group Registration for Single Service Pages
 * 
 * Provides structured customization for all 9 sections:
 * Hero, Client Logos, What (Capabilities), Why (Differentiators), 
 * Portfolio, Process, Who, and CTA Banner.
 */

if (function_exists('acf_add_local_field_group')) {
    acf_add_local_field_group([
        'key' => 'group_cs_service_page',
        'title' => 'Service Page Settings (Tailored Architecture)',
        'fields' => [
            // Tab 1: Hero Section
            [
                'key' => 'field_service_tab_hero',
                'label' => 'Hero Section',
                'type' => 'tab',
            ],
            [
                'key' => 'field_service_hero_kicker',
                'label' => 'Eyebrow / Kicker',
                'name' => 'service_hero_kicker',
                'type' => 'text',
                'default_value' => 'Front-End Engineering · Architecture',
            ],
            [
                'key' => 'field_service_hero_title',
                'label' => 'Headline Title',
                'name' => 'service_hero_title',
                'type' => 'text',
                'default_value' => 'Pixel-Perfect, High-Velocity Front-End Engineering',
            ],
            [
                'key' => 'field_service_hero_subtitle',
                'label' => 'Subtitle / Lead Paragraph',
                'name' => 'service_hero_subtitle',
                'type' => 'textarea',
                'rows' => 3,
                'default_value' => 'We engineer lightweight, accessible, and sub-second web interfaces using modern standards. No bloated themes, zero layout shifts, and 90+ Google PageSpeed guaranteed.',
            ],
            [
                'key' => 'field_service_hero_btn_text',
                'label' => 'Primary Button Text',
                'name' => 'service_hero_btn_text',
                'type' => 'text',
                'default_value' => 'Book Discovery Call',
            ],
            [
                'key' => 'field_service_hero_btn_url',
                'label' => 'Primary Button URL',
                'name' => 'service_hero_btn_url',
                'type' => 'text',
                'default_value' => '/contact/',
            ],
            [
                'key' => 'field_service_hero_secondary_text',
                'label' => 'Secondary Button Text',
                'name' => 'service_hero_secondary_text',
                'type' => 'text',
                'default_value' => 'Explore Capabilities',
            ],
            [
                'key' => 'field_service_hero_secondary_url',
                'label' => 'Secondary Button URL',
                'name' => 'service_hero_secondary_url',
                'type' => 'text',
                'default_value' => '#capabilities',
            ],
            [
                'key' => 'field_service_tech_stack',
                'label' => 'Tech Stack Badges (Comma-separated)',
                'name' => 'service_tech_stack',
                'type' => 'text',
                'default_value' => 'HTML5 / Modern CSS, TypeScript, React / Vue, Tailwind / Vanilla CSS, GSAP Motion, Webpack / Vite',
            ],
            [
                'key' => 'field_service_hero_image',
                'label' => 'Hero Showcase Image (Upload)',
                'name' => 'service_hero_image',
                'type' => 'image',
                'return_format' => 'array',
                'preview_size' => 'medium',
            ],
            [
                'key' => 'field_service_hero_image_url',
                'label' => 'Hero Showcase Image URL (Alternative)',
                'name' => 'service_hero_image_url',
                'type' => 'url',
            ],

            // Tab 2: What We Deliver (Capabilities)
            [
                'key' => 'field_service_tab_what',
                'label' => 'What We Deliver',
                'type' => 'tab',
            ],
            [
                'key' => 'field_service_what_kicker',
                'label' => 'What Section Kicker',
                'name' => 'service_what_kicker',
                'type' => 'text',
                'default_value' => 'Core Capabilities',
            ],
            [
                'key' => 'field_service_what_title',
                'label' => 'What Section Title',
                'name' => 'service_what_title',
                'type' => 'text',
                'default_value' => 'Everything You Need for Enterprise-Grade Front-End',
            ],
            [
                'key' => 'field_service_what_subtitle',
                'label' => 'What Section Subtitle',
                'name' => 'service_what_subtitle',
                'type' => 'textarea',
                'rows' => 2,
                'default_value' => 'Tailored front-end engineering designed for maximum performance, responsiveness, and seamless design system fidelity.',
            ],
            [
                'key' => 'field_service_capabilities',
                'label' => 'Capabilities Grid',
                'name' => 'service_capabilities',
                'type' => 'repeater',
                'layout' => 'block',
                'button_label' => 'Add Capability Card',
                'sub_fields' => [
                    [
                        'key' => 'field_cap_icon',
                        'label' => 'Icon Class (FontAwesome)',
                        'name' => 'icon_class',
                        'type' => 'text',
                        'default_value' => 'fa-solid fa-code',
                    ],
                    [
                        'key' => 'field_cap_title',
                        'label' => 'Capability Title',
                        'name' => 'title',
                        'type' => 'text',
                    ],
                    [
                        'key' => 'field_cap_desc',
                        'label' => 'Description',
                        'name' => 'description',
                        'type' => 'textarea',
                        'rows' => 3,
                    ],
                    [
                        'key' => 'field_cap_deliverables',
                        'label' => 'Deliverables / Bullet Points (One per line)',
                        'name' => 'deliverables',
                        'type' => 'textarea',
                        'rows' => 3,
                    ],
                ],
            ],

            // Tab 3: Why Choose Us (Differentiators)
            [
                'key' => 'field_service_tab_why',
                'label' => 'Why Choose Us',
                'type' => 'tab',
            ],
            [
                'key' => 'field_service_why_kicker',
                'label' => 'Why Section Kicker',
                'name' => 'service_why_kicker',
                'type' => 'text',
                'default_value' => 'The Technical Advantage',
            ],
            [
                'key' => 'field_service_why_title',
                'label' => 'Why Section Title',
                'name' => 'service_why_title',
                'type' => 'text',
                'default_value' => 'Engineered for Performance, Speed & Scalability',
            ],
            [
                'key' => 'field_service_why_items',
                'label' => 'Why Differentiators',
                'name' => 'service_why_items',
                'type' => 'repeater',
                'layout' => 'block',
                'button_label' => 'Add Advantage Item',
                'sub_fields' => [
                    [
                        'key' => 'field_why_icon',
                        'label' => 'Icon Class',
                        'name' => 'icon_class',
                        'type' => 'text',
                        'default_value' => 'fa-solid fa-bolt',
                    ],
                    [
                        'key' => 'field_why_title',
                        'label' => 'Advantage Title',
                        'name' => 'title',
                        'type' => 'text',
                    ],
                    [
                        'key' => 'field_why_desc',
                        'label' => 'Description',
                        'name' => 'description',
                        'type' => 'textarea',
                        'rows' => 3,
                    ],
                    [
                        'key' => 'field_why_stat',
                        'label' => 'Highlight Metric (Optional)',
                        'name' => 'stat_badge',
                        'type' => 'text',
                    ],
                ],
            ],

            // Tab 4: Featured Portfolio
            [
                'key' => 'field_service_tab_portfolio',
                'label' => 'Featured Portfolio',
                'type' => 'tab',
            ],
            [
                'key' => 'field_service_portfolio_kicker',
                'label' => 'Portfolio Kicker',
                'name' => 'service_portfolio_kicker',
                'type' => 'text',
                'default_value' => 'Proven Case Studies',
            ],
            [
                'key' => 'field_service_portfolio_title',
                'label' => 'Portfolio Title',
                'name' => 'service_portfolio_title',
                'type' => 'text',
                'default_value' => 'Real Front-End Builds Delivering Real ROI',
            ],
            [
                'key' => 'field_service_portfolio_items',
                'label' => 'Portfolio Cards',
                'name' => 'service_portfolio_items',
                'type' => 'repeater',
                'layout' => 'block',
                'button_label' => 'Add Case Study',
                'sub_fields' => [
                    [
                        'key' => 'field_port_image',
                        'label' => 'Project Screenshot / Mockup Image',
                        'name' => 'image',
                        'type' => 'image',
                        'return_format' => 'array',
                        'preview_size' => 'medium',
                    ],
                    [
                        'key' => 'field_port_image_url',
                        'label' => 'Direct Image URL (Alternative to upload)',
                        'name' => 'image_url',
                        'type' => 'url',
                    ],
                    [
                        'key' => 'field_port_title',
                        'label' => 'Project Name',
                        'name' => 'title',
                        'type' => 'text',
                    ],
                    [
                        'key' => 'field_port_client',
                        'label' => 'Client / Industry',
                        'name' => 'client_type',
                        'type' => 'text',
                    ],
                    [
                        'key' => 'field_port_tags',
                        'label' => 'Tech Tags (Comma-separated)',
                        'name' => 'tags',
                        'type' => 'text',
                    ],
                    [
                        'key' => 'field_port_desc',
                        'label' => 'Case Study Description',
                        'name' => 'description',
                        'type' => 'textarea',
                        'rows' => 3,
                    ],
                    [
                        'key' => 'field_port_metric',
                        'label' => 'Key Metric (e.g. 99 PageSpeed, +140% Conv)',
                        'name' => 'metric_badge',
                        'type' => 'text',
                    ],
                    [
                        'key' => 'field_port_url',
                        'label' => 'Case Study Link / Inquiry Action',
                        'name' => 'project_url',
                        'type' => 'text',
                    ],
                    [
                        'key' => 'field_port_live_url',
                        'label' => 'Live Website URL (Optional)',
                        'name' => 'live_url',
                        'type' => 'url',
                    ],
                ],
            ],

            // Tab 5: Our Process
            [
                'key' => 'field_service_tab_process',
                'label' => 'Our Process',
                'type' => 'tab',
            ],
            [
                'key' => 'field_service_process_kicker',
                'label' => 'Process Kicker',
                'name' => 'service_process_kicker',
                'type' => 'text',
                'default_value' => 'Engineering Roadmap',
            ],
            [
                'key' => 'field_service_process_title',
                'label' => 'Process Title',
                'name' => 'service_process_title',
                'type' => 'text',
                'default_value' => 'A Frictionless, 4-Step Engineering Workflow',
            ],
            [
                'key' => 'field_service_process_steps',
                'label' => 'Process Steps',
                'name' => 'service_process_steps',
                'type' => 'repeater',
                'layout' => 'block',
                'button_label' => 'Add Process Step',
                'sub_fields' => [
                    [
                        'key' => 'field_proc_step_num',
                        'label' => 'Step Number (e.g. 01, 02)',
                        'name' => 'step_num',
                        'type' => 'text',
                    ],
                    [
                        'key' => 'field_proc_title',
                        'label' => 'Step Title',
                        'name' => 'title',
                        'type' => 'text',
                    ],
                    [
                        'key' => 'field_proc_desc',
                        'label' => 'Step Description',
                        'name' => 'description',
                        'type' => 'textarea',
                        'rows' => 3,
                    ],
                    [
                        'key' => 'field_proc_deliverables',
                        'label' => 'Deliverables (One per line)',
                        'name' => 'deliverables',
                        'type' => 'textarea',
                        'rows' => 2,
                    ],
                ],
            ],

            // Tab 6: FAQs & CTA
            [
                'key' => 'field_service_tab_cta',
                'label' => 'FAQs & CTA',
                'type' => 'tab',
            ],
            [
                'key' => 'field_service_faqs',
                'label' => 'Service FAQs',
                'name' => 'service_faqs',
                'type' => 'repeater',
                'layout' => 'block',
                'button_label' => 'Add FAQ Item',
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
            [
                'key' => 'field_service_cta_kicker',
                'label' => 'CTA Kicker',
                'name' => 'service_cta_kicker',
                'type' => 'text',
                'default_value' => 'Get Started Today',
            ],
            [
                'key' => 'field_service_cta_title',
                'label' => 'CTA Title',
                'name' => 'service_cta_title',
                'type' => 'text',
                'default_value' => 'Ready to Upgrade Your Front-End Engineering?',
            ],
            [
                'key' => 'field_service_cta_desc',
                'label' => 'CTA Description',
                'name' => 'service_cta_desc',
                'type' => 'textarea',
                'rows' => 2,
                'default_value' => 'Let us build a lightning-fast, high-converting front-end architecture engineered to outperform your competitors.',
            ],
            [
                'key' => 'field_service_cta_btn_text',
                'label' => 'CTA Button Text',
                'name' => 'service_cta_btn_text',
                'type' => 'text',
                'default_value' => 'Book Your Discovery Call',
            ],
            [
                'key' => 'field_service_cta_btn_url',
                'label' => 'CTA Button URL',
                'name' => 'service_cta_btn_url',
                'type' => 'text',
                'default_value' => '/contact/',
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'page-templates/template-service.php',
                ],
            ],
            [
                [
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'service',
                ],
            ],
        ],
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => 'ACF Settings for Chad Sia Media Single Service Page Templates',
    ]);
}
