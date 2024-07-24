import { onDomReady } from '@shared/services/dom-services';
import lottie from 'lottie';

onDomReady(() => {
  const animationData = JSON.parse(window.wpPageData.animationData);
  const params = {
    container: document.querySelector('.banner-lottie__animation'),
    renderer: 'svg',
    loop: true,
    autoplay: true,
    animationData,
  };

  lottie.loadAnimation(params);
});
