var gulp = require('gulp');
var bower = require('gulp-bower');
var sass = require('gulp-sass');
var concat = require('gulp-concat');
var watch = require('gulp-watch');

var paths = {
    scripts: [
        'resources/app/app.js',
        'resources/app/controllers/controllers.js',
        'resources/app/services/apiService.js'
    ]
};

gulp.task('init', function() {
    bower()
        .pipe(gulp.dest('resources/lib/'))
});

gulp.task('scripts', function(){
    gulp.src(['resources/lib/jquery/jquery.js',
            'resources/lib/bootstrap-sass-official/vendor/assets/javascripts/bootstrap/affix.js',
            'resources/lib/bootstrap-sass-official/vendor/assets/javascripts/bootstrap/alert.js',
            'resources/lib/bootstrap-sass-official/vendor/assets/javascripts/bootstrap/button.js',
            'resources/lib/bootstrap-sass-official/vendor/assets/javascripts/bootstrap/carousel.js',
            'resources/lib/bootstrap-sass-official/vendor/assets/javascripts/bootstrap/collapse.js',
            'resources/lib/bootstrap-sass-official/vendor/assets/javascripts/bootstrap/dropdown.js',
            'resources/lib/bootstrap-sass-official/vendor/assets/javascripts/bootstrap/modal.js',
            'resources/lib/bootstrap-sass-official/vendor/assets/javascripts/bootstrap/tooltip.js',
            'resources/lib/bootstrap-sass-official/vendor/assets/javascripts/bootstrap/popover.js',
            'resources/lib/bootstrap-sass-official/vendor/assets/javascripts/bootstrap/scrollspy.js',
            'resources/lib/bootstrap-sass-official/vendor/assets/javascripts/bootstrap/tab.js',
            'resources/lib/bootstrap-sass-official/vendor/assets/javascripts/bootstrap/translation.js',
            'resources/lib/js/developer.js',
            'resources/lib/angular/angular.js',
            'resources/lib/angular-route/angular-route.js',
            'resources/lib/Chart.js/Chart.js',
            'resources/lib/angular-chart.js/angular-chart.js',
            'resources/lib/js/ui-bootstrap-tpls-0.12.1.min.js',
            'resources/lib/ngprogress/build/ngProgress.js',
            'resources/app/app.js',
            'resources/app/controllers/controllers.js',
            'resources/app/services/apiService.js'
        ])
        .pipe(concat('all.js'))
        .pipe(gulp.dest('public/js'));
});

gulp.task('default', function() {
    gulp.src(['resources/lib/jquery/jquery.js',
            'resources/lib/bootstrap-sass-official/vendor/assets/javascripts/bootstrap/affix.js',
            'resources/lib/bootstrap-sass-official/vendor/assets/javascripts/bootstrap/alert.js',
            'resources/lib/bootstrap-sass-official/vendor/assets/javascripts/bootstrap/button.js',
            'resources/lib/bootstrap-sass-official/vendor/assets/javascripts/bootstrap/carousel.js',
            'resources/lib/bootstrap-sass-official/vendor/assets/javascripts/bootstrap/collapse.js',
            'resources/lib/bootstrap-sass-official/vendor/assets/javascripts/bootstrap/dropdown.js',
            'resources/lib/bootstrap-sass-official/vendor/assets/javascripts/bootstrap/modal.js',
            'resources/lib/bootstrap-sass-official/vendor/assets/javascripts/bootstrap/tooltip.js',
            'resources/lib/bootstrap-sass-official/vendor/assets/javascripts/bootstrap/popover.js',
            'resources/lib/bootstrap-sass-official/vendor/assets/javascripts/bootstrap/scrollspy.js',
            'resources/lib/bootstrap-sass-official/vendor/assets/javascripts/bootstrap/tab.js',
            'resources/lib/bootstrap-sass-official/vendor/assets/javascripts/bootstrap/translation.js',
            'resources/lib/js/developer.js',
            'resources/lib/angular/angular.js',
            'resources/lib/angular-route/angular-route.js',
            'resources/lib/Chart.js/Chart.js',
            'resources/lib/angular-chart.js/angular-chart.js',
            'resources/lib/js/ui-bootstrap-tpls-0.12.1.min.js',
            'resources/lib/ngprogress/build/ngProgress.js',
            'resources/app/app.js',
            'resources/app/controllers/controllers.js',
            'resources/app/services/apiService.js'
        ])
        .pipe(concat('all.js'))
        .pipe(gulp.dest('public/js'));

    gulp.src('resources/style.scss')
        .pipe(sass())
        .pipe(gulp.dest('public/css'));

    gulp.src([
            'resources/lib/bootstrap-sass/assets/fonts/bootstrap/*',
            'resources/lib/sb-admin/font-awesome/fonts/*'
        ])
        .pipe(gulp.dest('public/fonts'));
});

gulp.task('watch', function() {
    gulp.watch(paths.scripts, ['scripts']);
});