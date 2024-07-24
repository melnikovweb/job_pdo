import {
  BURGER_BUTTON_SELECTOR,
  HEADER_BUTTON_THEMES_MAP,
  DATA_HEADER_THEME_NAME,
  MOBILE_HEADER_SELECTOR,
  PRIMARY_HEADER_SELECTOR,
} from '../constants';

class HeaderService {
  primaryHeader = document.querySelector(PRIMARY_HEADER_SELECTOR);
  mobileHeader = document.querySelector(MOBILE_HEADER_SELECTOR);
  burgerButton = this.primaryHeader.querySelector(BURGER_BUTTON_SELECTOR);

  #headerTheme = this.primaryHeader.getAttribute(DATA_HEADER_THEME_NAME);

  #isMobileMenuOpened = false;

  setTheme(theme) {
    this.#headerTheme = theme;

    this.primaryHeader.setAttribute(DATA_HEADER_THEME_NAME, this.#headerTheme);
    this.mobileHeader.setAttribute(DATA_HEADER_THEME_NAME, this.#headerTheme);
  }

  toggleMobileMenu() {
    const primatyHeaderHeight = this.primaryHeader.offsetHeight;
    const closeClass = this.burgerButton.dataset.iconClose;
    const openClass = this.burgerButton.dataset.iconOpen;

    this.mobileHeader.style.setProperty('--primary-header-height', `${primatyHeaderHeight}px`);

    this.#isMobileMenuOpened = !this.#isMobileMenuOpened;
    this.mobileHeader.ariaExpanded = this.#isMobileMenuOpened;

    document.body.setAttribute('data-scroll', this.#isMobileMenuOpened ? 'none' : 'scroll');

    this.burgerButton.classList.toggle(closeClass, this.#isMobileMenuOpened);
    this.burgerButton.classList.toggle(openClass, !this.#isMobileMenuOpened);
  }

  initThemeChangeHandler() {
    const observer = new MutationObserver((mutationList) => {
      for (const mutation of mutationList) {
        if (!mutation.type === 'attributes' && mutation.attributeName !== DATA_HEADER_THEME_NAME) {
          return;
        }

        this.#onThemeChanged();
      }
    });

    observer.observe(this.primaryHeader, {
      attributes: true,
      childList: false,
      subtree: false,
    });
  }

  #onThemeChanged() {
    const actions = [
      ...this.primaryHeader.querySelectorAll('[data-action]'),
      ...this.mobileHeader.querySelectorAll('[data-action]'),
    ];

    const buttonThemes = HEADER_BUTTON_THEMES_MAP[this.#headerTheme];

    actions.forEach((action) => {
      const actionName = action.dataset.action;

      if (!actionName) {
        return;
      }

      const theme = buttonThemes[actionName];
      action.dataset.style = theme;
    });
  }
}

export const headerService = new HeaderService();
