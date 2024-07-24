import { onDomReady } from '@shared/services/dom-services';
import Swiper from 'swiper';

onDomReady(() => {
  const sections = [...document.querySelectorAll('.timeline-section')];

  sections.forEach((section) => {
    const swiperElement = section.querySelector('.swiper');
    const nextElement = section.querySelector('[data-direction="next"]');
    const prevElement = section.querySelector('[data-direction="prev"]');

    const swiper = new Swiper(swiperElement, {
      slidesPerView: 'auto',
      spaceBetween: 0,
      navigation: {
        prevEl: prevElement,
        nextEl: nextElement,
      },
    });

    swiper.on('click', (event) => {
      if (!event.clickedIndex) {
        return;
      }

      swiper.slideTo(event.clickedIndex);
    });
  });
});
