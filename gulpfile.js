'use strict';

var gulp = require( 'gulp' );

var jshint = require( 'gulp-jshint' );
var sass = require( 'gulp-sass' );
var concat = require( 'gulp-concat' );
var uglify = require( 'gulp-uglify' );
var rename = require( 'gulp-rename' );

gulp.task( 'lint', function() {
	return gulp.src( 'views/assets/js/*.js' )
		.pipe( jshint() )
		.pipe( jshint.reporter( 'default' ) );
} );

gulp.task( 'css', function() {
	return gulp.src( 'views/assets/css/*.css' )
		.pipe( sass() )
		.pipe( gulp.dest( 'dist/css' ) );
} );

gulp.task( 'scripts', function() {
	return gulp.src( 'views/assets/js/*.js' )
		.pipe( concat( 'all.js' ) )
		.pipe( gulp.dest( 'dist' ) )
		.pipe( rename( 'all.min.js' ) )
		.pipe( uglify() )
		.pipe( gulp.dest( 'dist/js' ) );
} );

gulp.task('watch', function() {
	gulp.watch('js/*.js', ['lint', 'scripts']);
	gulp.watch('css/*.css', ['sass']);
});

gulp.task('default', ['lint', 'sass', 'scripts', 'watch']);