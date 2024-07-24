import { TOGGLE_EVENT } from '../../constants';
import htmlTemplate from './accordion-item.html';
import styleTemplate from './accordion-item.scss';

export class AccordionItem extends HTMLElement {
  isOpen = false;
  elements = {};

  connectedCallback() {
    const template = document.createDocumentFragment();
    const wrapper = document.createElement('div');
    const style = document.createElement('style');

    wrapper.innerHTML = htmlTemplate;
    style.textContent = styleTemplate;

    template.append(wrapper.firstElementChild);

    this.attachShadow({ mode: 'open' });
    this.shadowRoot.append(style, template);

    this.isOpen = this.hasAttribute('open');
    this.elements = this.#getElements();

    const { summary, container } = this.elements;

    container.setAttribute('data-theme', this.getAttribute('theme') ?? 'black');
    summary.innerHTML = this.getAttribute('summary');

    this.#initEvents();
    this.#handleStates();
  }

  toggle() {
    this.isOpen = !this.isOpen;
    this.#handleStates();
  }

  close() {
    this.isOpen = false;
    this.#handleStates();
  }

  #getElements() {
    return {
      group: this.closest('accordion-group'),
      container: this.shadowRoot.querySelector('.accordion-item'),
      header: this.shadowRoot.querySelector('.accordion-item__header'),
      content: this.shadowRoot.querySelector('.accordion-item__content'),
      summary: this.shadowRoot.querySelector('.accordion-item__summary'),
    };
  }

  #initEvents() {
    const { header, group } = this.elements;

    header.addEventListener('click', () => {
      this.toggle();

      if (!group) {
        return;
      }

      const event = new CustomEvent(TOGGLE_EVENT, {
        detail: { item: this },
      });

      group.dispatchEvent(event);
    });
  }

  #handleStates() {
    this.elements.container.classList.toggle('active', this.isOpen);
  }
}
