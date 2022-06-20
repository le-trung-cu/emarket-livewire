const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');
const autoprefixer = require('autoprefixer');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

// admin
mix.copy('resources/admin/js/init-alpine.js', 'public/admin/js')
.js('resources/admin/js/app.js', 'public/admin/js')
.postCss('resources/admin/css/app.css', 'public/admin/css', [
    tailwindcss('tailwind-admin.config.js'),
    autoprefixer,
]);


// site
mix.postCss('resources/site/css/app.css', 'public/site/css', [
    require('tailwindcss'),
    autoprefixer,
]);

mix.js('resources/js/app.js', 'public/js').postCss('resources/css/app.css', 'public/css', [
    require('tailwindcss'),
    autoprefixer,
]);
