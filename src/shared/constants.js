export const AVAILABLE_THEMES = {
  BLACK: 'black',
  DARK: 'dark',
  BLUE: 'blue',
  WHITE: 'white',
};

export const HEADER_BUTTON_THEMES_MAP = {
  [AVAILABLE_THEMES.BLACK]: {
    logIn: 'blue',
    signUp: 'white outlined',
  },
  [AVAILABLE_THEMES.DARK]: {
    logIn: 'blue',
    signUp: 'white outlined',
  },
  [AVAILABLE_THEMES.BLUE]: {
    logIn: 'white',
    signUp: 'white outlined',
  },
  [AVAILABLE_THEMES.WHITE]: {
    logIn: 'blue',
    signUp: 'blue outlined',
  },
};

export const PRIMARY_HEADER_SELECTOR = '[data-element="primary-header"]';
export const MOBILE_HEADER_SELECTOR = '[data-element="mobile-header"]';
export const BURGER_BUTTON_SELECTOR = '[data-action="burger"]';

export const DATA_HEADER_THEME_NAME = 'data-header-theme';

export const DOMAIN_NAME = 'SECRET.com';

export const UTM_KEYS = [
  'utm_source',
  'utm_medium',
  'utm_campaign',
  'utm_id',
  'utm_content',
  'utm_term',
  'utm_device',
  'utm_language',
  'utm_location',
  'utm_referrer',
  'utm_campaign_id',
  'utm_ad_group',
  'utm_creative',
  'utm_placement',
];
