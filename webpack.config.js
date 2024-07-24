const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const TerserPlugin = require('terser-webpack-plugin');
const CssMinimizerPlugin = require('css-minimizer-webpack-plugin');
const StylelintPlugin = require('stylelint-webpack-plugin');
const ESLintPlugin = require('eslint-webpack-plugin');
const glob = require('glob');

const EXTERNALS = {
  swiper: 'Swiper',
  choices: 'Choices',
  datatable: 'DataTable',
  jquery: 'jQuery',
  isotope: 'Isotope',
  lottie: 'lottie',
  '@global/constants': 'wpGlobalConstants',
};

const ALIASES = {
  '@shared': path.resolve(__dirname, 'src/shared'),
  '@parts': path.resolve(__dirname, 'src/parts'),
};

const isProduction = process.env.NODE_ENV === 'production';
const getResolvedPaths = (items) => items.map((item) => path.resolve(__dirname, item));

const replaceStyleStringLoader = {
  loader: 'string-replace-loader',
  options: {
    multiple: [
      {
        search: 'fonts/SECRET-landing',
        replace: path.resolve(__dirname, 'assets/libs/icons/fonts/SECRET-landing'),
        flags: 'g',
      },
    ],
  },
};

const getEntries = ({ root, isStrict = false }) => {
  const rawPath = isStrict ? `src/${root}` : `src/${root}/*`;
  const rawEntries = getResolvedPaths(glob.sync([`${rawPath}/*.js`, `${rawPath}/*.scss`]));

  return rawEntries.reduce((entries, filePath) => {
    const pathPieces = path.parse(filePath);
    const entryRoot = path.basename(pathPieces.dir);
    const ext = path.extname(filePath);
    const name = path.basename(filePath, ext);
    const entryKey = isStrict ? `${root}/${name}` : `${root}/${name}/${name}`;

    if (entryRoot === name) {
      entries[entryKey] = [...(entries[entryKey] ?? []), filePath];
    }

    return entries;
  }, {});
};

const config = {
  entry() {
    return {
      ...getEntries({ root: 'core', isStrict: true }),
      ...getEntries({ root: 'vendors', isStrict: true }),
      ...getEntries({ root: 'components' }),
      ...getEntries({ root: 'parts' }),
      ...getEntries({ root: 'views' }),
    };
  },
  output: {
    filename: '[name].js?[fullhash]',
    path: path.resolve(__dirname, 'public'),
    clean: true,
    assetModuleFilename: '../[file]',
  },
  watchOptions: {
    aggregateTimeout: 200,
    poll: 1000,
    ignored: /node_modules/,
  },
  plugins: [
    require('autoprefixer'),
    new StylelintPlugin({
      fix: true,
      files: [path.resolve(__dirname, 'src', '**', '*.scss')],
    }),
    new ESLintPlugin({
      files: [path.resolve(__dirname, 'src', '**', '*.{js,jsx,ts}')],
    }),
    new MiniCssExtractPlugin({
      filename: '[name].css?[fullhash]',
    }),
  ],
  optimization: {
    minimize: isProduction,
    minimizer: [new TerserPlugin(), new CssMinimizerPlugin()],
  },
  module: {
    rules: [
      {
        test: /\.(js|jsx)$/i,
        loader: 'babel-loader',
      },
      {
        test: /\.s[ac]ss$/i,
        exclude: [path.resolve(__dirname, 'src', 'components')],
        use: [MiniCssExtractPlugin.loader, 'css-loader', replaceStyleStringLoader, 'postcss-loader', 'sass-loader'],
      },
      {
        test: /\.s[ac]ss$/i,
        include: [path.resolve(__dirname, 'src', 'components')],
        use: ['css-loader', 'postcss-loader', 'sass-loader'],
      },
      {
        test: /\.css$/i,
        use: [MiniCssExtractPlugin.loader, 'css-loader', replaceStyleStringLoader, 'postcss-loader'],
      },
      {
        test: /\.(eot|svg|ttf|woff|woff2|png|jpg|gif)$/i,
        type: 'asset/resource',
        generator: {
          emit: false,
        },
      },
      {
        test: /\.html$/i,
        loader: 'html-loader',
      },
    ],
  },
  externals: EXTERNALS,
  resolve: {
    alias: ALIASES,
  },
};

module.exports = () => {
  config.mode = isProduction ? 'production' : 'development';

  return config;
};
