import { onDomReady } from '@shared/services/dom-services';

onDomReady(() => {
  const fileInput = document.querySelectorAll('input[type="file"]');

  fileInput.forEach((event) => {
    event.addEventListener('change', function () {
      if (event.files.length > 0) {
        event.classList.add('file-attached');
      } else {
        event.classList.remove('file-attached');
      }
    });
  });
});
