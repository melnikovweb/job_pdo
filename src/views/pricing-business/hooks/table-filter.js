import { useCustomSelect } from '@shared/hooks/custom-select';

function usePricingFilters(options) {
  const customSelect = useCustomSelect();

  const inudstryItems = options.industryFilter?.items || [];
  const countriesWithTierArray = options.countriesWithTier || [];

  const industryPlaceHolder = options.industryFilter?.placeholder || 'Select option';
  const countryPlaceHolder = options.countryFilter?.placeholder || 'Select option';

  const industriesElement = document.getElementById('industries-filter');
  const countriesElement = document.getElementById('country-of-incorporation-filter');

  const typeToText = (value) => {
    const normalizedString = value.replace(/_/g, ' ');
    return normalizedString.replace(/\b\w/g, (match) => match.toUpperCase());
  };

  const mapCountry = options.allCountries.map((e) => {
    const temp = countriesWithTierArray.data.find((element) => element.iso === e.cca2);
    if (temp?.iso) {
      e.tier = temp.tier;
    }
    return e;
  });

  const countriesOptions = mapCountry.map((country) => ({
    value: country.tier,
    label: country.name.common,
    customProperties: {
      cca2: country.cca2,
      region: country.region,
      flag: country.flags?.svg || '',
    },
  }));

  const industryFilter = customSelect.init(industriesElement, {
    searchPlaceholderValue: industryPlaceHolder,
    choices: inudstryItems.map((industry) => ({
      value: industry.tier,
      label: typeToText(industry.title),
    })),
  });

  const countriesFilter = customSelect.init(countriesElement, {
    choices: [{ value: '', label: countryPlaceHolder }, ...countriesOptions],
    searchPlaceholderValue: countryPlaceHolder,
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
    industryFilter,
    countriesFilter,
  };
}

export { usePricingFilters };
