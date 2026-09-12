<?php
/**
 * Chad Sia Media - Interactive Client Discovery & Project Questionnaire
 * Multi-step, high-converting project intake workflow
 * Destination Email: hello@chadsia.com
 */

if (!defined('ABSPATH')) {
    exit;
}

$nonce = wp_create_nonce('cs_discovery_nonce');
$ajax_url = admin_url('admin-ajax.php');
?>

<!-- FontAwesome 6 Free CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<style id="cs-discovery-styles">
@import url('https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,400..700;1,9..40,400..700&family=Outfit:wght@500;600;700;800&display=swap');

.cs-disc-wrapper {
  --cs-bg: #f5f5f7;
  --cs-bg-subtle: #f8fafc;
  --cs-border: #e5e7eb;
  --cs-border-light: #edf2f7;
  --cs-primary: #4968f8;
  --cs-primary-hover: #3553eb;
  --cs-primary-light: #eef2ff;
  --cs-primary-text: #1d4ed8;
  --cs-heading: #111827;
  --cs-heading-dark: #09090b;
  --cs-text: #1f2937;
  --cs-text-muted: #52525b;
  --cs-text-faint: #52525b;
  --cs-font: 'DM Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
  --cs-font-display: 'Outfit', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
  --cs-radius-sm: 8px;
  --cs-radius-md: 12px;
  --cs-radius-lg: 16px;
  --cs-radius-full: 9999px;
  --cs-shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.04);
  --cs-shadow-md: 0 8px 24px -4px rgba(0, 0, 0, 0.06);
  --cs-shadow-lg: 0 20px 40px -8px rgba(0, 0, 0, 0.08);
  --cs-ease: cubic-bezier(0.16, 1, 0.3, 1);

  font-family: var(--cs-font);
  background: var(--cs-bg-subtle);
  color: var(--cs-text);
  min-height: 100vh;
  padding: 40px 20px 80px;
  overflow-wrap: break-word;
}

.cs-disc-wrapper h1,
.cs-disc-wrapper h2,
.cs-disc-wrapper h3,
.cs-disc-hero h1,
.cs-disc-card h2 {
  font-family: var(--cs-font-display);
  letter-spacing: -0.02em;
  font-weight: 700;
  overflow-wrap: break-word;
}

/* Accessible Focus-Visible Navigation (WCAG 2.4.7 AA) */
.cs-disc-wrapper a:focus-visible,
.cs-disc-wrapper button:focus-visible,
.cs-disc-wrapper [type="button"]:focus-visible,
.cs-disc-wrapper [type="submit"]:focus-visible,
.cs-disc-wrapper input:focus-visible,
.cs-disc-wrapper select:focus-visible,
.cs-disc-wrapper textarea:focus-visible,
.cs-disc-wrapper .cs-select-card:focus-visible,
.cs-disc-wrapper .cs-chip:focus-visible {
  outline: 2px solid var(--cs-primary) !important;
  outline-offset: 3px !important;
  border-radius: var(--cs-radius-sm);
}

@media (prefers-reduced-motion: reduce) {
  .cs-disc-wrapper *,
  .cs-disc-wrapper *::before,
  .cs-disc-wrapper *::after {
    animation-duration: 0.01ms !important;
    animation-iteration-count: 1 !important;
    transition-duration: 0.01ms !important;
    scroll-behavior: auto !important;
  }
}  line-height: 1.6;
  -webkit-font-smoothing: antialiased;
}

.cs-disc-container {
  max-width: 860px;
  margin: 0 auto;
}

/* Header */
.cs-disc-header {
  text-align: center;
  margin-bottom: 36px;
}

.cs-badge {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  font-size: 12px;
  font-weight: 700;
  letter-spacing: normal;
  text-transform: none;
  color: var(--cs-primary);
  background: var(--cs-primary-light);
  padding: 6px 14px;
  border-radius: var(--cs-radius-full);
  margin-bottom: 16px;
}

.cs-badge-dot {
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: var(--cs-primary);
}

.cs-disc-title {
  font-size: clamp(28px, 4vw, 38px);
  font-weight: 800;
  color: var(--cs-heading);
  line-height: 1.35;
  margin: 0 0 12px;
  letter-spacing: -0.01em;
}

.cs-disc-subtitle {
  font-size: 16px;
  color: var(--cs-text-muted);
  max-width: 65ch;
  margin: 0 auto;
}

/* Progress Tracker */
.cs-disc-progress-box {
  background: #ffffff;
  border: 1px solid var(--cs-border);
  border-radius: var(--cs-radius-md);
  padding: 18px 24px;
  margin-bottom: 24px;
  box-shadow: var(--cs-shadow-sm);
}

.cs-progress-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 10px;
  font-size: 13px;
  font-weight: 700;
  color: var(--cs-heading);
}

.cs-progress-step-title {
  color: var(--cs-primary);
}

.cs-progress-bar-bg {
  width: 100%;
  height: 8px;
  background: #e2e8f0;
  border-radius: var(--cs-radius-full);
  overflow: hidden;
}

