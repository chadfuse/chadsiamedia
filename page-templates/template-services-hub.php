<?php
/**
 * Template Name: Services Hub
 * Description: High-performance services directory featuring all 15 specialized web engineering services, filter tabs, 4 engineering pillars, and FAQ accordion.
 *
 * @package ChadSia
 */

get_header();

// Look for services-hub-content.php in child theme page-templates, then fallback
$content_template = locate_template('page-templates/services-hub-content.php');

if ($content_template) {
    include $content_template;
} else {
    // Direct fallback path if not found by locate_template
    $direct_path = get_stylesheet_directory() . '/page-templates/services-hub-content.php';
    if (file_exists($direct_path)) {
        include $direct_path;
    } else {
        // Fallback to default post content
        while (have_posts()) : the_post();
            the_content();
        endwhile;
    }
}

get_footer();
