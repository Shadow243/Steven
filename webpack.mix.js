const { mix } = require('laravel-mix');

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
   .combine([
       'public/assets/css/bootstrap.css',
       'public/assets/css/animate.css',
       'public/assets/css/font-awesome.css',
       'public/assets/css/timeline.css',
       'public/assets/css/style.css',
   ], 'public/css/style.css');

if (mix.config.inProduction) {
  mix.version();
}