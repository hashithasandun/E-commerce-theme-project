/* ============================================================
   RStore - Product Image Slider / 360° Viewer
   Handles product main gallery thumbnails, drag 360° rotate,
   related products slide deck track, and hover image zooming.
   ============================================================ */
'use strict';

const ProductSlider = {
  currentIndex: 0,
  images: [],
  is360Active: false,
  drag360Start: null,
  drag360Current: 0,

  init() {
    this.initThumbnails();
    this.init360Viewer();
    this.initRelatedSlider();
    this.initImageZoom();
  },

  initThumbnails() {
    const thumbs = document.querySelectorAll('.product-thumb');
    const mainImg = document.querySelector('.product-main-img');

    thumbs.forEach((thumb, i) => {
      thumb.addEventListener('click', () => {
        thumbs.forEach(t => t.classList.remove('active'));
        thumb.classList.add('active');
        this.currentIndex = i;

        if (mainImg) {
          mainImg.style.opacity = '0';
          mainImg.style.transform = 'scale(0.95)';
          setTimeout(() => {
            const src = thumb.querySelector('img')?.src;
            if (src) mainImg.src = src;
            mainImg.style.opacity = '1';
            mainImg.style.transform = 'scale(1)';
          }, 200);
        }
      });
    });
  },

  init360Viewer() {
    const badge = document.querySelector('.gallery-360-badge');
    const mainWrap = document.querySelector('.product-main-img-wrap');

    if (!badge || !mainWrap) return;

    badge.addEventListener('click', () => {
      this.is360Active = !this.is360Active;

      if (this.is360Active) {
        badge.innerHTML = '⟳ Drag to Rotate (360°)';
        mainWrap.style.cursor = 'grab';
        mainWrap.classList.add('viewer-360-active');
        this.show360Hint(mainWrap);
      } else {
        badge.innerHTML = '360° View';
        mainWrap.style.cursor = 'zoom-in';
        mainWrap.classList.remove('viewer-360-active');
      }
    });

    mainWrap.addEventListener('mousedown', (e) => {
      if (!this.is360Active) return;
      this.drag360Start = e.clientX;
      mainWrap.style.cursor = 'grabbing';
    });

    document.addEventListener('mousemove', (e) => {
      if (!this.is360Active || this.drag360Start === null) return;
      const delta = e.clientX - this.drag360Start;
      this.drag360Current += delta;
      this.drag360Start = e.clientX;

      const img = mainWrap.querySelector('.product-main-img');
      if (img) {
        img.style.filter = `hue-rotate(${this.drag360Current * 0.5}deg)`;
        img.style.transform = `scale(1) perspective(500px) rotateY(${this.drag360Current * 0.2}deg)`;
      }
    });

    document.addEventListener('mouseup', () => {
      this.drag360Start = null;
      if (this.is360Active) mainWrap.style.cursor = 'grab';
    });
  },

  show360Hint(el) {
    const hint = document.createElement('div');
    hint.style.cssText = `
      position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);
      background:rgba(0,0,0,0.7);color:white;padding:8px 16px;border-radius:20px;
      font-size:13px;pointer-events:none;z-index:10;transition:opacity 0.3s;
    `;
    hint.textContent = '← Drag to rotate →';
    el.appendChild(hint);
    setTimeout(() => { hint.style.opacity = '0'; setTimeout(() => hint.remove(), 300); }, 2000);
  },

  initRelatedSlider() {
    const track = document.querySelector('.related-products-track');
    const prevBtn = document.querySelector('[data-related-prev]');
    const nextBtn = document.querySelector('[data-related-next]');

    if (!track) return;

    let position = 0;
    const itemWidth = 280; // px
    const visibleItems = 4;

    if (nextBtn) {
      nextBtn.addEventListener('click', () => {
        const maxItems = track.children.length - visibleItems;
        if (position < maxItems) {
          position++;
          track.style.transform = `translateX(-${position * itemWidth}px)`;
        }
      });
    }

    if (prevBtn) {
      prevBtn.addEventListener('click', () => {
        if (position > 0) {
          position--;
          track.style.transform = `translateX(-${position * itemWidth}px)`;
        }
      });
    }
  },

  initImageZoom() {
    const mainWrap = document.querySelector('.product-main-img-wrap');
    if (!mainWrap) return;

    mainWrap.addEventListener('mousemove', (e) => {
      if (document.querySelector('.viewer-360-active')) return;
      const img = mainWrap.querySelector('.product-main-img');
      if (!img) return;

      const rect = mainWrap.getBoundingClientRect();
      const x = ((e.clientX - rect.left) / rect.width) * 100;
      const y = ((e.clientY - rect.top) / rect.height) * 100;

      img.style.transformOrigin = `${x}% ${y}%`;
    });

    mainWrap.addEventListener('mouseenter', () => {
      const img = mainWrap.querySelector('.product-main-img');
      if (img && !this.is360Active) img.style.transform = 'scale(1.3)';
    });

    mainWrap.addEventListener('mouseleave', () => {
      const img = mainWrap.querySelector('.product-main-img');
      if (img) img.style.transform = 'scale(1)';
    });
  },
};
