<?php
/**
 * Template Name: Case Study Hub
 * Description: Engineering and Architecture Case Studies Hub showcasing real transformations, performance benchmarks, and custom WordPress systems.
 *
 * @package ChadSia
 */

get_header();

// Include Hub Content Template
$content_template = locate_template('page-templates/case-study-hub-content.php');
if ($content_template) {
    include $content_template;
} else {
    $direct_path = get_stylesheet_directory() . '/page-templates/case-study-hub-content.php';
    if (file_exists($direct_path)) {
        include $direct_path;
    } else {
        while (have_posts()) : the_post();
            the_content();
        endwhile;
    }
}

get_footer();
