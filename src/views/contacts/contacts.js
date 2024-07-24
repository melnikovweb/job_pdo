import { onDomReady } from '@shared/services/dom-services';
import Swiper from 'swiper';

// TODO: Needs a refactoring
onDomReady(async () => {
  const tabletMedia = window.matchMedia('(max-width: 1024px)');
  const tabsSliderElement = document.querySelector('.cu-tabs .swiper');
  let tabsSwiper = new Swiper(tabsSliderElement, {
    slidesPerView: 'auto',
    spaceBetween: 20,
  });

  if (!tabletMedia.matches) {
    tabsSwiper.destroy(false, true);
  }

  tabletMedia.onchange = (e) => {
    if (e.matches) {
      tabsSwiper = new Swiper(tabsSliderElement, {
        slidesPerView: 'auto',
        spaceBetween: 20,
      });
    } else {
      tabsSwiper.destroy(false, true);
    }
  };

  const tabs = document.querySelectorAll('.cu-tabs');
  if (tabs.length) {
    tabs.forEach((tab) => {
      const tabHeaderItems = tab.querySelectorAll('.cu-tabs__item-header');

      tabHeaderItems.forEach((tabHeaderItem) => {
        tabHeaderItem.addEventListener('click', () => {
          const navigationWrapper = tabHeaderItem.parentElement;
          const dataButton = tabHeaderItem.dataset.tabBtn;
          const tabsElement = tab.querySelectorAll('.cu-tabs__item-content');
          const currentTabElement = tab.querySelector(`[data-tab-elem="${dataButton}"]`);

          Array.from(navigationWrapper.children, (item) => {
            item.classList.remove('active');

            return item;
          });

          tabHeaderItem.classList.add('active');

          tabsElement.forEach((elem) => elem.classList.remove('active'));
          currentTabElement.classList.add('active');
        });
      });
    });
  }
});
