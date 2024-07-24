function useArrayUtils() {
  const shuffle = (array) => {
    const newArray = [...array];

    for (let index = newArray.length - 1; index > 0; index--) {
      const randomIndex = Math.floor(Math.random() * (index + 1));
      const item = newArray[index];

      newArray[index] = newArray[randomIndex];
      newArray[randomIndex] = item;
    }

    return newArray;
  };

  const divide = (array, amount) => {
    const arrayClone = [...array];
    const parts = [];

    for (let index = amount; index > 0; index--) {
      parts.push(arrayClone.splice(0, Math.ceil(arrayClone.length / index)));
    }

    return parts;
  };

  return {
    shuffle,
    divide,
  };
}

export { useArrayUtils };
