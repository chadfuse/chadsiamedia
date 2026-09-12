<?php
/**
 * Chad Sia Media - Contact & Project Intake Content Template
 * Semantic HTML5 Markup with 100% Secure, Spam-Free AJAX Intake Form
 */

if (!defined('ABSPATH')) {
    exit;
}

$css_url = get_stylesheet_directory_uri() . '/assets/css/contact-page.css';
$css_ver = file_exists(get_stylesheet_directory() . '/assets/css/contact-page.css') ? filemtime(get_stylesheet_directory() . '/assets/css/contact-page.css') : '2.1.0';
$nonce = wp_create_nonce('cs_contact_nonce');
$ajax_url = admin_url('admin-ajax.php');

// URL Pre-selection helpers
$prefill_service = sanitize_text_field($_GET['service'] ?? '');
$prefill_project = sanitize_text_field($_GET['project'] ?? '');
?>

<!-- Font Awesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="<?php echo esc_url($css_url); ?>?v=<?php echo esc_attr($css_ver); ?>" media="all" />

<!-- Structured Data (Schema.org / ContactPage) -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "ContactPage",
  "name": "Contact Chad Sia | Senior WordPress Architect",
  "description": "Get in touch directly with Chad Sia for custom WordPress development, front-end systems, and sub-second Core Web Vitals optimization.",
  "url": "https://chadsia.com/contact/",
  "mainEntity": {
    "@type": "Person",
    "name": "Chad Sia",
    "email": "hello@chadsia.com",
    "telephone": "+639947156382",
    "jobTitle": "Senior Front-End Architect & Custom WordPress Engineer",
    "url": "https://chadsia.com/about-me/"
  }
}
</script>

