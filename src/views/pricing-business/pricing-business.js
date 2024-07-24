import { onDomReady } from '@shared/services/dom-services';
import { useHtmlString } from '@shared/hooks/html-string';
import { useArrayUtils } from '@shared/hooks/array-utils';
import { useTickerRow } from '@shared/hooks/ticket-row';
import { getPricingData } from './hooks/payment-table.js';
import { usePricingFilters } from './hooks/table-filter.js';

onDomReady(async () => {
  const { currencies } = await useCurrenciesApi();
  const { getCurrencyCard } = useTemplates();
  const { getHtmlElement } = useHtmlString();
  const { shuffle } = useArrayUtils();
  const { createTickerRow } = useTickerRow();
  const { countriesWithTier } = await useCountriesApi();

  usePricingFilters({
    industryFilter: window.pricingBusinessData.industryFilter,
    allCountries: window.pricingBusinessData.allCountries,
    countryFilter: window.pricingBusinessData.countryFilter,
    countriesWithTier,
  });

  getPricingData();

  const previews = [...document.querySelectorAll('.currencies-preview')];

  previews.forEach((container, index) => {
    const data = shuffle(currencies.data);
    createTickerRow(
      container,
      data.map((item) => {
        const cardTemlate = getCurrencyCard(item);
        const cardElement = getHtmlElement(cardTemlate);

        return cardElement;
      }),
      !!(index % 2),
    );
  });
});

async function useCurrenciesApi() {
  const currenciesResponce = await fetch(window.pricingBusinessData.templateUrl + '/assets/data/currencies.json');
  const currencies = await currenciesResponce.json();

  return {
    currencies,
  };
}

async function useCountriesApi() {
  const countryResponce = await fetch(window.pricingBusinessData.templateUrl + '/assets/data/countries-with-tier.json');
  const countriesWithTier = await countryResponce.json();

  return {
    countriesWithTier,
  };
}

function useTemplates() {
  const getCurrencyCard = (data) => {
    return `
        <div class="currency-card">
          <div class="currency-card__media">
            <img src="${data.flag}" alt="${data.currency}">
          </div>
  
          <div class="currency-card__content">
            ${data.currency}
          </div>
        </div>
      `;
  };

  return {
    getCurrencyCard,
  };
}
