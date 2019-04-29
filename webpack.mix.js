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

mix.copyDirectory('resources/assets/templates/tabler/dist/assets/css', 'public/assets/css')
    .copyDirectory('resources/assets/templates/tabler/dist/assets/fonts', 'public/assets/fonts')
    .copyDirectory('resources/assets/templates/tabler/dist/assets/js', 'public/assets/js')
    .copyDirectory('resources/assets/templates/tabler/dist/assets/plugins', 'public/assets/plugins')
    .copyDirectory('resources/assets/plugins/sweetalert2/8.9.0/dist', 'public/assets/plugins/sweetalert2/8.9.0/dist')
    .copy('resources/assets/images/icons/*.ico', 'public/assets/images/icons')
    .copy('resources/assets/images/icons/*.png', 'public/assets/images/icons')
    .copy('resources/assets/images/icons/*.svg', 'public/assets/images/icons')
    .copy('resources/assets/images/logos/*.png', 'public/assets/images/logos')
    .copy('resources/assets/images/logos/*.svg', 'public/assets/images/logos')
    ;
