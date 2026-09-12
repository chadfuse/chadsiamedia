<?php
/**
 * Template Name: Thank You Template
 * Description: Dedicated confirmation & next steps template for Chad Sia Media.
 */

get_header();

$content_template = locate_template('page-templates/thank-you-content.php');
if (!$content_template) {
    $sandbox_path = WP_CONTENT_DIR . '/novamira-sandbox/templates/thank-you-content.php';
    if (file_exists($sandbox_path)) {
        $content_template = $sandbox_path;
    }
}

if ($content_template && file_exists($content_template)) {
    include $content_template;
} else {
    ?>
    <main id="primary" class="site-main">
        <?php
        while (have_posts()) :
            the_post();
            the_content();
        endwhile;
        ?>
    </main>
    <?php
}

get_footer();
