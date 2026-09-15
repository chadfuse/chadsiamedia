<?php
/**
 * Single Case Study Router Template
 *
 * Dynamically loads the appropriate technical case study based on the page slug:
 * - /case-study/olj-worker-ai-automation/ -> case-study-olj-worker.php
 * - /case-study/command-center-content-engine/ -> case-study-command-center.php
 * - /case-study/chadsia-media-architecture-revamp/ (or default) -> case-study-chadsia-media.php
 *
 * @package ChadSia
 */

if (!defined('ABSPATH')) {
    exit;
}

$slug = '';
if (is_singular('page')) {
    $slug = (string) get_post_field('post_name', get_the_ID());
}

if ($slug === 'olj-worker-ai-automation' || strpos($slug, 'olj-worker') !== false) {
    $tpl = locate_template('page-templates/case-study-olj-worker.php');
    if (!$tpl) {
        $tpl = get_stylesheet_directory() . '/page-templates/case-study-olj-worker.php';
    }
    if (file_exists($tpl)) {
        include $tpl;
        return;
    }
} elseif ($slug === 'command-center-content-engine' || strpos($slug, 'command-center') !== false) {
    $tpl = locate_template('page-templates/case-study-command-center.php');
    if (!$tpl) {
        $tpl = get_stylesheet_directory() . '/page-templates/case-study-command-center.php';
    }
    if (file_exists($tpl)) {
        include $tpl;
        return;
    }
}

// Default to Flagship Chad Sia Media Case Study
$tpl = locate_template('page-templates/case-study-chadsia-media.php');
if (!$tpl) {
    $tpl = get_stylesheet_directory() . '/page-templates/case-study-chadsia-media.php';
}
if (file_exists($tpl)) {
    include $tpl;
}
