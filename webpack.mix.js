const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

//mix.js('resources/js/app.js', 'public/js')
  //  .sass('resources/sass/app.scss', 'public/css');

mix.js([
    'public/vendor/jquery/jquery.min.js',//
    "public/vendor/bootstrap/js/bootstrap.bundle.min.js",
    "public/vendor/jquery-easing/jquery.easing.min.js",
    'resources/js/app.js',//
    "public/js/sb-admin-2.min.js",
    "public/vendor/chart.js/Chart.min.js",
], 'js/app.js').styles([
    "public/vendor/fontawesome-free/css/all.min.css",
    "public/css/sb-admin-2.min.css",
    'resources/sass/app.scss',
], 'public/css/app.css');
