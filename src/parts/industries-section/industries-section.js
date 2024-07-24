import { onDomReady } from '@shared/services/dom-services';
import { useShowMore } from '@shared/hooks/show-more';

onDomReady(() => {
  const industriesCount = document.body.clientWidth >= 768 ? 12 : 3;
  const { initShowMore } = useShowMore(industriesCount, industriesCount);
  const elements = document.querySelectorAll('.industries-section');

  elements.forEach((element) => {
    initShowMore(element);
  });
});
