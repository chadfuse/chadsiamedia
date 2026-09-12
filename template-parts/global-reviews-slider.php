<?php
/**
 * Global Reviews Slider Template Part (Centralized Forwarder)
 *
 * @package ChadSia
 */

if (!defined('ABSPATH')) {
    exit;
}

get_template_part('template-parts/google-reviews-widget', null, !empty($args) ? $args : []);

