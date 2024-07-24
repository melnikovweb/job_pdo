import { onDomReady } from '@shared/services/dom-services';
import { usePaymentsTable, useTableFilters } from '@shared/services/payment-table-service';

onDomReady(async () => {
  const { paymentsTable } = await usePaymentsTable();
  const { seatchFilter, countriesFilter, typeFilter } = useTableFilters({
    typeFilterPlaceholder: window.wpPageData.typeFilterPlaceholder,
    countryFilterPlaceholder: window.wpPageData.countryFilterPlaceholder,
    allCountries: window.wpPageData.allCountries,
    midForApp: window.wpPageData.midForApp,
  });

  if (seatchFilter) {
    seatchFilter.onInput((event) => {
      paymentsTable.columns(0).search(event.target.value).draw();
    });
  }

  if (typeFilter) {
    typeFilter.passedElement.element.addEventListener('choice', (event) => {
      paymentsTable.columns(0).search(event.detail.choice.label).draw();
    });
  }

  if (countriesFilter) {
    countriesFilter.passedElement.element.addEventListener('choice', (event) => {
      paymentsTable.columns(4).search(event.detail.choice.value).draw();
    });

    const selectedItem = countriesFilter.itemList.element.firstChild.dataset.value.trim();
    if (countriesFilter.itemList.element.innerText.trim() !== 'Country') {
      paymentsTable.columns(4).search(selectedItem).draw();
    }
  }
});
