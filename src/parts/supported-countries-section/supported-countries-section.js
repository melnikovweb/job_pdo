import { onDomReady } from '@shared/services/dom-services';
import { useShowMore } from '@shared/hooks/show-more';

onDomReady(async () => {
  const { initShowMore } = useShowMore(9, 3);

  const elements = document.querySelectorAll('.countries-wrap');

  elements.forEach((element) => {
    initShowMore(element);
  });
});