.cs-progress-bar-fill {
  height: 100%;
  width: 100%;
  background: linear-gradient(90deg, #4968f8 0%, #3553eb 100%);
  border-radius: var(--cs-radius-full);
  transform-origin: left;
  transform: scaleX(0.2);
  transition: transform 0.4s var(--cs-ease);
}

/* Questionnaire Card */
.cs-disc-card {
  background: #ffffff;
  border: 1px solid var(--cs-border);
  border-radius: var(--cs-radius-lg);
  padding: 40px;
  box-shadow: var(--cs-shadow-md);
}

/* Steps */
.cs-step-panel {
  display: none;
}
.cs-step-panel.active {
  display: block;
  animation: csStepFade 0.35s var(--cs-ease);
}

@keyframes csStepFade {
  from { opacity: 0; transform: translateY(8px); }
  to { opacity: 1; transform: translateY(0); }
}

.cs-step-heading {
  font-size: 22px;
  font-weight: 800;
  color: var(--cs-heading);
  margin: 0 0 8px;
}

.cs-step-desc {
  font-size: 15px;
  color: var(--cs-text-muted);
  margin: 0 0 28px;
}

/* Form Groups & Labels */
.cs-form-group {
  margin-bottom: 24px;
}

.cs-form-label {
  display: block;
  font-size: 14px;
  font-weight: 700;
  color: var(--cs-heading);
  margin-bottom: 8px;
}

.cs-form-label span.req {
  color: #ef4444;
  margin-left: 2px;
}

.cs-input,
.cs-textarea,
.cs-select {
  width: 100%;
  font-family: var(--cs-font);
  font-size: 15px;
  color: var(--cs-heading);
  background: #ffffff;
  border: 1.5px solid var(--cs-border);
  border-radius: var(--cs-radius-sm);
  padding: 12px 16px;
  box-sizing: border-box;
  transition: all 0.2s var(--cs-ease);
  outline: none;
}

.cs-input:focus,
.cs-textarea:focus,
.cs-select:focus {
  border-color: var(--cs-primary);
  box-shadow: 0 0 0 3px rgba(73, 104, 248, 0.15);
}

.cs-textarea {
  min-height: 100px;
  resize: vertical;
  line-height: 1.5;
}

/* Interactive Card Options (Multi-select / Single-select) */
.cs-card-grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 16px;
  margin-bottom: 24px;
}

.cs-select-card {
  background: #ffffff;
  border: 1.5px solid var(--cs-border);
  border-radius: var(--cs-radius-md);
  padding: 20px;
  cursor: pointer;
  transition: all 0.25s var(--cs-ease);
  display: flex;
  align-items: flex-start;
  gap: 14px;
  position: relative;
  user-select: none;
}

.cs-select-card:hover {
  border-color: #cbd5e1;
  background: var(--cs-bg-subtle);
  transform: translateY(-2px);
}

.cs-select-card.selected {
  border-color: var(--cs-primary);
  background: var(--cs-primary-light);
}

.cs-card-icon-box {
  width: 42px;
  height: 42px;
  border-radius: 10px;
  background: var(--cs-bg-subtle);
  color: var(--cs-heading);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 18px;
  flex-shrink: 0;
  transition: all 0.2s var(--cs-ease);
}

.cs-select-card.selected .cs-card-icon-box {
  background: var(--cs-primary);
  color: #ffffff;
}

.cs-card-info strong {
  display: block;
  font-size: 15px;
  font-weight: 700;
  color: var(--cs-heading);
  margin-bottom: 4px;
  line-height: 1.3;
}

.cs-card-info p {
  font-size: 13px;
  color: var(--cs-text-muted);
  margin: 0;
  line-height: 1.4;
}

.cs-card-check {
  position: absolute;
  top: 14px;
  right: 14px;
  width: 20px;
  height: 20px;
  border-radius: 50%;
  border: 1.5px solid var(--cs-border);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 10px;
  color: transparent;
  transition: all 0.2s;
}

.cs-select-card.selected .cs-card-check {
  background: var(--cs-primary);
  border-color: var(--cs-primary);
  color: #ffffff;
}

/* Interactive Chips */
.cs-chips-wrap {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin-bottom: 24px;
}

.cs-chip {
  background: #ffffff;
  border: 1.5px solid var(--cs-border);
  border-radius: var(--cs-radius-full);
  padding: 10px 18px;
  font-size: 14px;
  font-weight: 600;
  color: var(--cs-heading);
  cursor: pointer;
  transition: all 0.2s var(--cs-ease);
  display: inline-flex;
  align-items: center;
  gap: 8px;
  user-select: none;
}

.cs-chip:hover {
  border-color: #cbd5e1;
  background: var(--cs-bg-subtle);
}

.cs-chip.selected {
  border-color: var(--cs-primary);
  background: var(--cs-primary);
  color: #ffffff;
}

/* Radio Cards (Single select) */
.cs-radio-group {
  display: flex;
  flex-direction: column;
  gap: 12px;
  margin-bottom: 24px;
}

.cs-radio-card {
  background: #ffffff;
  border: 1.5px solid var(--cs-border);
  border-radius: var(--cs-radius-md);
  padding: 16px 20px;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: space-between;
  transition: all 0.2s var(--cs-ease);
}

.cs-radio-card:hover {
  border-color: #cbd5e1;
  background: var(--cs-bg-subtle);
}

.cs-radio-card.selected {
  border-color: var(--cs-primary);
  background: var(--cs-primary-light);
}

