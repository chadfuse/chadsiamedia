<?php
/**
 * Template Name: Homepage Architecture
 * Description: High-performance, zero-builder homepage template with background video hero and native design tokens.
 *
 * @package ChadSia
 */

get_header();

$content_template = locate_template('page-templates/home-content.php');

if ($content_template) {
    include $content_template;
} else {
    $direct_path = get_stylesheet_directory() . '/page-templates/home-content.php';
    if (file_exists($direct_path)) {
        include $direct_path;
    } else {
        while (have_posts()) : the_post();
            the_content();
        endwhile;
    }
}

get_footer();
