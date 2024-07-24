import { onDomReady } from '@shared/services/dom-services';
import { cookieService } from '@shared/services/cookie-service';

function redirectIfNotVisited() {
  const userIsOnSite = sessionStorage.getItem('userIsOnSite');
  const lastVisitedPageType = cookieService.get('lastVisitedPageType');
  if (!userIsOnSite && lastVisitedPageType === 'business' && window.location.pathname === '/') {
    const origin = window.location.origin;
    window.location.href = `${origin}/business`;
  }
}

function setLastVisitedPageType() {
  const pathSegments = window.location.pathname.split('/').filter((segment) => segment.length > 0);
  const pageType = pathSegments.length > 0 ? pathSegments[0] : 'home';
  cookieService.set('lastVisitedPageType', pageType, { 'max-age': 31536000 });
  sessionStorage.setItem('userIsOnSite', 'true');
}

onDomReady(() => {
  redirectIfNotVisited();
  setLastVisitedPageType();
});
