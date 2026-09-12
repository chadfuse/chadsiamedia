# Workspace Engineering & Design Guidelines

These guidelines apply across all frontend templates, stylesheets, and copy for **Chad Sia Media (chadsia.com)**.

---

## 1. Typography & Text Casing
- **No All-Caps in Body or UI Elements**:
  - Do **NOT** use `text-transform: uppercase` in body copy, section eyebrows, badge pills, category tags, buttons, form labels, or card metadata.
  - Always use natural **Title Case** (e.g. *Technical Publication & Case Studies*, *WordPress & CMS*) or **Sentence case** (e.g. *15 core capabilities*, *Average response time: under 4 hours*).
  - Keeps typography clean, editorial, human, and readable without aggressive capitalized shouting.

---

## 2. Authentic Engineering Copy (Zero AI Slop)
- **Remove Generic AI Pills & Fluff**:
  - Do **NOT** plaster generic AI badges, AI automation buzzwords, or "AI slop" pills across pages where they add no real substance.
  - Focus strictly on genuine, high-craft engineering strengths:
    - **Custom WordPress Architecture** (Bespoke PHP themes, ACF Pro blocks, clean database indexing, zero page-builder bloat).
    - **Front-End Engineering** (Semantic HTML5, modular CSS, micro-interactions, responsive Figma-to-code execution).
    - **Sub-Second Performance** (Core Web Vitals remediation, LCP/CLS optimization, Redis caching, sub-500ms TTFB).
    - **Direct Senior Access** (1-on-1 collaboration with a 17+ year engineer, async Slack/Loom communication, weekly agile sprints).
- When mentioning AI capabilities, keep it strictly tied to concrete technical deliverables (e.g., custom OpenAI/Claude API orchestrations, RAG search integrations, CRM webhook automations) rather than generic marketing buzzwords.

---

## 3. Aesthetics & Design System Tokens (Location Page Light Theme Standard)
- **Background Surface**: `#f5f5f7` (Light Apple/Stripe gray base canvas).
- **Card Surface**: `#ffffff` (Clean white card surface with `#e5e7eb` crisp border and soft elevation shadow `0 4px 20px -2px rgba(0,0,0,0.05)`).
- **Primary Brand**: `#4968f8` (Electric royal blue) with hover state `#3553eb`, light tint `#eef2ff`, and text `#1d4ed8`.
- **Accent / Status**: `#10b981` (Emerald green) for live availability dots, verified badges, and metrics.
- **Typography**: `Outfit` (Headings, display titles); `DM Sans` (Prose, body text); `JetBrains Mono` (Code snippets, metrics).
- **Badge Pills**: `#eef2ff` background, `rgba(73, 104, 248, 0.2)` border, `#1d4ed8` text.

---

## 4. Deployment & Server Sync Rule
- Always maintain dual sync for all modified and new template files:
  1. `wp-content/themes/chadsia/`
  2. `wp-content/novamira-sandbox/templates/`
- Always flush WP Rocket cache, Redis object cache, and Elementor cache after deploying changes.
