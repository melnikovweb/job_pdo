import htmlTemplate from './tab-item.html';
import styleTemplate from './tab-item.scss';

export class TabItem extends HTMLElement {
  elements = null;
  control = null;

  static observedAttributes = ['active'];

  constructor() {
    super();

    const template = document.createDocumentFragment();
    const wrapper = document.createElement('div');
    const style = document.createElement('style');

    wrapper.innerHTML = htmlTemplate;
    style.textContent = styleTemplate;

    template.append(wrapper.firstElementChild);

    this.attachShadow({ mode: 'open' });
    this.shadowRoot.append(style, template);

    this.elements = this.#getElements();
    this.control = this.#getControl();
  }

  attributeChangedCallback(name, _, value) {
    const attributesMap = {
      active: () => {
        this.control.isActive = !!value;
      },
    };

    attributesMap[name]();
  }

  #getElements() {
    return {
      group: this.parentElement,
      container: this.shadowRoot.querySelector('.tab-item'),
    };
  }

  #getControl() {
    return new Proxy(
      {
        isActive: false,
      },
      {
        set: (target, property, value) => {
          const callbackPropsMap = {
            isActive: this.#onActiveStateChanged,
          };

          return callbackPropsMap[property].call(this, target, property, value);
        },
      },
    );
  }

  #onActiveStateChanged(target, property, value) {
    this.elements.container.classList.toggle('active', value);

    return Reflect.set(target, property, value);
  }
}
