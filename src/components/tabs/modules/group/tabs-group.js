import { BOOLEAN_MAP } from '../../constants';
import htmlTemplate from './tabs-group.html';
import styleTemplate from './tabs-group.scss';

export class TabsGroup extends HTMLElement {
  elements = {};
  items = [];
  labels = [];
  clonedLabels = [];

  control = null;

  isDropdownView = true;

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

    this.items = this.#getItems();
    this.elements = this.#getElements();
    this.control = this.#getTabsControl();
  }

  connectedCallback() {
    this.elements.navigation.addEventListener('click', (event) => this.#onHeaderClick(event), true);

    window.addEventListener('click', (event) => this.#onOutsideClick(event), true);

    this.clonedLabels = this.labels.map((label) => {
      const clonedLabel = label.cloneNode(true);
      clonedLabel.ariaHidden = true;

      return clonedLabel;
    });

    this.elements.controls.append(...this.labels);
    this.elements.dropdown.append(...this.clonedLabels);

    this.control.activeIndex = this.getAttribute('initialIndex') ?? 0;

    this.elements.navigation.hidden = !(BOOLEAN_MAP[this.getAttribute('is-single-shown')] ?? true);

    this.elements.container.setAttribute('data-primary-theme', this.getAttribute('primary-theme') ?? 'blue');
    this.elements.container.setAttribute('data-secondary-theme', this.getAttribute('secondary-theme') ?? 'white');
    this.elements.container.setAttribute('data-border-theme', this.getAttribute('border-theme') ?? 'dark');

    this.#initMedia();
  }

  onChange(callback) {
    this.addEventListener('on-tab-index-changed', () => callback(this.control.activeIndex));
  }

  #initMedia() {
    const media = window.matchMedia('(min-width: 1024px)');

    const onMediaChanged = (query) => (this.isDropdownView = !query.matches);

    onMediaChanged(media);
    media.addEventListener('change', onMediaChanged);
  }

  #onHeaderClick(event) {
    if (this.isDropdownView) {
      this.control.isOpened = !this.control.isOpened;
    }

    const currentLabel = event.target.closest('[data-index]');

    if (!currentLabel) {
      return;
    }

    this.control.activeIndex = currentLabel.dataset.index;
  }

  #onOutsideClick(event) {
    if (event.composedPath().includes(this)) {
      return;
    }

    this.control.isOpened = false;
  }

  #onActiveIndexChanged(target, property, value) {
    const previousIndex = Reflect.get(target, property);
    const activeIndex = parseInt(value, 10);

    if (previousIndex === activeIndex) {
      return true;
    }

    Reflect.set(target, property, activeIndex);

    this.labels.forEach((label, index) => {
      const labelIndex = parseInt(label.dataset.index, 10);
      const item = this.items[index];
      const clonedLabel = this.clonedLabels[index];

      const isActive = activeIndex === labelIndex;

      label.classList.toggle('active', isActive);
      clonedLabel.classList.toggle('active', isActive);

      item.hidden = labelIndex !== activeIndex;

      if (labelIndex === activeIndex) {
        item.setAttribute('active', true);
      } else {
        item.removeAttribute('active');
      }
    });

    this.dispatchEvent(new Event('on-tab-index-changed', { cancelable: false }));

    return true;
  }

  #onHeaderToggle(target, property, value) {
    Reflect.set(target, property, value);

    const { navigation } = this.elements;

    navigation.classList.toggle('opened', value);

    return true;
  }

  #getElements() {
    return {
      container: this.shadowRoot.querySelector('.tabs-group'),
      navigation: this.shadowRoot.querySelector('.tabs-group__navigation'),
      header: this.shadowRoot.querySelector('.tabs-group__header'),
      controls: this.shadowRoot.querySelector('.tabs-group__controls'),
      dropdown: this.shadowRoot.querySelector('.tabs-group__dropdown'),
      content: this.shadowRoot.querySelector('.tabs-group__content'),
    };
  }

  #getItems() {
    const getLabelTemplate = (label, index) => `<div class="tabs-group__label" data-index="${index}">${label}</div>`;

    return Array.from(this.querySelectorAll('tab-item'), (item, index) => {
      const label = item.getAttribute('label') ?? `Label ${index}`;
      item.index = index;

      const headerWrapper = document.createElement('div');
      headerWrapper.innerHTML = getLabelTemplate(label, index);

      this.labels.push(headerWrapper.firstElementChild);

      return item;
    });
  }

  #getTabsControl() {
    return new Proxy(
      {
        activeindex: null,
        isopened: false,
      },
      {
        set: (target, property, value) => {
          const callbackPropsMap = {
            activeIndex: this.#onActiveIndexChanged,
            isOpened: this.#onHeaderToggle,
          };

          return callbackPropsMap[property].call(this, target, property, value);
        },
      },
    );
  }
}
