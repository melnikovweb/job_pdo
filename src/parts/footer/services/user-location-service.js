import { COUNTRY_DATE_KEY, PERSON_COUNTRY_KEY } from '../constants';

class UserLocationService {
  get #date() {
    return Number(localStorage.getItem(COUNTRY_DATE_KEY));
  }

  set #date(value) {
    if (this.#date === value) {
      return;
    }

    localStorage.setItem(COUNTRY_DATE_KEY, value);
    localStorage.removeItem(PERSON_COUNTRY_KEY);
  }

  get #userCountry() {
    return localStorage.getItem(PERSON_COUNTRY_KEY);
  }

  set #userCountry(value) {
    localStorage.setItem(PERSON_COUNTRY_KEY, value);
  }

  #getGeoAPISrc() {
    const refUrl = document.referrer;
    const location = window.location;
    const { urlWithId } = window.SECRETGeoLocation;

    return `${urlWithId}&refurl=${refUrl}&winurl=${encodeURIComponent(location)}`;
  }

  init() {
    this.#date = new Date().getDate();

    if (this.#userCountry) {
      return;
    }

    const TAG_NAME = 'script';

    const entryTag = document.getElementsByTagName(TAG_NAME)[0];
    const sourceTag = document.createElement(TAG_NAME);

    sourceTag.async = true;
    sourceTag.src = this.#getGeoAPISrc();

    entryTag.parentNode.insertBefore(sourceTag, entryTag);

    window.geotargetly_loaded = () => {
      this.#userCountry = window.geotargetly_country_code();
    };
  }
}

export const userLocationService = new UserLocationService();
