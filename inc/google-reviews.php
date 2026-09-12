<?php
/**
 * Google Reviews Integration & Caching Helper
 *
 * @package ChadSia
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Fetch Google Places Reviews with Transient Cache & Fallback
 */
function cs_get_google_reviews_data() {
    $cache_key = 'cs_google_places_reviews_data';
    $cached = get_transient($cache_key);
    
    if ($cached !== false && is_array($cached) && !empty($cached['reviews'])) {
        return $cached;
    }

    $api_key  = defined('GOOGLE_PLACES_API_KEY') ? GOOGLE_PLACES_API_KEY : get_option('cs_google_places_api_key', '');
    $place_id = defined('GOOGLE_PLACE_ID') ? GOOGLE_PLACE_ID : get_option('cs_google_place_id', '');

    if (!empty($api_key) && !empty($place_id)) {
        $endpoint = 'https://maps.googleapis.com/maps/api/place/details/json?' . http_build_query([
            'place_id' => $place_id,
            'fields'   => 'name,rating,reviews,user_ratings_total,url',
            'key'      => $api_key,
        ]);

        $response = wp_remote_get($endpoint, [
            'timeout' => 8,
            'headers' => ['Accept' => 'application/json']
        ]);

        if (!is_wp_error($response) && wp_remote_retrieve_response_code($response) === 200) {
            $body = json_decode(wp_remote_retrieve_body($response), true);
            if (!empty($body['result'])) {
                $res = $body['result'];
                $data = [
                    'rating'             => !empty($res['rating']) ? floatval($res['rating']) : 5.0,
                    'user_ratings_total' => !empty($res['user_ratings_total']) ? intval($res['user_ratings_total']) : 5,
                    'google_maps_url'    => !empty($res['url']) ? esc_url($res['url']) : 'https://www.google.com/maps/search/?api=1&query=Chad+Sia+Media',
                    'reviews'            => !empty($res['reviews']) ? $res['reviews'] : []
                ];

                set_transient($cache_key, $data, 24 * HOUR_IN_SECONDS);
                return $data;
            }
        }
    }

    // Default High-Fidelity Dataset with Exact Google Reviews
    $default_data = [
        'rating'             => 5.0,
        'user_ratings_total' => 5,
        'google_maps_url'    => 'https://search.google.com/local/writereview?placeid=ChIJL78UYsTPrjMRvJ2P_r18rHc',
        'reviews'            => [
            [
                'author_name' => 'Ismail Saleem',
                'author_role' => 'Verified Client · 8 months ago',
                'company'     => '1 Google review',
                'initials'    => 'IS',
                'rating'      => 5,
                'relative_time_description' => '8 months ago',
                'text'        => 'I had a great experience working with Charles Sia Media. Charles was professional, responsive, and really easy to work with from start to finish. He understood exactly what I was looking for and delivered a clean, well-structured website that matched the brief perfectly. What stood out most was his communication and attention to detail, he kept me updated throughout the process, made changes quickly, and genuinely cared about getting the final result right. The turnaround time was also excellent. If you’re looking for reliable, high-quality web design work, I’d highly recommend Charles Sia Media. Will definitely be working with him again.',
                'profile_photo_url' => ''
            ],
            [
                'author_name' => 'GypsyJazz Secrets',
                'author_role' => 'Client & Partner · 9 months ago',
                'company'     => '4 Google reviews',
                'initials'    => 'GJ',
                'rating'      => 5,
                'relative_time_description' => '9 months ago',
                'text'        => "We've been working with Chad for a long time now. He handles all our web design and we love him. He's a great guy and super easy to work with - and very responsive for those times where we need urgent help in a pinch. Chad is an absolute pleasure to work with!",
                'profile_photo_url' => ''
            ],
            [
                'author_name' => 'Tech P3Music',
                'author_role' => 'Verified Client · Recent',
                'company'     => 'Google review',
                'initials'    => 'TP',
                'rating'      => 5,
                'relative_time_description' => 'Recent',
                'text'        => 'I had a great experience working with Chad Sia on web design and WordPress development. Chad built a professional, easy-to-navigate website with a strong focus on conversions. The layout, calls to action, and overall user experience were thoughtfully structured to help turn visitors into leads. Highly recommended if you need someone who understands both WordPress development and conversion-focused web design.',
                'profile_photo_url' => ''
            ],
            [
                'author_name' => 'Kevin Koeppel',
                'author_role' => 'Verified Client · 9 months ago',
                'company'     => '13 Google reviews · 3 photos',
                'initials'    => 'KK',
                'rating'      => 5,
                'relative_time_description' => '9 months ago',
                'text'        => 'Amazing work and completed the project in a timely fashion! Highly recommend!',
                'profile_photo_url' => ''
            ],
            [
                'author_name' => 'dVillain .Kalaban',
                'author_role' => 'Local Guide · 8 months ago',
                'company'     => '2 Google reviews · 11 photos',
                'initials'    => 'DK',
                'rating'      => 5,
                'relative_time_description' => '8 months ago',
                'text'        => 'legit and hassle free',
                'profile_photo_url' => '',
                'source'      => 'google'
            ],
            [
                'author_name' => 'Barry W.',
                'author_role' => 'Verified Client · Dec 14, 2025',
                'company'     => 'Web Design Client',
                'initials'    => 'BW',
                'rating'      => 5,
                'relative_time_description' => 'Dec 14, 2025',
                'text'        => 'Charles provided fast service 2-days ahead of schedule. He communicated well with me and frequently. He took feedback and adjusted the site to my requirements. A pleasure to do business with and I highly recommend him for web-site design.',
                'profile_photo_url' => '',
                'source'      => 'client'
            ]
        ]
    ];

    return $default_data;
}

/**
 * Render the Google Reviews Widget Component
 */
function cs_render_google_reviews($args = []) {
    $tpl = get_stylesheet_directory() . '/template-parts/google-reviews-widget.php';
    if (file_exists($tpl)) {
        include $tpl;
    }
}

/**
 * Universal Alias for Global Reviews Widget
 */
if (!function_exists('cs_render_reviews_slider')) {
    function cs_render_reviews_slider($args = []) {
        cs_render_google_reviews($args);
    }
}

/**
 * Shortcode for embedding centralized Google Reviews: [cs_reviews] or [google_reviews]
 */
add_shortcode('cs_reviews', function($atts) {
    $atts = shortcode_atts([
        'kicker' => 'Verified Client Reviews',
        'title'  => 'Rated 5.0 on Google Reviews'
    ], $atts, 'cs_reviews');

    ob_start();
    cs_render_google_reviews($atts);
    return ob_get_clean();
});

add_shortcode('google_reviews', function($atts) {
    return do_shortcode('[cs_reviews]');
});
