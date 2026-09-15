<?php
/**
 * Case Study Hub Content Template
 *
 * Provides a clean, modern hub for deep-dive engineering case studies,
 * technical transformations, Core Web Vitals optimizations, and enterprise builds.
 *
 * @package ChadSia
 */

if (!defined('ABSPATH')) {
    exit;
}
?>

<div class="cs-case-study-root">
    <!-- Hero Section -->
    <header class="cs-hub-hero">
        <div class="cs-cs-container">
            <div class="cs-eyebrow">Engineering Case Studies</div>
            <h1 class="cs-hub-title">Architecture Transformations & Technical Case Studies</h1>
            <p class="cs-hub-lead">
                Explore in-depth technical breakdowns of custom WordPress architectures, sub-second performance engineering, headless migrations, and enterprise integrations delivered with precision.
            </p>

            <!-- Stats Strip -->
            <div class="cs-metrics-strip">
                <div class="cs-metric-card">
                    <span class="cs-metric-value">0.4s</span>
                    <span class="cs-metric-label">Average First Contentful Paint</span>
                </div>
                <div class="cs-metric-card">
                    <span class="cs-metric-value">98+</span>
                    <span class="cs-metric-label">Mobile PageSpeed Score</span>
                </div>
                <div class="cs-metric-card">
                    <span class="cs-metric-value">0.00</span>
                    <span class="cs-metric-label">Cumulative Layout Shift</span>
                </div>
                <div class="cs-metric-card">
                    <span class="cs-metric-value">17+</span>
                    <span class="cs-metric-label">Years Front-End Engineering</span>
                </div>
            </div>
        </div>
    </header>

    <!-- Flagship Case Study Feature -->
    <section class="cs-flagship-section">
        <div class="cs-cs-container">
            <div class="cs-flagship-card">
                <div class="cs-flagship-media">
                    <img src="https://chadsia.com/wp-content/uploads/2026/09/Chad-Sia-Media.jpg" 
                         alt="Chad Sia Media Architecture Revamp Case Study" 
                         width="1200" height="675" loading="eager" />
                    <span class="cs-flagship-badge">Flagship Revamp</span>
                </div>
                <div class="cs-flagship-content">
                    <div class="cs-card-tags">
                        <span class="cs-tag">Architecture Revamp</span>
                        <span class="cs-tag">Performance Engineering</span>
                        <span class="cs-tag">Core Web Vitals</span>
                    </div>
                    <h2 class="cs-flagship-title">
                        <a href="<?php echo esc_url(home_url('/case-study/chadsia-media-architecture-revamp/')); ?>">
                            Chad Sia Media: Complete Engineering & Architecture Revamp
                        </a>
                    </h2>
                    <p class="cs-flagship-desc">
                        How we dismantled 2,400+ DOM nodes of legacy builder bloat, migrated to clean native PHP design tokens, implemented critical CSS, and engineered sub-second Core Web Vitals on mobile.
                    </p>

                    <div class="cs-flagship-stats">
                        <div class="cs-stat-item">
                            <span class="cs-stat-val">48 &rarr; 99</span>
                            <span class="cs-stat-name">Mobile PageSpeed</span>
                        </div>
                        <div class="cs-stat-item">
                            <span class="cs-stat-val">2.8s &rarr; 0.4s</span>
                            <span class="cs-stat-name">LCP Metric</span>
                        </div>
                        <div class="cs-stat-item">
                            <span class="cs-stat-val">-83%</span>
                            <span class="cs-stat-name">DOM Node Reduction</span>
                        </div>
                    </div>

                    <div class="cs-flagship-actions">
                        <a href="<?php echo esc_url(home_url('/case-study/chadsia-media-architecture-revamp/')); ?>" class="cs-btn cs-btn-primary">
                            Read Full Case Study &rarr;
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Case Study Grid -->
    <section class="cs-grid-section">
        <div class="cs-cs-container">
            <div class="cs-section-header">
                <div class="cs-eyebrow">Client Transformations</div>
                <h2 class="cs-section-title">Production Engineering Across Industries</h2>
                <p class="cs-section-subtitle">Real-world deployments featuring custom freight APIs, interactive solar tools, bespoke legal directories, and ultra-fast web catalogs.</p>
            </div>

            <div class="cs-hub-grid">
                <!-- Case Study 1: OLJ-Worker Edge AI Pipeline -->
                <article class="cs-grid-card">
                    <div class="cs-grid-media">
                        <img src="https://chadsia.com/wp-content/uploads/2026/05/headless-CMS-architecture-1779610349.jpg" 
                             alt="OLJ-Worker Serverless AI Automation" 
                             width="600" height="340" loading="lazy" />
                        <span class="cs-grid-badge">Serverless Edge AI</span>
                    </div>
                    <div class="cs-grid-content">
                        <div class="cs-card-tags">
                            <span class="cs-tag">Cloudflare Workers</span>
                            <span class="cs-tag">Gemini 2.5 Flash</span>
                            <span class="cs-tag">KV Caching</span>
                        </div>
                        <h3 class="cs-grid-title">
                            <a href="<?php echo esc_url(home_url('/case-study/olj-worker-ai-automation/')); ?>">
                                OLJ-Worker: Autonomous Job Intelligence & Gemini AI Proposal Engine
                            </a>
                        </h3>
                        <p class="cs-grid-excerpt">
                            Edge-native Cloudflare Worker with KV session caching, Google Gemini 2.5 fit scoring, anti-spam screening trap detection, and real-time Discord/Telegram telemetry.
                        </p>
                        <div class="cs-grid-actions">
                            <a href="<?php echo esc_url(home_url('/case-study/olj-worker-ai-automation/')); ?>" class="cs-btn cs-btn-primary">Read Deep Dive &rarr;</a>
                            <a href="<?php echo esc_url(home_url('/case-study/olj-worker-ai-automation/')); ?>" class="cs-link-arrow">Architecture &rarr;</a>
                        </div>
                    </div>
                </article>

                <!-- Case Study 2: Command Center Omnichannel Engine -->
                <article class="cs-grid-card">
                    <div class="cs-grid-media">
                        <img src="https://chadsia.com/wp-content/uploads/2026/05/web-performance-optimization-1779610334.jpg" 
                             alt="Command Center Multi-Model Publishing Engine" 
                             width="600" height="340" loading="lazy" />
                        <span class="cs-grid-badge">Multi-Model AI Publisher</span>
                    </div>
                    <div class="cs-grid-content">
                        <div class="cs-card-tags">
                            <span class="cs-tag">Multi-Model AI</span>
                            <span class="cs-tag">REST APIs</span>
                            <span class="cs-tag">Social Syndication</span>
                        </div>
                        <h3 class="cs-grid-title">
                            <a href="<?php echo esc_url(home_url('/case-study/command-center-content-engine/')); ?>">
                                Command Center: Omnichannel Content Engine & Multi-Model Publisher
                            </a>
                        </h3>
                        <p class="cs-grid-excerpt">
                            Automated publishing pipeline with RSS ingestion, Google Gemini 2.5 editorial synthesis, 6-tier image fallback (Imagen 3, Flux), and cross-posting to WordPress, LinkedIn, & Meta APIs.
                        </p>
                        <div class="cs-grid-actions">
                            <a href="<?php echo esc_url(home_url('/case-study/command-center-content-engine/')); ?>" class="cs-btn cs-btn-primary">Read Deep Dive &rarr;</a>
                            <a href="<?php echo esc_url(home_url('/case-study/command-center-content-engine/')); ?>" class="cs-link-arrow">Architecture &rarr;</a>
                        </div>
                    </div>
                </article>

                <!-- Case Study 3: SolarPlus -->
                <article class="cs-grid-card">
                    <div class="cs-grid-media">
                        <img src="https://chadsia.com/wp-content/uploads/2024/10/Solarplus.webp" 
                             alt="SolarPlus Design Platform" 
                             width="600" height="340" loading="lazy" />
                        <span class="cs-grid-badge">Custom UI/UX &amp; Quoting Tool</span>
                    </div>
                    <div class="cs-grid-content">
                        <div class="cs-card-tags">
                            <span class="cs-tag">Solar Tech</span>
                            <span class="cs-tag">Quoting Engine</span>
                            <span class="cs-tag">Custom Frontend</span>
                        </div>
                        <h3 class="cs-grid-title">SolarPlus Platform &amp; Design Engine</h3>
                        <p class="cs-grid-excerpt">
                            End-to-end UI/UX and responsive front-end engineering for SolarPlus—featuring solar array design canvas, CRM workflows, and automated quotation calculation.
                        </p>
                        <div class="cs-grid-actions">
                            <a href="<?php echo esc_url(home_url('/portfolio/#solarplus')); ?>" class="cs-btn cs-btn-secondary">Explore Project</a>
                            <a href="https://www.solarplus.co/" target="_blank" rel="noopener" class="cs-link-arrow">Live Platform &rarr;</a>
                        </div>
                    </div>
                </article>

                <!-- Case Study 2: Frasso -->
                <article class="cs-grid-card">
                    <div class="cs-grid-media">
                        <img src="https://chadsia.com/wp-content/themes/chadsia/assets/images/frasso-catalog-showcase-1024.webp" 
                             alt="Frasso Architecture Web Catalog" 
                             width="600" height="340" loading="lazy" />
                        <span class="cs-grid-badge">Editorial Catalog UI</span>
                    </div>
                    <div class="cs-grid-content">
                        <div class="cs-card-tags">
                            <span class="cs-tag">Architecture Studio</span>
                            <span class="cs-tag">Web Catalog</span>
                            <span class="cs-tag">Figma-to-Code</span>
                        </div>
                        <h3 class="cs-grid-title">Frasso Architecture & Web Catalog</h3>
                        <p class="cs-grid-excerpt">
                            Architected an editorial web catalog with high-fidelity typography, interactive collection filtering, zero layout shift, and sub-second visual rendering.
                        </p>
                        <div class="cs-grid-actions">
                            <a href="<?php echo esc_url(home_url('/portfolio/#frasso')); ?>" class="cs-btn cs-btn-secondary">Explore Project</a>
                            <a href="<?php echo esc_url(home_url('/frasso/')); ?>" target="_blank" rel="noopener" class="cs-link-arrow">Live Demo &rarr;</a>
                        </div>
                    </div>
                </article>

                <!-- Case Study 3: Kirk Allen -->
                <article class="cs-grid-card">
                    <div class="cs-grid-media">
                        <img src="https://chadsia.com/wp-content/uploads/2025/07/Kirk-Allen-Landscape-Supply-1024x546.png" 
                             alt="Kirk Allen Landscape Supply" 
                             width="600" height="340" loading="lazy" />
                        <span class="cs-grid-badge">Distance Freight API</span>
                    </div>
                    <div class="cs-grid-content">
                        <div class="cs-card-tags">
                            <span class="cs-tag">WooCommerce</span>
                            <span class="cs-tag">Distance Logistics</span>
                            <span class="cs-tag">Calculators</span>
                        </div>
                        <h3 class="cs-grid-title">Kirk Allen Landscape Supply</h3>
                        <p class="cs-grid-excerpt">
                            Custom WooCommerce platform engineered with dynamic Google Maps distance freight charging, cubic yard aggregate calculators, and bulk ordering workflows.
                        </p>
                        <div class="cs-grid-actions">
                            <a href="<?php echo esc_url(home_url('/portfolio/#kirk-allen')); ?>" class="cs-btn cs-btn-secondary">Explore Project</a>
                            <a href="https://www.kirkallenlandscapesupply.com/" target="_blank" rel="noopener" class="cs-link-arrow">Live Platform &rarr;</a>
                        </div>
                    </div>
                </article>

                <!-- Case Study 4: Defensible Legal -->
                <article class="cs-grid-card">
                    <div class="cs-grid-media">
                        <img src="https://chadsia.com/wp-content/uploads/2026/08/Defensible-Legal-1024x565.png" 
                             alt="Defensible Legal Platform" 
                             width="600" height="340" loading="lazy" />
                        <span class="cs-grid-badge">99 PageSpeed · WCAG AA</span>
                    </div>
                    <div class="cs-grid-content">
                        <div class="cs-card-tags">
                            <span class="cs-tag">Legal Directory</span>
                            <span class="cs-tag">TypeScript</span>
                            <span class="cs-tag">Semantic HTML5</span>
                        </div>
                        <h3 class="cs-grid-title">Defensible Legal Platform</h3>
                        <p class="cs-grid-excerpt">
                            Corporate legal directory platform engineered with sub-second critical path rendering, WCAG 2.1 AA accessibility compliance, and structured schema data.
                        </p>
                        <div class="cs-grid-actions">
                            <a href="<?php echo esc_url(home_url('/portfolio/#defensible-legal')); ?>" class="cs-btn cs-btn-secondary">Explore Project</a>
                            <a href="https://defensiblelegal.co.uk/" target="_blank" rel="noopener" class="cs-link-arrow">Live Platform &rarr;</a>
                        </div>
                    </div>
                </article>

                <!-- Case Study 5: Casa Halo Tulum -->
                <article class="cs-grid-card">
                    <div class="cs-grid-media">
                        <img src="https://chadsia.com/wp-content/uploads/2025/09/Casa-Halo-Site-1024x546.png" 
                             alt="Casa Halo Tulum Booking Platform" 
                             width="600" height="340" loading="lazy" />
                        <span class="cs-grid-badge">Luxury Hospitality</span>
                    </div>
                    <div class="cs-grid-content">
                        <div class="cs-card-tags">
                            <span class="cs-tag">Vacation Rental</span>
                            <span class="cs-tag">Direct Booking</span>
                            <span class="cs-tag">Fluid Typography</span>
                        </div>
                        <h3 class="cs-grid-title">Casa Halo Luxury Villa Portal</h3>
                        <p class="cs-grid-excerpt">
                            Bespoke booking portal for private vacation villas in Tulum with immersive visual storytelling, fluid responsive typography, and direct booking inquiries.
                        </p>
                        <div class="cs-grid-actions">
                            <a href="<?php echo esc_url(home_url('/portfolio/#casa-halo')); ?>" class="cs-btn cs-btn-secondary">Explore Project</a>
                            <a href="https://casahalotulum.com/" target="_blank" rel="noopener" class="cs-link-arrow">Live Platform &rarr;</a>
                        </div>
                    </div>
                </article>

                <!-- Case Study 6: Headless Architecture & Performance -->
                <article class="cs-grid-card">
                    <div class="cs-grid-media">
                        <img src="https://chadsia.com/wp-content/uploads/2026/05/headless-CMS-architecture-1779610349.jpg" 
                             alt="Headless CMS Architecture" 
                             width="600" height="340" loading="lazy" />
                        <span class="cs-grid-badge">Architecture Guide</span>
                    </div>
                    <div class="cs-grid-content">
                        <div class="cs-card-tags">
                            <span class="cs-tag">Headless CMS</span>
                            <span class="cs-tag">REST / GraphQL</span>
                            <span class="cs-tag">Edge Caching</span>
                        </div>
                        <h3 class="cs-grid-title">Headless WordPress Architecture Patterns</h3>
                        <p class="cs-grid-excerpt">
                            Decoupled frontend strategies utilizing WordPress as a structured headless content engine with edge-cached static pages and real-time webhook revalidation.
                        </p>
                        <div class="cs-grid-actions">
                            <a href="<?php echo esc_url(home_url('/services/')); ?>" class="cs-btn cs-btn-secondary">Explore Services</a>
                            <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="cs-link-arrow">Consult Architecture &rarr;</a>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <!-- Technical Pillars Strip with Stock Illustrations -->
    <section class="cs-pillars-section">
        <div class="cs-cs-container">
            <div class="cs-section-header">
                <div class="cs-eyebrow">Core Engineering Standard</div>
                <h2 class="cs-section-title">Built on Deterministic Engineering Principles</h2>
                <p class="cs-section-subtitle">Every project is engineered from first principles without bloated dependencies.</p>
            </div>

            <div class="cs-pillars-grid">
                <div class="cs-pillar-item">
                    <div class="cs-pillar-icon-box">
                        <img src="https://chadsia.com/wp-content/uploads/2026/05/web-performance-optimization-1779610334.jpg" 
                             alt="Web Performance Optimization" 
                             width="80" height="80" loading="lazy" />
                    </div>
                    <h3 class="cs-pillar-title">Sub-Second Speed</h3>
                    <p class="cs-pillar-desc">
                        Critical CSS inlining, deferred non-blocking assets, and zero layout shifts for instant first contentful paint.
                    </p>
                </div>

                <div class="cs-pillar-item">
                    <div class="cs-pillar-icon-box">
                        <img src="https://chadsia.com/wp-content/uploads/2026/05/API-development-coding-1779610349.jpg" 
                             alt="API Development & Custom Systems" 
                             width="80" height="80" loading="lazy" />
                    </div>
                    <h3 class="cs-pillar-title">Custom PHP & API Integrations</h3>
                    <p class="cs-pillar-desc">
                        Transactional APIs, bespoke freight calculators, Brevo routing, and clean modular codebases built to scale.
                    </p>
                </div>

                <div class="cs-pillar-item">
                    <div class="cs-pillar-icon-box">
                        <img src="https://chadsia.com/wp-content/uploads/2026/06/custom-vs-template.jpg" 
                             alt="Zero Builder Bloat" 
                             width="80" height="80" loading="lazy" />
                    </div>
                    <h3 class="cs-pillar-title">Zero Builder Bloat</h3>
                    <p class="cs-pillar-desc">
                        Eliminating unnecessary plugins, multi-megabyte DOM wrappers, and slow render-blocking script chains.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Global CTA Section -->
    <section class="cs-cta-section">
        <div class="cs-cs-container">
            <div class="cs-cta-card">
                <div class="cs-eyebrow">Ready to Transform Your Platform?</div>
                <h2 class="cs-cta-title">Let's Engineer Your High-Performance Web Solution</h2>
                <p class="cs-cta-desc">
                    Partner directly with a senior engineer with 17+ years of expertise in custom WordPress architecture, speed optimization, and bespoke web applications.
                </p>
                <div class="cs-cta-actions">
                    <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="cs-btn cs-btn-primary">Start Your Project</a>
                    <a href="<?php echo esc_url(home_url('/portfolio/')); ?>" class="cs-btn cs-btn-secondary">View Full Portfolio</a>
                </div>
            </div>
        </div>
    </section>
</div>
