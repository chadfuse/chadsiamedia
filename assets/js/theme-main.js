/**
 * Chad Sia Media - Theme Main JavaScript
 * Lightweight, Vanilla JS for Native Header, Mobile Drawer, and FAQs
 */

document.addEventListener('DOMContentLoaded', function () {
  // 1. Sticky Header Blur Effect
  const header = document.querySelector('.cs-site-header');
  if (header) {
    let ticking = false;
    const handleScroll = () => {
      if (!ticking) {
        window.requestAnimationFrame(() => {
          if (window.scrollY > 40) {
            header.classList.add('is-scrolled');
          } else {
            header.classList.remove('is-scrolled');
          }
          ticking = false;
        });
        ticking = true;
      }
    };
    window.addEventListener('scroll', handleScroll, { passive: true });
    handleScroll();
  }

  // 2. Mobile Drawer Navigation
  const mobileToggle = document.querySelector('.cs-mobile-toggle');
  const mobileDrawer = document.querySelector('.cs-mobile-drawer');
  const drawerOverlay = document.querySelector('.cs-drawer-overlay');
  const drawerClose = document.querySelector('.cs-drawer-close');

  function openDrawer() {
    if (mobileDrawer && drawerOverlay) {
      mobileDrawer.classList.add('is-open');
      drawerOverlay.classList.add('is-open');
      document.body.style.overflow = 'hidden';
    }
  }

  function closeDrawer() {
    if (mobileDrawer && drawerOverlay) {
      mobileDrawer.classList.remove('is-open');
      drawerOverlay.classList.remove('is-open');
      document.body.style.overflow = '';
    }
  }

  if (mobileToggle) {
    mobileToggle.addEventListener('click', openDrawer);
  }
  if (drawerClose) {
    drawerClose.addEventListener('click', closeDrawer);
  }
  if (drawerOverlay) {
    drawerOverlay.addEventListener('click', closeDrawer);
  }

  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape' && mobileDrawer && mobileDrawer.classList.contains('is-open')) {
      closeDrawer();
    }
  });

  // 2b. Mobile Drawer Submenu Accordions
  const mobileSubToggles = document.querySelectorAll('.cs-mobile-sub-toggle');
  mobileSubToggles.forEach(toggleBtn => {
    toggleBtn.addEventListener('click', function (e) {
      e.preventDefault();
      e.stopPropagation();
      const parentItem = toggleBtn.closest('.cs-mobile-has-sub');
      if (parentItem) {
        parentItem.classList.toggle('is-open');
      }
    });
  });

  // 3. Global FAQ Accordion Handler
  const accordions = document.querySelectorAll('.cs-faq-item, .cs-accordion-item');
  accordions.forEach(item => {
    const header = item.querySelector('.cs-faq-header, .cs-accordion-header');
    if (!header) return;

    header.addEventListener('click', function () {
      const isActive = item.classList.contains('active') || item.classList.contains('is-open');
      
      // Close sibling items in the same container
      const parent = item.parentElement;
      if (parent) {
        parent.querySelectorAll('.cs-faq-item, .cs-accordion-item').forEach(sibling => {
          sibling.classList.remove('active', 'is-open');
          const body = sibling.querySelector('.cs-faq-body, .cs-accordion-body');
          if (body) body.style.display = 'none';
        });
      }

      if (!isActive) {
        item.classList.add('active', 'is-open');
        const body = item.querySelector('.cs-faq-body, .cs-accordion-body');
        if (body) body.style.display = 'block';
      }
    });
  });

  // 4. Global Reviews Slider
  const sliders = document.querySelectorAll('.cs-reviews-slider');
  sliders.forEach(slider => {
    const track = slider.querySelector('.cs-reviews-track');
    const container = slider.closest('.cs-loc-reviews') || slider.parentElement;
    const prevBtn = container.querySelector('.cs-slider-btn.prev');
    const nextBtn = container.querySelector('.cs-slider-btn.next');
    const dotsContainer = slider.querySelector('.cs-slider-dots');
    const cards = slider.querySelectorAll('.cs-review-card');

    if (track && cards.length > 0) {
      let currentIndex = 0;
      let autoPlayInterval = null;

      const getCardsPerView = () => {
        if (window.innerWidth >= 1024) return 3;
        if (window.innerWidth >= 720) return 2;
        return 1;
      };

      const getMaxIndex = () => {
        const perView = getCardsPerView();
        return Math.max(0, cards.length - perView);
      };

      const updateDots = () => {
        if (!dotsContainer) return;
        dotsContainer.innerHTML = '';
        const maxIndex = getMaxIndex();
        for (let i = 0; i <= maxIndex; i++) {
          const dot = document.createElement('button');
          dot.classList.add('cs-slider-dot');
          if (i === currentIndex) dot.classList.add('active');
          dot.setAttribute('aria-label', `Go to slide ${i + 1}`);
          dot.addEventListener('click', () => {
            goToSlide(i);
            resetAutoPlay();
          });
          dotsContainer.appendChild(dot);
        }
      };

      const updateSlider = () => {
        const maxIndex = getMaxIndex();
        if (currentIndex > maxIndex) currentIndex = maxIndex;
        if (currentIndex < 0) currentIndex = 0;

        const card = cards[0];
        const gap = 24;
        const cardWidth = card.offsetWidth + gap;
        const offset = -(currentIndex * cardWidth);
        track.style.transform = `translate3d(${offset}px, 0, 0)`;

        if (prevBtn) prevBtn.disabled = currentIndex === 0;
        if (nextBtn) nextBtn.disabled = currentIndex >= maxIndex;

        if (dotsContainer) {
          const dots = dotsContainer.querySelectorAll('.cs-slider-dot');
          dots.forEach((dot, idx) => {
            dot.classList.toggle('active', idx === currentIndex);
          });
        }
      };

      const goToSlide = (index) => {
        currentIndex = index;
        updateSlider();
      };

      if (prevBtn) {
        prevBtn.addEventListener('click', () => {
          if (currentIndex > 0) {
            currentIndex--;
            updateSlider();
            resetAutoPlay();
          }
        });
      }

      if (nextBtn) {
        nextBtn.addEventListener('click', () => {
          const maxIndex = getMaxIndex();
          if (currentIndex < maxIndex) {
            currentIndex++;
            updateSlider();
            resetAutoPlay();
          }
        });
      }

      const startAutoPlay = () => {
        autoPlayInterval = setInterval(() => {
          const maxIndex = getMaxIndex();
          if (currentIndex < maxIndex) {
            currentIndex++;
          } else {
            currentIndex = 0;
          }
          updateSlider();
        }, 6000);
      };

      const resetAutoPlay = () => {
        if (autoPlayInterval) clearInterval(autoPlayInterval);
        startAutoPlay();
      };

      slider.addEventListener('mouseenter', () => {
        if (autoPlayInterval) clearInterval(autoPlayInterval);
      });

      slider.addEventListener('mouseleave', () => {
        startAutoPlay();
      });

      window.addEventListener('resize', () => {
        updateDots();
        updateSlider();
      });

      updateDots();
      updateSlider();
      startAutoPlay();
    }
  });
});
