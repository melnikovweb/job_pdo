class PaymentSchemesService {
  getCurrencyCardTemplate({ flag, name }) {
    return `
        <div class="currency-card">
          <div class="currency-card__media">
            <img src="${flag}" alt="${name}">
          </div>
  
          <div class="currency-card__content">${name}</div>
        </div>
      `;
  }

  async getCurrencies$() {
    const url = `${window.paymentSchemesData.templateUrl}/assets/data/currencies.json`;
    const responce = await fetch(url);
    const data = await responce.json();

    return data;
  }
}

export const paymentSchemesService = new PaymentSchemesService();
