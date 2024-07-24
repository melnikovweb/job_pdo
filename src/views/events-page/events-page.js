import { onDomReady } from '@shared/services/dom-services';
import Isotope from 'isotope';

onDomReady(async () => {
  const evSelectTop = document.querySelector('.ev-select-top');
  const evSelectTopTitle = document.querySelector('.ev-select-top-title');
  const evSelect = document.querySelector('.ev-select');

  evSelectTop.addEventListener('click', () => {
    evSelect.classList.toggle('active');
  });

  document.body.addEventListener('click', (e) => {
    if (!e.target.closest('.ev-select')) {
      evSelect.classList.remove('active');
    }
  });

  evSelectTopTitle.textContent = document.querySelector('.ev-select-bot-item.active').textContent;

  const iso = new Isotope('.grid', {
    itemSelector: '.element-item',
    layoutMode: 'fitRows',
    filter: '.upcoming',
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
      const buttons = buttonGroup.querySelectorAll('.js-ev-btn');
      buttons.forEach((btn) => {
        btn.classList.remove('active');
      });
      clickedButton.classList.add('active');
      evSelectTopTitle.textContent = document.querySelector('.ev-select-bot-item.active').textContent;
      document.querySelector('.ev-select').classList.remove('active');
    });
  });

  function getValues(obj) {
    if (obj.type !== '.past') {
      obj.type = '.upcoming';
    }

    return Object.values(obj).join('').replace(/\*/g, '');
  }
});
