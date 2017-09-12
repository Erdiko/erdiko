'use strict';

// Useful vars for configuring in your environment
/*-------------------------------------------------------------------------------------------------*/

// var parentThemeRoot  = "../../../vendor/erdiko/wordpress/themes/clean-blog/"; // for themes updated with composer
var renderedThemeRoot  = "../../public/";

var themeName       = "bootstrap";
var renderedTheme   = renderedThemeRoot+'themes/'+themeName;

var jQueryJs        = "node_modules/jquery/dist/jquery.slim.js";

var tetherJs        = "node_modules/tether/dist/js/tether.js";

var popperJs        = "node_modules/popper.js/dist/umd/popper.min.js";

var bootstrapJs     = "node_modules/bootstrap/dist/js/bootstrap.js";

// var cleanBlogJs     = parentThemeRoot+"scripts/clean-blog.js";


// Boilerplate & Setup
/*-------------------------------------------------------------------------------------------------*/

var gulp = require('gulp');

// load plugins from package.json file
var $ = require('gulp-load-plugins')();
    $.del = require('del');
    $.runSequence = require('run-sequence');

// Make 'build' the default task
gulp.task('default', function() {
   gulp.start('build');
});

// Notify when build is complete
gulp.task('notify:buildComplete', function(callback) {
   $.notify().write("Build Complete");
   callback();
});

// Empty 'stage' directory so we can start fresh
gulp.task('clean:stage', function(callback) {
   $.del([
      'stage/**/*',
  ], callback);
});


// Main Tasks
/*-------------------------------------------------------------------------------------------------*/

// build - The main task that runs all subtasks
gulp.task('build', function(callback) {
   $.runSequence(
      'clean:stage',
      ['styles',
          'tether-scripts',
          'popper-scripts',
          'bootstrap-scripts', 'jquery-scripts', 'scripts'],
      ['minify-css', 'minify-js'],
      'notify:buildComplete',
      callback
   );
});


// Subtasks
/*-------------------------------------------------------------------------------------------------*/


// Compile SASS
gulp.task('styles', function(callback) {
   return gulp.src('styles/**/*.scss')
      .pipe($.order([
          "styles.css",
          "**/*.scss"
      ]))
      // Load existing internal sourcemap
      .pipe($.sourcemaps.init())
      // generate CSS from SASS
      .pipe($.sass())
      // Catch any errors and prevent them from crashing gulp
      .on('error', function (error) {
         $.notify().write(error);
         this.emit('end');
      })
      // autoprefix CSS using bootstrap standards
      .pipe($.autoprefixer({
         browsers: [
            "Android 2.3",
            "Android >= 4",
            "Chrome >= 20",
            "Firefox >= 24",
            "Explorer >= 8",
            "iOS >= 6",
            "Opera >= 12",
            "Safari >= 6"
         ],
         remove: false
      }))
      // Write final .map file
      .pipe($.sourcemaps.write())
      // move files to stage
      .pipe(gulp.dest('stage/styles'), callback);
});

// Javascript
gulp.task('scripts', function(callback) {
   return gulp.src('scripts/**/*.js')
      // copy scripts to stage
      .pipe(gulp.dest('stage/scripts'), callback);
});

// Tether Javascript
gulp.task('tether-scripts', function(callback) {
   return gulp.src(tetherJs)
      // copy scripts to stage
      .pipe(gulp.dest('stage/scripts/vendor'), callback);
});

// Popper Javascript
gulp.task('popper-scripts', function(callback) {
   return gulp.src(popperJs)
      // copy scripts to stage
      .pipe(gulp.dest('stage/scripts/vendor'), callback);
});

// Bootstrap Javascript
gulp.task('bootstrap-scripts', function(callback) {
   return gulp.src(bootstrapJs)
      // copy scripts to stage
      .pipe(gulp.dest('stage/scripts/vendor'), callback);
});

// jQuery Javascript
gulp.task('jquery-scripts', function(callback) {
   return gulp.src(jQueryJs)
      // copy scripts to stage
      .pipe(gulp.dest('stage/scripts/vendor'), callback);
});

// Minify CSS and put it in the public dir
gulp.task('minify-css', function() {
  return gulp.src('stage/styles/**/*.css')
     .pipe($.cleanCss({
        processImport: false
     }))
     .pipe($.rename({
        basename: 'main',
        suffix: '.min',
        extname: '.css'
     }))
    .pipe(gulp.dest(renderedTheme+'/css'));
});

// minify JS and put in the public dir
gulp.task('minify-js', function () {

   return gulp.src(['stage/scripts/**/*.js'])
      .pipe($.order([
        "vendor/jquery.slim.js",
        "vendor/tether.js",
        "vendor/popper.min.js",
        "vendor/bootstrap.js",
        "vendor/*.js",
        "**/*.js"
      ]))
      .pipe($.concat('scripts.min.js'))
      .pipe($.uglify())
      .pipe(gulp.dest(renderedTheme+'/js'));
});
