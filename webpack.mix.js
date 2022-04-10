const mix = require('laravel-mix');

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

mix
    .js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
        require('autoprefixer'),
    ])
    .sass('resources/scss/font-awesome.scss', 'public/css')
    .copyDirectory('vendor/tinymce/tinymce', 'public/js/tinymce')
    .copyDirectory('resources/js/tinymce/langs', 'public/js/tinymce/langs');

mix.browserSync('http://localhost');