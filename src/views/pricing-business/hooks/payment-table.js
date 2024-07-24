function getPricingData(items) {
  const itemsToDisplay = document.querySelectorAll('.pricing-filters-data');

  itemsToDisplay.forEach(function (item) {
    const tierId = item.getAttribute('data-tier');
    if (tierId.trim().toLocaleLowerCase() === 'tier_1') {
      item.classList.remove('display-none');
    } else {
      item.classList.add('display-none');
    }
  });

  let tierValue = {};

  const calcWeight = (weights) => {
    const { total, weight } = Object.keys(weights)
      .map((key) => {
        const { weight: singleWeight, tier } = weights[key];
        const weightedSum = tier * singleWeight;
        return { weightedSum, singleWeight };
      })
      .reduce(
        (accumulator, { weightedSum, singleWeight }) => {
          return {
            total: accumulator.total + weightedSum,
            weight: accumulator.weight + singleWeight,
          };
        },
        { total: 0, weight: 0 },
      );

    return total / weight;
  };

  const filterItems = (selectedCurrency) => {
    const itemsToDisplay = document.querySelectorAll('.pricing-filters-data');
    itemsToDisplay.forEach(function (item) {
      const tierId = item.getAttribute('data-tier');
      if (selectedCurrency === tierId.trim()) {
        item.classList.remove('display-none');
      } else {
        item.classList.add('display-none');
      }
    });
  };

  const calcTier = () => {
    if (Object.keys(tierValue).length === 4) {
      const tierMap = ['tier_1', 'tier_2', 'tier_3'];

      const weight = Number(calcWeight(tierValue).toFixed());

      const choice = tierMap[weight - 1] || tierMap[0];
      filterItems(choice);
    }
  };

  const countrySelect = document.getElementById('country-of-incorporation-filter');

  const industriesSelect = document.getElementById('industries-filter');

  const ageInGroup = document.getElementsByName('age-of-incorporation-filter');
  const turnoverGroup = document.getElementsByName('turnover-filter');

  countrySelect.addEventListener('change', function () {
    const selectedValue = this.value.trim();
    if (!tierValue.country) {
      tierValue = { ...tierValue, country: { tier: selectedValue, weight: 0.25 } };
    } else {
      tierValue.country.tier = selectedValue;
    }
    calcTier();
  });

  industriesSelect.addEventListener('change', function () {
    const selectedValue = this.value.trim();
    if (!tierValue.industries) {
      tierValue = { ...tierValue, industries: { tier: selectedValue, weight: 0.51 } };
    } else {
      tierValue.industries.tier = selectedValue;
    }
    calcTier();
  });

  ageInGroup.forEach(function (radio) {
    radio.addEventListener('change', function () {
      if (radio.checked) {
        const selectedValue = radio.value.trim();
        if (!tierValue.ageInc) {
          tierValue = { ...tierValue, ageInc: { tier: selectedValue, weight: 0.1 } };
        } else {
          tierValue.ageInc.tier = selectedValue;
        }

        calcTier();
      }
    });
  });

  turnoverGroup.forEach(function (radio) {
    radio.addEventListener('change', function () {
      if (radio.checked) {
        const selectedValue = radio.value.trim();
        if (!tierValue.turnover) {
          tierValue = { ...tierValue, turnover: { tier: selectedValue, weight: 0.1 } };
        } else {
          tierValue.turnover.tier = selectedValue;
        }

        calcTier();
      }
    });
  });
}

export { getPricingData };
