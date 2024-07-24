class Dropdown {
  element = null;
  trigger = null;
  isExpanded = false;

  #subscribers = [];

  constructor(element) {
    this.element = element;
    this.trigger = this.element.querySelector('a');

    this.element.ariaExpanded = this.isExpanded;
    this.trigger.removeAttribute('href');
  }

  close() {
    this.isExpanded = false;
    this.element.ariaExpanded = this.isExpanded;
  }

  open() {
    this.isExpanded = true;
    this.element.ariaExpanded = this.isExpanded;
  }

  toggle() {
    this.isExpanded = !this.isExpanded;
    this.element.ariaExpanded = this.isExpanded;
  }

  onClick(callback) {
    this.trigger.addEventListener('click', () => {
      callback();
    });
  }
}

export function useNavigation(elements) {
  const navigationItems = Array.from(elements, (element) => new Dropdown(element));

  navigationItems.forEach((currentItem) => {
    currentItem.onClick(() => {
      navigationItems.forEach((item) => {
        if (currentItem === item) {
          return;
        }

        item.close();
      });

      currentItem.toggle();
    });
  });

  const navigationCloseAll = () => {
    navigationItems.forEach((dropdown) => dropdown.close());
  };

  return {
    navigationItems,
    navigationCloseAll,
  };
}
