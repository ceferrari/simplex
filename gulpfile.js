var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    //mix.sass('app.scss');

	mix.browserSync({
		'host': 'simplex.app',
		'proxy': 'simplex.app'
	});

	mix.scripts([
		'simplex.js'
	]);

	mix.styles([
		'simplex.css'
	]);

	mix.version([
		'css/all.css'
	]);
});
