class CookieService {
  get(cname) {
    const name = cname + '=';
    const decodedCookie = decodeURIComponent(document.cookie);
    const ca = decodedCookie.split(';');
    const cookie = ca.find((c) => c.trim().startsWith(name));
    if (cookie) {
      const value = cookie.trim().substring(name.length);
      return value.startsWith('"') && value.endsWith('"') ? value.slice(1, -1) : value;
    }
    return null;
  }

  set(name, value, options = {}) {
    options = {
      path: '/',
      ...options,
    };

    const encodedName = encodeURIComponent(name);
    let cookieValue = encodeURIComponent(value);

    if (typeof value === 'object') {
      cookieValue = JSON.stringify(value);
    }

    if (options.expires instanceof Date) {
      options.expires = options.expires.toUTCString();
    }

    const cookieOptions = Object.entries(options)
      .map(([key, val]) => (val === true ? key : `${key}=${val}`))
      .join('; ');

    document.cookie = `${encodedName}=${cookieValue}; ${cookieOptions}`;
  }
}

export const cookieService = new CookieService();
