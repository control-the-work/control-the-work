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

mix.copyDirectory('resources/templates/tabler/dist/assets/css', 'public/assets/css')
    .copyDirectory('resources/templates/tabler/dist/assets/fonts', 'public/assets/fonts')
    .copyDirectory('resources/templates/tabler/dist/assets/images', 'public/assets/images')
    .copyDirectory('resources/templates/tabler/dist/assets/js', 'public/assets/js')
    .copyDirectory('resources/templates/tabler/dist/assets/plugins', 'public/assets/plugins')
    ;
