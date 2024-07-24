import { TOGGLE_EVENT } from '../../constants';
import htmlTemplate from './accordion-group.html';
import styleTemplate from './accordion-group.scss';

export class AccordionGroup extends HTMLElement {
  isMultiple = false;
  items = [];

  connectedCallback() {
    const template = document.createDocumentFragment();
    const wrapper = document.createElement('div');
    const style = document.createElement('style');

    wrapper.innerHTML = htmlTemplate;
    style.textContent = styleTemplate;

    template.append(wrapper.firstElementChild);

    this.attachShadow({ mode: 'open' });
    this.shadowRoot.append(style, template);

    this.isMultiple = this.hasAttribute('multiple');
    this.items = this.querySelectorAll('accordion-item');

    this.#initEvents();
  }

  #initEvents() {
    this.addEventListener(TOGGLE_EVENT, (event) => {
      const activeItem = event.detail.item;

      if (this.isMultiple) {
        return;
      }

      this.items.forEach((item) => {
        if (item === activeItem) {
          return;
        }

        item.close();
      });
    });
  }
}
