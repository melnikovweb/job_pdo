import { onDomReady } from '@shared/services/dom-services';
import { useShowMore } from '@shared/hooks/show-more';

onDomReady(async () => {
  const { initShowMore } = useShowMore(7, 7);
  const elements = document.querySelectorAll('.milestone-section');

  elements.forEach((element) => {
    initShowMore(element);
  });
});
