import { UTM_KEYS, DOMAIN_NAME } from '@shared/constants';

window.addEventListener('pointerdown', onUtmHandle);
function onUtmHandle(event) {
  const target = event.target.closest('a[href]');
  if (!target || target.href.includes('#')) {
    return;
  }

  const utm = getUtm(new URLSearchParams(window.location.search));
  if (!utm.size || !target.href.includes(DOMAIN_NAME)) {
    return;
  }

  const divider = target.href.includes('?') ? '&' : '?';
  target.href = target.href + divider + utm.toString();
}

function getUtm(queryParams) {
  const utmParams = UTM_KEYS.reduce((accumulator, key) => {
    if (queryParams.get(key)) {
      accumulator[key] = queryParams.get(key);
    }
    return accumulator;
  }, {});

  return new URLSearchParams(utmParams);
}
