var elixir = require('laravel-elixir');

var paths = {
    'bootstrap': './bower_components/bootstrap-sass-official/assets/stylesheets',
    'fontawesome': './bower_components/fontawesome',
    'jquery': './bower_components/jquery/dist'
}

elixir(function(mix) {
    mix.sass("app.scss", "public/css", {
        includePaths: [
            paths.bootstrap,
            paths.fontawesome + '/scss'
        ]
    });
    mix.styles([
        'app.css'
    ], 'public/css/app-compiled.css', 'public/css');
    mix.version("public/css/app-compiled.css");
    mix.copy(paths.fontawesome + '/fonts', 'public/build/fonts');
    mix.copy('resources/assets/js/ckeditor', 'public/js/ckeditor/');
    mix.copy('resources/assets/css', 'public/css/');
    mix.scripts([
        '../../../' + paths.jquery + '/jquery.js',
        '../../../' + paths.bootstrap + '/../javascripts/bootstrap.js',
        'modalPosition.js',
        'helperFunctions.js',
        'profile.js'
    ], 'public/js/app.js', 'resources/assets/js');
});
