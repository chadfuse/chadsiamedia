function csToggleFaq(btn) {
  if (!btn) return;
  var item = btn.closest('.cs-faq-item');
  if (!item) return;
  var list = item.closest('.cs-faq-list') || item.parentElement;
  var isActive = item.classList.contains('active');

  if (list) {
    var activeItems = list.querySelectorAll('.cs-faq-item.active');
    for (var i = 0; i < activeItems.length; i++) {
      if (activeItems[i] !== item) {
        activeItems[i].classList.remove('active');
        var otherBtn = activeItems[i].querySelector('.cs-faq-btn');
        if (otherBtn) otherBtn.setAttribute('aria-expanded', 'false');
      }
    }
  }

  if (isActive) {
    item.classList.remove('active');
    btn.setAttribute('aria-expanded', 'false');
  } else {
    item.classList.add('active');
    btn.setAttribute('aria-expanded', 'true');
  }
}
window.csToggleFaq = csToggleFaq;

document.addEventListener('DOMContentLoaded', () => {
  // 1. FAQ Accordion (Delegated & Idempotent Fallback)
  if (!window.__csFaqAccordionInitialized) {
    window.__csFaqAccordionInitialized = true;
    document.addEventListener('click', (e) => {
      const btn = e.target.closest('.cs-faq-btn');
      if (btn) {
        e.preventDefault();
        csToggleFaq(btn);
      }
    });
  }

  // 2. Smooth Scroll for In-Page Anchors
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
      const href = this.getAttribute('href');
      if (href && href.length > 1) {
        const target = document.querySelector(href);
        if (target) {
          e.preventDefault();
          target.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
      }
    });
  });

  // 3. Global Reviews Slider
  const slider = document.querySelector('.cs-reviews-slider');
  if (slider) {
    const track = slider.querySelector('.cs-reviews-track');
    const prevBtn = slider.querySelector('.cs-slider-btn.prev');
    const nextBtn = slider.querySelector('.cs-slider-btn.next');
    const dotsContainer = slider.querySelector('.cs-slider-dots');
    const cards = slider.querySelectorAll('.cs-review-card');

    if (track && cards.length > 0) {
      let currentIndex = 0;
      let startX = 0;
      let isDragging = false;
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

      // Create Dot Indicators
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
        const perView = getCardsPerView();
        const maxIndex = getMaxIndex();
        if (currentIndex > maxIndex) currentIndex = maxIndex;

        // Calculate card width including gap
        const card = cards[0];
        const gap = 24;
        const cardWidth = card.offsetWidth + gap;
        const offset = -(currentIndex * cardWidth);

        track.style.transform = `translateX(${offset}px)`;

        // Update button states
        if (prevBtn) prevBtn.disabled = currentIndex === 0;
        if (nextBtn) nextBtn.disabled = currentIndex >= maxIndex;

        // Update active dots
        if (dotsContainer) {
          const dots = dotsContainer.querySelectorAll('.cs-slider-dot');
          dots.forEach((dot, idx) => {
            dot.classList.toggle('active', idx === currentIndex);
          });
        }
      };

      const goToSlide = (index) => {
        const maxIndex = getMaxIndex();
        currentIndex = Math.max(0, Math.min(index, maxIndex));
        updateSlider();
      };

      if (prevBtn) {
        prevBtn.addEventListener('click', () => {
          goToSlide(currentIndex - 1);
          resetAutoPlay();
        });
      }

      if (nextBtn) {
        nextBtn.addEventListener('click', () => {
          const maxIndex = getMaxIndex();
          if (currentIndex >= maxIndex) {
            goToSlide(0);
          } else {
            goToSlide(currentIndex + 1);
          }
          resetAutoPlay();
        });
      }

      // Touch / Swipe support
      track.addEventListener('touchstart', (e) => {
        startX = e.touches[0].clientX;
        isDragging = true;
      }, { passive: true });

      track.addEventListener('touchend', (e) => {
        if (!isDragging) return;
        isDragging = false;
        const endX = e.changedTouches[0].clientX;
        const diffX = startX - endX;

        if (Math.abs(diffX) > 50) {
          if (diffX > 0) {
            goToSlide(currentIndex + 1);
          } else {
            goToSlide(currentIndex - 1);
          }
          resetAutoPlay();
        }
      }, { passive: true });

      // Auto Play
      const startAutoPlay = () => {
        autoPlayInterval = setInterval(() => {
          const maxIndex = getMaxIndex();
          if (currentIndex >= maxIndex) {
            goToSlide(0);
          } else {
            goToSlide(currentIndex + 1);
          }
        }, 5500);
      };

      const resetAutoPlay = () => {
        clearInterval(autoPlayInterval);
        startAutoPlay();
      };

      slider.addEventListener('mouseenter', () => clearInterval(autoPlayInterval));
      slider.addEventListener('mouseleave', () => startAutoPlay());

      window.addEventListener('resize', () => {
        updateDots();
        updateSlider();
      });

      updateDots();
      updateSlider();
      startAutoPlay();
    }
  }
});
