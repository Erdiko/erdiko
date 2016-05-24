'use strict';

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
      ['styles', 'scripts'],
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

// Minify CSS and put it in the public dir
gulp.task('minify-css', function() {
  return gulp.src('stage/styles/**/*.css')
     .pipe($.cleanCss({
        processImport: false
     }))
     .pipe($.rename({
        basename: 'styles',
        suffix: '.min',
        extname: '.css'
     }))
    .pipe(gulp.dest('../../../public/themes/bootstrap/css'));
});

// minify JS and put in the public dir
gulp.task('minify-js', function () {

   return gulp.src(['stage/scripts/**/*.js'])
      .pipe($.order([
        "vendor/jquery.js",
        "vendor/bootstrap.js",
        "vendor/carousel.js",
        "vendor/*.js",
        "**/*.js"
      ]))
      .pipe($.concat('scripts.min.js'))
      .pipe($.uglify())
      .pipe(gulp.dest('../../../public/themes/bootstrap/js'));

});
