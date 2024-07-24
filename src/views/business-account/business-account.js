import { onDomReady } from '@shared/services/dom-services';
import { useLineClamp } from '@shared/hooks/line-clamp';
import { useShowMore } from '@shared/hooks/show-more';

onDomReady(async () => {
  const { initShowMore } = useShowMore();
  const { initLineClamp } = useLineClamp();

  const transfers = document.querySelector('[data-element="business-transfers"]');

  initShowMore(transfers);
  initLineClamp();

  const countryBlocks = [...document.querySelectorAll('.ba-countries-block')];

  countryBlocks.forEach((container) => {
    const rawData = container.dataset.json;

    if (!rawData) {
      return;
    }

    const buttonWrapper = document.createElement('div');
    buttonWrapper.innerHTML = `
        <button type="button" class="ba-countries-block__more"></button>
      `;

    const currencies = JSON.parse(rawData);
    const itemsPerView = parseInt(container.dataset.itemsPerView, 10);
    const button = buttonWrapper.firstElementChild;

    const elements = currencies.map((currencyItem) => {
      const wrapper = document.createElement('div');
      wrapper.innerHTML = `
          <div class="ba-countries-block__currency">
            <img src="${currencyItem.flag}" alt="" />
  
            ${currencyItem.currency}
          </div>
        `;

      return wrapper.firstElementChild;
    });

    const shortList = elements.slice(0, itemsPerView - 1);
    let isItemsShown = false;

    container.append(...shortList);

    if (shortList.length < elements.length) {
      button.innerHTML = `+${elements.length - shortList.length}`;
      container.append(button);
    }

    button.addEventListener('click', () => {
      container.innerHTML = '';

      if (isItemsShown) {
        container.append(...elements);
        button.innerHTML = `-${elements.length - shortList.length}`;
      } else {
        container.append(...shortList);
        button.innerHTML = `+${elements.length - shortList.length}`;
      }

      container.append(button);
      isItemsShown = !isItemsShown;
    });
  });
});
