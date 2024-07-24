import { onDomReady } from '@shared/services/dom-services';
import { NAVIGATION_KEY, OPENED_CLASS } from './constants';
import { footerService } from './services/footer-service';
import { userLocationService } from './services/user-location-service';

onDomReady(() => {
  const navigationContainers = document.querySelectorAll(`[${NAVIGATION_KEY}="container"]`);

  userLocationService.init();

  footerService.onScreenChanged((isDesktop) => {
    navigationContainers.forEach((item) => item.classList.toggle(OPENED_CLASS, isDesktop));
  });

  navigationContainers.forEach((container) => {
    footerService.initNavigationHandler(container, navigationContainers);
  });
});
