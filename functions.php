<?php
/**
 * Theme Setup & Standard WordPress Supports
 */
function chadsia_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');
    add_theme_support('responsive-embeds');
    add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script']);

    register_nav_menus([
        'primary' => __('Primary Navigation', 'chadsia'),
        'footer'  => __('Footer Navigation', 'chadsia'),
    ]);
}
add_action('after_setup_theme', 'chadsia_theme_setup');

/**
 * Load Centralized Design System Master CSS & Scripts
 */
function chadsia_enqueue_theme_scripts() {
    $dir = get_stylesheet_directory();
    $uri = get_stylesheet_directory_uri();

    // 1. Single Unified Master Theme Stylesheet (style.css)
    $css_path = $dir . '/style.css';
    $css_ver = file_exists($css_path) ? filemtime($css_path) : '1.1.0';
    wp_enqueue_style(
        'cs-master-theme-style',
        get_stylesheet_uri(),
        [],
        $css_ver
    );

    // 2. Theme Main JavaScript
    $js_ver = file_exists($dir . '/assets/js/theme-main.js') ? filemtime($dir . '/assets/js/theme-main.js') : '1.0.0';
    wp_enqueue_script(
        'cs-theme-main',
        $uri . '/assets/js/theme-main.js',
        [],
        $js_ver,
        true
    );

    // 3. Case Study Styles (when on case study templates or pages)
    if (is_page_template('page-templates/template-case-study-hub.php') ||
        is_page_template('page-templates/template-case-study-single.php') ||
        is_page('case-study') ||
        is_page('chadsia-media-architecture-revamp') ||
        (is_singular('page') && strpos((string) get_post_field('post_name', get_the_ID()), 'case-study') !== false)) {
        $cs_css = $dir . '/assets/css/case-study-page.css';
        if (file_exists($cs_css)) {
            wp_enqueue_style(
                'cs-case-study-page-style',
                $uri . '/assets/css/case-study-page.css',
                ['cs-master-theme-style'],
                filemtime($cs_css)
            );
        }
    }

    // 4. Location Page Scripts (only when location template is used)
    if (is_page_template('page-templates/template-location.php') || is_page_template('template-location.php')) {
        $loc_js = $dir . '/assets/js/location-page.js';
        if (file_exists($loc_js)) {
            wp_enqueue_script(
                'cs-location-scripts',
                $uri . '/assets/js/location-page.js',
                [],
                filemtime($loc_js),
                true
            );
        }
    }
}
add_action('wp_enqueue_scripts', 'chadsia_enqueue_theme_scripts', 15);

// Dequeue unneeded parent theme / builder stylesheets
add_action('wp_enqueue_scripts', function() {
    wp_dequeue_style('hello-elementor');
    wp_dequeue_style('hello-elementor-theme-style');
    wp_dequeue_style('hello-elementor-header-footer');
    wp_dequeue_style('hello-elementor-reset');
}, 99);

// WP Rocket Exclusions for Above-the-Fold Assets & PageSpeed Optimization
add_filter('rocket_lazyload_excluded_attributes', function ($attributes) {
    if (!is_array($attributes)) $attributes = [];
    $attributes[] = 'data-no-lazy="1"';
    $attributes[] = 'no-lazy';
    $attributes[] = 'cs-header-logo-img';
    $attributes[] = 'cs-logo-white';
    $attributes[] = 'cs-logo-dark';
    $attributes[] = 'cs-portrait-img';
    return array_unique($attributes);
});

add_filter('rocket_lazyload_excluded_src', function ($src) {
    if (!is_array($src)) $src = [];
    $src[] = 'logo-cds.webp';
    $src[] = 'logo-chadsia.webp';
    $src[] = 'Chad-Sia-Media.jpg.webp';
    return array_unique($src);
});

// Preload critical above-the-fold logo image for instant LCP
add_action('wp_head', function() {
    echo '<link rel="preload" as="image" href="https://chadsia.com/wp-content/uploads/2024/10/logo-cds.webp" type="image/webp" fetchpriority="high">' . "\n";
}, 1);

