const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');

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


// Public ressources
mix.js("resources/js/app.js", "public/js")
  .postCss("resources/css/app.css", "public/css", [
    tailwindcss,
  ]);
mix.copy('node_modules/jquery/dist/jquery.min.js', 'public/js');

// Admin ressources
mix.js("resources/admin/js/app.js", "public/admin/js")
  .sass('resources/admin/sass/fontawesome.scss', 'public/admin/css')
  .postCss("resources/admin/css/app.css", "public/admin/css", [
    tailwindcss,
  ]);
mix.copy('node_modules/jquery/dist/jquery.min.js', 'public/admin/js');
mix.copy('node_modules/@fortawesome/fontawesome-free/webfonts', 'public/webfonts');