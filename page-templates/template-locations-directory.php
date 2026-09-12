<?php
/**
 * Template Name: Locations Directory (Global Hubs & Markets)
 * Description: High-performance directory of global markets, countries (US, UK, AU, PH), and strategic regions.
 */

get_header();

$local_block = __DIR__ . '/locations-directory-content.php';
if (file_exists($local_block)) {
    include $local_block;
} else {
    $sandbox_block = WP_CONTENT_DIR . '/novamira-sandbox/templates/locations-directory-content.php';
    if (file_exists($sandbox_block)) {
        include $sandbox_block;
    } else {
        the_content();
    }
}

get_footer();
