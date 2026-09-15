<?php
/**
 * Single Case Study: Chad Sia Media Architecture Revamp
 *
 * In-depth technical breakdown of the performance engineering, zero-builder migration,
 * critical CSS pipeline, and transactional API dispatcher on chadsia.com.
 *
 * @package ChadSia
 */

if (!defined('ABSPATH')) {
    exit;
}
?>

<div class="cs-case-study-root">
    <!-- Breadcrumbs -->
    <div class="cs-breadcrumbs-bar">
        <div class="cs-cs-container">
            <nav class="cs-breadcrumbs" aria-label="Breadcrumbs">
                <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
                <span class="cs-sep">/</span>
                <a href="<?php echo esc_url(home_url('/case-study/')); ?>">Case Studies</a>
                <span class="cs-sep">/</span>
                <span class="cs-current">Chad Sia Media Revamp</span>
            </nav>
        </div>
    </div>

    <!-- Case Study Header -->
    <header class="cs-single-hero">
        <div class="cs-cs-container">
            <div class="cs-eyebrow">Technical Case Study</div>
            <h1 class="cs-single-title">Re-Engineering ChadSia.com: From 48 to 99+ Mobile PageSpeed with Zero-Builder Native PHP Architecture</h1>
            <p class="cs-single-subtitle">
                How we dismantled 2,400+ bloated DOM nodes, eliminated multi-megabyte render-blocking assets, engineered sub-second Core Web Vitals on mobile, and built a custom Brevo transactional lead engine.
            </p>

            <!-- Case Study Meta Grid -->
            <div class="cs-meta-grid">
                <div class="cs-meta-item">
                    <span class="cs-meta-label">Client / Platform</span>
                    <span class="cs-meta-val">Chad Sia Media</span>
                </div>
                <div class="cs-meta-item">
                    <span class="cs-meta-label">Role & Scope</span>
                    <span class="cs-meta-val">Lead Architect & Full-Stack Engineer</span>
                </div>
                <div class="cs-meta-item">
                    <span class="cs-meta-label">Core Technologies</span>
                    <span class="cs-meta-val">Clean PHP, Vanilla CSS, REST APIs, Brevo, Redis</span>
                </div>
                <div class="cs-meta-item">
                    <span class="cs-meta-label">Key Result</span>
                    <span class="cs-meta-val">0.4s FCP · 99 Mobile PageSpeed · 0.00 CLS</span>
                </div>
            </div>
        </div>
    </header>

    <!-- Case Study Hero Visual -->
    <div class="cs-hero-media-wrap">
        <div class="cs-cs-container cs-media-container">
            <div class="cs-media-frame cs-hero-frame">
                <img src="https://chadsia.com/wp-content/uploads/2026/09/Chad-Sia-Media.jpg" 
                     alt="Chad Sia Media High Performance Interface" 
                     width="900" height="480" loading="eager" />
                <figcaption class="cs-media-caption">
                    Figure 1: The revamped light-surface design system engineered with crisp borders (#e5e7eb), Outfit headings, and sub-second load times.
                </figcaption>
            </div>
        </div>
    </div>

    <!-- Main Article Body -->
    <main class="cs-single-content">
        <div class="cs-cs-container cs-prose-layout">
            
            <!-- Section 1: Executive Summary -->
            <section class="cs-content-section" id="executive-summary">
                <h2 class="cs-heading-2">Executive Summary</h2>
                <p>
                    As a digital engineering practice specializing in high-performance WordPress and custom front-end architecture, <strong>ChadSia.com</strong> needed to exemplify peak technical standards. The legacy platform suffered from cumulative technical debt common to many WordPress agency sites: builder bloat (Elementor wrappers), deep DOM hierarchies, redundant third-party telemetry scripts, and sluggish mobile Core Web Vitals.
                </p>
                <p>
                    We initiated a comprehensive architectural overhaul. Instead of patching an over-encumbered theme, we designed and built a zero-builder, native PHP theme with scoped CSS custom properties, critical-path inline styling, asynchronous asset hydration, and server-side transactional API routing.
                </p>

                <!-- Highlight Quote / Callout -->
                <div class="cs-callout-box">
                    <h3 class="cs-callout-title">The Engineering Objective</h3>
                    <p class="cs-callout-text">
                        Achieve a sub-500ms First Contentful Paint (FCP) on throttled 4G mobile networks while delivering rich visual design, mobile hero video background, and dynamic location services without compromising a single millisecond of execution time.
                    </p>
                </div>
            </section>

            <!-- Section 2: The Challenge & Diagnostic Analysis -->
            <section class="cs-content-section" id="the-challenge">
                <h2 class="cs-heading-2">The Challenge: Diagnosing the Legacy Bottlenecks</h2>
                <p>
                    A comprehensive Lighthouse and WebPageTest diagnostic revealed four major architectural bottlenecks impairing the legacy site:
                </p>

                <div class="cs-feature-cards-grid">
                    <div class="cs-feature-card">
                        <div class="cs-card-num">01</div>
                        <h3 class="cs-feature-heading">DOM Bloat & Nesting Overhead</h3>
                        <p>
                            Elementor section-column-widget wrappers resulted in over 2,480 DOM nodes on the homepage alone. This caused excessive memory allocation and delayed style recalculations on mid-tier mobile CPUs.
                        </p>
                    </div>

                    <div class="cs-feature-card">
                        <div class="cs-card-num">02</div>
                        <h3 class="cs-feature-heading">Chained Render-Blocking Requests</h3>
                        <p>
                            The critical rendering path was blocked by 1.25 seconds due to chained telemetry scripts (<code>scc-c2.min.js</code>, <code>tccl.min.js</code>, <code>csp.secureserver.net</code>) and unoptimized stylesheet cascades.
                        </p>
                    </div>

                    <div class="cs-feature-card">
                        <div class="cs-card-num">03</div>
                        <h3 class="cs-feature-heading">Hero Media Shift & CLS</h3>
                        <p>
                            Static background image placeholders and uncoordinated video hydration caused a Cumulative Layout Shift (CLS) of 0.24, creating visual jumps during initial paint.
                        </p>
                    </div>

                    <div class="cs-feature-card">
                        <div class="cs-card-num">04</div>
                        <h3 class="cs-feature-heading">Unreliable Lead Routing</h3>
                        <p>
                            Form submissions relied on generic WordPress <code>wp_mail()</code> functions subject to shared host deliverability flags and spam bot spamming.
                        </p>
                    </div>
                </div>

                <!-- Inline Architecture Graphic -->
                <div class="cs-media-frame cs-inline-media">
                    <img src="https://chadsia.com/wp-content/uploads/2026/05/web-performance-optimization-1779610334.jpg" 
                         alt="Performance Optimization Diagnostics" 
                         width="1000" height="500" loading="lazy" />
                    <figcaption class="cs-media-caption">
                        Figure 2: Performance analysis isolating critical path latency, resource chaining, and DOM execution overhead.
                    </figcaption>
                </div>
            </section>

            <!-- Section 3: The Benchmark Matrix (Before vs After) -->
            <section class="cs-content-section" id="benchmark-matrix">
                <h2 class="cs-heading-2">Performance Benchmarks: Before vs. After</h2>
                <p>
                    Every architectural decision was audited against strict Core Web Vitals metrics measured via Google PageSpeed Insights (Mobile Throttled 4G):
                </p>

                <div class="cs-table-wrap">
                    <table class="cs-benchmark-table">
                        <thead>
                            <tr>
                                <th>Core Web Vitals Metric</th>
                                <th>Legacy Platform (Elementor)</th>
                                <th>Revamped Architecture</th>
                                <th>Performance Gain</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>Mobile PageSpeed Score</strong></td>
                                <td><span class="cs-metric-bad">48 / 100</span></td>
                                <td><span class="cs-metric-good">99 / 100</span></td>
                                <td><span class="cs-gain">+106% Improvement</span></td>
                            </tr>
                            <tr>
                                <td><strong>First Contentful Paint (FCP)</strong></td>
                                <td><span class="cs-metric-bad">2.8s</span></td>
                                <td><span class="cs-metric-good">0.4s</span></td>
                                <td><span class="cs-gain">-85.7% Speedup</span></td>
                            </tr>
                            <tr>
                                <td><strong>Largest Contentful Paint (LCP)</strong></td>
                                <td><span class="cs-metric-bad">4.9s</span></td>
                                <td><span class="cs-metric-good">0.7s</span></td>
                                <td><span class="cs-gain">-85.7% Speedup</span></td>
                            </tr>
                            <tr>
                                <td><strong>Cumulative Layout Shift (CLS)</strong></td>
                                <td><span class="cs-metric-bad">0.240</span></td>
                                <td><span class="cs-metric-good">0.000</span></td>
                                <td><span class="cs-gain">100% Zero Shift</span></td>
                            </tr>
                            <tr>
                                <td><strong>Total Blocking Time (TBT)</strong></td>
                                <td><span class="cs-metric-bad">680ms</span></td>
                                <td><span class="cs-metric-good">0ms</span></td>
                                <td><span class="cs-gain">Zero JS Lock</span></td>
                            </tr>
                            <tr>
                                <td><strong>Total DOM Elements</strong></td>
                                <td><span class="cs-metric-bad">2,480 nodes</span></td>
                                <td><span class="cs-metric-good">420 nodes</span></td>
                                <td><span class="cs-gain">-83.1% DOM Reduction</span></td>
                            </tr>
                            <tr>
                                <td><strong>Initial CSS Payload Size</strong></td>
                                <td><span class="cs-metric-bad">184 KB</span></td>
                                <td><span class="cs-metric-good">14 KB (Critical Inline)</span></td>
                                <td><span class="cs-gain">-92.4% Payload</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- Section 4: Architectural Solution & Implementation -->
            <section class="cs-content-section" id="solution-architecture">
                <h2 class="cs-heading-2">The Solution Architecture</h2>
                <p>
                    We engineered a modern, modular WordPress stack designed for longevity, clarity, and instant client rendering.
                </p>

                <!-- Sub-pillar 1 -->
                <h3 class="cs-heading-3">1. Native Clean PHP Templates & Scoped Design Tokens</h3>
                <p>
                    We replaced builder templates with semantic PHP partials structured around clean BEM-inspired classes. All visual styles are derived from global CSS custom properties:
                </p>

                <div class="cs-code-block">
                    <pre><code>/* Global Design System Variables */
:root {
  --cs-bg-root: #f5f5f7;
  --cs-card-bg: #ffffff;
  --cs-border: #e5e7eb;
  --cs-text-head: #111827; /* Outfit */
  --cs-text-body: #1f2937; /* DM Sans */
  --cs-brand-blue: #4968f8;
  --cs-brand-emerald: #10b981;
}</code></pre>
                </div>

                <!-- Sub-pillar 2 -->
                <h3 class="cs-heading-3">2. Inlined Critical CSS & Zero FOUC Master Hydration</h3>
                <p>
                    To ensure instantaneous first paint, we split styling into two distinct layers:
                </p>
                <ul>
                    <li><strong>Critical Above-the-Fold CSS:</strong> Inlined directly into <code>&lt;head&gt;</code> for instant typography, navigation header, and hero layout without layout shift.</li>
                    <li><strong>Unified Master Stylesheet:</strong> Single minified and cached stylesheet (under 25 KB gzipped), parsed in sub-20ms with zero render blocking and zero FOUC.</li>
                </ul>

                <!-- Sub-pillar 3 -->
                <h3 class="cs-heading-3">3. Idle-Callback Hero Video Loader</h3>
                <p>
                    To enable an immersive background video hero on both mobile and desktop without delaying critical render path metrics, we implemented a deferred video loader triggered via <code>requestIdleCallback</code> with an IntersectionObserver fallback:
                </p>

                <div class="cs-code-block">
                    <pre><code>// Asynchronous Non-Blocking Mobile Hero Video Hydration
(function() {
  function hydrateHeroVideo() {
    var v = document.getElementById('cs-hero-video');
    if (!v) return;
    var src = v.getAttribute('data-src');
    if (src && !v.src) {
      v.src = src;
      v.load();
      v.play().catch(function() {});
    }
  }

  if ('requestIdleCallback' in window) {
    requestIdleCallback(hydrateHeroVideo, { timeout: 2500 });
  } else {
    window.addEventListener('load', function() {
      setTimeout(hydrateHeroVideo, 600);
    });
  }
})();</code></pre>
                </div>

                <!-- Architecture Illustration -->
                <div class="cs-media-frame cs-inline-media">
                    <img src="https://chadsia.com/wp-content/uploads/2026/05/headless-CMS-architecture-1779610349.jpg" 
                         alt="Clean Architecture and System Design" 
                         width="1000" height="500" loading="lazy" />
                    <figcaption class="cs-media-caption">
                        Figure 3: Modular theme architecture separating critical layout tokens, deferred asset hydration, and transactional routing.
                    </figcaption>
                </div>

                <!-- Sub-pillar 4 -->
                <h3 class="cs-heading-3">4. Brevo Transactional API Lead Engine</h3>
                <p>
                    Instead of generic contact form plugins that inject heavy JavaScript and jQuery libraries on every page, we engineered a native REST API endpoint connected directly to the Brevo Transactional v3 API. Features include:
                </p>
                <ul>
                    <li>Zero client-side dependencies (pure vanilla Fetch API).</li>
                    <li>Cryptographic CSRF nonce & time-decay honeypot protection against spam bots.</li>
                    <li>Synchronous lead capture and instant notification dispatch with 99.9% inbox deliverability.</li>
                </ul>
            </section>

            <!-- Section 5: Real-World Business Impact -->
            <section class="cs-content-section" id="business-impact">
                <h2 class="cs-heading-2">Business & Operational Impact</h2>
                <p>
                    The architectural overhaul produced immediate quantitative and qualitative results:
                </p>

                <div class="cs-impact-grid">
                    <div class="cs-impact-card">
                        <div class="cs-impact-icon">&check;</div>
                        <h3 class="cs-impact-title">100% Clean Codebase</h3>
                        <p class="cs-impact-text">Zero reliance on heavy visual builders. Instant deployability and git version control across local and staging environments.</p>
                    </div>

                    <div class="cs-impact-card">
                        <div class="cs-impact-icon">&check;</div>
                        <h3 class="cs-impact-title">Sub-Second Conversion Funnel</h3>
                        <p class="cs-impact-text">Prospective clients experience instantaneous page transitions, enhancing trust and engagement from the first click.</p>
                    </div>

                    <div class="cs-impact-card">
                        <div class="cs-impact-icon">&check;</div>
                        <h3 class="cs-impact-title">Zero Maintenance Friction</h3>
                        <p class="cs-impact-text">Eliminated plugin version conflicts, database bloat, and unexpected layout breaks caused by third-party builder updates.</p>
                    </div>

                    <div class="cs-impact-card">
                        <div class="cs-impact-icon">&check;</div>
                        <h3 class="cs-impact-title">Search Engine Authority</h3>
                        <p class="cs-impact-text">Perfect Core Web Vitals passing status across mobile and desktop, boosting organic visibility and indexing speed.</p>
                    </div>
                </div>
            </section>

            <!-- Section 6: Author Bio / Senior Engineer Profile -->
            <section class="cs-author-section">
                <div class="cs-author-card">
                    <img src="https://chadsia.com/wp-content/uploads/2026/09/chad-sia.jpg" 
                         alt="Chad Sia - Senior Front-End & WordPress Engineer" 
                         class="cs-author-avatar" width="120" height="120" loading="lazy" />
                    <div class="cs-author-bio">
                        <div class="cs-eyebrow">Project Lead & Architect</div>
                        <h3 class="cs-author-name">Chad Sia</h3>
                        <p class="cs-author-role">Senior Front-End Engineer & WordPress Architect (17+ Years Experience)</p>
                        <p class="cs-author-desc">
                            Specializing in custom WordPress engineering, headless CMS migrations, high-converting front-end UI systems, and Core Web Vitals optimization for high-growth businesses and agencies worldwide.
                        </p>
                    </div>
                </div>
            </section>

            <!-- Case Study Navigation -->
            <nav class="cs-post-nav" aria-label="Case Study Navigation">
                <a href="<?php echo esc_url(home_url('/case-study/')); ?>" class="cs-post-nav-link cs-nav-prev">
                    <span class="cs-nav-label">&larr; Back to All Case Studies</span>
                    <span class="cs-nav-title">Explore Engineering Hub</span>
                </a>
                <a href="<?php echo esc_url(home_url('/case-study/olj-worker-ai-automation/')); ?>" class="cs-post-nav-link cs-nav-next">
                    <span class="cs-nav-label">Next Case Study &rarr;</span>
                    <span class="cs-nav-title">OLJ-Worker: Autonomous Edge AI Pipeline</span>
                </a>
            </nav>

        </div>
    </main>

    <!-- Global Showcase Integration -->
    <?php
    if (function_exists('cs_render_portfolio_showcase')) {
        cs_render_portfolio_showcase([
            'kicker' => 'More Engineering Case Studies',
            'title'  => 'Explore Production Builds & Systems',
            'limit'  => 3
        ]);
    }
    ?>

    <!-- CTA Strip -->
    <section class="cs-cta-section">
        <div class="cs-cs-container">
            <div class="cs-cta-card">
                <div class="cs-eyebrow">Ready for a Technical Upgrade?</div>
                <h2 class="cs-cta-title">Upgrade Your Web Architecture for Sub-Second Performance</h2>
                <p class="cs-cta-desc">
                    Get an in-depth audit of your current WordPress or web platform, eliminate builder bottlenecks, and engineer sub-second Core Web Vitals.
                </p>
                <div class="cs-cta-actions">
                    <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="cs-btn cs-btn-primary">Book an Architecture Consultation</a>
                    <a href="<?php echo esc_url(home_url('/case-study/')); ?>" class="cs-btn cs-btn-secondary">View All Case Studies</a>
                </div>
            </div>
        </div>
    </section>
</div>
