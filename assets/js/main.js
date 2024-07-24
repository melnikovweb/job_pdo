const fade = document.querySelectorAll('.fade-in');

const appearOptions = {
  threshold: 0,
  rootMargin: '0px 0px -25% 0px',
};

const appearOnScroll = new IntersectionObserver((entries, appearOnScroll) => {
  entries.forEach((entry) => {
    if (!entry.isIntersecting) {
      return;
    }

    entry.target.classList.add('appear');
    appearOnScroll.unobserve(entry.target);
  });
}, appearOptions);

fade.forEach((fader) => {
  appearOnScroll.observe(fader);
});

const searchElement = document.querySelector('.custom-search');

if (searchElement) {
  const searchField = searchElement.querySelector('.custom-search-input-field');

  window.addEventListener('click', () => {
    searchElement.classList.toggle('show-result', searchField === document.activeElement);
  });
}
