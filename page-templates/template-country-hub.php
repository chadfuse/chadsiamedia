<?php
/**
 * Template Name: Country Hub (Strategic Engineering Hubs)
 * Description: High-performance Country landing page linking to regional cities.
 */

get_header();

$local_block = __DIR__ . '/country-hub-content.php';
if (file_exists($local_block)) {
    include $local_block;
} else {
    $sandbox_block = WP_CONTENT_DIR . '/novamira-sandbox/templates/country-hub-content.php';
    if (file_exists($sandbox_block)) {
        include $sandbox_block;
    } else {
        the_content();
    }
}

get_footer();