// Register ACF JSON Save & Load Points in Theme
add_filter('acf/settings/save_json', function ($path) {
    return get_stylesheet_directory() . '/acf-json';
});

add_filter('acf/settings/load_json', function ($paths) {
    unset($paths[0]);
    $paths[] = get_stylesheet_directory() . '/acf-json';
    return $paths;
});

// Include Programmatic ACF Fallback Fields
if (file_exists(get_stylesheet_directory() . '/inc/acf-location-fields.php')) {
    require_once get_stylesheet_directory() . '/inc/acf-location-fields.php';
}
if (file_exists(get_stylesheet_directory() . '/inc/acf-service-fields.php')) {
    require_once get_stylesheet_directory() . '/inc/acf-service-fields.php';
}
if (file_exists(get_stylesheet_directory() . '/inc/global-logo-carousel.php')) {
    require_once get_stylesheet_directory() . '/inc/global-logo-carousel.php';
}
if (file_exists(get_stylesheet_directory() . '/inc/global-portfolio-showcase.php')) {
    require_once get_stylesheet_directory() . '/inc/global-portfolio-showcase.php';
}
if (file_exists(get_stylesheet_directory() . '/inc/global-reviews-slider.php')) {
    require_once get_stylesheet_directory() . '/inc/global-reviews-slider.php';
}
if (file_exists(get_stylesheet_directory() . '/inc/google-reviews.php')) {
    require_once get_stylesheet_directory() . '/inc/google-reviews.php';
}

// Dynamic Years Calculation & Shortcodes (Started in 2009)
if (!function_exists('cs_get_years_experience')) {
    function cs_get_years_experience($start_year = 2009, $suffix = '+') {
        $start = (int) $start_year;
        $current = (int) current_time('Y');
        if ($current < 2009) {
            $current = (int) date('Y');
        }
        $years = max(1, $current - $start);
        return $years . $suffix;
    }
}

add_shortcode('cs_years_experience', function ($atts) {
    $a = shortcode_atts([
        'start'  => 2009,
        'suffix' => '+'
    ], $atts);
    return cs_get_years_experience($a['start'], $a['suffix']);
});

add_shortcode('cs_years_since', function ($atts) {
    $a = shortcode_atts([
        'start' => 2009
    ], $atts);
    return cs_get_years_experience($a['start'], '');
});

add_shortcode('cs_start_year', function () {
    return '2009';
});

add_shortcode('l4-years-in-business', function () {
    return cs_get_years_experience(2009, '');
});

// Modify the application form fields to set the CV/resume upload as not required
add_filter('awsm_application_form_fields', 'customize_wp_job_openings_form_fields');

if (!function_exists('customize_wp_job_openings_form_fields')) {
    function customize_wp_job_openings_form_fields($fields) {
        foreach ($fields as $key => $field) {
            if ($field['id'] === 'awsm-application-file') {
                $fields[$key]['required'] = false;  // Set required to false
            }
        }
        return $fields;
    }
}

// Include the custom job openings form class
if (file_exists(get_stylesheet_directory() . '/custom-awsm-job-openings-form.php')) {
    require_once get_stylesheet_directory() . '/custom-awsm-job-openings-form.php';
}

// Hook to override the original form class
add_action( 'init', function() {
    if ( class_exists( 'AWSM_Job_Openings_Form' ) && class_exists('My_Custom_AWSM_Job_Openings_Form') ) {
        remove_action( 'awsm_job_openings_form', array( 'AWSM_Job_Openings_Form', 'render_form' ), 10 );
        global $awsm_job_openings_form;
        $awsm_job_openings_form = new My_Custom_AWSM_Job_Openings_Form();
    }
}, 10);

add_filter('body_class', function ($classes) {
    if (is_page('locations')) {
        $classes[] = 'is-locations';
    }

    $parent = wp_get_post_parent_id(get_the_ID());
    $locations = get_page_by_path('locations');

    if ($locations && $parent === $locations->ID) {
        $classes[] = 'is-locations';
    }

    return $classes;
});

