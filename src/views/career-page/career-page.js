import { onDomReady } from '@shared/services/dom-services';
import Isotope from 'isotope';

onDomReady(() => {
  const evSelectTop = document.querySelector('.career-filter__select-top');
  const evSelectTopTitle = document.querySelector('.career-filter__select-top-title');
  const evSelect = document.querySelector('.career-filter__select');

  evSelectTop.addEventListener('click', () => {
    evSelect.classList.toggle('active');
  });

  document.body.addEventListener('click', (e) => {
    if (!e.target.closest('.career-filter__select')) {
      evSelect.classList.remove('active');
    }
  });

  evSelectTopTitle.textContent = document.querySelector('.career-filter__select-bot-item.active').textContent;

  const iso = new Isotope('.career-list', {
    itemSelector: '.career-list__item',
    layoutMode: 'fitRows',
    filter: '.remote',
  });

  const filters = {};

  const parentFilter = document.querySelector('.filters');
  parentFilter.addEventListener('click', (event) => {
    const button = event.target;
    const buttonGroup = button.closest('.button-group');
    const filterGroup = buttonGroup.getAttribute('data-filter-group');
    filters[filterGroup] = button.getAttribute('data-filter');
    const filterValue = getValues(filters);
    iso.arrange({ filter: filterValue });
  });

  document.querySelectorAll('.button-group').forEach((buttonGroup) => {
    buttonGroup.addEventListener('click', (event) => {
      const clickedButton = event.target;
      const buttons = buttonGroup.querySelectorAll('.js-career-filter__button');
      buttons.forEach((btn) => {
        btn.classList.remove('active');
      });
      clickedButton.classList.add('active');
      document.querySelector('.career-filter__select').classList.remove('active');
      evSelectTopTitle.textContent = document.querySelector('.career-filter__select-bot-item.active').textContent;
    });
  });

  function getValues(obj) {
    return Object.values(obj).join('').replace(/\*/g, '');
  }
});
