<?php
/**
 * Template Part: Global Client Logo Carousel Widget
 *
 * Can be loaded via:
 *   get_template_part('template-parts/global-logo-carousel', null, [
 *       'theme' => 'dark', // 'dark' | 'light'
 *       'show_header' => true,
 *       'kicker' => 'Proven Track Record',
 *       'title' => 'Trusted by Leading Brands & Innovators'
 *   ]);
 */

if (!defined('ABSPATH')) {
    exit;
}

$args = $args ?? [];
if (function_exists('cs_render_logo_carousel')) {
    cs_render_logo_carousel($args);
}
