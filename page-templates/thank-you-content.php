<?php
/**
 * Chad Sia Media - Thank You Page Content Template
 * High-performance confirmation, actionable 3-step roadmap, Calendly priority booking & channels.
 */

if (!defined('ABSPATH')) {
    exit;
}

$css_url = get_stylesheet_directory_uri() . '/assets/css/thank-you-page.css';
$css_ver = file_exists(get_stylesheet_directory() . '/assets/css/thank-you-page.css') ? filemtime(get_stylesheet_directory() . '/assets/css/thank-you-page.css') : '1.0.0';

$client_name = sanitize_text_field($_GET['client'] ?? $_GET['cname'] ?? '');
?>

<!-- Font Awesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="<?php echo esc_url($css_url); ?>?v=<?php echo esc_attr($css_ver); ?>" media="all" />

<div class="cs-ty-wrapper">

  <div class="cs-ty-container">

    <!-- Celebration Hero -->
    <header class="cs-ty-hero">
      <div class="cs-ty-badge">
        <i class="fa-solid fa-circle-check"></i>
        <span>Inquiry Successfully Received</span>
      </div>

      <h1 class="cs-ty-title">
        <?php if (!empty($client_name)) : ?>
          Thank You, <?php echo esc_html($client_name); ?>! <span class="gradient-text">Your Project Discovery is Underway</span>
        <?php else : ?>
          Thank You! <span class="gradient-text">Your Project Discovery is Underway</span>
        <?php endif; ?>
      </h1>

      <p class="cs-ty-subtitle">
        Your brief has been delivered directly to Chad Sia (<a href="mailto:hello@chadsia.com" style="color: var(--cs-ty-primary); font-weight: 700; text-decoration: none;">hello@chadsia.com</a>). I personally review every submission and will reply within 4 hours with a scope assessment.
      </p>
    </header>

    <!-- 3-Step Clear Roadmap -->
    <section class="cs-ty-steps-card">
      <div class="cs-ty-section-head">
        <h2 class="cs-ty-section-title">What Happens Next?</h2>
        <p class="cs-ty-section-desc">Here is the exact step-by-step process for turning your brief into high-performance reality:</p>
      </div>

      <div class="cs-ty-steps-grid">
        <!-- Step 1 -->
        <div class="cs-ty-step-item">
          <div class="cs-ty-step-num">01</div>
          <h3 class="cs-ty-step-title">Technical Brief Review</h3>
          <p class="cs-ty-step-text">
            Within 4 hours, I thoroughly analyze your goals, existing technical setup, speed bottlenecks, or design assets.
          </p>
        </div>

        <!-- Step 2 -->
        <div class="cs-ty-step-item">
          <div class="cs-ty-step-num">02</div>
          <h3 class="cs-ty-step-title">Scope &amp; Architecture Proposal</h3>
          <p class="cs-ty-step-text">
            You receive a concrete breakdown covering architecture, milestone deliverables, fixed pricing, and launch timeline.
          </p>
        </div>

        <!-- Step 3 -->
        <div class="cs-ty-step-item">
          <div class="cs-ty-step-num">03</div>
          <h3 class="cs-ty-step-title">Discovery Call &amp; Sprint Kickoff</h3>
          <p class="cs-ty-step-text">
            We hold a 1-on-1 sprint planning session to align on deliverables and begin high-velocity engineering with weekly staging reviews.
          </p>
        </div>
      </div>
    </section>

    <!-- Fast-Track Calendly Banner -->
    <section class="cs-ty-calendly-card">
      <div class="cs-ty-calendly-left">
        <div class="cs-ty-calendly-pill">
          <i class="fa-solid fa-bolt"></i> Fast-Track Option
        </div>
        <h2 class="cs-ty-calendly-title">Want to Jump Straight into a Live Discussion?</h2>
        <p class="cs-ty-calendly-desc">
          If your timeline is urgent or you prefer talking through architecture live, book a direct 30-minute discovery call right now on Calendly.
        </p>
      </div>
      <a href="https://calendly.com/hello-chadsia/30min" target="_blank" rel="noopener noreferrer" class="cs-ty-calendly-btn">
        <span>Schedule 30-Min Call</span>
        <i class="fa-solid fa-arrow-right"></i>
      </a>
    </section>

    <!-- Direct Channels & Quick Actions -->
    <div class="cs-ty-subgrid">

      <!-- Direct Channels Box -->
      <div class="cs-ty-info-box">
        <h3 class="cs-ty-box-title">
          <i class="fa-solid fa-address-book" style="color: var(--cs-ty-primary);"></i>
          <span>Direct Access Channels</span>
        </h3>
        <div class="cs-ty-channels-list">
          <a href="mailto:hello@chadsia.com" class="cs-ty-channel-link">
            <i class="fa-solid fa-envelope"></i>
            <span>hello@chadsia.com</span>
          </a>
          <a href="tel:+639947156382" class="cs-ty-channel-link">
            <i class="fa-solid fa-phone"></i>
            <span>+63 9947156382</span>
          </a>
          <a href="https://www.linkedin.com/in/chadsiamedia/" target="_blank" rel="noopener noreferrer" class="cs-ty-channel-link">
            <i class="fa-brands fa-linkedin-in"></i>
            <span>LinkedIn Profile</span>
          </a>
          <a href="https://github.com/chadfuse" target="_blank" rel="noopener noreferrer" class="cs-ty-channel-link">
            <i class="fa-brands fa-github"></i>
            <span>GitHub Profile</span>
          </a>
        </div>
      </div>

      <!-- Quick Actions / Portfolio Exploration -->
      <div class="cs-ty-info-box">
        <h3 class="cs-ty-box-title">
          <i class="fa-solid fa-compass" style="color: var(--cs-ty-accent);"></i>
          <span>Explore While You Wait</span>
        </h3>
        <div class="cs-ty-actions-list">
          <a href="<?php echo esc_url(home_url('/portfolio/')); ?>" class="cs-ty-action-btn">
            <span>Explore 37+ Live Builds &amp; Funnels</span>
            <i class="fa-solid fa-arrow-right"></i>
          </a>
          <a href="<?php echo esc_url(home_url('/services/')); ?>" class="cs-ty-action-btn">
            <span>View Core Engineering Services</span>
            <i class="fa-solid fa-arrow-right"></i>
          </a>
          <a href="<?php echo esc_url(home_url('/')); ?>" class="cs-ty-action-btn">
            <span>Back to Homepage</span>
            <i class="fa-solid fa-arrow-right"></i>
          </a>
        </div>
      </div>

    </div>

  </div><!-- .cs-ty-container -->

</div><!-- .cs-ty-wrapper -->
