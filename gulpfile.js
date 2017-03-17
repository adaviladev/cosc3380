'use strict';

var gulp = require( 'gulp' );

var jshint = require( 'gulp-jshint' );
var sass = require( 'gulp-sass' );
var concat = require( 'gulp-concat' );
var uglify = require( 'gulp-uglify' );
var rename = require( 'gulp-rename' );
var concatCss = require( 'gulp-concat-css' );
var cleanCss = require( 'gulp-clean-css' );

gulp.task( 'lint', function() {
	return gulp.src( 'views/assets/js/*.js' )
		.pipe( jshint() )
		.pipe( jshint.reporter( 'default' ) );
} );

gulp.task( 'css', function() {
	return gulp.src( 'views/assets/css/*.css' )
		.pipe( concatCss( 'all.min.css' ) )
		.pipe( cleanCss() )
		.pipe( gulp.dest( 'views/assets/bundle/css' ) );
} );

gulp.task( 'scripts', function() {
	return gulp.src( [ 'views/assets/js/vendor/*.js', 'views/assets/js/*.js'] )
		.pipe( concat( 'all.min.js' ) )
		.pipe( gulp.dest( 'views/assets/bundle/js' ) )
		.pipe( rename( 'all.min.js' ) )
		.pipe( uglify() )
		.pipe( gulp.dest( 'views/assets/bundle/js' ) );
} );

gulp.task( 'watch', function() {
	gulp.watch( 'views/assets/js/*.js', [ 'lint', 'scripts' ] );
	gulp.watch( 'views/assets/css/*.css', [ 'css' ] );
} );

gulp.task( 'default', [ 'lint', 'css', 'scripts', 'watch' ] );