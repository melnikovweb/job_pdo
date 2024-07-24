import { onDomReady } from '@shared/services/dom-services';
import { usePaymentsTable, useTableFilters } from '@shared/services/table-service';

onDomReady(async () => {
  const { paymentsTable } = await usePaymentsTable();
  const { seatchFilter, countriesFilter, currencyFilter } = useTableFilters({
    countryFilterPlaceholder: window.wpPageData.countryFilterPlaceholder,
    currencyFilterPlaceholder: window.wpPageData.currencyFilterPlaceholder,
    allCountries: window.wpPageData.allCountries,
    allRegions: window.wpPageData.allRegions,
    midForApp: window.wpPageData.midForApp,
  });

  const industryBtn = document.querySelector('.industry-btn');
  const industryItem = document.querySelector('.industry__item');

  industryBtn.addEventListener('click', () => {
    industryItem.classList.toggle('active');
    if (industryItem[0].classList.contains('active')) {
      industryBtn.textContent = industryBtn.getAttribute('data-less');
    } else {
      industryBtn.textContent = industryBtn.getAttribute('data-more');
    }
  });

  if (seatchFilter) {
    seatchFilter.onInput((event) => {
      paymentsTable.columns(0).search(event.target.value).draw();
    });
  }

  if (countriesFilter) {
    countriesFilter.passedElement.element.addEventListener('choice', (event) => {
      paymentsTable.columns(1).search(event.detail.choice.label).draw();
    });
  }

  if (currencyFilter) {
    currencyFilter.passedElement.element.addEventListener('choice', (event) => {
      paymentsTable.columns(2).search(event.detail.choice.label).draw();
    });
  }
});
