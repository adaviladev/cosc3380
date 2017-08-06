var fs = require("fs");
var browserify = require('browserify');
var vueify = require('vueify');
var gulp = require('gulp');
var babelify = require('babelify');

gulp.task('vueify', function () {
  return browserify('./public/assets/src/js/main.js')
  .transform(babelify, { presets: ['es2015'], plugins: ["transform-runtime"] })
  .transform(vueify)
  .bundle()
  .pipe(fs.createWriteStream("./public/assets/dist/bundle/all.min.js"));
});

gulp.task('default', function() {
  gulp.watch('./public/assets/src/js/**/*.js', ['vueify']);
  gulp.watch('./public/assets/src/js/**/*.vue', ['vueify']);
});