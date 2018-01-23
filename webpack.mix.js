let mix = require('laravel-mix');

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

mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css')
   .sass('resources/assets/sass/custom.scss', 'public/css');


mix.styles([
    'public/css/app.css',
    'resources/assets/gentella/build/css/custom.css',
    'resources/assets/gentella/vendors/font-awesome/css/font-awesome.min.css',
    'resources/assets/gentella/vendors/select2/dist/css/select2.min.css',
    'resources/assets/gentella/vendors/sweetalert2/dist/sweetalert2.min.css',
    'public/css/custom.css'
], 'public/css/style.css');