function useLineClamp(stateClass = 'shown') {
  const initLineClamp = () => {
    const containers = [...document.querySelectorAll("[data-clamp='container']")];

    containers.forEach((container) => {
      const text = container.querySelector("[data-clamp='text']");
      const action = container.querySelector("[data-clamp='action']");

      if (!action || !text) {
        return;
      }

      const isTextCutted = text.scrollHeight > text.clientHeight;

      action.style.display = isTextCutted ? '' : 'none';

      action.addEventListener('click', () => {
        text.classList.toggle(stateClass);
        action.classList.toggle(stateClass);
      });
    });
  };

  const updateLineClamp = () => initLineClamp();

  return {
    initLineClamp,
    updateLineClamp,
  };
}

export { useLineClamp };
