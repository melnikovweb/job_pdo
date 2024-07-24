import { onDomReady } from '@shared/services/dom-services';
import { useRecommendationsSlider } from '@shared/hooks/recommendations-slider';
import { useLineClamp } from '@shared/hooks/line-clamp';
import { useArrayUtils } from '@shared/hooks/array-utils';
import { useHtmlString } from '@shared/hooks/html-string';
import { useTickerRow } from '@shared/hooks/ticket-row';
import { useShowMore } from '@shared/hooks/show-more';
import { paymentSchemesService } from './services/payment-schemes-service';

onDomReady(async () => {
  const { getHtmlElement } = useHtmlString();
  const { shuffle } = useArrayUtils();
  const { createTickerRow } = useTickerRow();
  const { initSlider } = useRecommendationsSlider();
  const { initShowMore } = useShowMore(12, 6);
  const { initLineClamp } = useLineClamp();

  const currencies = await paymentSchemesService.getCurrencies$();

  const previews = [...document.querySelectorAll('.currencies-preview')];
  const currenciesList = document.querySelector('[data-element="countries-list"]');

  initLineClamp();
  initShowMore(currenciesList);
  initSlider('#case-studies');

  previews.forEach((container, index) => {
    const data = shuffle(currencies);

    createTickerRow(
      container,
      data.map((item) => {
        const cardTemlate = paymentSchemesService.getCurrencyCardTemplate(item);
        const cardElement = getHtmlElement(cardTemlate);

        return cardElement;
      }),
      !!(index % 2),
    );
  });
});
