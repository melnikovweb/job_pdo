import { onDomReady } from '@shared/services/dom-services';
import { useObstaclesSlider } from '@shared/hooks/obstacles-slider';

onDomReady(async () => {
  const { initSlider } = useObstaclesSlider();

  initSlider('#obstacles-cards');
});
