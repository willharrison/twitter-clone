var elixir = require('laravel-elixir');

var paths = {
    'bootstrapsass': './bower_components/bootstrap-sass-official/assets/',
    'bootstrapless': './bower_components/bootstrap/dist/',
    'angular': './bower_components/angular/'
}

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    //mix.sass("style.scss", 'public/css', { includePaths: [ paths.bootstrap + 'stylesheets/' ] })
    //.copy(paths.bootstrap + 'fonts/bootstrap/**', 'public/fonts')
    mix.copy(paths.bootstrapless + 'css/bootstrap.css', 'public/css/bootstrap.css')
        .copy(paths.angular + 'angular.js', 'public/js/angular.js');
        /*
        .scripts([
            paths.angular + 'angular.js',
            paths.jquery + 'dist/jquery.js',
            paths.bootstrap + 'javascripts/bootstrap.js'
        ], './', 'public/js/app.js');
        */
});
