import Swiper from 'swiper';

function useObstaclesSlider() {
  const initSlider = (hostSelector, options = {}) =>
    new Swiper(`${hostSelector} .swiper`, {
      slidesPerView: 1,
      spaceBetween: 20,
      breakpoints: {
        768: {
          slidesPerView: 1.5,
        },
        1024: {
          slidesPerView: 2.5,
        },
        1920: {
          spaceBetween: 30,
          slidesPerView: 2.5,
        },
      },
      ...options,
    });

  return {
    initSlider,
  };
}

export { useObstaclesSlider };
