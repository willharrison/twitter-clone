var elixir = require('laravel-elixir');

var paths = {
    'bootstrap': './bower_components/bootstrap-sass-official/assets/stylesheets',
    'fontawesome': './bower_components/fontawesome'
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
    mix.sass("app.scss", "public/css", {
        includePaths: [
            paths.bootstrap,
            paths.fontawesome + '/scss'
        ]
    })
    mix.version("public/css/app.css");
    mix.copy(paths.fontawesome + '/fonts', 'public/build/fonts');
});
