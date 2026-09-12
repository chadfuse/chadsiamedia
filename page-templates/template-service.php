<?php
/**
 * Template Name: Single Service Template
 * Description: High-speed, Elementor-free tailored single service page template with AI platform aesthetics and full ACF integration.
 */

get_header();

$content_block = __DIR__ . '/service-content.php';
if (file_exists($content_block)) {
    require $content_block;
} else {
    $sandbox_block = WP_CONTENT_DIR . '/novamira-sandbox/templates/service-content.php';
    if (file_exists($sandbox_block)) {
        require $sandbox_block;
    }
}

get_footer();
