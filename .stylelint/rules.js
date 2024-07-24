'use strict';

module.exports = {
  rules: {
    'function-name-case': 'lower',
    'no-duplicate-selectors': true,
    'no-descending-specificity': true,
    'alpha-value-notation': ['percentage', { exceptProperties: ['/opacity/'] }],
    'color-hex-length': 'short',
    'color-named': 'never',
    'media-feature-range-notation': 'prefix',
    'selector-class-pattern': '^([a-z][a-z0-9]*)(-[_a-z0-9]+)*$',
    'custom-property-pattern': '^_?([a-z][a-z0-9]*)(-[a-z0-9]+)*$',
    'custom-property-empty-line-before': [
      'always',
      {
        except: ['after-comment', 'after-custom-property', 'first-nested'],
      },
    ],
    'declaration-empty-line-before': [
      'always',
      {
        except: ['first-nested', 'after-comment'],
        ignore: ['after-declaration'],
      },
    ],
    'at-rule-no-unknown': null,
    'at-rule-empty-line-before': [
      'always',
      {
        except: ['blockless-after-blockless', 'first-nested'],
        ignoreAtRules: ['else'],
      },
    ],
    'selector-max-id': 0,
    'selector-max-universal': 2,
    'no-unknown-animations': true,
    'named-grid-areas-no-invalid': true,
    'string-no-newline': true,
    'function-calc-no-unspaced-operator': true,
    'shorthand-property-no-redundant-values': true,
    'declaration-block-no-redundant-longhand-properties': true,
    'selector-attribute-quotes': 'always',
    'declaration-no-important': true,
    'property-no-vendor-prefix': true,
    'function-url-quotes': 'always',
    'font-weight-notation': 'numeric',
    'font-family-name-quotes': 'always-unless-keyword',
    'comment-whitespace-inside': 'always',
    'at-rule-no-vendor-prefix': true,
    'rule-empty-line-before': [
      'always',
      {
        except: ['first-nested', 'after-single-line-comment'],
      },
    ],
    'declaration-property-unit-allowed-list': [
      {
        '/^line-height/': [],
        '/^animation/': ['ms'],
        '/^transition/': ['ms'],
      },
    ],
    'comment-word-disallowed-list': ['/[А-я]+/'],
    'at-rule-disallowed-list': ['import'],
    'selector-pseudo-element-colon-notation': 'double',
  },
};
