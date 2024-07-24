import { useCustomSelect } from '@shared/hooks/custom-select';
import DataTable from 'datatable';

const customSelect = useCustomSelect();

async function usePaymentsTable() {
  const paymentsTable = new DataTable('#payment-methods-table', {
    autoWidth: true,
    pageLength: 5,
    pagingType: 'simple_numbers',
    sPaginationType: 'four_button',
    language: {
      paginate: {
        previous: `<span class="icon-arrow-left"></span>`,
        next: `<span class="icon-arrow-right"></span>`,
      },
    },
  });

  const tableNode = paymentsTable.table().node();
  const tableContainer = tableNode.closest('.dataTables_wrapper');
  const tableWrapper = document.createElement('div');
  tableWrapper.classList.add('table-wrapper');

  tableNode.after(tableWrapper);
  tableWrapper.append(tableNode);

  const onPageChange = () => {
    setTimeout(() => {
      const paginationButtons = [...tableContainer.querySelectorAll('span .paginate_button')];

      if (!paginationButtons.length) {
        return;
      }

      const activeButton = paginationButtons.find((button) => button.classList.contains('current'));

      const nextButton = activeButton.nextElementSibling;
      const prevButton = activeButton.previousElementSibling;

      prevButton && prevButton.setAttribute('data-position', 'prev');
      nextButton && nextButton.setAttribute('data-position', 'next');
    }, 0);
  };

  onPageChange();
  paymentsTable.on('page', onPageChange);

  return {
    paymentsTable,
  };
}

function useTableFilters(options) {
  const searchElement = document.getElementById('payment-methods-search');
  const typeElement = document.getElementById('payment-methods-types');
  const countriesElement = document.getElementById('payment-methods-countries');

  const countriesOptions = options.allCountries.map((country) => ({
    value: country.cca2,
    label: country.name.common,
    customProperties: {
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

  const typeFilter = customSelect.init(typeElement, {
    searchPlaceholderValue: options.typeFilterPlaceholder,
    choices: [],
  });

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

  if (currentCountry) {
    countriesFilter.setValue([currentCountry]);
  }

  const seatchFilter = {
    element: searchElement,
    onInput: (callback) => {
      searchElement.addEventListener('input', callback);
    },
  };

  return {
    seatchFilter,
    typeFilter,
    countriesFilter,
  };
}

export { usePaymentsTable, useTableFilters };
