# Workspace Guidelines for Chad Sia Media

## Core Rules & Constraints

### 1. Typography & Text Casing
- **NO All-Caps in Body or UI Elements**: Never use `text-transform: uppercase` on body copy, eyebrows, badge pills, category tags, buttons, form labels, or metadata. Always use natural **Title Case** or **Sentence case**.

### 2. Copywriting & No AI Slop
- **Eliminate Generic AI Pills & Fluff**: Remove all decorative or generic AI buzzword pills and AI hype copy ("AI slop"). Ground all copy in concrete engineering value:
  - Custom WordPress Development & Headless Architecture
  - Front-End Engineering & Figma-to-Code Fidelity
  - Sub-Second Speed & Core Web Vitals Optimization
  - Direct 1-on-1 Senior Engineer Collaboration (17+ years experience)

### 3. Design System & Theme Styling
- **Pure Clean Text Eyebrows (No Badge Pills)**: Never use pill containers, badge background fills, or border pills on section eyebrows (`.cs-badge-pill`, `.cs-eyebrow`). All eyebrows must be pure clean text (`background: transparent; border: none; padding: 0;`).
- **Location Page Light Background Architecture**: `#f5f5f7` background, `#ffffff` card surface, `#e5e7eb` crisp borders, `#111827` dark headings (`Outfit`), `#1f2937` / `#374151` body text (`DM Sans`).
- **Brand Colors**: `#4968f8` electric blue, `#10b981` emerald accent, `#1d4ed8` / `#4968f8` text for eyebrows.
- **Zero Builder Bloat**: Clean PHP templates and lightweight modular CSS. No heavy Elementor/page builder dependencies.

### 4. Dual Server Sync & Cache Flush
- Any modified or created theme template must be synced to both:
  1. `wp-content/themes/chadsia/`
  2. `wp-content/novamira-sandbox/templates/`
- Always flush WP Rocket domain cache, minify cache, Redis object cache, and Elementor cache after deploying.
