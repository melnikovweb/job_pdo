import { useCustomSelect } from '@shared/hooks/custom-select';
import { onDomReady } from '@shared/services/dom-services';

onDomReady(async () => {
  window.wpcf7.cached = 0;

  const customSelect = useCustomSelect();
  const countriesChoices = window.wpPageData.allCountries.map((country) => ({
    value: country.name.common,
    label: `<img class="choices__item-flag" src="${country.flags.svg}"> ${country.name.common}`,
  }));

  customSelect.init(document.querySelector('#contact-form-industry'), {
    searchEnabled: true,
  });

  customSelect.init(document.querySelector('#countries-filter'), {
    searchEnabled: true,
    choices: countriesChoices,
  });
});
