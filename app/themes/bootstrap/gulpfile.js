var _    = require('lodash'),
    gulp = require('gulp'),
    less = require('gulp-less'),
    path = require('path');

// compile less
gulp.task('less', function () {
  return gulp.src('./less/**/*.less')
  .pipe(less({
    paths: [ path.join(__dirname, 'less', 'includes') ]
  }))
  .pipe(gulp.dest('./css'));
});


// copy assests to public dir
gulp.task('copy-assets', function() {
    var assets = {
        js: [
            './node_modules/angular/angular.js',
            './node_modules/bootstrap/dist/js/bootstrap.min.js',
            './js/carousel.js',
            './js/home.js',
            './js/default.js'
        ],
        css: [
          //'./node_modules/bootstrap/dist/css/bootstrap.css',
          //'./node_modules/bootstrap/dist/css/bootstrap-theme.min.css',
          './css/carousel.css',
          './css/home.css',
          './css/default.css'
        ]
    };
    _(assets).forEach(function (assets, type) {
       gulp.src(assets).pipe(gulp.dest('../../../public/themes/bootstrap/' + type));
    });
});

gulp.task('default', ['copy-assets']);
