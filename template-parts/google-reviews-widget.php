<?php
/**
 * Google Reviews Widget Template Part
 * High-performance, branded Google Reviews slider with 5.0 Trust Badge
 *
 * @package ChadSia
 */

if (!defined('ABSPATH')) {
    exit;
}

// Fetch Google Reviews from helper (with automatic transient cache & fallback)
$google_data = function_exists('cs_get_google_reviews_data') ? cs_get_google_reviews_data() : [];

$reviews = !empty($google_data['reviews']) ? $google_data['reviews'] : [
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
];

$overall_rating = !empty($google_data['rating']) ? $google_data['rating'] : 5.0;
$total_reviews  = !empty($google_data['user_ratings_total']) ? $google_data['user_ratings_total'] : count($reviews);
$google_maps_url = !empty($google_data['google_maps_url']) ? $google_data['google_maps_url'] : 'https://search.google.com/local/writereview?placeid=ChIJL78UYsTPrjMRvJ2P_r18rHc';

$kicker = !empty($args['kicker']) ? $args['kicker'] : 'Verified Client Reviews';
$title  = !empty($args['title']) ? $args['title'] : 'Rated 5.0 on Google Reviews';
?>
<section class="cs-loc-reviews cs-google-reviews-section">
  <div class="cs-loc-container">
    
    <!-- Top Header + Google Summary Badge -->
    <div class="cs-google-reviews-header-wrap">
      <div class="cs-google-reviews-heading">
        <div class="cs-eyebrow cs-google-eyebrow">
          <svg class="cs-google-g-icon" viewBox="0 0 24 24" width="18" height="18">
            <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
            <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
            <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"/>
            <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"/>
          </svg>
          <span><?php echo esc_html($kicker); ?></span>
        </div>
        <h2 class="cs-sec-title" style="margin-bottom: 0;"><?php echo esc_html($title); ?></h2>
      </div>

      <!-- Google Trust Summary Pill -->
      <div class="cs-google-trust-badge">
        <div class="cs-google-rating-score"><?php echo number_format((float)$overall_rating, 1); ?></div>
        <div class="cs-google-stars-wrap">
          <div class="cs-google-stars">
            <?php for ($i = 0; $i < 5; $i++): ?>
              <i class="fa-solid fa-star"></i>
            <?php endfor; ?>
          </div>
          <span class="cs-google-count"><?php echo intval($total_reviews); ?> Google Reviews</span>
        </div>
        <a href="<?php echo esc_url($google_maps_url); ?>" target="_blank" rel="noopener noreferrer" class="cs-google-write-btn">
          <span>Review on Google</span>
          <i class="fa-solid fa-arrow-up-right-from-square"></i>
        </a>
      </div>

      <!-- Slider Controls -->
      <div class="cs-slider-controls">
        <button type="button" class="cs-slider-btn prev" aria-label="Previous Google Review"><i class="fa-solid fa-chevron-left"></i></button>
        <button type="button" class="cs-slider-btn next" aria-label="Next Google Review"><i class="fa-solid fa-chevron-right"></i></button>
      </div>
    </div>

    <!-- Review Slider Viewport -->
    <div class="cs-reviews-slider">
      <div class="cs-reviews-viewport">
        <div class="cs-reviews-track">
          <?php foreach ($reviews as $rev): 
              $rev_name = !empty($rev['author_name']) ? $rev['author_name'] : 'Client';
              $rev_text = !empty($rev['text']) ? $rev['text'] : '';
              $rev_rating = !empty($rev['rating']) ? intval($rev['rating']) : 5;
              $rev_time = !empty($rev['relative_time_description']) ? $rev['relative_time_description'] : 'Verified Review';
              $rev_initials = !empty($rev['initials']) ? $rev['initials'] : strtoupper(substr($rev_name, 0, 2));
              $rev_role = !empty($rev['author_role']) ? $rev['author_role'] : '';
              $rev_company = !empty($rev['company']) ? $rev['company'] : '';
              $rev_photo = !empty($rev['profile_photo_url']) ? $rev['profile_photo_url'] : '';
              $rev_source = !empty($rev['source']) ? $rev['source'] : 'google';
          ?>
            <div class="cs-review-card cs-google-card">
              
              <!-- Card Top: Stars + Source Badge -->
              <div class="cs-google-card-top">
                <div class="cs-review-stars">
                  <?php for ($i = 0; $i < $rev_rating; $i++): ?>
                    <i class="fa-solid fa-star"></i>
                  <?php endfor; ?>
                </div>
                <?php if ($rev_source === 'client'): ?>
                  <div class="cs-google-tag" style="background: rgba(16, 185, 129, 0.08); color: #065f46;">
                    <i class="fa-solid fa-circle-check" style="color: #10b981; font-size: 11px;"></i>
                    <span>Verified Review</span>
                  </div>
                <?php else: ?>
                  <div class="cs-google-tag">
                    <svg viewBox="0 0 24 24" width="14" height="14">
                      <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                      <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                      <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"/>
                      <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"/>
                    </svg>
                    <span>Google Review</span>
                  </div>
                <?php endif; ?>
              </div>

              <!-- Review Narrative -->
              <p class="cs-review-text">“<?php echo esc_html($rev_text); ?>”</p>

              <!-- Author Metadata -->
              <div class="cs-review-author">
                <?php if (!empty($rev_photo)): ?>
                  <img src="<?php echo esc_url($rev_photo); ?>" alt="<?php echo esc_attr($rev_name); ?>" class="cs-author-avatar-img" loading="lazy" />
                <?php else: ?>
                  <div class="cs-author-avatar cs-google-avatar"><?php echo esc_html($rev_initials); ?></div>
                <?php endif; ?>
                
                <div class="cs-author-meta">
                  <div class="cs-author-name-row">
                    <strong><?php echo esc_html($rev_name); ?></strong>
                    <i class="fa-solid fa-circle-check cs-verified-badge" title="Verified Google Review"></i>
                  </div>
                  <?php if (!empty($rev_role) || !empty($rev_company)): ?>
                    <span><?php echo esc_html($rev_role . (!empty($rev_company) ? ' · ' . $rev_company : '')); ?></span>
                  <?php else: ?>
                    <span><?php echo esc_html($rev_time); ?></span>
                  <?php endif; ?>
                </div>
              </div>

            </div>
          <?php endforeach; ?>
        </div>
      </div>
      <div class="cs-slider-dots"></div>
    </div>

  </div>
</section>
