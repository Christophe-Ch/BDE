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

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css')
   .sass('resources/sass/layout.scss', 'public/css')
   .sass('resources/sass/buttons.scss', 'public/css')
   .sass('resources/sass/notification.scss', 'public/css')
   .sass('resources/sass/ideas.scss', 'public/css')
   .sass('resources/sass/user.scss', 'public/css')
   .sass('resources/sass/event.scss', 'public/css')
   .sass('resources/sass/list-element.scss', 'public/css')
   .sass('resources/sass/search-bar.scss', 'public/css')
   .sass('resources/sass/legal-notice.scss', 'public/css')
   .sass('resources/sass/administration.scss', 'public/css')
   .sass('resources/sass/articles/index.scss', 'public/css/articles');