onDomReady(async () => {
    const { currencies } = await useCurrenciesApi();
    const { getCurrencyCard } = useTemplates();
    const { getHtmlElement } = useHtmlString();
    const { shuffle } = useArrayUtils();
    const { createTickerRow } = useTickerRow();
    const { countriesWithTier } = await useCountriesApi();

    usePricingBusinessFilters({
      industryFilter: wpPageData.industryFilter,
      allCountries: wpPageData.allCountries,
      countryFilter: wpPageData.countryFilter,
      countriesWithTier: countriesWithTier,
    });
  
    getPricingBusinessData();

    const previews = [...document.querySelectorAll(".currencies-preview")];
  
    previews.forEach((container, index) => {
      const data = shuffle(currencies.data);
      createTickerRow(
        container,
        data.map((item) => {
          const cardTemlate = getCurrencyCard(item);
          const cardElement = getHtmlElement(cardTemlate);
  
          return cardElement;
        }),
        !!(index % 2)
      );
    });


  });
  
  async function useCurrenciesApi() {
    const currenciesResponce = await fetch(
      "/wp-content/themes/SECRET/assets/data/currencies.json"
    );
    const currencies = await currenciesResponce.json();
  
    return {
      currencies,
    };
  }

  async function useCountriesApi() {
    const countryResponce = await fetch(
      "/wp-content/themes/SECRET/assets/data/countries-with-tier.json"
    );
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




