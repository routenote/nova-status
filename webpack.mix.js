let mix = require('laravel-mix')

mix.setPublicPath('dist')
    .styles(['resources/sass/app.css'], 'dist/css/app.css')
    .js('resources/js/app.js', 'js')