.cs-radio-card strong {
  font-size: 15px;
  font-weight: 700;
  color: var(--cs-heading);
}

.cs-radio-card span {
  font-size: 13px;
  color: var(--cs-text-muted);
}

/* Action Buttons */
.cs-disc-actions {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-top: 36px;
  padding-top: 24px;
  border-top: 1px solid var(--cs-border-light);
}

.cs-btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 10px;
  font-size: 15px;
  font-weight: 700;
  padding: 13px 26px;
  border-radius: var(--cs-radius-sm);
  text-decoration: none;
  transition: all 0.25s var(--cs-ease);
  cursor: pointer;
  line-height: 1;
  border: none;
  outline: none;
}

.cs-btn-primary {
  background: var(--cs-primary);
  color: #ffffff;
  box-shadow: 0 4px 14px rgba(73, 104, 248, 0.25);
}
.cs-btn-primary:hover {
  background: var(--cs-primary-hover);
  color: #ffffff;
  transform: translateY(-1px);
  box-shadow: 0 6px 18px rgba(73, 104, 248, 0.35);
}

.cs-btn-outline {
  background: #ffffff;
  color: var(--cs-heading);
  border: 1.5px solid var(--cs-border);
}
.cs-btn-outline:hover {
  background: var(--cs-bg-subtle);
  border-color: #cbd5e1;
}

.cs-btn:disabled {
  opacity: 0.5;
  cursor: not-allowed;
  transform: none !important;
}

/* Error Notice */
.cs-error-msg {
  color: #ef4444;
  font-size: 13px;
  font-weight: 600;
  margin-top: 6px;
  display: none;
}

/* Success State */
.cs-success-panel {
  display: none;
  text-align: center;
  padding: 50px 20px;
}

.cs-success-icon {
  width: 72px;
  height: 72px;
  border-radius: 50%;
  background: #ecfdf5;
  color: #10b981;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 36px;
  margin: 0 auto 24px;
}

.cs-success-title {
  font-size: 28px;
  font-weight: 800;
  color: var(--cs-heading);
  margin-bottom: 12px;
}

.cs-success-desc {
  font-size: 16px;
  color: var(--cs-text);
  max-width: 540px;
  margin: 0 auto 28px;
  line-height: 1.6;
}

/* Responsive */
@media (max-width: 768px) {
  .cs-disc-card {
    padding: 26px 20px;
  }
  .cs-card-grid {
    grid-template-columns: 1fr;
  }
  .cs-disc-actions {
    flex-direction: column-reverse;
    gap: 12px;
  }
  .cs-btn {
    width: 100%;
  }
}
</style>

