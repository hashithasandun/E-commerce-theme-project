/**
 * R Store Premium Features: AJAX Instant Search & Auto-Complete
 */
(function () {
  'use strict';

  document.addEventListener('DOMContentLoaded', function () {
    var searchInput = document.querySelector('.header-search-input');
    var dropdown = document.getElementById('search-dropdown');

    if (!searchInput || !dropdown) return;

    var debounceTimer;
    var currentRequest = null;

    // Listen to keystrokes
    searchInput.addEventListener('input', function () {
      var query = searchInput.value.trim();

      clearTimeout(debounceTimer);

      if (query.length < 2) {
        dropdown.innerHTML = '';
        dropdown.classList.remove('active');
        return;
      }

      // Show beautiful loading state
      dropdown.innerHTML = '<div class="search-loading"><div class="search-spinner"></div><span>Searching for "' + RStore.escapeHTML(query) + '"...</span></div>';
      dropdown.classList.add('active');

      // Debounce the actual fetch request by 300ms
      debounceTimer = setTimeout(function () {
        performSearch(query);
      }, 300);
    });

    // Close search dropdown on click outside
    document.addEventListener('click', function (e) {
      if (!searchInput.contains(e.target) && !dropdown.contains(e.target)) {
        dropdown.classList.remove('active');
      }
    });

    // Focus triggers showing previous results if available
    searchInput.addEventListener('focus', function () {
      if (dropdown.innerHTML !== '' && searchInput.value.trim().length >= 2) {
        dropdown.classList.add('active');
      }
    });

    /**
     * Perform the AJAX search request
     */
    function performSearch(query) {
      // Abort previous pending request if any
      if (currentRequest) {
        currentRequest.abort();
      }

      var controller = new AbortController();
      currentRequest = controller;

      var ajaxUrl = (window.rstore_vars && window.rstore_vars.ajax_url) ? window.rstore_vars.ajax_url : '/wp-admin/admin-ajax.php';
      var requestUrl = ajaxUrl + '?action=rstore_ajax_search&term=' + encodeURIComponent(query);

      fetch(requestUrl, { signal: controller.signal })
        .then(function (response) {
          return response.json();
        })
        .then(function (response) {
          if (response.success && Array.isArray(response.data)) {
            renderResults(response.data, query);
          } else {
            dropdown.innerHTML = '<div class="search-no-results">An error occurred. Please try again.</div>';
          }
        })
        .catch(function (err) {
          if (err.name !== 'AbortError') {
            dropdown.innerHTML = '<div class="search-no-results">No products found matching "' + RStore.escapeHTML(query) + '"</div>';
          }
        });
    }

    /**
     * Render the search result list
     */
    function renderResults(products, query) {
      if (products.length === 0) {
        dropdown.innerHTML = '<div class="search-no-results">No products found matching "' + RStore.escapeHTML(query) + '"</div>';
        return;
      }

      var html = '<div class="search-results-list">';
      products.forEach(function (product) {
        html += '<a href="' + esc_url(product.permalink) + '" class="search-result-item">' +
          '<img src="' + esc_url(product.image) + '" alt="' + RStore.escapeHTML(product.title) + '" class="search-result-img" />' +
          '<div class="search-result-details">' +
          '<h4 class="search-result-title">' + RStore.escapeHTML(product.title) + '</h4>' +
          '<div class="search-result-price">' + product.price + '</div>' +
          '</div>' +
          '</a>';
      });
      html += '</div>';

      dropdown.innerHTML = html;
    }

    // Helper functions to prevent XSS
    function esc_url(url) {
      if (!url) return '#';
      return url.replace(/["']/g, '');
    }
  });
})();
