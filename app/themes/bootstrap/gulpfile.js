var _    = require('lodash'),
    gulp = require('gulp');

gulp.task('copy-assets', function() {
    var assets = {
        js: [
            './node_modules/angular/angular.js',
            './node_modules/bootstrap/dist/js/bootstrap.min.js'
        ],
        css: [
          './node_modules/bootstrap/dist/js/bootstrap.min.js'
        ]
    };
    _(assets).forEach(function (assets, type) {
       gulp.src(assets).pipe(gulp.dest('../../../public/themes/bootstrap/' + type));
    });
});
