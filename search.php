<?php
/**
 * The template for displaying search results pages
 *
 * @package ChadSia
 */

$archive_template = locate_template('archive.php');
if ($archive_template) {
    include $archive_template;
} else {
    include get_stylesheet_directory() . '/archive.php';
}
