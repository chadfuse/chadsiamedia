<?php
/**
 * Template Name: Blog Hub
 * Description: High-converting engineering publication hub featuring spotlight article, 3-column post grid, category filters, and newsletter module.
 *
 * @package ChadSia
 */

get_header();

// Look for blog-content.php in child theme page-templates, then fallback
$content_template = locate_template('page-templates/blog-content.php');

if ($content_template) {
    include $content_template;
} else {
    // Direct fallback path if not found by locate_template
    $direct_path = get_stylesheet_directory() . '/page-templates/blog-content.php';
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
