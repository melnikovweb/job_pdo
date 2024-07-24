function useTemplateService() {
  const getPaymentMethodTemplate = (imgUrl, title, description) => {
    return `
      <div class="payment-method-type">
        <div class="payment-method-type__banner">
          <img src="${imgUrl}" alt="" />
        </div>

        <div class="payment-method-type__content">
          <div class="payment-method-type__title">${title}</div>
        </div>
      </div>
    `;
  };

  const getCellTemplate = (template) => {
    return `<span class="cell-wrapper">${template}</span>`;
  };

  const getCountriesTemplate = (regionsMap) => {
    const regions = Object.keys(regionsMap);

    const getCountriesHtml = (region, countriesData) => {
      const countriesHtmlList = countriesData.map((countryData) => {
        return `${countryData.name.common}`;
      });

      return `<p data-region="${region}">${countriesHtmlList.join(', ')}</p> `;
    };

    const regionsHtmlList = regions.map((region) => getCountriesHtml(region, regionsMap[region]));

    return `
      <div class="supported-countries" data-clamp="container">
        <div class="supported-countries__content" data-clamp="text">
          ${regionsHtmlList.join('')}
        </div>

        <button class="supported-countries__button" data-clamp="action" data-show-text="See more" data-hide-text="Close"></button>
      </div>
    `;
  };

  return {
    getCellTemplate,
    getPaymentMethodTemplate,
    getCountriesTemplate,
  };
}

export { useTemplateService };
