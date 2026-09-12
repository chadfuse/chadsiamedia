<?php
/**
 * Template Name: Location Page (SEO / AEO / GEO)
 * Description: High-speed, Elementor-free location landing page template powered by ACF.
 */

get_header();

$content_block = __DIR__ . '/location-content.php';
if (file_exists($content_block)) {
    require $content_block;
} else {
    $sandbox_block = WP_CONTENT_DIR . '/novamira-sandbox/templates/location-content.php';
    if (file_exists($sandbox_block)) {
        require $sandbox_block;
    }
}

get_footer();