add_action('elementor/query/locations_children', function ($query) {
    $parent = get_page_by_path('locations');
    if (!$parent) return;

    $query->set('post_type', 'page');
    $query->set('post_parent', $parent->ID);
    $query->set('orderby', 'title');
    $query->set('order', 'ASC');
});

if (!function_exists('chadsia_staging_noindex')) {
    function chadsia_staging_noindex() {
        if (wp_get_environment_type() === 'staging') {
            echo '<meta name="robots" content="noindex, nofollow">';
        }
    }
}
add_action('wp_head', 'chadsia_staging_noindex');

if (!function_exists('chadsia_staging_headers')) {
    function chadsia_staging_headers() {
        if (wp_get_environment_type() === 'staging') {
            header('X-Robots-Tag: noindex, nofollow', true);
        }
    }
}
add_action('send_headers', 'chadsia_staging_headers');

// Security: disable XML-RPC entirely
add_filter( 'xmlrpc_enabled', '__return_false' );

// Security: block REST API user enumeration for unauthenticated requests
add_filter( 'rest_endpoints', function( $endpoints ) {
	if ( ! is_user_logged_in() ) {
		unset( $endpoints['/wp/v2/users'] );
		unset( $endpoints['/wp/v2/users/(?P<id>[\d]+)'] );
	}
	return $endpoints;
} );

if (file_exists(get_stylesheet_directory() . '/chadsia-aeo-schema.php')) {
    require_once get_stylesheet_directory() . '/chadsia-aeo-schema.php';
}

/**
 * Force Custom Native WordPress Theme Templates (Bypass Elementor Pro Theme Builder)
 */
add_filter('template_include', function ($template) {
    $theme_dir = get_stylesheet_directory();

    if (is_404()) {
        $tpl_404 = $theme_dir . '/404.php';
        if (file_exists($tpl_404)) return $tpl_404;
    }

    if (is_singular('post')) {
        $tpl_single = $theme_dir . '/single.php';
        if (file_exists($tpl_single)) return $tpl_single;
    }

    if (is_category() || is_tag() || is_author() || is_date() || is_archive() || is_tax() || is_search()) {
        $tpl_archive = $theme_dir . '/archive.php';
        if (file_exists($tpl_archive)) return $tpl_archive;
    }

    if (is_home()) {
        $tpl_index = $theme_dir . '/index.php';
        if (file_exists($tpl_index)) return $tpl_index;
    }

    if (is_page('blog') || is_page(3055)) {
        $tpl_blog = $theme_dir . '/page-templates/template-blog.php';
        if (file_exists($tpl_blog)) return $tpl_blog;
    }

    if (is_page('services') || is_page(2887)) {
        $tpl_srv = $theme_dir . '/page-templates/template-services-hub.php';
        if (file_exists($tpl_srv)) return $tpl_srv;
    }

    if (is_page('contact') || is_page(2986)) {
        $tpl_cnt = $theme_dir . '/page-templates/template-contact.php';
        if (file_exists($tpl_cnt)) return $tpl_cnt;
    }

    if (is_page('thank-you') || is_page(3162)) {
        $tpl_ty = $theme_dir . '/page-templates/template-thank-you.php';
        if (file_exists($tpl_ty)) return $tpl_ty;
    }

    return $template;
}, 99999);

/**
 * Universal Transactional Mail Dispatcher (Brevo API v3 with Native wp_mail Fallback)
 */
