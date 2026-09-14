<?php
/**
 * Template Name: Case Study Single
 * Description: Deep-dive engineering and architecture case study template with before/after benchmarks, technical breakdowns, code snippets, and client impact.
 *
 * @package ChadSia
 */

get_header();

// Enqueue Case Study Stylesheet
wp_enqueue_style(
    'cs-case-study-css',
    get_stylesheet_directory_uri() . '/assets/css/case-study-page.css',
    ['chadsia-style'],
    file_exists(get_stylesheet_directory() . '/assets/css/case-study-page.css') ? filemtime(get_stylesheet_directory() . '/assets/css/case-study-page.css') : '1.0.0'
);

// Include Single Content Template
$content_template = locate_template('page-templates/case-study-single-content.php');
if ($content_template) {
    include $content_template;
} else {
    $direct_path = get_stylesheet_directory() . '/page-templates/case-study-single-content.php';
    if (file_exists($direct_path)) {
        include $direct_path;
    } else {
        while (have_posts()) : the_post();
            the_content();
        endwhile;
    }
}

get_footer();
