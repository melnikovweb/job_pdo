import Choices from 'choices';

export function useCustomSelect() {
  const createStructure = (instance) => {
    const elements = {
      wrapper: document.createElement('div'),
      inner: instance.containerInner.element,
      input: instance.input.element,
      outer: instance.containerOuter.element,
    };

    elements.outer.classList.add('icon-chevron-down');

    elements.wrapper.classList.add('filters-search-wrapper');
    elements.wrapper.classList.add('icon-search');
    elements.wrapper.append(elements.input);

    elements.inner.append(elements.wrapper);

    instance.passedElement.element.addEventListener('showDropdown', () => {
      elements.input.focus();
    });

    return elements;
  };

  const init = (element, options = {}) => {
    if (!element) {
      return null;
    }

    const instance = new Choices(element, {
      itemSelectText: '',
      allowHTML: true,
      ...options,
    });

    createStructure(instance);

    return instance;
  };

  return {
    init,
    createStructure,
  };
}
