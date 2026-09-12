<?php
/**
 * Global Client Logo Carousel Widget & Helper
 * 
 * Provides a high-performance, responsive infinite marquee logo carousel
 * usable across all templates, PHP parts, and Gutenberg/Elementor shortcodes.
 * 
 * Usage in PHP:
 *   if (function_exists('cs_render_logo_carousel')) {
 *       cs_render_logo_carousel(['theme' => 'dark', 'kicker' => 'Proven Track Record']);
 *   }
 * 
 * Usage in WordPress Content / Elementor:
 *   [cs_logo_carousel theme="dark" show_header="true"]
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Returns array of client logos
 */
function cs_get_client_logos() {
    $base_url = get_stylesheet_directory_uri() . '/assets/logos/optimized/';
    
    return [
        [
            'name'        => 'Casa Halo',
            'file'        => 'CasaHalo-Logo.png',
            'dark_file'   => 'dark_CasaHalo-Logo.png',
            'white_file'  => 'white_CasaHalo-Logo.png',
            'aspect'      => 'square',
        ],
        [
            'name'        => 'Medmate',
            'file'        => 'Medmate_logo_2025.png',
            'dark_file'   => 'dark_Medmate_logo_2025.png',
            'white_file'  => 'white_Medmate_logo_2025.png',
            'aspect'      => 'wide',
        ],
        [
            'name'        => 'Pumpables',
            'file'        => 'Pumpables_Logo_White.png',
            'dark_file'   => 'dark_Pumpables_Logo_White.png',
            'white_file'  => 'white_Pumpables_Logo_White.png',
            'aspect'      => 'wide',
        ],
        [
            'name'        => 'BluSONIL',
            'file'        => 'bluSONIL-Logo.png',
            'dark_file'   => 'dark_bluSONIL-Logo.png',
            'white_file'  => 'white_bluSONIL-Logo.png',
            'aspect'      => 'wide',
        ],
        [
            'name'        => 'Frasso',
            'file'        => 'Frasso-Logo.png',
            'dark_file'   => 'dark_Frasso-Logo.png',
            'white_file'  => 'white_Frasso-Logo.png',
            'aspect'      => 'square',
        ],
        [
            'name'        => 'Kikku',
            'file'        => 'Kikku-logo.png',
            'dark_file'   => 'dark_Kikku-logo.png',
            'white_file'  => 'white_Kikku-logo.png',
            'aspect'      => 'medium',
        ],
        [
            'name'        => 'Kirk Allen',
            'file'        => 'Kirk-Allen-Logo-1-600x164.png',
            'dark_file'   => 'dark_Kirk-Allen-Logo-1-600x164.png',
            'white_file'  => 'white_Kirk-Allen-Logo-1-600x164.png',
            'aspect'      => 'wide',
        ],
        [
            'name'        => 'Martin Taylor',
            'file'        => 'MartinTaylor-logo.png',
            'dark_file'   => 'dark_MartinTaylor-logo.png',
            'white_file'  => 'white_MartinTaylor-logo.png',
            'aspect'      => 'wide',
        ],
        [
            'name'        => 'Cowper Residences',
            'file'        => 'cowper-residences-logo.png',
            'dark_file'   => 'dark_cowper-residences-logo.png',
            'white_file'  => 'white_cowper-residences-logo.png',
            'aspect'      => 'wide',
        ],
        [
            'name'        => 'Defensible',
            'file'        => 'defensible-logo.png',
            'dark_file'   => 'dark_defensible-logo.png',
            'white_file'  => 'white_defensible-logo.png',
            'aspect'      => 'wide',
        ],
        [
            'name'        => 'Gypsy Jazz Club',
            'file'        => 'gypsyjazzclub.png',
            'dark_file'   => 'dark_gypsyjazzclub.png',
            'white_file'  => 'white_gypsyjazzclub.png',
            'aspect'      => 'wide',
        ],
        [
            'name'        => 'LaSalle Stingers',
            'file'        => 'lasalle-stingers.png',
            'dark_file'   => 'dark_lasalle-stingers.png',
            'white_file'  => 'white_lasalle-stingers.png',
            'aspect'      => 'square',
        ],
        [
            'name'        => 'Robin Nolan',
            'file'        => 'robinnolan.png',
            'dark_file'   => 'dark_robinnolan.png',
            'white_file'  => 'white_robinnolan.png',
            'aspect'      => 'medium',
        ],
        [
            'name'        => 'Scott Paxton',
            'file'        => 'scottpaxton-logo.png',
            'dark_file'   => 'dark_scottpaxton-logo.png',
            'white_file'  => 'white_scottpaxton-logo.png',
            'aspect'      => 'wide',
        ],
        [
            'name'        => 'SolarPlus',
            'file'        => 'solarplus.png',
            'dark_file'   => 'dark_solarplus.png',
            'white_file'  => 'white_solarplus.png',
            'aspect'      => 'wide',
        ],
        [
            'name'        => 'SpeakersU',
            'file'        => 'speakersu.png',
            'dark_file'   => 'dark_speakersu.png',
            'white_file'  => 'white_speakersu.png',
            'aspect'      => 'wide',
        ],
        [
            'name'        => 'Spectra',
            'file'        => 'spectra-logo.png',
            'dark_file'   => 'dark_spectra-logo.png',
            'white_file'  => 'white_spectra-logo.png',
            'aspect'      => 'wide',
        ],
        [
            'name'        => 'Sugar Sugar Cakes',
            'file'        => 'sugarsugarcakes.png',
            'dark_file'   => 'dark_sugarsugarcakes.png',
            'white_file'  => 'white_sugarsugarcakes.png',
            'aspect'      => 'medium',
        ],
        [
            'name'        => 'W. James Taylor',
            'file'        => 'wJamesTaylor-30.png',
            'dark_file'   => 'dark_wJamesTaylor-30.png',
            'white_file'  => 'white_wJamesTaylor-30.png',
            'aspect'      => 'wide',
        ],
    ];
}