if (!function_exists('cs_send_transactional_email')) {
    function cs_send_transactional_email($to_email, $to_name, $subject, $html_body, $reply_to_email = '', $reply_to_name = '') {
        $api_key = defined('BREVO_API_KEY') ? BREVO_API_KEY : get_option('cs_brevo_api_key', '');

        if (!empty($api_key) && strpos($api_key, 'xkeysib-') === 0) {
            // When delivering to hello@chadsia.com on Zoho, use verified sender chad@navaramarketing.com to prevent Zoho self-spoofing bounce
            $sender_email = ($to_email === 'hello@chadsia.com' || $to_email === get_option('admin_email')) ? 'chad@navaramarketing.com' : 'hello@chadsia.com';
            $sender_name  = ($to_email === 'hello@chadsia.com' || $to_email === get_option('admin_email')) ? 'Chad Sia Media Leads' : 'Chad Sia';

            $payload = [
                'sender'      => ['name' => $sender_name, 'email' => $sender_email],
                'to'          => [['email' => $to_email, 'name' => $to_name ?: $to_email]],
                'subject'     => $subject,
                'htmlContent' => $html_body,
            ];
            if (!empty($reply_to_email)) {
                $payload['replyTo'] = ['email' => $reply_to_email, 'name' => $reply_to_name ?: $reply_to_email];
            }

            $res = wp_remote_post('https://api.brevo.com/v3/smtp/email', [
                'headers' => [
                    'api-key'      => $api_key,
                    'Content-Type' => 'application/json',
                    'Accept'       => 'application/json',
                ],
                'body'    => json_encode($payload),
                'timeout' => 15,
            ]);

            $code = wp_remote_retrieve_response_code($res);
            if ($code >= 200 && $code < 300) {
                return true;
            }
        }

        // Fallback to WordPress native mail
        $headers = [
            'Content-Type: text/html; charset=UTF-8',
            'From: Chad Sia <hello@chadsia.com>',
        ];
        if (!empty($reply_to_email)) {
            $headers[] = 'Reply-To: ' . ($reply_to_name ? $reply_to_name . ' ' : '') . '<' . $reply_to_email . '>';
        }
        return wp_mail($to_email, $subject, $html_body, $headers);
    }
}

/**
 * AJAX Handler for Contact & Project Intake Form
 * 100% Secure, Spam-Free Architecture: Multi-Layer Honeypots, Time-Trap, IP Rate Limiting, Nonce Validation & Lead Persistence
 */
