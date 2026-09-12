<?php
/**
 * Template Name: Client Discovery Questionnaire
 * Description: Interactive multi-step client project onboarding & discovery brief.
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

$discovery_block = cs_get_template_block('client-discovery-content.php');
if ($discovery_block && file_exists($discovery_block)) {
    include $discovery_block;
} else {
    $local_fallback = dirname(__FILE__) . '/client-discovery-content.php';
    if (file_exists($local_fallback)) {
        include $local_fallback;
    }
}

get_footer();