/**
 * Render the logo carousel widget
 */
function cs_render_logo_carousel($args = []) {
    $defaults = [
        'theme'        => 'dark', // 'dark' | 'light' | 'glass'
        'show_header'  => true,
        'kicker'       => 'Proven Track Record',
        'title'        => 'Trusted by Leading Brands, Founders & Fast-Growing Enterprises',
        'speed'        => '38s',
        'class'        => '',
        'id'           => '',
    ];
    
    $config = wp_parse_args($args, $defaults);
    $logos = cs_get_client_logos();
    $base_url = get_stylesheet_directory_uri() . '/assets/logos/optimized/';
    
    $theme_class = 'cs-logo-theme-' . esc_attr($config['theme']);
    $extra_class = esc_attr($config['class']);
    $sec_id      = !empty($config['id']) ? 'id="' . esc_attr($config['id']) . '"' : '';
    $speed_style = '--cs-marquee-speed: ' . esc_attr($config['speed']) . ';';
    
    // Choose image variant based on theme
    $img_key = ($config['theme'] === 'light') ? 'dark_file' : 'white_file';
    ?>
    <section class="cs-global-logo-carousel <?php echo $theme_class . ' ' . $extra_class; ?>" <?php echo $sec_id; ?> style="<?php echo $speed_style; ?>">
      <div class="cs-logo-carousel-inner">
        <?php if (!empty($config['show_header'])): ?>
          <div class="cs-logo-carousel-header">
            <?php if (!empty($config['kicker'])): ?>
              <div class="cs-logo-kicker">
                <span><?php echo esc_html($config['kicker']); ?></span>
              </div>
            <?php endif; ?>
            <?php if (!empty($config['title'])): ?>
              <p class="cs-logo-title"><?php echo esc_html($config['title']); ?></p>
            <?php endif; ?>
          </div>
        <?php endif; ?>

        <div class="cs-logo-marquee-viewport" aria-label="Client Brands and Partners">
          <div class="cs-logo-marquee-track">
            <?php 
            // Render first track
            foreach ($logos as $logo): 
                $file_name = str_replace('.png', '.webp', $logo[$img_key]);
                $img_src = $base_url . $file_name;
                $alt_text = esc_attr($logo['name'] . ' Logo');
                $aspect_class = 'cs-aspect-' . esc_attr($logo['aspect']);
            ?>
              <div class="cs-logo-item <?php echo $aspect_class; ?>" title="<?php echo esc_attr($logo['name']); ?>">
                <img src="<?php echo esc_url($img_src); ?>" 
                     alt="<?php echo $alt_text; ?>" 
                     loading="lazy" 
                     decoding="async" 
                     width="160" 
                     height="44" />
              </div>
            <?php endforeach; ?>

            <?php 
            // Duplicate track for seamless infinite marquee loop
            foreach ($logos as $logo): 
                $file_name = str_replace('.png', '.webp', $logo[$img_key]);
                $img_src = $base_url . $file_name;
                $alt_text = esc_attr($logo['name'] . ' Logo');
                $aspect_class = 'cs-aspect-' . esc_attr($logo['aspect']);
            ?>
              <div class="cs-logo-item <?php echo $aspect_class; ?>" aria-hidden="true" title="<?php echo esc_attr($logo['name']); ?>">
                <img src="<?php echo esc_url($img_src); ?>" 
                     alt="<?php echo $alt_text; ?>" 
                     loading="lazy" 
                     decoding="async" 
                     width="160" 
                     height="44" />
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </section>
    <?php
}

/**
 * Shortcode [cs_logo_carousel]
 */
add_shortcode('cs_logo_carousel', function ($atts) {
    $atts = shortcode_atts([
        'theme'       => 'dark',
        'show_header' => 'true',
        'kicker'      => 'Proven Track Record',
        'title'       => 'Trusted by Leading Brands, Founders & Fast-Growing Enterprises',
        'speed'       => '38s',
        'class'       => '',
        'id'          => '',
    ], $atts, 'cs_logo_carousel');
    
    $args = [
        'theme'       => sanitize_text_field($atts['theme']),
        'show_header' => filter_var($atts['show_header'], FILTER_VALIDATE_BOOLEAN),
        'kicker'      => sanitize_text_field($atts['kicker']),
        'title'       => sanitize_text_field($atts['title']),
        'speed'       => sanitize_text_field($atts['speed']),
        'class'       => sanitize_text_field($atts['class']),
        'id'          => sanitize_text_field($atts['id']),
    ];
    
    ob_start();
    cs_render_logo_carousel($args);
    return ob_get_clean();
});

add_shortcode('cs_clients_carousel', function ($atts) {
    return do_shortcode('[cs_logo_carousel ' . http_build_query((array)$atts, '', ' ') . ']');
});
