import { useCustomSelect } from '@shared/hooks/custom-select';
import DataTable from 'datatable';

async function usePaymentsTable() {
  const paymentsTable = new DataTable('#payment-methods-table', {
    autoWidth: false,
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
  const customSelect = useCustomSelect();
  const paymentMethods = options.midForApp.map((item) => item.paymentMethod);

  const allCurrencies = options.midForApp.map((item) => item.paymentMethod.currencies);

  const uniqueCurrencyArray = [];

  for (const item of allCurrencies) {
    if (Array.isArray(item)) {
      for (const subItem of item) {
        if (!uniqueCurrencyArray.includes(subItem)) {
          uniqueCurrencyArray.push(subItem);
        }
      }
    } else {
      if (!uniqueCurrencyArray.includes(item)) {
        uniqueCurrencyArray.push(item);
      }
    }
  }

  const currencyOptions = uniqueCurrencyArray.flat();

  const searchElement = document.getElementById('payment-methods-search');
  const typeElement = document.getElementById('payment-methods-types');
  const countriesElement = document.getElementById('payment-methods-countries');
  const currencyElement = document.getElementById('payment-methods-currency');

  const allPaymentTypes = paymentMethods.map((paymentMethod) => paymentMethod.type);
  const uniquePaymentTypes = [...new Set(allPaymentTypes)];

  const typeToText = (value) => {
    const normalizedString = value.replace(/_/g, ' ');

    return normalizedString.replace(/\b\w/g, (match) => match.toUpperCase());
  };

  const countriesOptions = options.allCountries.map((country) => ({
    value: country.area,
    label: country.name.common,
    customProperties: {
      cca2: country.cca2,
      region: country.region,
      flag: country.flags.svg,
    },
  }));

  const filters = {};

  const typeFilter = customSelect.init(typeElement, {
    searchPlaceholderValue: options.typeFilterPlaceholder,
    choices: uniquePaymentTypes.map((paymentType) => ({
      value: paymentType,
      label: typeToText(paymentType),
    })),
  });

  if (typeFilter) {
    filters.typeFilter = typeFilter;
  }

  const currencyFilter = customSelect.init(currencyElement, {
    searchPlaceholderValue: options.currencyFilterPlaceholder,
    choices: currencyOptions.map((paymentType) => ({
      value: paymentType,
      label: typeToText(paymentType),
    })),
  });

  if (currencyFilter) {
    filters.currencyFilter = currencyFilter;
  }

  const countriesFilter = customSelect.init(countriesElement, {
    choices: countriesOptions,
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

  if (currencyFilter) {
    filters.countriesFilter = countriesFilter;
  }

  if (searchElement) {
    const seatchFilter = {
      element: searchElement,
      onInput: (callback) => {
        searchElement.addEventListener('input', callback);
      },
    };

    filters.seatchFilter = seatchFilter;
  }

  return filters;
}

export { usePaymentsTable, useTableFilters };
