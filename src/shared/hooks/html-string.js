function useHtmlString() {
  const getHtmlElement = (htmlString) => {
    const wrapper = document.createElement('div');
    wrapper.innerHTML = htmlString;

    return wrapper.firstElementChild;
  };

  return {
    getHtmlElement,
  };
}

export { useHtmlString };
