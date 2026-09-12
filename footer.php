<?php
/**
 * The template for displaying the footer
 * Native, lightweight, zero-builder architecture
 *
 * @package ChadSia
 */

if (!defined('ABSPATH')) {
    exit;
}
?>

<footer class="cs-site-footer" id="site-footer">
    <div class="cs-container">
        
        <div class="cs-footer-grid">
            
            <!-- Column 1: Brand & Status -->
            <div class="cs-footer-brand">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="cs-header-logo" rel="home">
                    <img src="https://chadsia.com/wp-content/uploads/2024/10/logo-cds.webp" alt="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" class="cs-header-logo-img" width="697" height="359">
                </a>
                <p>
                    Senior front-end architect and custom WordPress engineer with 17+ years of craft delivering sub-second web platforms globally.
                </p>
                <div class="cs-footer-status">
                    <span class="status-dot-live"></span>
                    <span>Available for Project Engagements</span>
                </div>
            </div>

            <!-- Column 2: 15 Services -->
            <div class="cs-footer-col">
                <p class="cs-footer-heading">Core Capabilities</p>
                <ul class="cs-footer-links">
                    <li><a href="<?php echo esc_url(home_url('/services/front-end-development/')); ?>">Front-End Development</a></li>
                    <li><a href="<?php echo esc_url(home_url('/services/custom-wordpress-development/')); ?>">Custom WordPress</a></li>
                    <li><a href="<?php echo esc_url(home_url('/services/website-speed-optimization/')); ?>">Speed Optimization</a></li>
                    <li><a href="<?php echo esc_url(home_url('/services/ui-ux-design/')); ?>">UI/UX Design</a></li>
                    <li><a href="<?php echo esc_url(home_url('/services/ai-web-development/')); ?>">Web Applications</a></li>
                    <li><a href="<?php echo esc_url(home_url('/services/')); ?>" style="color: #818cf8; font-weight: 700;">View All 15 Services &rarr;</a></li>
                </ul>
            </div>

            <!-- Column 3: Navigation -->
            <div class="cs-footer-col">
                <p class="cs-footer-heading">Company &amp; Work</p>
                <ul class="cs-footer-links">
                    <li><a href="<?php echo esc_url(home_url('/portfolio/')); ?>">Featured Portfolio</a></li>
                    <li><a href="<?php echo esc_url(home_url('/about-me/')); ?>">About Chad Sia</a></li>
                    <li><a href="<?php echo esc_url(home_url('/blog/')); ?>">Technical Publication</a></li>
                    <li><a href="<?php echo esc_url(home_url('/locations/')); ?>">Global Locations</a></li>
                    <li><a href="<?php echo esc_url(home_url('/contact/')); ?>">Project Intake Form</a></li>
                </ul>
            </div>

            <!-- Column 4: Direct Channels -->
            <div class="cs-footer-col">
                <p class="cs-footer-heading">Direct Channels</p>
                <ul class="cs-footer-links">
                    <li><!--email_off--><a href="mailto:hello@chadsia.com"><i class="fa-regular fa-envelope"></i> hello@chadsia.com</a><!--/email_off--></li>
                    <li><a href="tel:+639947156382"><i class="fa-solid fa-phone"></i> +63 9947156382</a></li>
                    <li><a href="https://calendly.com/hello-chadsia/30min" target="_blank" rel="noopener noreferrer"><i class="fa-regular fa-calendar"></i> Book 30-Min Discovery</a></li>
                </ul>
                <div class="cs-footer-socials">
                    <a href="https://www.facebook.com/chadsiamedia" target="_blank" rel="noopener noreferrer" class="cs-social-icon" aria-label="Facebook Page">
                        <i class="fa-brands fa-facebook-f"></i>
                    </a>
                    <a href="https://www.linkedin.com/in/chadsiamedia/" target="_blank" rel="noopener noreferrer" class="cs-social-icon" aria-label="LinkedIn Profile">
                        <i class="fa-brands fa-linkedin-in"></i>
                    </a>
                    <a href="https://www.instagram.com/chadsiamedia/" target="_blank" rel="noopener noreferrer" class="cs-social-icon" aria-label="Instagram Profile">
                        <i class="fa-brands fa-instagram"></i>
                    </a>
                    <a href="https://github.com/chadfuse" target="_blank" rel="noopener noreferrer" class="cs-social-icon" aria-label="GitHub Profile">
                        <i class="fa-brands fa-github"></i>
                    </a>
                    <!--email_off--><a href="mailto:hello@chadsia.com" class="cs-social-icon" aria-label="Send Email">
                        <i class="fa-regular fa-envelope"></i>
                    </a><!--/email_off-->
                </div>
            </div>

        </div>

        <!-- Footer Bottom Bar -->
        <div class="cs-footer-bottom">
            <div>
                &copy; <?php echo date('Y'); ?> Chad Sia Media. Engineered with sub-second performance &amp; zero builder bloat.
            </div>
            <div class="cs-footer-legal">
                <a href="<?php echo esc_url(home_url('/privacy-policy/')); ?>">Privacy Policy</a>
                <a href="<?php echo esc_url(home_url('/terms-and-conditions/')); ?>">Terms and Conditions</a>
            </div>
        </div>

    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
