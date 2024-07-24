onDomReady(async () => {
  const { currencies } = await useCurrenciesApi();
  const { getCurrencyCard } = useTemplates();
  const { getHtmlElement } = useHtmlString();
  const { shuffle } = useArrayUtils();
  const { createTickerRow } = useTickerRow();
  const { initSlider } = useRecommendationsSlider();

  const { initLineClamp } = useLineClamp();
  initLineClamp();

  initSlider("#case-studies");

  const previews = [...document.querySelectorAll(".currencies-preview")];

  previews.forEach((container, index) => {
    const data = shuffle(currencies);

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

  $('.countries-btn').on('click', () => {
    $('.countries__item').toggleClass('active')
    if ($('.countries__item').eq(0).hasClass('active')) {
        $('.countries-btn').text($('.countries-btn').attr('data-less'))
    } else {
        $('.countries-btn').text($('.countries-btn').attr('data-more'))
    }
  })
  

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

function useTemplates() {
  const getCurrencyCard = (data) => {
    return `
      <div class="currency-card">
        <div class="currency-card__media">
          <img src="${data.flag}" alt="${data.name}">
        </div>

        <div class="currency-card__content">
          ${data.name}
        </div>
      </div>
    `;
  };

  return {
    getCurrencyCard,
  };
}


