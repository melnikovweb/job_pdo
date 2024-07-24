import { onDomReady } from '@shared/services/dom-services';
import { headerService } from '@shared/services/header-service';
import { AVAILABLE_THEMES } from '@shared/constants';

onDomReady(() => {
  const headerOffset = headerService.primaryHeader.offsetHeight;
  const sections = [...document.querySelectorAll('[data-theme]')];

  const options = {
    rootMargin: `-${headerOffset}px 0px -${window.innerHeight - headerOffset}px 0px`,
    threshold: [0],
  };

  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        const theme = entry.target.dataset.theme;
        const isThemeExist = Object.values(AVAILABLE_THEMES).includes(theme);

        headerService.setTheme(isThemeExist ? theme : AVAILABLE_THEMES.WHITE);
      }
    });
  }, options);

  sections.forEach((section) => observer.observe(section));

  headerService.initThemeChangeHandler();
});
