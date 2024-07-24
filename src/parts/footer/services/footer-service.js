import { NAVIGATION_KEY, OPENED_CLASS } from '../constants';

class FooterService {
  #media = window.matchMedia('(min-width: 1024px)');

  get isDesktop() {
    return this.#media.matches;
  }

  onScreenChanged(callback) {
    callback(this.isDesktop);

    this.#media.addEventListener('change', () => callback(this.isDesktop));
  }

  initNavigationHandler(container, containers) {
    const button = container.querySelector(`[${NAVIGATION_KEY}="button"]`);

    button.addEventListener('click', () => {
      if (footerService.isDesktop) {
        return;
      }

      containers.forEach((item) => {
        if (item === container) {
          return;
        }

        item.classList.remove(OPENED_CLASS);
      });

      container.classList.toggle(OPENED_CLASS);
    });
  }
}

export const footerService = new FooterService();
