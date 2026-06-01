/**
 * R Store Premium Features: Product Quick View & Variation Swatches
 */
(function() {
  'use strict';

  document.addEventListener('DOMContentLoaded', function() {
    // Bind click events on all product grid card Quick View triggers
    document.body.addEventListener('click', function(e) {
      var trigger = e.target.closest('[data-quick-view]');
      if (!trigger) return;

      e.preventDefault();
      var productId = trigger.getAttribute('data-product-id');
      if (productId) {
        openQuickView(productId);
      }
    });

    // Close modal triggers
    document.body.addEventListener('click', function(e) {
      if (e.target.closest('[data-close-quick-view]') || e.target.classList.contains('quick-view-overlay')) {
        closeQuickView();
      }
    });

    /**
     * Open Quick View Modal and load product data
     */
    function openQuickView(productId) {
      var overlay = document.getElementById('quick-view-overlay');
      var container = document.getElementById('quick-view-container');

      if (!overlay || !container) return;

      // Show skeleton loading state
      container.innerHTML = '<div class="quick-view-loading"><div class="search-spinner"></div><span>Loading product details...</span></div>';
      overlay.classList.add('active');
      document.body.style.overflow = 'hidden'; // Lock scrolling

      var ajaxUrl = (window.rstore_vars && window.rstore_vars.ajax_url) ? window.rstore_vars.ajax_url : '/wp-admin/admin-ajax.php';
      var requestUrl = ajaxUrl + '?action=rstore_product_quick_view&product_id=' + productId;

      fetch(requestUrl)
        .then(function(response) {
          return response.json();
        })
        .then(function(response) {
          if (response.success && response.data) {
            renderQuickView(response.data);
          } else {
            container.innerHTML = '<div class="quick-view-error">Failed to load product details. Please try again.</div>';
          }
        })
        .catch(function() {
          container.innerHTML = '<div class="quick-view-error">Unable to connect to the server. Please check your connection.</div>';
        });
    }

    /**
     * Close the Quick View Modal
     */
    function closeQuickView() {
      var overlay = document.getElementById('quick-view-overlay');
      if (overlay) {
        overlay.classList.remove('active');
        document.body.style.overflow = ''; // Unlock scrolling
      }
    }

    /**
     * Render product details inside the Quick View container
     */
    function renderQuickView(data) {
      var container = document.getElementById('quick-view-container');
      if (!container) return;

      // Construct slider gallery HTML
      var galleryHtml = '<div class="qv-gallery-slider">';
      if (Array.isArray(data.gallery) && data.gallery.length > 0) {
        data.gallery.forEach(function(imgUrl, idx) {
          galleryHtml += '<div class="qv-gallery-slide' + (idx === 0 ? ' active' : '') + '"><img src="' + imgUrl + '" alt="Product Image ' + (idx + 1) + '" /></div>';
        });
        if (data.gallery.length > 1) {
          galleryHtml += '<button class="qv-gallery-prev" onclick="RStore.prevQVSlide()">❮</button>';
          galleryHtml += '<button class="qv-gallery-next" onclick="RStore.nextQVSlide()">❯</button>';
        }
      }
      galleryHtml += '</div>';

      // Assemble full modal layout
      var html = '<button class="quick-view-close" data-close-quick-view>✕</button>' +
                 '<div class="quick-view-grid">' +
                   '<div class="quick-view-left">' + galleryHtml + '</div>' +
                   '<div class="quick-view-right">' +
                     '<h2 class="quick-view-title">' + RStore.escapeHTML(data.title) + '</h2>' +
                     '<div class="quick-view-price">' + data.price + '</div>' +
                     '<div class="quick-view-desc">' + data.desc + '</div>' +
                     '<div class="quick-view-cart-form">' + data.cart_html + '</div>' +
                   '</div>' +
                 '</div>';

      container.innerHTML = html;

      // Initialize visual variation swatches immediately after rendering
      initializeSwatches(container);
    }

    /**
     * Automatically convert dropdown selectors into premium circular color bubbles and size labels
     */
    function initializeSwatches(modalContainer) {
      var selectFields = modalContainer.querySelectorAll('.quick-view-cart-form select');
      if (selectFields.length === 0) return;

      selectFields.forEach(function(select) {
        var name = select.getAttribute('name') || '';
        var isColor = name.toLowerCase().indexOf('color') !== -1 || name.toLowerCase().indexOf('colour') !== -1;
        var isSize = name.toLowerCase().indexOf('size') !== -1;

        if (!isColor && !isSize) return;

        // Hide the default HTML select box
        select.style.display = 'none';

        // Create the swatches wrapper container
        var swatchesWrapper = document.createElement('div');
        swatchesWrapper.className = 'rstore-swatches-container';
        swatchesWrapper.setAttribute('data-target-select', name);

        var titleLabel = document.createElement('div');
        titleLabel.className = 'rstore-swatches-title';
        titleLabel.innerHTML = 'Select ' + (isColor ? 'Color' : 'Size') + ': <span class="selected-swatch-val">Choose an option</span>';
        swatchesWrapper.appendChild(titleLabel);

        var listContainer = document.createElement('div');
        listContainer.className = 'rstore-swatches-list';

        var options = select.querySelectorAll('option');
        options.forEach(function(option) {
          var value = option.value;
          var text = option.textContent;

          if (!value) return; // Skip "Choose an option" placeholder

          var swatchItem = document.createElement('button');
          swatchItem.type = 'button';
          swatchItem.className = 'rstore-swatch-item' + (isColor ? ' color-swatch' : ' size-swatch');
          swatchItem.setAttribute('data-value', value);
          swatchItem.title = text;

          if (isColor) {
            // Map common color names to real CSS values, fallback to generic styling
            var colorVal = value.toLowerCase();
            var mappedColor = colorVal;
            if (colorVal === 'black') mappedColor = '#222222';
            else if (colorVal === 'white') mappedColor = '#fcfcfc';
            else if (colorVal === 'red') mappedColor = '#EE4B2B';
            else if (colorVal === 'blue') mappedColor = '#0047AB';
            else if (colorVal === 'green') mappedColor = '#3F704D';
            else if (colorVal === 'yellow') mappedColor = '#FFC000';
            else if (colorVal === 'grey' || colorVal === 'gray') mappedColor = '#808080';
            else if (colorVal === 'pink') mappedColor = '#FFC0CB';
            else if (colorVal === 'gold') mappedColor = '#D4AF37';

            swatchItem.style.backgroundColor = mappedColor;
            if (colorVal === 'white') {
              swatchItem.style.border = '1px solid #dddddd';
            }
          } else {
            swatchItem.textContent = text;
          }

          // Handle click event on the swatch item
          swatchItem.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Toggle active state in the list UI
            listContainer.querySelectorAll('.rstore-swatch-item').forEach(function(btn) {
              btn.classList.remove('active');
            });
            swatchItem.classList.add('active');

            // Update selected value text label
            titleLabel.querySelector('.selected-swatch-val').textContent = text;

            // Trigger the change in the hidden WooCommerce HTML select element
            select.value = value;
            var changeEvent = new Event('change', { bubbles: true });
            select.dispatchEvent(changeEvent);
          });

          listContainer.appendChild(swatchItem);
        });

        swatchesWrapper.appendChild(listContainer);
        select.parentNode.insertBefore(swatchesWrapper, select.nextSibling);
      });
    }
  });

  // Expose slide controls globally under the RStore namespace
  window.RStore = window.RStore || {};
  
  window.RStore.prevQVSlide = function() {
    var slides = document.querySelectorAll('.qv-gallery-slide');
    if (slides.length <= 1) return;
    var activeIdx = -1;
    slides.forEach(function(s, idx) {
      if (s.classList.contains('active')) activeIdx = idx;
    });
    slides[activeIdx].classList.remove('active');
    var nextIdx = activeIdx - 1 < 0 ? slides.length - 1 : activeIdx - 1;
    slides[nextIdx].classList.add('active');
  };

  window.RStore.nextQVSlide = function() {
    var slides = document.querySelectorAll('.qv-gallery-slide');
    if (slides.length <= 1) return;
    var activeIdx = -1;
    slides.forEach(function(s, idx) {
      if (s.classList.contains('active')) activeIdx = idx;
    });
    slides[activeIdx].classList.remove('active');
    var nextIdx = activeIdx + 1 >= slides.length ? 0 : activeIdx + 1;
    slides[nextIdx].classList.add('active');
  };
})();
