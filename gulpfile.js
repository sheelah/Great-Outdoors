// Dependencies
var pkg = require('./package.json');
var config = require('./app_config.json');
var banner = require('gulp-banner');
var gulp = require('gulp');
var sass = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');
var uglify = require('gulp-uglify');
var concat = require('gulp-concat');
var jshint = require('gulp-jshint');
var sourcemaps = require('gulp-sourcemaps');
var stylish = require('jshint-stylish');
var phplint = require('gulp-phplint');
var newer = require('gulp-newer');
var rename = require('gulp-rename');
var size = require('gulp-size');
var browserSync = require('browser-sync').create();

var comment =  ['/*! <%= pkg.title || pkg.name %> - v<%= pkg.version %>',
      '<%= pkg.homepage ? pkg.homepage : "" %>',
      'Copyright (c) <%= new Date().getFullYear() %> <%= pkg.author %>',
      'Licensed <%= pkg.license %> */\n',
    ].join(' | ');

// Tasks
gulp.task('js-app', function() {
  gulp.src(['js/lib/sticky-footer.js', 'js/src/*.js', '!js/src/customizer.js'])
    .pipe(sourcemaps.init())
    .pipe(concat('greatoutdoors.js'))
    .pipe(rename('greatoutdoors.min.js'))
    .pipe(uglify())
    .pipe(banner(comment, {pkg: pkg}))
    .pipe(size({gzip: true, showFiles: true}))
    .pipe(sourcemaps.write('./'))
    .pipe(gulp.dest('js/'))
});

gulp.task('sass', function() {
  return gulp.src('sass/**/*.scss')
    .pipe(sourcemaps.init())
    .pipe(sass({
      includePaths: 'bower_components/foundation/scss',
      outputStyle: 'compressed'
     }).on('error', sass.logError))
    .pipe(autoprefixer({browsers: ['last 2 versions']}))
    .pipe(size({gzip: true, showFiles: true}))
    .pipe(sourcemaps.write('./'))
    .pipe(gulp.dest('./'))
});

gulp.task('jshint', function() {
  gulp.src('js/src/*.js')
    .pipe(jshint())
    .pipe(jshint.reporter('jshint-stylish'))
});

gulp.task('js-customizer', function() {
  gulp.src('js/src/customizer.js')
    .pipe(rename('customizer.min.js'))
    .pipe(uglify())
    .pipe(gulp.dest('js/'))
});

gulp.task('phplint', function() {
  gulp.src('**/*.php')
    .pipe(phplint())
});

gulp.task('watch', function() {
  gulp.watch('sass/**/*.scss', ['sass']);
  gulp.watch('js/**/*.js', ['jshint', 'js-app', 'js-customizer']);
  gulp.watch('**/*.php', ['phplint']);
});

gulp.task('browser-sync', function() {
  browserSync.init({
    proxy: config['proxy'],
    files: [
            '*.css',
            'js/**/*.js',
            '**/*.php',
            'images/*.jpg',
            'images/*.png',
          ],
    logLevel: 'debug',
  });
});

// Dev and build tasks
gulp.task('default',function() {
  gulp.start('browser-sync', 'watch');
});

gulp.task('build', function() {
  gulp.start('js-app', 'js-customizer', 'sass');
});

gulp.task('lint', function() {
  gulp.start('phplint', 'jshint');
});

