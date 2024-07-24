import { onDomReady } from '@shared/services/dom-services';

onDomReady(async () => {
  const searchFilters = [...document.querySelectorAll('.search-filter')];
  syncFilters(searchFilters);
});

function syncFilters(filters) {
  const backupItems = [];

  const controlHandler = {
    set: (target, property, value) => {
      const propertiesMap = {
        value: () => {
          filters.forEach((filter, index) => {
            filter.value = value;

            const parent = filter.closest('.pj-tab-content');

            const contentElement = parent.querySelector('.pj-countries__content');
            const listElement = parent.querySelector('.pj-countries__list');
            const emptyElement = parent.querySelector('.pj-empty-search-result');

            if (!backupItems[index]) {
              backupItems[index] = [...listElement.children];
            }

            const filteredItems = backupItems[index].filter((item) => {
              const rawFilters = item.dataset?.value;

              if (!rawFilters) {
                return false;
              }

              const filters = JSON.parse(rawFilters);
              let isPresent = false;
              for (let i = 0; i < filters.length; i++) {
                if (filters[i].includes(value.toLowerCase())) {
                  isPresent = true;
                  break;
                }
              }

              return isPresent;
            });

            const listResult = value ? filteredItems : backupItems[index];

            listElement.innerHTML = '';
            listElement.append(...listResult);

            contentElement.hidden = !listResult.length;
            emptyElement.hidden = !!listResult.length;
          });

          return Reflect.set(target, property, value);
        },
      };

      return propertiesMap[property]();
    },
  };

  const control = new Proxy({ value: '' }, controlHandler);

  filters.forEach((filter) => {
    filter.addEventListener('input', (event) => (control.value = event.target.value || ''));
  });
}