<div class="cs-disc-wrapper">
  <div class="cs-disc-container">
    
    <!-- HEADER -->
    <div class="cs-disc-header">
      <div class="cs-eyebrow">Project Intake &amp; Discovery</div>
      <h1 class="cs-disc-title">Let’s Architect Your Next Digital Platform</h1>
      <p class="cs-disc-subtitle">Share your goals, technical requirements, and vision below. You will receive a direct architectural review and estimate within 24 hours.</p>
    </div>

    <!-- PROGRESS TRACKER -->
    <div class="cs-disc-progress-box" id="csProgressBox">
      <div class="cs-progress-top">
        <span id="csStepLabel">Step 1 of 5</span>
        <span class="cs-progress-step-title" id="csStepName">Project Scope &amp; Goals</span>
      </div>
      <div class="cs-progress-bar-bg">
        <div class="cs-progress-bar-fill" id="csProgressFill"></div>
      </div>
    </div>

    <!-- QUESTIONNAIRE FORM CONTAINER -->
    <div class="cs-disc-card">
      <form id="csDiscoveryForm">
        <input type="hidden" name="action" value="cs_discovery_submit">
        <input type="hidden" name="cs_nonce" value="<?php echo esc_attr($nonce); ?>">
        <!-- Honeypot anti-spam -->
        <input type="text" name="website_trap" style="display:none !important;" tabindex="-1" autocomplete="off">

        <!-- =========================================================================
             STEP 1: PROJECT SCOPE & GOALS
             ========================================================================= -->
        <div class="cs-step-panel active" data-step="1" data-step-name="Project Scope &amp; Goals">
          <h2 class="cs-step-heading">1. What type of project are we building?</h2>
          <p class="cs-step-desc">Select all capabilities that apply to your upcoming web platform:</p>

          <div class="cs-card-grid">
            <div class="cs-select-card" data-group="project_type" data-val="Custom WordPress Development">
              <div class="cs-card-icon-box"><i class="fa-brands fa-wordpress"></i></div>
              <div class="cs-card-info">
                <strong>Custom WordPress Build</strong>
                <p>Zero-bloat theme, custom Gutenberg blocks, and scalable PHP architecture.</p>
              </div>
              <div class="cs-card-check"><i class="fa-solid fa-check"></i></div>
            </div>

            <div class="cs-select-card" data-group="project_type" data-val="Website Redesign & Modernization">
              <div class="cs-card-icon-box"><i class="fa-solid fa-wand-magic-sparkles"></i></div>
              <div class="cs-card-info">
                <strong>Website Redesign &amp; UI/UX</strong>
                <p>Complete overhaul of outdated layouts into modern, high-converting interfaces.</p>
              </div>
              <div class="cs-card-check"><i class="fa-solid fa-check"></i></div>
            </div>

            <div class="cs-select-card" data-group="project_type" data-val="AI Web Development & Automation">
              <div class="cs-card-icon-box"><i class="fa-solid fa-robot"></i></div>
              <div class="cs-card-info">
                <strong>AI Web Dev &amp; Automation</strong>
                <p>Custom OpenAI chatbots, automated lead qualification, and CRM workflows.</p>
              </div>
              <div class="cs-card-check"><i class="fa-solid fa-check"></i></div>
            </div>

            <div class="cs-select-card" data-group="project_type" data-val="Speed & Core Web Vitals Optimization">
              <div class="cs-card-icon-box"><i class="fa-solid fa-gauge-high"></i></div>
              <div class="cs-card-info">
                <strong>Speed &amp; Core Web Vitals</strong>
                <p>Sub-second TTFB, 90+ PageSpeed score, and server-level caching optimization.</p>
              </div>
              <div class="cs-card-check"><i class="fa-solid fa-check"></i></div>
            </div>

            <div class="cs-select-card" data-group="project_type" data-val="High-Converting WooCommerce Store">
              <div class="cs-card-icon-box"><i class="fa-solid fa-cart-shopping"></i></div>
              <div class="cs-card-info">
                <strong>High-Converting WooCommerce</strong>
                <p>Fast product browsing, frictionless mobile checkout, and custom payment gateways.</p>
              </div>
              <div class="cs-card-check"><i class="fa-solid fa-check"></i></div>
            </div>

            <div class="cs-select-card" data-group="project_type" data-val="Landing Page & Conversion Funnel">
              <div class="cs-card-icon-box"><i class="fa-solid fa-layer-group"></i></div>
              <div class="cs-card-info">
                <strong>Landing Page / Lead Funnel</strong>
                <p>High-trust, focused conversion funnel built for paid ads and B2B client acquisition.</p>
              </div>
              <div class="cs-card-check"><i class="fa-solid fa-check"></i></div>
            </div>
          </div>

          <div class="cs-form-group">
            <label class="cs-form-label" for="primary_goal">What is the #1 goal of this new website?<span class="req">*</span></label>
            <textarea class="cs-textarea" id="primary_goal" name="primary_goal" placeholder="e.g. Generate 3x more qualified B2B inquiries, modernize brand authority, replace a slow Elementor site, or scale online sales..."></textarea>
            <div class="cs-error-msg" id="err_primary_goal">Please describe your main project goal.</div>
          </div>
        </div>

        <!-- =========================================================================
             STEP 2: BUSINESS PROFILE & INSPIRATION
             ========================================================================= -->
        <div class="cs-step-panel" data-step="2" data-step-name="Business &amp; Market Profile">
          <h2 class="cs-step-heading">2. Tell us about your business &amp; market</h2>
          <p class="cs-step-desc">Help us understand your brand identity, industry, and benchmarks:</p>

          <div class="cs-form-group">
            <label class="cs-form-label" for="company_name">Company / Brand Name<span class="req">*</span></label>
            <input type="text" class="cs-input" id="company_name" name="company_name" placeholder="e.g. Acme Tech Solutions">
            <div class="cs-error-msg" id="err_company_name">Please enter your company or brand name.</div>
          </div>

          <div class="cs-form-group">
            <label class="cs-form-label" for="current_website">Current Website URL (if any)</label>
            <input type="url" class="cs-input" id="current_website" name="current_website" placeholder="https://example.com">
          </div>

          <div class="cs-form-group">
            <label class="cs-form-label">Estimated Number of Pages:</label>
            <div class="cs-chips-wrap">
              <div class="cs-chip" data-group="page_count" data-val="1 Page (Landing Page / Funnel)"><i class="fa-solid fa-file"></i> 1 Page (Landing Page / Funnel)</div>
              <div class="cs-chip selected" data-group="page_count" data-val="2 - 5 Pages (Starter Business Site)"><i class="fa-solid fa-file-lines"></i> 2 – 5 Pages (Starter Site)</div>
              <div class="cs-chip" data-group="page_count" data-val="6 - 10 Pages (Growing Brand / Multi-Service)"><i class="fa-solid fa-file-lines"></i> 6 – 10 Pages (Growing Brand)</div>
              <div class="cs-chip" data-group="page_count" data-val="11 - 25 Pages (Comprehensive Portal / Catalog)"><i class="fa-solid fa-folder-tree"></i> 11 – 25 Pages (Portal / Catalog)</div>
              <div class="cs-chip" data-group="page_count" data-val="25+ Pages (Enterprise Architecture)"><i class="fa-solid fa-sitemap"></i> 25+ Pages (Enterprise)</div>
            </div>
          </div>

          <div class="cs-form-group">
            <label class="cs-form-label" for="target_audience">Who is your primary target audience / ideal client?</label>
            <input type="text" class="cs-input" id="target_audience" name="target_audience" placeholder="e.g. Healthcare clinic directors, enterprise SaaS buyers, D2C homeowners...">
          </div>

          <div class="cs-form-group">
            <label class="cs-form-label" for="inspiration_urls">Inspiration / Competitor Websites you admire</label>
            <textarea class="cs-textarea" id="inspiration_urls" name="inspiration_urls" placeholder="Share 1–3 websites you like (and what you like about their design, speed, or layout)..."></textarea>
          </div>
        </div>

        <!-- =========================================================================
             STEP 3: TECHNICAL FEATURES & INTEGRATIONS
             ========================================================================= -->
        <div class="cs-step-panel" data-step="3" data-step-name="Technical Features &amp; Integrations">
          <h2 class="cs-step-heading">3. Which technical features &amp; integrations do you need?</h2>
          <p class="cs-step-desc">Click any capabilities required for your platform architecture:</p>

          <div class="cs-chips-wrap">
            <div class="cs-chip" data-group="features" data-val="ACF Pro & Custom Fields"><i class="fa-solid fa-code"></i> Advanced Custom Fields (ACF Pro)</div>
            <div class="cs-chip" data-group="features" data-val="AI Chatbot / LLM Assistant"><i class="fa-solid fa-robot"></i> Custom AI Chatbot / OpenAI</div>
            <div class="cs-chip" data-group="features" data-val="CRM Integration (HubSpot/GoHighLevel)"><i class="fa-solid fa-network-wired"></i> CRM (HubSpot / GoHighLevel / Salesforce)</div>
            <div class="cs-chip" data-group="features" data-val="WooCommerce Storefront"><i class="fa-solid fa-cart-shopping"></i> WooCommerce / E-Commerce</div>
            <div class="cs-chip" data-group="features" data-val="Payment Gateways (Stripe/PayPal/Maya/GCash)"><i class="fa-solid fa-credit-card"></i> Payment Gateways (Stripe / PayPal / Local)</div>
            <div class="cs-chip" data-group="features" data-val="Multilingual Language Switcher"><i class="fa-solid fa-globe"></i> Multilingual (English / French / etc.)</div>
            <div class="cs-chip" data-group="features" data-val="Member Portal / Gated Access"><i class="fa-solid fa-lock"></i> Member Portal / Gated Access</div>
            <div class="cs-chip" data-group="features" data-val="AEO & AI Search Schema"><i class="fa-solid fa-microchip"></i> AEO &amp; AI Search Schema Graph</div>
            <div class="cs-chip" data-group="features" data-val="Online Scheduling / Booking"><i class="fa-solid fa-calendar-check"></i> Online Scheduling / Cal.com / Calendly</div>
            <div class="cs-chip" data-group="features" data-val="Interactive Quote Calculator"><i class="fa-solid fa-calculator"></i> Custom Price / Quote Calculator</div>
          </div>

          <div class="cs-form-group">
            <label class="cs-form-label" for="custom_integrations">Other Specific Software, APIs, or Tools to integrate:</label>
            <input type="text" class="cs-input" id="custom_integrations" name="custom_integrations" placeholder="e.g. Zapier, Make.com, ERP, custom REST API, Mailchimp...">
          </div>
        </div>

        <!-- =========================================================================
             STEP 4: DESIGN & CREATIVE ASSETS
             ========================================================================= -->
        <div class="cs-step-panel" data-step="4" data-step-name="Design &amp; Creative Assets">
          <h2 class="cs-step-heading">4. What is your current design readiness?</h2>
          <p class="cs-step-desc">Select the option that matches your design and asset preparation:</p>

          <div class="cs-radio-group">
            <div class="cs-radio-card" data-group="design_status" data-val="Figma / Adobe XD Designs Ready">
              <div>
                <strong>Figma / Adobe XD Ready to Code</strong>
                <p style="margin:2px 0 0; font-size:13px; color:var(--cs-text-muted);">We have finalized pixel-perfect Figma designs ready for clean HTML/PHP translation.</p>
              </div>
              <i class="fa-solid fa-circle-dot cs-radio-icon" style="color:var(--cs-border);"></i>
            </div>

            <div class="cs-radio-card selected" data-group="design_status" data-val="Need Custom UI/UX Design from Scratch">
              <div>
                <strong>Need Custom UI/UX Design from Scratch</strong>
                <p style="margin:2px 0 0; font-size:13px; color:var(--cs-text-muted);">We need Chad Sia Media to design bespoke, high-converting desktop and mobile layouts.</p>
              </div>
              <i class="fa-solid fa-circle-dot cs-radio-icon" style="color:var(--cs-primary);"></i>
            </div>

            <div class="cs-radio-card" data-group="design_status" data-val="Modernize Existing Website Layout">
              <div>
                <strong>Evolve &amp; Modernize Existing Brand Layout</strong>
                <p style="margin:2px 0 0; font-size:13px; color:var(--cs-text-muted);">Keep our core branding structure while elevating visual polish, typography, and speed.</p>
              </div>
              <i class="fa-solid fa-circle-dot cs-radio-icon" style="color:var(--cs-border);"></i>
            </div>
          </div>

          <div class="cs-form-group">
            <label class="cs-form-label">Available Content &amp; Brand Assets (Select all ready):</label>
            <div class="cs-chips-wrap">
              <div class="cs-chip" data-group="assets_ready" data-val="Vector Logo & Brand Guide"><i class="fa-solid fa-circle-check"></i> Vector Logo &amp; Brand Colors</div>
              <div class="cs-chip" data-group="assets_ready" data-val="Copywriting / Text Ready"><i class="fa-solid fa-circle-check"></i> Written Copy / Page Content Ready</div>
              <div class="cs-chip" data-group="assets_ready" data-val="High-Res Photography & Video"><i class="fa-solid fa-circle-check"></i> High-Res Photography / Media</div>
              <div class="cs-chip" data-group="assets_ready" data-val="Need Assistance with Copy & Media"><i class="fa-solid fa-pen-nib"></i> Need Help with Copy / Assets</div>
            </div>
          </div>
        </div>

        <!-- =========================================================================
             STEP 5: TIMELINE, BUDGET & CONTACT INFO
             ========================================================================= -->
        <div class="cs-step-panel" data-step="5" data-step-name="Timeline &amp; Contact Details">
          <h2 class="cs-step-heading">5. Timeline, Investment &amp; Direct Contact</h2>
          <p class="cs-step-desc">Final details so we can prepare your project architecture and estimate:</p>

          <div class="cs-form-group">
            <label class="cs-form-label">Target Launch Timeline:</label>
            <div class="cs-chips-wrap">
              <div class="cs-chip selected" data-group="timeline" data-val="1 - 2 Months (Standard)"><i class="fa-regular fa-clock"></i> 1 – 2 Months (Standard)</div>
              <div class="cs-chip" data-group="timeline" data-val="Urgent (< 4 Weeks)"><i class="fa-solid fa-bolt"></i> Urgent (&lt; 4 Weeks)</div>
              <div class="cs-chip" data-group="timeline" data-val="2 - 3 Months"><i class="fa-regular fa-calendar"></i> 2 – 3 Months</div>
              <div class="cs-chip" data-group="timeline" data-val="Flexible / Planning Phase"><i class="fa-solid fa-hourglass-half"></i> Flexible / Planning Phase</div>
            </div>
          </div>

          <div class="cs-form-group">
            <label class="cs-form-label">Estimated Project Investment Range (USD):</label>
            <div class="cs-chips-wrap">
              <div class="cs-chip selected" data-group="budget" data-val="$800 - $1,500 USD">$800 – $1,500 USD</div>
              <div class="cs-chip" data-group="budget" data-val="$1,500 - $3,000 USD">$1,500 – $3,000 USD</div>
              <div class="cs-chip" data-group="budget" data-val="$3,000 - $6,000 USD">$3,000 – $6,000 USD</div>
              <div class="cs-chip" data-group="budget" data-val="$6,000 - $10,000 USD">$6,000 – $10,000 USD</div>
              <div class="cs-chip" data-group="budget" data-val="$10,000+ USD Enterprise">$10,000+ USD Enterprise</div>
            </div>
          </div>

          <div style="display:grid; grid-template-columns: 1fr 1fr; gap:16px;">
            <div class="cs-form-group">
              <label class="cs-form-label" for="client_name">Your Full Name<span class="req">*</span></label>
              <input type="text" class="cs-input" id="client_name" name="client_name" placeholder="Chad Sia">
              <div class="cs-error-msg" id="err_client_name">Please enter your name.</div>
            </div>

            <div class="cs-form-group">
              <label class="cs-form-label" for="client_email">Work Email Address<span class="req">*</span></label>
              <input type="email" class="cs-input" id="client_email" name="client_email" placeholder="hello@yourcompany.com">
              <div class="cs-error-msg" id="err_client_email">Please enter a valid work email.</div>
            </div>
          </div>

          <div style="display:grid; grid-template-columns: 1fr 1fr; gap:16px;">
            <div class="cs-form-group">
              <label class="cs-form-label" for="client_phone">Phone / WhatsApp (with country code)<span class="req">*</span></label>
              <input type="tel" class="cs-input" id="client_phone" name="client_phone" placeholder="+1 (555) 000-0000 or +63 998...">
              <div class="cs-error-msg" id="err_client_phone">Please enter your phone or WhatsApp number.</div>
            </div>

            <div class="cs-form-group">
              <label class="cs-form-label" for="preferred_channel">Preferred Communication:</label>
              <select class="cs-select" id="preferred_channel" name="preferred_channel">
                <option value="WhatsApp">WhatsApp (Fastest)</option>
                <option value="Slack Channel">Dedicated Slack Channel</option>
                <option value="Google Meet">Google Meet Discovery Call</option>
                <option value="Email">Email Communication</option>
              </select>
            </div>
          </div>

          <div class="cs-form-group">
            <label class="cs-form-label" for="additional_notes">Any additional technical notes, questions, or specific requirements?</label>
            <textarea class="cs-textarea" id="additional_notes" name="additional_notes" placeholder="Feel free to share any specific hosting preferences, database requirements, or deadlines..."></textarea>
          </div>
        </div>

        <!-- NAVIGATION ACTIONS -->
        <div class="cs-disc-actions">
          <button type="button" class="cs-btn cs-btn-outline" id="csPrevBtn" style="visibility:hidden;">
            <i class="fa-solid fa-arrow-left"></i> Previous Step
          </button>
          
          <button type="button" class="cs-btn cs-btn-primary" id="csNextBtn">
            Next Step <i class="fa-solid fa-arrow-right"></i>
          </button>
        </div>
      </form>

      <!-- SUCCESS CONFIRMATION PANEL -->
      <div class="cs-success-panel" id="csSuccessPanel">
        <div class="cs-success-icon"><i class="fa-solid fa-circle-check"></i></div>
        <h2 class="cs-success-title">Discovery Brief Received!</h2>
        <p class="cs-success-desc">Thank you for submitting your project requirements. Chad will personally review your architecture and respond to <strong id="successEmailDisplay">your email</strong> within 24 hours with an actionable roadmap.</p>
        <a href="<?php echo esc_url(home_url('/')); ?>" class="cs-btn cs-btn-primary">
          <i class="fa-solid fa-house"></i> Return to Homepage
        </a>
      </div>
    </div>

  </div>
