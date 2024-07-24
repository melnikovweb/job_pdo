onDomReady(async () => {
  const { initSlider } = useRecommendationsSlider();

  const { initLineClamp } = useLineClamp();
  initLineClamp();

  initSlider("#case-studies");

  const countryBlocks = [...document.querySelectorAll(".ba-countries-block")];

  countryBlocks.forEach((container) => {
    const rawData = container.dataset.json;

    if (!rawData) {
      return;
    }

    const buttonWrapper = document.createElement("div");
    buttonWrapper.innerHTML = `
      <button type="button" class="ba-countries-block__more"></button>
    `;

    const currencies = JSON.parse(rawData);
    const itemsPerView = parseInt(container.dataset.itemsPerView, 10);
    const button = buttonWrapper.firstElementChild;

    const elements = currencies.map((currencyItem) => {
      const wrapper = document.createElement("div");
      wrapper.innerHTML = `
        <div class="ba-countries-block__currency">
          <img src="${currencyItem.flag}" alt="" />

          ${currencyItem.currency}
        </div>
      `;

      return wrapper.firstElementChild;
    });

    const shortList = elements.slice(0, itemsPerView - 1);
    let isItemsShown = false;

    container.append(...shortList);

    if (shortList.length < elements.length) {
      button.innerHTML = `+${elements.length - shortList.length}`;
      container.append(button);
    }

    button.addEventListener("click", () => {
      container.innerHTML = "";

      if (isItemsShown) {
        container.append(...elements);
        button.innerHTML = `-${elements.length - shortList.length}`;
      } else {
        container.append(...shortList);
        button.innerHTML = `+${elements.length - shortList.length}`;
      }

      container.append(button);
      isItemsShown = !isItemsShown;
    });
  });
});

function useTemplates() {
  const getCurrencyCard = (data) => {
    return `
      <div class="currency-card">
        <div class="currency-card__media">
          <img src="${data.flag}" alt="${data.currency}">
        </div>

        <div class="currency-card__content">
          ${data.currency}
        </div>
      </div>
    `;
  };

  // ind more btn
  $(".industry-btn").on("click", () => {
    $(".industry__item").toggleClass("active");
    if ($(".industry__item").eq(0).hasClass("active")) {
      $(".industry-btn").text($(".industry-btn").attr("data-less"));
    } else {
      $(".industry-btn").text($(".industry-btn").attr("data-more"));
    }
  });

  // $(".business-transfers-btn").on("click", () => {
  //   $(".business-transfers__group").toggleClass("active");
  //   if ($(".business-transfers__group").eq(0).hasClass("active")) {
  //     $(".business-transfers-btn").text(
  //       $(".business-transfers-btn").attr("data-less"),
  //     );
  //   } else {
  //     $(".business-transfers-btn").text(
  //       $(".business-transfers-btn").attr("data-more"),
  //     );
  //   }
  // });

  $(".currency-table-btn").on("click", () => {
    $(".currency-table__group").toggleClass("active");
    if ($(".currency-table__group").eq(0).hasClass("active")) {
      $(".currency-table-btn").text($(".currency-table-btn").attr("data-less"));
    } else {
      $(".currency-table-btn").text($(".currency-table-btn").attr("data-more"));
    }
  });

  if ($(".one-btn").length) {
    $(".one-btn").eq(0).addClass("active");
    $(".tabs__tab").eq(0).addClass("active");
    $(".one-btn").each(function (index) {
      $(this).on("click", () => {
        $(".one-btn").removeClass("active");
        $(this).addClass("active");
        $(".tabs__tab").removeClass("active");
        $(".tabs__tab").eq(index).addClass("active");
      });
    });
  }

  $(".one__select-top").on("click", () => {
    $(".one__select").toggleClass("active");
  });
  $("body").on("click", (e) => {
    if (!e.target.closest(".one__select")) {
      $(".one__select").removeClass("active");
    }
  });
  $(".one__select-bot-item").each(function (index) {
    $(this).on("click", () => {
      $(".one__select-bot-item").removeClass("active");
      $(this).addClass("active");
      $(".one__select").removeClass("active");
      $(".one__select-top-title").text($(this).text());
      $(".tabs__tab").removeClass("active");
      $(".tabs__tab").eq(index).addClass("active");
    });
  });
  $(".one__select-bot-item").eq(0).addClass("active");
  $(".one__select-top-title").text($(".one__select-bot-item").eq(0).text());

  return {
    getCurrencyCard,
  };
}
