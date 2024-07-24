import { onDomReady } from '@shared/services/dom-services';
import { useRecommendationsSlider } from '@shared/hooks/recommendations-slider';

onDomReady(async () => {
  const { initSlider } = useRecommendationsSlider();
  initSlider('#case-studies');
});