function cs_handle_contact_submission() {
    // 1. Honeypot Anti-Spam Check (Silently drop bots)
    if (!empty($_POST['cs_hp_company_website']) || !empty($_POST['website_trap'])) {
        wp_send_json_success([
            'message' => 'Thank you! Your project details have been received.',
            'redirect_url' => home_url('/thank-you/')
        ]);
        exit;
    }

    // 2. Timing Anti-Bot Check (Real humans take > 2.5s to fill out details)
    $form_token = isset($_POST['cs_form_token']) ? intval($_POST['cs_form_token']) : 0;
    if ($form_token > 0 && (time() - $form_token) < 2) {
        wp_send_json_success([
            'message' => 'Thank you! Your project details have been received.',
            'redirect_url' => home_url('/thank-you/')
        ]);
        exit;
    }

    // 3. Cryptographic Nonce Check
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'cs_contact_nonce')) {
        wp_send_json_error(['message' => 'Security token invalid or expired. Please refresh the page and try again.'], 403);
    }

    // 4. IP Rate Limiting (Max 5 submissions per 10 minutes per IP)
    $client_ip = sanitize_text_field($_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1');
    $client_ip = explode(',', $client_ip)[0];
    $rate_limit_key = 'cs_rl_' . md5($client_ip);
    $attempts = (int) get_transient($rate_limit_key);
    if ($attempts >= 5) {
        wp_send_json_error(['message' => 'Too many submissions detected. Please wait a few minutes or email hello@chadsia.com directly.'], 429);
    }
    set_transient($rate_limit_key, $attempts + 1, 600);

    // 5. Sanitize Inputs & Strip Header Injections
    $name = isset($_POST['cs_name']) ? sanitize_text_field($_POST['cs_name']) : '';
    $name = str_replace(["\r", "\n", "%0a", "%0d"], '', $name);
    
    $email = isset($_POST['cs_email']) ? sanitize_email($_POST['cs_email']) : '';
    $email = str_replace(["\r", "\n", "%0a", "%0d"], '', $email);

    $phone = isset($_POST['cs_phone']) ? sanitize_text_field($_POST['cs_phone']) : '';
    $phone = str_replace(["\r", "\n", "%0a", "%0d"], '', $phone);

    $services = isset($_POST['cs_services']) ? (array) $_POST['cs_services'] : [];
    $services = array_map('sanitize_text_field', $services);
    
    $budget = isset($_POST['cs_budget']) ? sanitize_text_field($_POST['cs_budget']) : 'Not Specified';
    $timeline = isset($_POST['cs_timeline']) ? sanitize_text_field($_POST['cs_timeline']) : 'Not Specified';
    $message = isset($_POST['cs_message']) ? sanitize_textarea_field($_POST['cs_message']) : '';

    if (empty($name) || empty($email) || !is_email($email) || empty($message)) {
        wp_send_json_error(['message' => 'Please provide a valid Name, Business Email, and Project Scope brief.']);
    }

    // 6. Persist Lead to Database Backup Log (Zero lost inquiries)
    $leads_log = get_option('cs_contact_leads_log', []);
    if (!is_array($leads_log)) $leads_log = [];
    array_unshift($leads_log, [
        'timestamp' => current_time('mysql'),
        'name'      => $name,
        'email'     => $email,
        'phone'     => $phone,
        'services'  => $services,
        'budget'    => $budget,
        'timeline'  => $timeline,
        'message'   => $message,
        'ip'        => $client_ip
    ]);
    if (count($leads_log) > 50) {
        $leads_log = array_slice($leads_log, 0, 50);
    }
    update_option('cs_contact_leads_log', $leads_log, false);

    // 7. Dispatch Email to hello@chadsia.com
    $to = 'hello@chadsia.com';
    $subject = '🚀 Project Intake: ' . $name . ' (' . (empty($services) ? 'General Inquiry' : $services[0]) . ')';

    $services_str = empty($services) ? 'General Inquiry' : implode(', ', $services);

    // Beautiful Responsive HTML Email
    $html_body = '<!DOCTYPE html><html><body style="font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif; line-height: 1.6; color: #111827; background: #f4f5f7; padding: 24px;">';
    $html_body .= '<div style="max-width: 600px; margin: 0 auto; background: #ffffff; border-radius: 12px; overflow: hidden; border: 1px solid #e5e7eb; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">';
    $html_body .= '<div style="background: #4968f8; color: #ffffff; padding: 24px; text-align: left;">';
    $html_body .= '<h1 style="margin: 0; font-size: 20px; font-weight: 800; letter-spacing: -0.02em;">New Project Discovery Intake</h1>';
    $html_body .= '<p style="margin: 6px 0 0; font-size: 13px; color: rgba(255,255,255,0.85);">Received via chadsia.com/contact/</p>';
    $html_body .= '</div>';
    
    $html_body .= '<div style="padding: 24px;">';
    $html_body .= '<table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">';
    $html_body .= '<tr><td style="padding: 8px 0; color: #6b7280; font-size: 13px; width: 140px; font-weight: 600;">Client Name:</td><td style="padding: 8px 0; font-weight: 700; color: #111827; font-size: 15px;">' . esc_html($name) . '</td></tr>';
    $html_body .= '<tr><td style="padding: 8px 0; color: #6b7280; font-size: 13px; font-weight: 600;">Business Email:</td><td style="padding: 8px 0;"><a href="mailto:' . esc_attr($email) . '" style="color: #4968f8; font-weight: 700; text-decoration: none;">' . esc_html($email) . '</a></td></tr>';
    if (!empty($phone)) {
        $html_body .= '<tr><td style="padding: 8px 0; color: #6b7280; font-size: 13px; font-weight: 600;">Phone / WhatsApp:</td><td style="padding: 8px 0; font-weight: 600;">' . esc_html($phone) . '</td></tr>';
    }
    $html_body .= '<tr><td style="padding: 8px 0; color: #6b7280; font-size: 13px; font-weight: 600;">Services Needed:</td><td style="padding: 8px 0; font-weight: 600; color: #1d4ed8;">' . esc_html($services_str) . '</td></tr>';
    $html_body .= '<tr><td style="padding: 8px 0; color: #6b7280; font-size: 13px; font-weight: 600;">Estimated Budget:</td><td style="padding: 8px 0; font-weight: 700; color: #065f46;">' . esc_html($budget) . '</td></tr>';
    $html_body .= '<tr><td style="padding: 8px 0; color: #6b7280; font-size: 13px; font-weight: 600;">Target Timeline:</td><td style="padding: 8px 0; font-weight: 600;">' . esc_html($timeline) . '</td></tr>';
    $html_body .= '</table>';

    $html_body .= '<div style="background: #f8fafc; border-left: 4px solid #4968f8; padding: 16px; border-radius: 4px; margin-top: 16px;">';
    $html_body .= '<div style="font-size: 12px; font-weight: 700; color: #4b5563; margin-bottom: 6px; text-transform: uppercase; letter-spacing: 0.05em;">Project Scope & Brief:</div>';
    $html_body .= '<div style="font-size: 14px; color: #1f2937; white-space: pre-wrap; line-height: 1.6;">' . esc_html($message) . '</div>';
    $html_body .= '</div>';

    $html_body .= '<div style="margin-top: 24px; padding-top: 16px; border-top: 1px solid #e5e7eb; display: flex; justify-content: space-between; align-items: center; font-size: 12px; color: #9ca3af;">';
    $html_body .= '<span>Direct 1-on-1 Lead Dispatch</span>';
    $html_body .= '<span>IP: ' . esc_html($client_ip) . '</span>';
    $html_body .= '</div>';
    
    $html_body .= '</div></div></body></html>';

    // Direct Transactional Dispatch via Brevo API v3 over HTTPS
    cs_send_transactional_email($to, 'Chad Sia', $subject, $html_body, $email, $name);
    cs_send_transactional_email('chadfuse@yahoo.com', 'Chad Sia', $subject, $html_body, $email, $name);

    // Automated client confirmation receipt
    $client_subject = 'Inquiry Received - Chad Sia Media';
    $client_body = '<!DOCTYPE html><html><body style="font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif; line-height: 1.6; color: #111827; background: #f4f5f7; padding: 24px;">'
        . '<div style="max-width: 580px; margin: 0 auto; background: #ffffff; border-radius: 12px; overflow: hidden; border: 1px solid #e5e7eb; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">'
        . '<div style="background: #4968f8; color: #ffffff; padding: 24px;">'
        . '<h1 style="margin: 0; font-size: 18px; font-weight: 800;">Thank You, ' . esc_html($name) . '!</h1>'
        . '<p style="margin: 6px 0 0; font-size: 13px; color: rgba(255,255,255,0.85);">Chad Sia Media - Project Discovery</p>'
        . '</div>'
        . '<div style="padding: 24px;">'
        . '<p style="margin: 0 0 16px; font-size: 14px; color: #374151;">Your project inquiry has been safely received. I personally review every brief and will get back to you within 4 hours with a scope assessment.</p>'
        . '<div style="background: #f8fafc; border-left: 3px solid #4968f8; padding: 14px 16px; border-radius: 4px; margin-bottom: 20px;">'
        . '<strong style="font-size: 12px; text-transform: uppercase; color: #6b7280; display: block; margin-bottom: 6px;">Your Project Scope:</strong>'
        . '<div style="font-size: 13px; color: #1f2937; white-space: pre-wrap;">' . esc_html($message) . '</div>'
        . '</div>'
        . '<p style="margin: 0 0 16px; font-size: 13px; color: #6b7280;">If you\'d like to jump straight to a live discussion, feel free to grab a time directly: <a href="https://calendly.com/hello-chadsia/30min" style="color: #4968f8; font-weight: 700; text-decoration: none;">Schedule a 30-Min Call &rarr;</a></p>'
        . '<hr style="border: none; border-top: 1px solid #e5e7eb; margin: 20px 0;" />'
        . '<p style="margin: 0; font-size: 13px; font-weight: 700; color: #111827;">Chad Sia</p>'
        . '<p style="margin: 2px 0 0; font-size: 12px; color: #6b7280;">Senior Front-End Architect &amp; Custom WordPress Engineer<br /><a href="https://chadsia.com" style="color: #4968f8; text-decoration: none;">chadsia.com</a> | <a href="mailto:hello@chadsia.com" style="color: #4968f8; text-decoration: none;">hello@chadsia.com</a></p>'
        . '</div></div></body></html>';

    cs_send_transactional_email($email, $name, $client_subject, $client_body, 'hello@chadsia.com', 'Chad Sia');

    wp_send_json_success([
        'message'      => 'Thank you, ' . esc_html($name) . '! Your project details have been received. Redirecting...',
        'redirect_url' => home_url('/thank-you/?client=' . urlencode($name))
    ]);
}
add_action('wp_ajax_cs_handle_contact_submission', 'cs_handle_contact_submission');
add_action('wp_ajax_nopriv_cs_handle_contact_submission', 'cs_handle_contact_submission');