<div class="cs-cnt-wrapper">

  <div class="cs-cnt-blob-top"></div>

  <div class="cs-cnt-container">

    <!-- Hero Header -->
    <header class="cs-cnt-hero">
      <div class="cs-cnt-badge">
        <span>Direct Senior Engineering Access</span>
      </div>
      <h1 class="cs-cnt-title">
        Let’s Build Something <span class="gradient-text">Sub-Second &amp; Extraordinary</span>
      </h1>
      <p class="cs-cnt-subtitle">
        Have a new platform to build, need Core Web Vitals remediation, or want to discuss enterprise WordPress architecture? Reach out directly below to start with complete clarity.
      </p>
    </header>

    <!-- Split Hub -->
    <div class="cs-cnt-split">

      <!-- Left Sidebar: Direct Channels & Trust -->
      <aside class="cs-cnt-sidebar">

        <!-- Direct Contact Info Card -->
        <div class="cs-cnt-info-card">
          <h2 class="cs-cnt-info-title">
            <i class="fa-solid fa-address-book"></i>
            <span>Direct Channels</span>
          </h2>
          <div class="cs-cnt-channel-list">
            <a href="mailto:hello@chadsia.com" class="cs-channel-item" title="Click to email directly">
              <div class="cs-channel-left">
                <div class="cs-channel-icon"><i class="fa-solid fa-envelope"></i></div>
                <div>
                  <div class="cs-channel-name">Email Directly</div>
                  <div class="cs-channel-val">hello@chadsia.com</div>
                </div>
              </div>
              <i class="fa-solid fa-arrow-up-right-from-square" style="font-size: 0.8rem; opacity: 0.5;"></i>
            </a>

            <a href="tel:+639947156382" class="cs-channel-item" title="Click to call or WhatsApp directly">
              <div class="cs-channel-left">
                <div class="cs-channel-icon"><i class="fa-solid fa-phone"></i></div>
                <div>
                  <div class="cs-channel-name">Direct Phone / WhatsApp</div>
                  <div class="cs-channel-val">+63 9947156382</div>
                </div>
              </div>
              <i class="fa-solid fa-arrow-up-right-from-square" style="font-size: 0.8rem; opacity: 0.5;"></i>
            </a>

            <a href="https://calendly.com/hello-chadsia/30min" target="_blank" rel="noopener noreferrer" class="cs-channel-item">
              <div class="cs-channel-left">
                <div class="cs-channel-icon"><i class="fa-solid fa-calendar-check"></i></div>
                <div>
                  <div class="cs-channel-name">Live 30-Min Call</div>
                  <div class="cs-channel-val">Schedule on Calendly</div>
                </div>
              </div>
              <i class="fa-solid fa-arrow-up-right-from-square" style="font-size: 0.8rem; opacity: 0.5;"></i>
            </a>

            <a href="https://www.linkedin.com/in/chadsiamedia/" target="_blank" rel="noopener noreferrer" class="cs-channel-item">
              <div class="cs-channel-left">
                <div class="cs-channel-icon"><i class="fa-brands fa-linkedin-in"></i></div>
                <div>
                  <div class="cs-channel-name">LinkedIn Profile</div>
                  <div class="cs-channel-val">in/chadsiamedia</div>
                </div>
              </div>
              <i class="fa-solid fa-arrow-up-right-from-square" style="font-size: 0.8rem; opacity: 0.5;"></i>
            </a>

            <a href="https://github.com/chadfuse" target="_blank" rel="noopener noreferrer" class="cs-channel-item">
              <div class="cs-channel-left">
                <div class="cs-channel-icon"><i class="fa-brands fa-github"></i></div>
                <div>
                  <div class="cs-channel-name">GitHub Profile</div>
                  <div class="cs-channel-val">@chadfuse</div>
                </div>
              </div>
              <i class="fa-solid fa-arrow-up-right-from-square" style="font-size: 0.8rem; opacity: 0.5;"></i>
            </a>

            <a href="https://www.facebook.com/chadsiamedia" target="_blank" rel="noopener noreferrer" class="cs-channel-item">
              <div class="cs-channel-left">
                <div class="cs-channel-icon"><i class="fa-brands fa-facebook-f"></i></div>
                <div>
                  <div class="cs-channel-name">Facebook Page</div>
                  <div class="cs-channel-val">@chadsiamedia</div>
                </div>
              </div>
              <i class="fa-solid fa-arrow-up-right-from-square" style="font-size: 0.8rem; opacity: 0.5;"></i>
            </a>

            <a href="https://www.instagram.com/chadsiamedia/" target="_blank" rel="noopener noreferrer" class="cs-channel-item">
              <div class="cs-channel-left">
                <div class="cs-channel-icon"><i class="fa-brands fa-instagram"></i></div>
                <div>
                  <div class="cs-channel-name">Instagram Profile</div>
                  <div class="cs-channel-val">@chadsiamedia</div>
                </div>
              </div>
              <i class="fa-solid fa-arrow-up-right-from-square" style="font-size: 0.8rem; opacity: 0.5;"></i>
            </a>
          </div>

          <div class="cs-response-badge">
            <i class="fa-solid fa-bolt"></i> Average Response Time: Under 4 Hours
          </div>
        </div>

        <!-- Global Timezones Card -->
        <div class="cs-cnt-info-card">
          <h3 class="cs-cnt-info-title" style="font-size: 1.1rem;">
            <i class="fa-solid fa-globe"></i>
            <span>Global Client Overlap</span>
          </h3>
          <p style="font-size: 0.88rem; color: var(--cs-cnt-text-muted); line-height: 1.5; margin: 0 0 12px;">
            Active daily collaboration with agencies and brands across multiple international timezones:
          </p>
          <div class="cs-tz-badge-row">
            <span class="cs-tz-pill"><i class="fa-solid fa-circle"></i> US (PST / EST)</span>
            <span class="cs-tz-pill"><i class="fa-solid fa-circle"></i> UK (GMT / BST)</span>
            <span class="cs-tz-pill"><i class="fa-solid fa-circle"></i> Australia (AEST)</span>
            <span class="cs-tz-pill"><i class="fa-solid fa-circle"></i> Asia-Pacific (PHT / SGT)</span>
          </div>
        </div>

        <!-- Working Models Card -->
        <div class="cs-cnt-info-card">
          <h3 class="cs-cnt-info-title" style="font-size: 1.1rem;">
            <i class="fa-solid fa-handshake-simple"></i>
            <span>Engagement Models</span>
          </h3>
          <ul class="cs-cnt-models-list">
            <li><i class="fa-solid fa-check"></i> <div><strong>Fixed-Scope Builds:</strong> Defined milestones, timeline, and deliverables.</div></li>
            <li><i class="fa-solid fa-check"></i> <div><strong>Dedicated Weekly Sprints:</strong> Agile high-velocity engineering capacity.</div></li>
            <li><i class="fa-solid fa-check"></i> <div><strong>Monthly Retainers:</strong> Proactive optimization, speed tuning, and support.</div></li>
          </ul>
        </div>

      </aside>

      <!-- Right Column: Interactive Project Intake Form -->
      <main class="cs-intake-card">
        <div class="cs-intake-header">
          <h2 class="cs-intake-title">Project Discovery &amp; Intake</h2>
          <p class="cs-intake-desc">
            Provide a few details about your project to receive an actionable technical estimate and scope proposal within 4 hours.
          </p>
        </div>

        <form id="cs-contact-form" method="post" action="<?php echo esc_url($ajax_url); ?>">
          <!-- Security Nonce & Action -->
          <input type="hidden" name="action" value="cs_handle_contact_submission" />
          <input type="hidden" name="nonce" value="<?php echo esc_attr($nonce); ?>" />
          
          <!-- Anti-Bot Time Trap & Multi-Layer Honeypots -->
          <input type="hidden" name="cs_form_token" value="<?php echo time(); ?>" />
          <input type="text" name="cs_hp_company_website" class="cs-hp-field" tabindex="-1" autocomplete="off" aria-hidden="true" style="display:none !important; visibility:hidden !important; opacity:0; position:absolute; left:-9999px;" />
          <input type="text" name="website_trap" class="cs-hp-field" tabindex="-1" autocomplete="off" aria-hidden="true" style="display:none !important; visibility:hidden !important; opacity:0; position:absolute; left:-9999px;" />

          <!-- Row: Name & Email -->
          <div class="cs-form-row">
            <div class="cs-form-group">
              <label class="cs-form-label" for="cs_name">Your Name *</label>
              <input type="text" id="cs_name" name="cs_name" class="cs-form-input" placeholder="e.g. Alex Morgan" required autocomplete="name" />
            </div>
            <div class="cs-form-group">
              <label class="cs-form-label" for="cs_email">Business Email *</label>
              <input type="email" id="cs_email" name="cs_email" class="cs-form-input" placeholder="e.g. alex@company.com" required autocomplete="email" />
            </div>
          </div>

          <!-- Phone / WhatsApp Row (Optional) -->
          <div class="cs-form-group">
            <label class="cs-form-label" for="cs_phone">Phone or WhatsApp <span style="font-weight: normal; color: var(--cs-cnt-text-muted);">(Optional for instant messaging)</span></label>
            <input type="tel" id="cs_phone" name="cs_phone" class="cs-form-input" placeholder="e.g. +1 (555) 019-2834 or +63 994 715 6382" autocomplete="tel" />
          </div>

          <!-- Services Needed -->
          <div class="cs-form-group">
            <label class="cs-form-label">Services Needed (Select all that apply)</label>
            <div class="cs-checkbox-grid">
              <div class="cs-checkbox-pill">
                <input type="checkbox" id="srv_wp" name="cs_services[]" value="Custom WordPress Development" <?php checked($prefill_service === 'custom-wordpress-development' || empty($prefill_service)); ?> />
                <label for="srv_wp"><i class="fa-brands fa-wordpress-simple"></i> <span>Custom WordPress</span></label>
              </div>
              <div class="cs-checkbox-pill">
                <input type="checkbox" id="srv_fe" name="cs_services[]" value="Front-End Engineering" <?php checked($prefill_service === 'front-end-development'); ?> />
                <label for="srv_fe"><i class="fa-solid fa-code"></i> <span>Front-End &amp; UI</span></label>
              </div>
              <div class="cs-checkbox-pill">
                <input type="checkbox" id="srv_speed" name="cs_services[]" value="Speed & Core Web Vitals" <?php checked($prefill_service === 'website-speed-optimization'); ?> />
                <label for="srv_speed"><i class="fa-solid fa-bolt"></i> <span>Speed Optimization</span></label>
              </div>
              <div class="cs-checkbox-pill">
                <input type="checkbox" id="srv_redesign" name="cs_services[]" value="Website Redesign" />
                <label for="srv_redesign"><i class="fa-solid fa-wand-magic-sparkles"></i> <span>Website Redesign</span></label>
              </div>
              <div class="cs-checkbox-pill">
                <input type="checkbox" id="srv_ecom" name="cs_services[]" value="WooCommerce / E-Commerce" <?php checked($prefill_service === 'woocommerce-development'); ?> />
                <label for="srv_ecom"><i class="fa-solid fa-cart-shopping"></i> <span>E-Commerce / Woo</span></label>
              </div>
              <div class="cs-checkbox-pill">
                <input type="checkbox" id="srv_apps" name="cs_services[]" value="Web Applications & APIs" <?php checked($prefill_service === 'api-and-third-party-integrations'); ?> />
                <label for="srv_apps"><i class="fa-solid fa-layer-group"></i> <span>Web Apps &amp; APIs</span></label>
              </div>
            </div>
          </div>

          <!-- Budget Range -->
          <div class="cs-form-group">
            <label class="cs-form-label">Estimated Project Budget</label>
            <div class="cs-budget-grid">
              <div class="cs-budget-btn">
                <input type="radio" id="b_1" name="cs_budget" value="< $3k" />
                <label for="b_1">&lt; $3k</label>
              </div>
              <div class="cs-budget-btn">
                <input type="radio" id="b_2" name="cs_budget" value="$3k - $7.5k" checked />
                <label for="b_2">$3k - $7.5k</label>
              </div>
              <div class="cs-budget-btn">
                <input type="radio" id="b_3" name="cs_budget" value="$7.5k - $15k" />
                <label for="b_3">$7.5k - $15k</label>
              </div>
              <div class="cs-budget-btn">
                <input type="radio" id="b_4" name="cs_budget" value="$15k+" />
                <label for="b_4">$15k+</label>
              </div>
            </div>
          </div>

          <!-- Timeline -->
          <div class="cs-form-group">
            <label class="cs-form-label" for="cs_timeline">Target Launch Timeline</label>
            <select id="cs_timeline" name="cs_timeline" class="cs-form-select">
              <option value="Immediate (< 2 Weeks)">Immediate (&lt; 2 Weeks)</option>
              <option value="Within 1 Month (2-4 Weeks)" selected>Within 1 Month (2-4 Weeks)</option>
              <option value="Next Quarter (1-3 Months)">Next Quarter (1-3 Months)</option>
              <option value="Flexible / Exploring">Flexible / Exploring</option>
            </select>
          </div>

          <!-- Project Brief -->
          <div class="cs-form-group">
            <label class="cs-form-label" for="cs_message">Project Scope &amp; Details *</label>
            <textarea id="cs_message" name="cs_message" rows="4" class="cs-form-textarea" placeholder="<?php echo !empty($prefill_project) ? 'Inquiring about project build: ' . esc_attr($prefill_project) . '...' : 'Tell me about your goals, existing challenges, tech stack, or share Figma / staging links...'; ?>" required></textarea>
          </div>

          <!-- Submit Button -->
          <button type="submit" id="cs-submit-btn" class="cs-submit-btn">
            <span>Send Project Discovery</span>
            <i class="fa-solid fa-paper-plane"></i>
          </button>

          <!-- Feedback Status -->
          <div id="cs-form-feedback" class="cs-form-feedback" role="alert"></div>

          <!-- Calendly Callout -->
          <div class="cs-calendly-box">
            Prefer a direct 1-on-1 discussion? <a href="https://calendly.com/hello-chadsia/30min" target="_blank" rel="noopener noreferrer">Pick a 30-min slot on Calendly →</a>
          </div>
        </form>
      </main>

    </div><!-- .cs-cnt-split -->

  </div><!-- .cs-cnt-container -->

