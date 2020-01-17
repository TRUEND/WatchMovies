const mix = require('laravel-mix');

createFiles("app.js", "app.scss");
createFiles("Movies.js", "Movies.scss");

mix.sass("resources/sass/index.scss", "public/css");

//compile the files in the public/file_type folder.
function createFiles(js, sass)
{
    mix.js(`resources/js/${js}`, 'public/js')
    .sass(`resources/sass/${sass}`, 'public/css');
};