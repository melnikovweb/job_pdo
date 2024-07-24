'use strict';

module.exports = {
  env: {
    browser: true,
    commonjs: true,
    es2021: true,
  },
  extends: ['standard', 'plugin:prettier/recommended'],
  plugins: ['prettier'],
  ignorePatterns: ['*.scss'],
  overrides: [
    {
      env: {
        node: true,
      },
      files: ['.eslintrc.{js,cjs}'],
      parserOptions: {
        sourceType: 'script',
      },
    },
  ],
  parserOptions: {
    ecmaVersion: 'latest',
  },
  rules: {
    semi: ['error', 'always'],
    'prettier/prettier': 'error',
  },
};
