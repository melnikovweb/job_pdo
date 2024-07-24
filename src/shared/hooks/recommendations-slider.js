import Swiper from 'swiper';

function useRecommendationsSlider() {
  // Page examples: page-home.php:925
  const initSlider = (hostSelector, options = {}) =>
    new Swiper(`${hostSelector} .swiper`, {
      slidesPerView: 1,
      spaceBetween: 20,
      navigation: {
        nextEl: `${hostSelector} [data-action='next']`,
        prevEl: `${hostSelector} [data-action='prev']`,
      },
      breakpoints: {
        768: {
          slidesPerView: 'auto',
        },
      },
      ...options,
    });

  return {
    initSlider,
  };
}

export { useRecommendationsSlider };
