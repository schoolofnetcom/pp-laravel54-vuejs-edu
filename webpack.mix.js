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

mix.js('resources/assets/admin/js/admin.js', 'public/js')
   .sass('resources/assets/admin/sass/admin.scss', 'public/css')
    .sourceMaps();

mix.js('resources/assets/spa/js/spa.js', 'public/js')
    .sass('resources/assets/spa/sass/spa.scss', 'public/css')
    .sourceMaps();


mix.browserSync('localhost:8000'); //:3000
//8000 - Laravel