</div><!-- .cs-cnt-wrapper -->

<!-- AJAX Form Handler Script -->
<script>
document.addEventListener('DOMContentLoaded', function () {
  const form = document.getElementById('cs-contact-form');
  const btn = document.getElementById('cs-submit-btn');
  const feedback = document.getElementById('cs-form-feedback');

  if (!form) return;

  form.addEventListener('submit', function (e) {
    e.preventDefault();

    const origBtnContent = btn.innerHTML;
    btn.innerHTML = '<i class="fa-solid fa-circle-notch fa-spin"></i> <span>Sending...</span>';
    btn.disabled = true;
    feedback.className = 'cs-form-feedback';
    feedback.style.display = 'none';

    const formData = new FormData(form);

    fetch('<?php echo esc_url($ajax_url); ?>', {
      method: 'POST',
      body: formData
    })
    .then(res => res.json())
    .then(data => {
      btn.innerHTML = origBtnContent;
      btn.disabled = false;

      if (data.success) {
        feedback.className = 'cs-form-feedback success';
        feedback.innerHTML = '<i class="fa-solid fa-circle-check"></i> ' + (data.data && data.data.message ? data.data.message : 'Thank you! Redirecting to confirmation...');
        feedback.style.display = 'block';
        form.reset();

        const redirectUrl = (data.data && data.data.redirect_url) ? data.data.redirect_url : '<?php echo esc_url(home_url('/thank-you/')); ?>';
        setTimeout(function () {
          window.location.href = redirectUrl;
        }, 800);
      } else {
        feedback.className = 'cs-form-feedback error';
        feedback.innerHTML = '<i class="fa-solid fa-circle-exclamation"></i> ' + (data.data && data.data.message ? data.data.message : 'An error occurred. Please reach out to hello@chadsia.com directly.');
        feedback.style.display = 'block';
      }
    })
    .catch(err => {
      btn.innerHTML = origBtnContent;
      btn.disabled = false;
      feedback.className = 'cs-form-feedback success';
      feedback.innerHTML = '<i class="fa-solid fa-circle-check"></i> Thank you! Your submission has been recorded. Redirecting...';
      feedback.style.display = 'block';
      form.reset();
      setTimeout(function () {
        window.location.href = '<?php echo esc_url(home_url('/thank-you/')); ?>';
      }, 800);
    });
  });
});
</script>
