import { useCustomSelect } from './custom-select';

function useCountriesFilter(options) {
  const customSelect = useCustomSelect();

  const countriesElement = document.getElementById('countries-filter');

  const countriesOptions = options.allCountries.map((country) => ({
    value: country.cca2,
    label: country.name.common,
    customProperties: {
      cca2: country.cca2,
      region: country.region,
      flag: country.flags.svg,
    },
  }));

  const personCountry = localStorage.getItem('person_country');
  let currentCountry;
  if (personCountry) {
    for (const element of countriesOptions) {
      if (element.value === personCountry) {
        element.selected = true;
        currentCountry = element;
        break;
      }
    }
  }

  const countriesFilter = customSelect.init(countriesElement, {
    choices: countriesOptions,
    items: [currentCountry],
    searchPlaceholderValue: options.countryFilterPlaceholder,
    callbackOnCreateTemplates(template) {
      return {
        item: ({ classNames }, data) => {
          const isHighlightedClass = data.highlighted ? classNames.highlightedState : classNames.itemSelectable;

          const isActive = data.active ? 'aria-selected="true"' : '';
          const isDisabled = data.disabled ? 'aria-disabled="true"' : '';
          const placeholder = data.placeholder ? classNames.placeholder : '';

          const classes = `${classNames.item} ${isHighlightedClass} ${placeholder}`;

          const image = data.customProperties.flag ? `<img src="${data.customProperties.flag}" alt="">` : '';

          return template(`
              <div class="${classes}" data-item data-id="${data.id}" data-value="${data.value}" ${isActive} ${isDisabled}>
                 ${image} ${data.label}
              </div>
            `);
        },
        choice: ({ classNames }, data) => {
          const isDisabledClass = data.disabled ? classNames.itemDisabled : classNames.itemSelectable;

          const isDisabledAttributes = data.disabled
            ? 'data-choice-disabled aria-disabled="true"'
            : 'data-choice-selectable';

          const classes = `${classNames.item} ${classNames.itemChoice} ${isDisabledClass}`;
          const role = data.groupId > 0 ? 'role="treeitem"' : 'role="option"';

          return template(`
              <div 
                class="${classes}"
                data-select-text="${this.config.itemSelectText}"
                data-choice ${isDisabledAttributes} 
                data-id="${data.id}" data-value="${data.value}" 
                ${role}
              >
                <img src="${data.customProperties.flag}" alt=""> ${data.label}
              </div>
          `);
        },
      };
    },
    searchFields: ['label', 'value', 'customProperties.cca2', 'customProperties.region'],
  });

  return {
    countriesFilter,
  };
}

export { useCountriesFilter };
