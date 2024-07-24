import htmlTemplate from './text-clamp.html';
import styleTemplate from './text-clamp.scss';

class TextClamp extends HTMLElement {
  constructor() {
    super();

    const wrapper = document.createElement('div');
    const template = document.createDocumentFragment();
    const style = document.createElement('style');

    wrapper.innerHTML = htmlTemplate;
    style.textContent = styleTemplate;

    template.append(wrapper.firstElementChild);

    this.attachShadow({ mode: 'open' });
    this.shadowRoot.append(style, template);

    this.#init();

    this.#initControl();
    this.#updateState();
  }

  #init() {
    this.options = {
      moreLabel: this.getAttribute('more-label') || 'see more',
      lessLabel: this.getAttribute('less-label') || 'see less',
      clamp: this.getAttribute('clamp') || 2,
    };

    this.elements = {
      container: this.shadowRoot.querySelector('.text-clamp'),
      content: this.shadowRoot.querySelector('.text-clamp__content'),
      button: this.shadowRoot.querySelector('.text-clamp__button'),
      shortText: this.shadowRoot.querySelector(".text-clamp__text[data-type='short']"),
      longText: this.shadowRoot.querySelector(".text-clamp__text[data-type='long']"),
    };

    this.elements.container.style.setProperty('--_text-clamp', this.options.clamp);

    this.elements.button.addEventListener('click', () => {
      if (this.control.isAnimating) {
        return;
      }

      this.control.isExpanded = !this.control.isExpanded;
    });
  }

  #initControl() {
    const { container, button, shortText, longText } = this.elements;

    this.control = new Proxy(
      {
        isExpanded: false,
        isAnimating: false,
        isClamped: true,
      },
      {
        set: (target, property, value) => {
          Reflect.set(target, property, value);

          if (property === 'isExpanded') {
            this.#onExpandedChanged(value);
          }

          if (property === 'isAnimating') {
            container.classList.toggle('animating', value);
          }

          if (property === 'isClamped') {
            button.hidden = !value;

            shortText.hidden = !value;

            container.classList.toggle('expanded', !value);
            Reflect.set(target, 'isExpanded', !value);
          }

          return true;
        },
      },
    );

    this.control.isExpanded = this.hasAttribute('expanded');
    this.control.isClamped = longText.scrollHeight > shortText.offsetHeight;
  }

  #updateState() {
    const { isExpanded } = this.control;
    const { lessLabel, moreLabel } = this.options;
    const { container, button } = this.elements;

    button.innerHTML = `
      <span> 
        ${isExpanded ? lessLabel : moreLabel}
      </span>
    `;

    container.classList.toggle('expanded', isExpanded);
  }

  #onExpandedChanged(isExpanded) {
    const { longText, shortText, content } = this.elements;

    const animationOptions = {
      duration: 300,
      iterations: 1,
      easing: 'ease-out',
    };

    const longHeight = `${longText.scrollHeight}px`;
    const shortHeight = `${shortText.offsetHeight}px`;

    const startHeight = !isExpanded ? longHeight : shortHeight;
    const endHeight = isExpanded ? longHeight : shortHeight;

    content.style.height = endHeight;
    this.control.isAnimating = true;

    const animation = content.animate([{ height: startHeight }, { height: endHeight }], animationOptions);

    animation.finished.then(() => {
      this.control.isAnimating = false;
      this.#updateState();
    });
  }
}

window.customElements.define('text-clamp', TextClamp);