</div>

<script id="cs-discovery-script">
(function() {
  let currentStep = 1;
  const totalSteps = 5;

  const form = document.getElementById('csDiscoveryForm');
  const panels = document.querySelectorAll('.cs-step-panel');
  const prevBtn = document.getElementById('csPrevBtn');
  const nextBtn = document.getElementById('csNextBtn');
  const progressFill = document.getElementById('csProgressFill');
  const stepLabel = document.getElementById('csStepLabel');
  const stepName = document.getElementById('csStepName');
  const progressBox = document.getElementById('csProgressBox');
  const successPanel = document.getElementById('csSuccessPanel');
  const successEmailDisplay = document.getElementById('successEmailDisplay');

  // Multi-select Cards Handler
  document.querySelectorAll('.cs-select-card').forEach(card => {
    card.addEventListener('click', function() {
      this.classList.toggle('selected');
      saveProgress();
    });
  });

  // Chips Multi-select / Single-select Handler
  document.querySelectorAll('.cs-chip').forEach(chip => {
    chip.addEventListener('click', function() {
      const group = this.dataset.group;
      if (group === 'timeline' || group === 'budget') {
        document.querySelectorAll(`.cs-chip[data-group="${group}"]`).forEach(c => c.classList.remove('selected'));
        this.classList.add('selected');
      } else {
        this.classList.toggle('selected');
      }
      saveProgress();
    });
  });

  // Radio Cards (Single Select) Handler
  document.querySelectorAll('.cs-radio-card').forEach(radio => {
    radio.addEventListener('click', function() {
      const group = this.dataset.group;
      document.querySelectorAll(`.cs-radio-card[data-group="${group}"]`).forEach(r => {
        r.classList.remove('selected');
        const icon = r.querySelector('.cs-radio-icon');
        if (icon) icon.style.color = 'var(--cs-border)';
      });
      this.classList.add('selected');
      const icon = this.querySelector('.cs-radio-icon');
      if (icon) icon.style.color = 'var(--cs-primary)';
      saveProgress();
    });
  });

  function updateStepUI() {
    panels.forEach(p => {
      p.classList.remove('active');
      if (parseInt(p.dataset.step) === currentStep) {
        p.classList.add('active');
        stepName.innerHTML = p.dataset.stepName;
      }
    });

    stepLabel.textContent = `Step ${currentStep} of ${totalSteps}`;
    progressFill.style.transform = `scaleX(${currentStep / totalSteps})`;

    prevBtn.style.visibility = currentStep > 1 ? 'visible' : 'hidden';
    if (currentStep === totalSteps) {
      nextBtn.innerHTML = 'Submit Project Brief <i class="fa-solid fa-paper-plane"></i>';
    } else {
      nextBtn.innerHTML = 'Next Step <i class="fa-solid fa-arrow-right"></i>';
    }

    window.scrollTo({ top: progressBox.offsetTop - 30, behavior: 'smooth' });
  }

  function validateCurrentStep() {
    let isValid = true;
    // Clear existing error messages
    document.querySelectorAll('.cs-error-msg').forEach(e => e.style.display = 'none');

    if (currentStep === 1) {
      const goal = document.getElementById('primary_goal').value.trim();
      if (!goal) {
        document.getElementById('err_primary_goal').style.display = 'block';
        isValid = false;
      }
    } else if (currentStep === 2) {
      const cname = document.getElementById('company_name').value.trim();
      if (!cname) {
        document.getElementById('err_company_name').style.display = 'block';
        isValid = false;
      }
    } else if (currentStep === 5) {
      const name = document.getElementById('client_name').value.trim();
      const email = document.getElementById('client_email').value.trim();
      const phone = document.getElementById('client_phone').value.trim();

      if (!name) {
        document.getElementById('err_client_name').style.display = 'block';
        isValid = false;
      }
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!email || !emailRegex.test(email)) {
        document.getElementById('err_client_email').style.display = 'block';
        isValid = false;
      }
      if (!phone) {
        document.getElementById('err_client_phone').style.display = 'block';
        isValid = false;
      }
    }

    return isValid;
  }

  nextBtn.addEventListener('click', function() {
    if (!validateCurrentStep()) return;

    if (currentStep < totalSteps) {
      currentStep++;
      updateStepUI();
      saveProgress();
    } else {
      submitDiscoveryForm();
    }
  });

  prevBtn.addEventListener('click', function() {
    if (currentStep > 1) {
      currentStep--;
      updateStepUI();
    }
  });

  function collectFormData() {
    const selectedTypes = Array.from(document.querySelectorAll('.cs-select-card[data-group="project_type"].selected')).map(c => c.dataset.val);
    const pageCount = document.querySelector('.cs-chip[data-group="page_count"].selected')?.dataset.val || '2 - 5 Pages (Starter Business Site)';
    const selectedFeatures = Array.from(document.querySelectorAll('.cs-chip[data-group="features"].selected')).map(c => c.dataset.val);
    const designStatus = document.querySelector('.cs-radio-card[data-group="design_status"].selected')?.dataset.val || 'Need Custom UI/UX Design';
    const assetsReady = Array.from(document.querySelectorAll('.cs-chip[data-group="assets_ready"].selected')).map(c => c.dataset.val);
    const timeline = document.querySelector('.cs-chip[data-group="timeline"].selected')?.dataset.val || '1 - 2 Months';
    const budget = document.querySelector('.cs-chip[data-group="budget"].selected')?.dataset.val || '$800 - $1,500 USD';

    return {
      action: 'cs_discovery_submit',
      cs_nonce: '<?php echo esc_js($nonce); ?>',
      website_trap: form.querySelector('input[name="website_trap"]').value,
      project_types: selectedTypes,
      primary_goal: document.getElementById('primary_goal').value.trim(),
      company_name: document.getElementById('company_name').value.trim(),
      current_website: document.getElementById('current_website').value.trim(),
      page_count: pageCount,
      target_audience: document.getElementById('target_audience').value.trim(),
      inspiration_urls: document.getElementById('inspiration_urls').value.trim(),
      features: selectedFeatures,
      custom_integrations: document.getElementById('custom_integrations').value.trim(),
      design_status: designStatus,
      assets_ready: assetsReady,
      timeline: timeline,
      budget: budget,
      client_name: document.getElementById('client_name').value.trim(),
      client_email: document.getElementById('client_email').value.trim(),
      client_phone: document.getElementById('client_phone').value.trim(),
      preferred_channel: document.getElementById('preferred_channel').value,
      additional_notes: document.getElementById('additional_notes').value.trim()
    };
  }

  function submitDiscoveryForm() {
    const payload = collectFormData();
    nextBtn.disabled = true;
    nextBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Submitting Brief...';

    fetch('<?php echo esc_url($ajax_url); ?>', {
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: new URLSearchParams(payload)
    })
    .then(r => r.json())
    .then(data => {
      if (data.success) {
        localStorage.removeItem('cs_discovery_saved');
        form.style.display = 'none';
        progressBox.style.display = 'none';
        successEmailDisplay.textContent = payload.client_email;
        successPanel.style.display = 'block';
        window.scrollTo({ top: successPanel.offsetTop - 50, behavior: 'smooth' });
      } else {
        alert(data.data?.message || 'Error submitting brief. Please try again.');
        nextBtn.disabled = false;
        nextBtn.innerHTML = 'Submit Project Brief <i class="fa-solid fa-paper-plane"></i>';
      }
    })
    .catch(err => {
      console.error(err);
      alert('An unexpected network error occurred. Please reach out to hello@chadsia.com directly.');
      nextBtn.disabled = false;
      nextBtn.innerHTML = 'Submit Project Brief <i class="fa-solid fa-paper-plane"></i>';
    });
  }

  function saveProgress() {
    try {
      const data = collectFormData();
      data._step = currentStep;
      localStorage.setItem('cs_discovery_saved', JSON.stringify(data));
    } catch(e) {}
  }

  function restoreProgress() {
    try {
      const raw = localStorage.getItem('cs_discovery_saved');
      if (!raw) return;
      const data = JSON.parse(raw);
      if (data.primary_goal) document.getElementById('primary_goal').value = data.primary_goal;
      if (data.company_name) document.getElementById('company_name').value = data.company_name;
      if (data.current_website) document.getElementById('current_website').value = data.current_website;
      if (data.target_audience) document.getElementById('target_audience').value = data.target_audience;
      if (data.inspiration_urls) document.getElementById('inspiration_urls').value = data.inspiration_urls;
      if (data.custom_integrations) document.getElementById('custom_integrations').value = data.custom_integrations;
      if (data.client_name) document.getElementById('client_name').value = data.client_name;
      if (data.client_email) document.getElementById('client_email').value = data.client_email;
      if (data.client_phone) document.getElementById('client_phone').value = data.client_phone;
      if (data.additional_notes) document.getElementById('additional_notes').value = data.additional_notes;

      if (Array.isArray(data.project_types)) {
        document.querySelectorAll('.cs-select-card[data-group="project_type"]').forEach(c => {
          c.classList.toggle('selected', data.project_types.includes(c.dataset.val));
        });
      }
      if (data.page_count) {
        document.querySelectorAll('.cs-chip[data-group="page_count"]').forEach(c => {
          c.classList.toggle('selected', c.dataset.val === data.page_count);
        });
      }
      if (Array.isArray(data.features)) {
        document.querySelectorAll('.cs-chip[data-group="features"]').forEach(c => {
          c.classList.toggle('selected', data.features.includes(c.dataset.val));
        });
      }
      if (data.budget) {
        document.querySelectorAll('.cs-chip[data-group="budget"]').forEach(c => {
          c.classList.toggle('selected', c.dataset.val === data.budget);
        });
      }
    } catch(e) {}
  }

  restoreProgress();
})();
</script>