/**
 * 301 Canonical Redirects for Legacy / Shortened Slugs
 */
add_action('template_redirect', function () {
    $uri = trim(parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH), '/');
    
    $redirects = [
        'locations/philippines/cebu' => home_url('/locations/philippines/cebu-city/'),
        'services/figma-to-wordpress' => home_url('/services/front-end-development/'),
        'services/headless-wordpress' => home_url('/services/api-and-third-party-integrations/'),
        'services/speed-optimization' => home_url('/services/website-speed-optimization/'),
        'services/wordpress-maintenance' => home_url('/services/website-maintenance-support-services/'),
        'services/front-end-engineering' => home_url('/services/front-end-development/'),
        'services/core-web-vitals' => home_url('/services/website-speed-optimization/'),
    ];

    if (isset($redirects[$uri])) {
        wp_safe_redirect($redirects[$uri], 301);
        exit;
    }
});

/**
 * Critical Request Chain & PageSpeed Performance Optimizations
 */
// 1. Asynchronous non-blocking load for master theme CSS on homepage where critical CSS is inlined
add_filter('style_loader_tag', function ($html, $handle, $href, $media) {
    if ($handle === 'cs-master-theme-style' && (is_front_page() || is_home())) {
        return '<link rel="preload" as="style" href="' . esc_url($href) . '">' .
               '<link rel="stylesheet" id="' . esc_attr($handle) . '-css" href="' . esc_url($href) . '" media="print" onload="this.media=\'all\'">' .
               '<noscript>' . $html . '</noscript>';
    }
    return $html;
}, 10, 4);

// 2. Output Buffer Filter: Strip Render-Blocking GoDaddy Telemetry & Defer Cloudflare Beacons
add_action('template_redirect', function () {
    if (is_admin() || wp_doing_ajax() || wp_doing_cron() || (defined('REST_REQUEST') && REST_REQUEST)) {
        return;
    }
    ob_start(function ($buffer) {
        if (empty($buffer) || !is_string($buffer)) {
            return $buffer;
        }
        // Remove GoDaddy telemetry scripts (scc-c2.min.js, tccl.min.js, csp.secureserver.net)
        $buffer = preg_replace('/<script[^>]*src=[\'"][^\'"]*(?:img1\.wsimg\.com|secureserver\.net)[^\'"]*[\'"][^>]*><\/script>/i', '', $buffer);
        $buffer = preg_replace('/<link[^>]*href=[\'"][^\'"]*img1\.wsimg\.com[^\'"]*[\'"][^>]*>/i', '', $buffer);
        // Defer Cloudflare Insights beacon
        $buffer = preg_replace('/(<script[^>]*src=[\'"][^\'"]*static\.cloudflareinsights\.com[^\'"]*[\'"][^>]*)>/i', '$1 defer>', $buffer);
        return $buffer;
    });
}, 1);

