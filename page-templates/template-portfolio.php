<?php
/**
 * Template Name: Portfolio Showcase
 * Description: High-performance portfolio showcase with hero, category filters, and interactive case study cards.
 *
 * @package ChadSia
 */

get_header();

// Look for portfolio-content.php in child theme page-templates, then fallback
$content_template = locate_template('page-templates/portfolio-content.php');

if ($content_template) {
    include $content_template;
} else {
    // Direct fallback path if not found by locate_template
    $direct_path = get_stylesheet_directory() . '/page-templates/portfolio-content.php';
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
