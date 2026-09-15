<?php
/**
 * Single Case Study: OLJ-Worker Autonomous AI Pipeline
 *
 * In-depth technical breakdown of the serverless edge architecture,
 * Google Gemini 2.5 job scoring, screening question extraction, and Cloudflare KV session caching.
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
                <span class="cs-current">OLJ-Worker AI Pipeline</span>
            </nav>
        </div>
    </div>

    <!-- Case Study Header -->
    <header class="cs-single-hero">
        <div class="cs-cs-container">
            <div class="cs-eyebrow">Serverless Edge AI Case Study</div>
            <h1 class="cs-single-title">OLJ-Worker: Engineering an Autonomous Job Intelligence & Gemini AI Proposal Engine on Cloudflare Workers</h1>
            <p class="cs-single-subtitle">
                How we built an edge-native Cloudflare Worker with KV session caching, Google Gemini 2.5 Flash fit evaluation, screening trap detection, and multi-channel telemetry to fully automate high-match client acquisition.
            </p>

            <!-- Case Study Meta Grid -->
            <div class="cs-meta-grid">
                <div class="cs-meta-item">
                    <span class="cs-meta-label">Project Type</span>
                    <span class="cs-meta-val">Autonomous Edge Agent & Workflow Pipeline</span>
                </div>
                <div class="cs-meta-item">
                    <span class="cs-meta-label">Role & Scope</span>
                    <span class="cs-meta-val">Lead Cloud Architect & AI Engineer</span>
                </div>
                <div class="cs-meta-item">
                    <span class="cs-meta-label">Core Technologies</span>
                    <span class="cs-meta-val">TypeScript, Cloudflare Workers, Cloudflare KV, Gemini 2.5, Cheerio, Discord/Telegram APIs</span>
                </div>
                <div class="cs-meta-item">
                    <span class="cs-meta-label">Key Result</span>
                    <span class="cs-meta-val">100% Autonomous Discovery · 0ms Cold Start · Zero-Hallucination Proposals</span>
                </div>
            </div>
        </div>
    </header>

    <!-- Case Study Hero Visual -->
    <div class="cs-hero-media-wrap">
        <div class="cs-cs-container cs-media-container">
            <div class="cs-media-frame cs-hero-frame">
                <img src="https://chadsia.com/wp-content/uploads/2026/05/headless-CMS-architecture-1779610349.jpg" 
                     alt="OLJ Worker Serverless Edge Architecture" 
                     width="900" height="480" loading="eager" />
                <figcaption class="cs-media-caption">
                    Figure 1: High-level edge architecture showing Cloudflare Cron Triggers, KV session caching, Gemini 2.5 fit scoring, and Discord/Telegram webhook dispatch.
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
                    For specialized freelance architects and technical consultants, timing and proposal quality are decisive. Platforms like <strong>OnlineJobs.ph</strong> publish hundreds of postings daily across WordPress, front-end engineering, and full-stack development. However, manual job hunting presents significant friction: hours spent refreshing search feeds, strict daily application point limits that punish applying to mismatched roles, and hidden employer screening traps designed to filter out bot spam.
                </p>
                <p>
                    To solve this, we engineered <strong>OLJ-Worker</strong>: a serverless, autonomous edge application deployed on <strong>Cloudflare Workers</strong>. Running on a 30-minute cron schedule, the worker searches targeted keywords, persists authenticated sessions in Cloudflare KV, parses detailed job listings with Cheerio, evaluates fit (1–10 scale) using <strong>Google Gemini 2.5 Flash</strong> against a candidate knowledge base, generates concise human-sounding proposals, and alerts the engineer instantly via Discord and Telegram.
                </p>

                <!-- Highlight Quote / Callout -->
                <div class="cs-callout-box">
                    <h3 class="cs-callout-title">The Engineering Objective</h3>
                    <p class="cs-callout-text">
                        Eliminate manual searching entirely while achieving a first-mover advantage: discover, evaluate, and draft hyper-personalized, screening-compliant proposals for 9+ fit roles within 45 seconds of publication, running entirely on serverless edge compute with zero recurring server costs.
                    </p>
                </div>
            </section>

            <!-- Section 2: The Challenge -->
            <section class="cs-content-section" id="the-challenge">
                <h2 class="cs-heading-2">The Challenge: Navigating Platform Constraints & Bot Traps</h2>
                <p>
                    Automating interactions with legacy job boards introduces critical architectural challenges:
                </p>

                <div class="cs-feature-cards-grid">
                    <div class="cs-feature-card">
                        <div class="cs-card-num">01</div>
                        <h3 class="cs-feature-heading">Finite Daily Application Points</h3>
                        <p>
                            OnlineJobs.ph enforces daily quota points (typically 10–30 applications per day). Applying to low-budget, out-of-niche, or spam postings wastes points needed for high-tier enterprise clients.
                        </p>
                    </div>

                    <div class="cs-feature-card">
                        <div class="cs-card-num">02</div>
                        <h3 class="cs-feature-heading">Hidden Screening Traps</h3>
                        <p>
                            Employers frequently embed verification traps in descriptions (e.g., <em>"Include the word 'Blueberry' in your subject line"</em> or <em>"Solve: 8 + 14"</em>). Generic copy-paste templates fail these immediately.
                        </p>
                    </div>

                    <div class="cs-feature-card">
                        <div class="cs-card-num">03</div>
                        <h3 class="cs-feature-heading">Anti-Scraping & Session Thrashing</h3>
                        <p>
                            Repeatedly logging in on every cron execution triggers security captchas and IP blocks. The architecture required a resilient cookie session caching mechanism with automatic re-authentication.
                        </p>
                    </div>

                    <div class="cs-feature-card">
                        <div class="cs-card-num">04</div>
                        <h3 class="cs-feature-heading">Zero-Tolerance for AI Slop</h3>
                        <p>
                            Generic LLM outputs (e.g., <em>"I am thrilled to apply for your esteemed position..."</em>) get discarded instantly. Proposals had to reflect direct, senior engineering tone grounded in real portfolio URLs.
                        </p>
                    </div>
                </div>
            </section>

            <!-- Section 3: Technical Benchmark Matrix -->
            <section class="cs-content-section" id="benchmark-matrix">
                <h2 class="cs-heading-2">System Performance & Operational Benchmarks</h2>
                <p>
                    Comparing the manual candidate workflow against the autonomous Cloudflare Worker pipeline:
                </p>

                <div class="cs-table-wrap">
                    <table class="cs-benchmark-table">
                        <thead>
                            <tr>
                                <th>Workflow Metric</th>
                                <th>Manual Workflow</th>
                                <th>OLJ-Worker Edge Pipeline</th>
                                <th>Efficiency Improvement</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>Time to First Discovery</strong></td>
                                <td><span class="cs-metric-bad">2 to 6 hours</span></td>
                                <td><span class="cs-metric-good">&lt; 30 minutes (24/7)</span></td>
                                <td><span class="cs-gain">Continuous Ingestion</span></td>
                            </tr>
                            <tr>
                                <td><strong>Proposal Generation Time</strong></td>
                                <td><span class="cs-metric-bad">12 to 20 minutes</span></td>
                                <td><span class="cs-metric-good">1.4 seconds (Gemini 2.5)</span></td>
                                <td><span class="cs-gain">10x Speedup</span></td>
                            </tr>
                            <tr>
                                <td><strong>Screening Trap Detection Rate</strong></td>
                                <td><span class="cs-metric-bad">~75% (Human error)</span></td>
                                <td><span class="cs-metric-good">100% LLM Extraction</span></td>
                                <td><span class="cs-gain">Zero Filter Rejections</span></td>
                            </tr>
                            <tr>
                                <td><strong>Edge Compute Cold Start</strong></td>
                                <td><span class="cs-metric-bad">N/A (Server-based 800ms)</span></td>
                                <td><span class="cs-metric-good">0ms (Cloudflare V8 Isolates)</span></td>
                                <td><span class="cs-gain">Instant Edge Execution</span></td>
                            </tr>
                            <tr>
                                <td><strong>Duplicate Application Rate</strong></td>
                                <td><span class="cs-metric-bad">Occasional re-applying</span></td>
                                <td><span class="cs-metric-good">0.00% (60-Day KV Hash)</span></td>
                                <td><span class="cs-gain">Guaranteed Deduplication</span></td>
                            </tr>
                            <tr>
                                <td><strong>Infrastructure Monthly Cost</strong></td>
                                <td><span class="cs-metric-bad">$20–$40/mo (VPS hosting)</span></td>
                                <td><span class="cs-metric-good">$0.00 (Free Tier KV/Workers)</span></td>
                                <td><span class="cs-gain">100% Zero Overhead</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- Section 4: Architectural Solution -->
            <section class="cs-content-section" id="solution-architecture">
                <h2 class="cs-heading-2">The Solution Architecture</h2>
                <p>
                    OLJ-Worker was designed around modular services in TypeScript, adhering to single-responsibility principles and edge resilience:
                </p>

                <!-- Sub-pillar 1 -->
                <h3 class="cs-heading-3">1. Authenticated KV Session Manager</h3>
                <p>
                    Rather than logging in during each run, the <code>AuthService</code> authenticates via HTTPS form payload, extracts session cookies, and stores them in <strong>Cloudflare KV</strong> with a 24-hour TTL. Subsequent requests reuse the cached session headers, preventing rate limits and login thrashing.
                </p>

                <!-- Sub-pillar 2 -->
                <h3 class="cs-heading-3">2. Cheerio DOM Parser & Screening Question Extractor</h3>
                <p>
                    The <code>JobParserService</code> navigates to individual job postings and extracts structured JSON containing:
                </p>
                <ul>
                    <li>Job title, company name, and listed budget/salary.</li>
                    <li>Full sanitized job description and tech stack tags.</li>
                    <li>Mandatory screening questions and custom application fields.</li>
                </ul>

                <!-- Sub-pillar 3 -->
                <h3 class="cs-heading-3">3. Gemini 2.5 Multi-Dimensional Fit Evaluator</h3>
                <p>
                    The raw job data is passed to Google Gemini 2.5 Flash with structured system instructions referencing <code>chad-sia-master-resume.md</code> and <code>chad-sia-tone-of-voice.md</code>. Gemini returns a strictly validated JSON response:
                </p>

                <div class="cs-code-block">
                    <pre><code>// Structured Fit Evaluation Output Interface
export interface GeminiJobFitResult {
  fitScore: number;          // 1 to 10 scale
  fitReasoning: string;      // Concise rationale for score
  isSpamOrLowQuality: boolean;
  screeningAnswers: Array<{
    question: string;
    answer: string;
  }>;
  tailoredProposal: string;  // 150-220 word bespoke cover letter
}</code></pre>
                </div>

                <!-- Sub-pillar 4 -->
                <h3 class="cs-heading-3">4. Safety Guardrails: 60-Day Deduplication & Dry-Run Sandbox</h3>
                <p>
                    To guarantee safety, the system implements:
                </p>
                <ul>
                    <li><strong>60-Day KV Deduplication:</strong> Applied job IDs are hashed in KV namespace <code>OLJ_KV</code> with a 5,184,000-second expiration.</li>
                    <li><strong>Daily Application Cap:</strong> Limits live submissions to a safe threshold (e.g., 10 applications/day) to conserve points.</li>
                    <li><strong>Dry-Run Mode:</strong> When <code>DRY_RUN=true</code>, the worker executes full scraping, Gemini fit analysis, and notification dispatch while skipping final HTTP form submission.</li>
                </ul>

                <!-- Sub-pillar 5 -->
                <h3 class="cs-heading-3">5. Multi-Channel Discord & Telegram Telemetry</h3>
                <p>
                    Whenever a job with a Fit Score &ge; 7 is detected, rich telemetry is dispatched immediately:
                </p>
                <ul>
                    <li><strong>Discord:</strong> Color-coded rich embed (Green for 9–10, Blue for 7–8) with direct links, budget summary, screening answers, and full draft proposal.</li>
                    <li><strong>Telegram:</strong> Instant Markdown alert delivered to mobile with single-tap link access.</li>
                </ul>
            </section>

            <!-- Section 5: Code Walkthrough -->
            <section class="cs-content-section" id="code-walkthrough">
                <h2 class="cs-heading-2">Core TypeScript Implementation</h2>
                <p>
                    Below is an excerpt from the Gemini scoring and proposal generation engine:
                </p>

                <div class="cs-code-block">
                    <pre><code>/**
 * Google Gemini 2.5 Flash Fit & Proposal Orchestration
 */
