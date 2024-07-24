import { onDomReady } from '@shared/services/dom-services';
import { useCountriesFilter } from '@shared/hooks/countries-filter';

onDomReady(async () => {
  const { countriesFilter } = useCountriesFilter({
    countryFilterPlaceholder: window.wpPageData.countryFilterPlaceholder,
    allCountries: window.wpPageData.allCountries,
    midForApp: window.wpPageData.midForApp,
  });

  const pricingTiers = [...document.querySelectorAll('.pp-pricing-groups__section')];

  const setActiveTier = (tierElements, value = null) => {
    const ACTIVE_CLASS_NAME = 'active';
    const ordered = tierElements.sort((a, b) => {
      const firstIndex = parseInt(a.dataset.id, 10);
      const secondIndex = parseInt(b.dataset.id, 10);

      return firstIndex > secondIndex ? 1 : -1;
    });

    if (!value) {
      ordered[0].classList.add(ACTIVE_CLASS_NAME);

      return;
    }

    let isUpdated = false;

    ordered.forEach((item) => {
      const countries = JSON.parse(item.dataset.codes);

      item.classList.remove(ACTIVE_CLASS_NAME);

      if (!isUpdated && countries.includes(value)) {
        item.classList.add(ACTIVE_CLASS_NAME);
        isUpdated = true;
      }
    });

    if (!isUpdated) {
      const itemDefault = ordered.find((item) => {
        const countries = JSON.parse(item.dataset.codes);

        return !countries.length;
      });

      if (!itemDefault) {
        ordered[ordered.length - 1].classList.add(ACTIVE_CLASS_NAME);

        return;
      }

      itemDefault.classList.add(ACTIVE_CLASS_NAME);
    }
  };
  setActiveTier(pricingTiers, countriesFilter.getValue(true));

  countriesFilter.passedElement.element.addEventListener(
    'change',
    (event) => setActiveTier(pricingTiers, event.detail.value),
    false,
  );
});
