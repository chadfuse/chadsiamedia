<?php
/**
 * Global Reviews Slider Helper & Function
 * 
 * @package ChadSia
 */

if (!defined('ABSPATH')) {
    exit;
}

function cs_render_reviews_slider($args = []) {
    if (function_exists('cs_render_google_reviews')) {
        cs_render_google_reviews($args);
    } else {
        $template_file = get_stylesheet_directory() . '/template-parts/google-reviews-widget.php';
        if (file_exists($template_file)) {
            include $template_file;
        }
    }
}
