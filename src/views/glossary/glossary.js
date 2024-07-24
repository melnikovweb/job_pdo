import { onDomReady } from '@shared/services/dom-services';

function initSearch() {
  const searchContainer = document.querySelector('.gl-search');
  const searchInput = document.querySelector('.gl-search__field');
  const searchList = document.querySelector('.gl-search__result-list');
  let isSearching = true;
  let searchQueries = [];

  searchInput.addEventListener('click', onShowHistory);
  searchInput.addEventListener('input', onTyping);
  document.addEventListener('click', onToggleResultView);

  searchList.addEventListener('click', (event) => {
    const clickedItem = event.target.closest('.gl-search__result-list-link');
    if (clickedItem) {
      const query = clickedItem.outerHTML;
      handleSearchResponseLogic(query);
    }
  });

  async function onTyping() {
    const newItem = escTags(searchInput.value);

    if (newItem.length >= 3 && isSearching) {
      isSearching = false;
      const formData = createFormData(newItem);

      const result = await getPosts$(formData);
      handleSearchResult(result, newItem);
      isSearching = true;
    } else {
      onShowHistory();
    }
  }

  function onToggleResultView(event) {
    searchContainer.classList.toggle('show-result', event.target === searchInput);
  }

  async function getPosts$(data) {
    const result = await fetch(window.wpPageData.ajaxUrl, {
      method: 'POST',
      body: data,
    });

    return await result.text();
  }

  function createFormData(query) {
    const formData = new FormData();
    formData.append('action', 'glossary');
    formData.append('nonce', window.wpPageData.nonce);
    formData.append('s', query);
    return formData;
  }

  function handleSearchResult(answer, newItem) {
    searchList.innerHTML = '';

    setTimeout(() => {
      isSearching = true;
    }, 1000);

    searchList.innerHTML = answer;
  }

  function handleSearchResponseLogic(trimmedAnswer) {
    const includesQuery = !searchQueries.includes(trimmedAnswer);
    const includesNotFoundText = !trimmedAnswer.includes(window.wpPageData.notFoundText);

    if (includesQuery && includesNotFoundText) {
      setNewQuery(trimmedAnswer);
    }
  }

  function setNewQuery(newQuery) {
    for (let i = 1; i <= 5; i++) {
      const key = `SECRETsearch${i}`;
      localStorage.setItem(key, localStorage.getItem(`SECRETsearch${i + 1}`) || '');
      searchQueries[i - 1] = searchQueries[i] || '';
    }
    localStorage.setItem('SECRETsearch5', newQuery);
    searchQueries[4] = newQuery;
  }

  function onShowHistory() {
    if (searchInput.value.length < 3) {
      getLocalQueries();
      searchQueries.length = 5;
      renderSearchQueries();
    }
  }

  function getLocalQueries() {
    searchQueries = [];
    for (let i = 1; i <= 5; i++) {
      const key = `SECRETsearch${i}`;
      const query = localStorage.getItem(key);
      if (query) {
        searchQueries.push(query);
      }
    }
  }

  function renderSearchQueries() {
    searchList.innerHTML = '';
    searchQueries.forEach((query) => {
      if (query) {
        searchList.insertAdjacentHTML('afterbegin', query);
      }
    });
  }

  function escTags(str) {
    return str.replace(/<[^>]+>/gi, '');
  }
}

onDomReady(async () => {
  initSearch();
});
