import { onDomReady } from '@shared/services/dom-services';

onDomReady(() => {
  const elements = document.querySelectorAll('[data-src-defer]');

  const options = {
    rootMargin: `0px 0px 50px 0px`,
    threshold: [0],
  };

  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        if (entry.target.getAttribute('src')) {
          observer.unobserve(entry.target);
          return;
        }
        entry.target.setAttribute('src', entry.target.dataset.srcDefer);
      }
    });
  }, options);

  elements.forEach((section) => observer.observe(section));
});
