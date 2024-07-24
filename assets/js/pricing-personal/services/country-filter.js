function useFilters( options ) {
  const countriesElement = document.getElementById( 'countries-filter' );
  const updateSelectStructure = ( select ) => {
    const inputElementContainer = document.createElement( 'div' );
    const innerElement = select.containerInner.element;
    const inputElement = select.input.element;
    const outerElement = select.containerOuter.element;

    outerElement.classList.add( 'icon-chevron-down' );

    inputElementContainer.classList.add( 'filters-search-wrapper' );
    inputElementContainer.classList.add( 'icon-search' );
    inputElementContainer.append( inputElement );

    innerElement.append( inputElementContainer );
  };

  const countriesOptions = options.allCountries.map( ( country ) => ( {
    value: country.cca2,
    label: country.name.common,
    customProperties: {
      cca2: country.cca2,
      region: country.region,
      flag: country.flags.svg,
    },
  } ) );

  let person_country = localStorage.getItem("person_country");
  let current_country;
  if (person_country){
    for (const element of countriesOptions){
      if (element.value === person_country){
        element.selected = true;
        current_country = element;
        break;
      }
    }
  }
  
  const countriesFilter = new Choices( countriesElement, {
    choices: countriesOptions,
    items: [current_country],
    allowHTML: true,
    searchPlaceholderValue: options.countryFilterPlaceholder,
    callbackOnCreateTemplates( template ) {
      return {
        item: ( { classNames }, data ) => {
          const isHighlightedClass = data.highlighted
            ? classNames.highlightedState
            : classNames.itemSelectable;

          const isActive = data.active ? 'aria-selected="true"' : '';
          const isDisabled = data.disabled ? 'aria-disabled="true"' : '';
          const placeholder = data.placeholder ? classNames.placeholder : '';

          const classes = `${ classNames.item } ${ isHighlightedClass } ${ placeholder }`;

          const image = data.customProperties.flag
            ? `<img src="${ data.customProperties.flag }" alt="">`
            : '';

          return template( `
            <div class="${ classes }" data-item data-id="${ data.id }" data-value="${ data.value }" ${ isActive } ${ isDisabled }>
               ${ image } ${ data.label }
            </div>
          ` );
        },
        choice: ( { classNames }, data ) => {
          const isDisabledClass = data.disabled
            ? classNames.itemDisabled
            : classNames.itemSelectable;

          const isDisabledAttributes = data.disabled
            ? 'data-choice-disabled aria-disabled="true"'
            : 'data-choice-selectable';

          const classes = `${ classNames.item } ${ classNames.itemChoice } ${ isDisabledClass }`;
          const role = data.groupId > 0 ? 'role="treeitem"' : 'role="option"';

          return template( `
            <div 
              class="${ classes }"
              data-select-text="${ this.config.itemSelectText }"
              data-choice ${ isDisabledAttributes } 
              data-id="${ data.id }" data-value="${ data.value }" 
              ${ role }
            >
              <img src="${ data.customProperties.flag }" alt=""> ${ data.label }
            </div>
        ` );
        },
      };
    },
    searchFields: [
      'label',
      'value',
      'customProperties.cca2',
      'customProperties.region',
    ],
  } );

  updateSelectStructure( countriesFilter );

  return {
    countriesFilter,
  };
}
