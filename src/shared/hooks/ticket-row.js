function useTickerRow() {
  const BLOCK_NAME = 'ticker-row';
  const WRAPPER_NAME = 'ticker-row__wrapper';

  const createTickerRow = (selector, items, isReverse = false) => {
    if (!items || !selector) {
      throw new Error('Selector or items args do not exist');
    }

    const container = typeof selector === 'object' ? selector : document.querySelector(selector);

    if (!container) {
      throw new Error(`Element with selector ${selector} does not exist`);
    }

    const ticker = document.createElement('div');
    const wrapper = document.createElement('div');

    ticker.classList.add(BLOCK_NAME);
    ticker.classList.toggle('reverse', isReverse);
    wrapper.classList.add(WRAPPER_NAME);

    wrapper.append(...items);
    ticker.append(wrapper);
    ticker.append(wrapper.cloneNode(true));

    container.append(ticker);
  };

  return {
    createTickerRow,
  };
}

export { useTickerRow };
