// -------------------- Required modules --------------------
var { task, src, dest, watch, series } = require('gulp'),
	chmod = require('gulp-chmod'),
	plumber = require('gulp-plumber'),
	postcss = require('gulp-postcss'),
	sass = require('gulp-sass'),
	autoprefixer = require('autoprefixer'),
	cssnano = require('cssnano');

// -------------------- Configure object --------------------
var config = {};
config.src = './assets';
config.SCSS = config.src + '/scss';
config.CSS = config.src + '/css';
config.buildTasks = ['sass'];

//  -------------------- Gulp Tasks --------------------
// Compile SASS into CSS
task('sass', function() {
	var plugins = [ 
		autoprefixer(),
		cssnano()
	];
	return src(config.SCSS +'/*.scss')
		.pipe(plumber())
		.pipe(sass())
		.pipe(postcss(plugins))
		.pipe(chmod(0o755))
		.pipe(dest(config.CSS))
});

// Watches scss files
task('watch', series('sass', function(done) {
	watch([config.SCSS + '/*.scss', config.SCSS + '/_*.scss'], series('sass'));
	watch([config.SCSS + '/page/*.scss', config.SCSS + '/page/_*.scss'], series('sass'));
	done();
}));

task('build', series(config.buildTasks));

task('default', series('watch'));