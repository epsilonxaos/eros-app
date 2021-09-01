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
.js('resources/js/mapa.js', 'public/js')
.js('resources/js/galeria.js', 'public/js')
.version();

mix.sass('resources/sass/plugins.scss', 'public/css')
.sass('resources/sass/app.scss', 'public/css')
.sass('resources/sass/web/home.scss', 'public/css')
.sass('resources/sass/web/catalogo.scss', 'public/css')
.sass('resources/sass/web/extras.scss', 'public/css')
.version();


mix.js('resources/js/panel/scripts/index.js', 'public/panel/js/main.js').version();
mix.copy('resources/vendor/nucleo', 'public/panel/vendor/nucleo')
.copy('node_modules/@fortawesome/fontawesome-free', 'public/panel/vendor/@fortawesome/fontawesome-free')
.copy('node_modules/trumbowyg/dist/ui/icons.svg', 'public/panel/vendor/trumbowyg/dist/ui/icons.svg');

mix.styles([
    'resources/vendor/panel.css'
], 'public/panel/css/main.css');
