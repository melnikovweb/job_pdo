function useShowMore(perViewDesktop = 12, perViewMobile = 3) {
  const initShowMore = (container) => {
    const list = container.querySelector('[data-see-more="list"]');
    const action = container.querySelector('[data-see-more="action"]');

    if (!(list && list.children.length && action)) {
      return;
    }

    const media = window.matchMedia('(width < 768px)');
    const items = [...list.children];

    let isMobile = false;
    let itemsProcessing = [...items];

    const addItems = () => {
      const itemsPerView = isMobile ? perViewDesktop : perViewMobile;
      const displayingItems = itemsProcessing.splice(0, itemsPerView);

      list.append(...displayingItems);

      if (itemsProcessing.length) {
        return;
      }

      action.hidden = true;
    };

    const reset = () => {
      list.innerHTML = '';
      action.hidden = false;
      itemsProcessing = [...items];
      addItems();

      action.addEventListener('click', addItems);
    };

    const onMediaChanged = (query) => {
      isMobile = !query.matches;
      reset();
    };

    onMediaChanged(media);
    media.addEventListener('change', onMediaChanged);

    return {
      container,
      list,
      action,
    };
  };

  return { initShowMore };
}

export { useShowMore };
