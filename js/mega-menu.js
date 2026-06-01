/* ============================================================
   RStore - Mega Menu Module
   Controls multi-column mega menus on desktop with delays,
   and mobile nav dropdown accordion menus.
   ============================================================ */
'use strict';

const MegaMenu = {
  init() {
    // Desktop mega menu
    const navItems = document.querySelectorAll('.nav-item');
    navItems.forEach(item => {
      const megaMenu = item.querySelector('.mega-menu');
      if (!megaMenu) return;

      let timeout;

      item.addEventListener('mouseenter', () => {
        clearTimeout(timeout);
        megaMenu.style.opacity = '1';
        megaMenu.style.visibility = 'visible';
        megaMenu.style.transform = 'translateX(-50%) translateY(0)';
      });

      item.addEventListener('mouseleave', () => {
        timeout = setTimeout(() => {
          megaMenu.style.opacity = '0';
          megaMenu.style.visibility = 'hidden';
          megaMenu.style.transform = 'translateX(-50%) translateY(10px)';
        }, 150);
      });

      megaMenu.addEventListener('mouseenter', () => clearTimeout(timeout));
      megaMenu.addEventListener('mouseleave', () => {
        timeout = setTimeout(() => {
          megaMenu.style.opacity = '0';
          megaMenu.style.visibility = 'hidden';
          megaMenu.style.transform = 'translateX(-50%) translateY(10px)';
        }, 150);
      });
    });

    // Mobile nav accordion
    document.querySelectorAll('.mobile-nav-link[data-has-children]').forEach(link => {
      link.addEventListener('click', (e) => {
        e.preventDefault();
        const sub = link.nextElementSibling;
        if (!sub) return;
        const isOpen = sub.style.display === 'block';
        sub.style.display = isOpen ? 'none' : 'block';
        link.querySelector('.nav-arrow')?.classList.toggle('rotated', !isOpen);
      });
    });
  }
};
