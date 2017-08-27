const fs = require("fs");
const browserify = require('browserify');
const vueify = require('vueify');
const gulp = require('gulp');
const babelify = require('babelify');

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