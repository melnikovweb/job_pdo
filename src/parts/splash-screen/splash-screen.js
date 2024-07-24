import { onDomReady } from '@shared/services/dom-services';
import { ANIMATION_DURATION, CONTAINER_SELECTOR, DISPLAYING_DELAY } from './constants';

onDomReady(() => {
  const container = document.querySelector(CONTAINER_SELECTOR);

  setTimeout(async () => {
    const keyframes = [{ opacity: 1 }, { opacity: 0 }];
    const animationOptions = {
      duration: ANIMATION_DURATION,
    };

    await container.animate(keyframes, animationOptions).finished;

    container.remove();
  }, DISPLAYING_DELAY);
});
