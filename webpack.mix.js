const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');

mix.postCss('./src/css/styles.css', './public/css/styles.css',
  tailwindcss('./tailwind.config.js')
);