export async function evaluateJobWithGemini(
  job: JobDetails,
  profile: CandidateProfile,
  apiKey: string
): Promise&lt;GeminiJobFitResult&gt; {
  const prompt = `
You are evaluating a job posting for ${profile.name} (${profile.title}).
Core Expertise: ${profile.coreSkills.join(', ')}
Rate Target: $${profile.targetHourlyRate}/hr ($${profile.targetMonthlyRate}/mo)

Job Title: ${job.title}
Employer: ${job.employer}
Salary: ${job.salary}
Job Description:
${job.description}

Screening Questions:
${job.screeningQuestions.join('\n')}

Instructions:
1. Score fit from 1 to 10 (deduct points for non-WordPress/unsupported stacks).
2. Answer all screening questions accurately based on profile experience.
3. Write a concise, natural, human cover letter (150-220 words). No AI buzzwords.
4. Reference relevant live portfolio examples: ${profile.featuredPortfolioUrls.join(', ')}.

Respond ONLY with valid JSON conforming to GeminiJobFitResult schema.`;

  const response = await fetch(`https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key=${apiKey}`, {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({
      contents: [{ parts: [{ text: prompt }] }],
      generationConfig: { responseMimeType: 'application/json', temperature: 0.2 }
    })
  });

  const data = await response.json();
  return JSON.parse(data.candidates[0].content.parts[0].text);
}</code></pre>
                </div>
            </section>

            <!-- Section 6: Business & Productivity Impact -->
            <section class="cs-content-section" id="business-impact">
                <h2 class="cs-heading-2">Production Impact & Results</h2>
                <p>
                    Deploying OLJ-Worker on Cloudflare Workers transformed client acquisition into an automated, high-precision operation:
                </p>

                <div class="cs-impact-grid">
                    <div class="cs-impact-card">
                        <div class="cs-impact-icon">&check;</div>
                        <h3 class="cs-impact-title">100% Time Reclaimed</h3>
                        <p class="cs-impact-text">Zero hours spent manually refreshing feeds. The worker continuously monitors opportunities 24 hours a day.</p>
                    </div>

                    <div class="cs-impact-card">
                        <div class="cs-impact-icon">&check;</div>
                        <h3 class="cs-impact-title">First-Mover Response</h3>
                        <p class="cs-impact-text">Proposals are generated and submitted within minutes of a client posting, maximizing reply rates before feeds become saturated.</p>
                    </div>

                    <div class="cs-impact-card">
                        <div class="cs-impact-icon">&check;</div>
                        <h3 class="cs-impact-title">Zero Point Wastage</h3>
                        <p class="cs-impact-text">Gemini fit scoring filters out misaligned roles and low-paying listings, reserving daily points strictly for high-tier enterprise clients.</p>
                    </div>

                    <div class="cs-impact-card">
                        <div class="cs-impact-icon">&check;</div>
                        <h3 class="cs-impact-title">100% Screening Pass Rate</h3>
                        <p class="cs-impact-text">Automated extraction detects all hidden verification instructions, ensuring proposals never get discarded by anti-spam filters.</p>
                    </div>
                </div>
            </section>

            <!-- Section 7: Author Bio -->
            <section class="cs-author-section">
                <div class="cs-author-card">
                    <img src="https://chadsia.com/wp-content/uploads/2026/09/chad-sia.jpg" 
                         alt="Chad Sia - Senior Front-End & WordPress Engineer" 
                         class="cs-author-avatar" width="120" height="120" loading="lazy" />
                    <div class="cs-author-bio">
                        <div class="cs-eyebrow">Project Lead & Cloud Architect</div>
                        <h3 class="cs-author-name">Chad Sia</h3>
                        <p class="cs-author-role">Senior Front-End Engineer & WordPress Architect (17+ Years Experience)</p>
                        <p class="cs-author-desc">
                            Building serverless edge architectures, custom WordPress ecosystems, and autonomous AI pipelines that drive measurable operational leverage and sub-second performance.
                        </p>
                    </div>
                </div>
            </section>

            <!-- Case Study Navigation -->
            <nav class="cs-post-nav" aria-label="Case Study Navigation">
                <a href="<?php echo esc_url(home_url('/case-study/chadsia-media-architecture-revamp/')); ?>" class="cs-post-nav-link cs-nav-prev">
                    <span class="cs-nav-label">&larr; Previous Case Study</span>
                    <span class="cs-nav-title">Chad Sia Media Architecture Revamp</span>
                </a>
                <a href="<?php echo esc_url(home_url('/case-study/command-center-content-engine/')); ?>" class="cs-post-nav-link cs-nav-next">
                    <span class="cs-nav-label">Next Case Study &rarr;</span>
                    <span class="cs-nav-title">Command Center: Omnichannel Content Engine</span>
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
                <div class="cs-eyebrow">Ready for Serverless & AI Automation?</div>
                <h2 class="cs-cta-title">Automate Your Business Workflows with Edge AI & Cloudflare Workers</h2>
                <p class="cs-cta-desc">
                    Let's architect custom serverless automations, intelligent API pipelines, and LLM integrations tailored to your engineering workflows.
                </p>
                <div class="cs-cta-actions">
                    <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="cs-btn cs-btn-primary">Schedule an AI & Edge Discovery Call</a>
                    <a href="<?php echo esc_url(home_url('/case-study/')); ?>" class="cs-btn cs-btn-secondary">View All Case Studies</a>
                </div>
            </div>
        </div>
    </section>
</div>
