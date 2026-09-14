<?php
/**
 * Global Portfolio Showcase Template Part
 * 
 * @package ChadSiaTheme
 */

if (!defined('ABSPATH')) {
    exit;
}

$args = get_query_var('cs_portfolio_args', []);
if (empty($args)) {
    $args = [
        'kicker'        => 'Proven Case Studies',
        'title'         => 'Featured Portfolio: Real Results & Engineered Speed',
        'subtitle'      => '',
        'items'         => function_exists('cs_get_default_portfolio_items') ? cs_get_default_portfolio_items() : [],
        'show_footer'   => true,
        'footer_text'   => 'Looking for more live enterprise builds and custom engineering benchmarks?',
        'view_all_text' => 'View Complete Work Portfolio',
        'view_all_url'  => '/portfolio/',
        'class'         => '',
    ];
}

$items = $args['items'] ?? [];
if (empty($items) && function_exists('cs_get_default_portfolio_items')) {
    $items = cs_get_default_portfolio_items();
}

$kicker        = $args['kicker'] ?? 'Proven Case Studies';
$title         = $args['title'] ?? 'Featured Portfolio: Real Results & Engineered Speed';
$subtitle      = $args['subtitle'] ?? '';
$show_footer   = !empty($args['show_footer']);
$footer_text   = $args['footer_text'] ?? 'Looking for more live enterprise builds and custom engineering benchmarks?';
$view_all_text = $args['view_all_text'] ?? 'View Complete Work Portfolio';
$view_all_url  = $args['view_all_url'] ?? '/portfolio/';
$extra_class   = $args['class'] ?? '';
?>

<section class="cs-global-portfolio-sec cs-service-portfolio <?php echo esc_attr($extra_class); ?>">
  <div class="cs-service-container">
    <div class="cs-sec-heading-group">
      <?php if (!empty($kicker)): ?>
      <div class="cs-eyebrow">
        <?php echo esc_html($kicker); ?>
      </div>
      <?php endif; ?>
      <h2 class="cs-sec-title"><?php echo esc_html($title); ?></h2>
      <?php if (!empty($subtitle)): ?>
        <p class="cs-sec-subtitle"><?php echo esc_html($subtitle); ?></p>
      <?php endif; ?>
    </div>

    <div class="cs-portfolio-grid">
      <?php foreach ($items as $port): 
          $p_title = $port['title'] ?? '';
          $p_client = $port['client_type'] ?? '';
          $p_metric = $port['metric_badge'] ?? '';
          $p_desc = $port['description'] ?? '';
          $p_tags_raw = $port['tags'] ?? '';
          if (is_array($p_tags_raw)) {
              $p_tags = $p_tags_raw;
          } else {
              $p_tags = array_filter(array_map('trim', explode(',', $p_tags_raw)));
          }
          $p_url = $port['project_url'] ?? '/contact/';
          $p_live = !empty($port['live_url']) ? $port['live_url'] : '';
          $p_live_text = $port['live_text'] ?? '';
          
          // Resolve image URL
          $p_img = '';
          if (!empty($port['image'])) {
              if (is_array($port['image']) && !empty($port['image']['url'])) {
                  $p_img = $port['image']['url'];
              } elseif (is_numeric($port['image'])) {
                  $p_img = wp_get_attachment_image_url($port['image'], 'large');
              } elseif (is_string($port['image'])) {
                  $p_img = $port['image'];
              }
          }
          if (empty($p_img) && !empty($port['image_url'])) {
              $p_img = $port['image_url'];
          }
          if (empty($p_title)) continue;
      ?>
        <div class="cs-portfolio-card">
          <?php if (!empty($p_img)): ?>
            <div class="cs-portfolio-media">
              <img src="<?php echo esc_url($p_img); ?>" alt="<?php echo esc_attr($p_title); ?>" loading="lazy" />
              <div class="cs-portfolio-media-overlay"></div>
            </div>
          <?php endif; ?>

          <div class="cs-portfolio-body">
            <?php if (empty($p_img) && (!empty($p_client) || !empty($p_metric))): ?>
              <div class="cs-portfolio-meta">
                <span class="cs-portfolio-client"><?php echo esc_html($p_client); ?></span>
                <?php if (!empty($p_metric)): ?>
                  <span class="cs-portfolio-metric-badge"><?php echo esc_html($p_metric); ?></span>
                <?php endif; ?>
              </div>
            <?php endif; ?>

            <h3><?php echo esc_html($p_title); ?></h3>
            <p><?php echo esc_html(wp_strip_all_tags($p_desc)); ?></p>

            <?php if (!empty($p_tags)): ?>
            <div class="cs-portfolio-tags">
              <?php foreach ($p_tags as $tag): ?>
                <span class="cs-port-tag"><?php echo esc_html($tag); ?></span>
              <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <div class="cs-portfolio-actions">
              <a href="<?php echo esc_url($p_url); ?>" class="cs-portfolio-btn">
                Discuss Similar Architecture <i class="fa-solid fa-arrow-right"></i>
              </a>
              <?php if (!empty($p_live)): 
                $live_btn_label = !empty($p_live_text) ? $p_live_text : ((strpos($p_live, 'chadsia.com/portfolio') !== false) ? 'Explore Portfolio' : 'View Live Demo');
              ?>
                <a href="<?php echo esc_url($p_live); ?>" class="cs-portfolio-live-link" target="_blank" rel="noopener noreferrer">
                  <span><?php echo esc_html($live_btn_label); ?></span> <i class="fa-solid fa-arrow-up-right-from-square"></i>
                </a>
              <?php endif; ?>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <?php if ($show_footer): ?>
    <div class="cs-portfolio-cta-footer">
      <p><?php echo esc_html($footer_text); ?></p>
      <a href="<?php echo esc_url($view_all_url); ?>" class="cs-portfolio-view-all-btn">
        <?php echo esc_html($view_all_text); ?> <i class="fa-solid fa-arrow-right"></i>
      </a>
    </div>
    <?php endif; ?>
  </div>
</section>
