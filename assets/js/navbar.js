// Custom mobile panel toggler for the navbar
(function () {
  'use strict';

  var toggle = document.getElementById('mobile-toggle');
  var collapse = document.getElementById('navbar-items');
  var closeBtn = null;

  if (!toggle || !collapse) return;

  // helper to detect mobile viewport
  function isMobile() {
    return window.innerWidth <= 767;
  }

  // prepare collapse element for mobile-panel behavior
  function preparePanel() {
    collapse.classList.add('mobile-panel');
    collapse.setAttribute('aria-hidden', 'true');
    closeBtn = document.getElementById('mobile-close');
    if (closeBtn) {
      closeBtn.addEventListener('click', function (e) {
        e.stopPropagation();
        closePanel();
      });
    }
  }

  function openPanel() {
    if (!isMobile()) return; // only on mobile sizes
    collapse.classList.add('open');
    collapse.style.maxHeight = collapse.scrollHeight + 'px';
    collapse.setAttribute('aria-hidden', 'false');
    toggle.setAttribute('aria-expanded', 'true');
    document.body.classList.add('mobile-panel-open');
    // trap clicks outside to close
    setTimeout(function () {
      document.addEventListener('click', outsideClick);
      document.addEventListener('keydown', onKeyDown);
    }, 0);
  }

  function closePanel() {
    collapse.classList.remove('open');
    collapse.style.maxHeight = '0px';
    collapse.setAttribute('aria-hidden', 'true');
    toggle.setAttribute('aria-expanded', 'false');
    document.body.classList.remove('mobile-panel-open');
    document.removeEventListener('click', outsideClick);
    document.removeEventListener('keydown', onKeyDown);
  }

  function togglePanel(e) {
    e && e.preventDefault();
    if (!isMobile()) return; // ignore on larger screens
    if (collapse.classList.contains('open')) closePanel();
    else openPanel();
  }

  function outsideClick(e) {
    if (!collapse) return;
    if (collapse.contains(e.target) || toggle.contains(e.target)) return;
    closePanel();
  }

  function onKeyDown(e) {
    if (e.key === 'Escape' || e.key === 'Esc') {
      closePanel();
    }
  }

  // close on nav link click (mobile)
  collapse.addEventListener('click', function (e) {
    var target = e.target;
    if (target.tagName === 'A' && isMobile()) {
      // allow anchor navigation but close panel
      setTimeout(closePanel, 60);
    }
  });

  // attach toggle
  toggle.addEventListener('click', function (e) {
    togglePanel(e);
  });

  // initialize on load and on resize
  function init() {
    if (isMobile()) preparePanel();
    else {
      // ensure panel closed and remove mobile class on larger screens
      collapse.classList.remove('mobile-panel', 'open');
      collapse.style.maxHeight = '';
      collapse.setAttribute('aria-hidden', 'false');
    }
  }

  window.addEventListener('load', init);
  window.addEventListener('resize', function () {
    // close when resizing to desktop
    if (!isMobile()) closePanel();
    init();
  });

})();
