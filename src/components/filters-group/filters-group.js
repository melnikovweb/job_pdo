import htmlTemplate from './filters-group.html';
import styleTemplate from './filters-group.scss';

class FiltersGroup extends HTMLElement {
  isOpened = false;
  isInitialized = false;
  isAnimating = false;
  contentHeight;

  constructor() {
    super();

    this.#init();
  }

  #init() {
    const template = document.createDocumentFragment();
    const wrapper = document.createElement('div');
    const style = document.createElement('style');

    wrapper.innerHTML = htmlTemplate;
    style.textContent = styleTemplate;

    template.append(wrapper.firstElementChild);

    this.attachShadow({ mode: 'open' });
    this.shadowRoot.append(style, template);

    this.elements = this.#getElements();

    this.#initMediaQuery();
    this.#initToggleHandler();
  }

  dropdownInit() {
    const { content, button } = this.elements;

    button.hidden = false;
    content.style.overflow = 'hidden';
    content.style.height = 0;
    content.style.opacity = 0;

    this.contentHeight = this.elements.content.scrollHeight;

    this.isInitialized = true;
  }

  dropdownDestroy() {
    const { content, button } = this.elements;

    content.removeAttribute('style');
    button.hidden = true;

    this.isInitialized = false;
  }

  dropdownToggle(isOpened) {
    const { content } = this.elements;
    this.isOpened = isOpened || !this.isOpened;
    this.isAnimating = true;

    content.style.overflow = 'hidden';

    const getStyles = (state) =>
      state
        ? {
            height: 0,
            opacity: 0,
          }
        : {
            height: `${this.contentHeight}px`,
            opacity: 1,
          };

    const keyFrames = [getStyles(this.isOpened), getStyles(!this.isOpened)];

    const animationOptions = {
      duration: 300,
      easing: 'ease-in-out',
      fill: 'forwards',
    };

    const animation = content.animate(keyFrames, animationOptions);

    animation.finished.then(() => {
      this.isAnimating = false;

      if (!this.isOpened) {
        return;
      }

      content.style.overflow = 'visible';
    });
  }

  #getElements() {
    return {
      container: this.shadowRoot.querySelector('.filters-group'),
      button: this.shadowRoot.querySelector('.filters-group__button-wrapper'),
      content: this.shadowRoot.querySelector('.filters-group__content'),
    };
  }

  #initMediaQuery() {
    const mediaQuery = window.matchMedia('(min-width: 1024px)');

    const updateStates = (query) => {
      if (query.matches) {
        return this.dropdownDestroy();
      }

      this.dropdownInit();
    };

    updateStates(mediaQuery);
    mediaQuery.addEventListener('change', updateStates);
  }

  #initToggleHandler() {
    const { button } = this.elements;

    button.addEventListener('click', () => {
      if (this.isAnimating) {
        return;
      }

      this.dropdownToggle();
    });
  }
}

window.customElements.define('filters-group', FiltersGroup);
