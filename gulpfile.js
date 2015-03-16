var gulp = require('gulp');
var bower = require('gulp-bower');
var sass = require('gulp-sass');
var concat = require('gulp-concat');
var watch = require('gulp-watch');

gulp.task('init', function() {
    bower()
        .pipe(gulp.dest('resources/lib/'))
});

gulp.task('default', function() {

    gulp.src(['resources/lib/jquery/jquery.js',
            'resources/lib/js/developer.js',
            'resources/lib/bootstrap-sass-official/vendor/assets/javascripts/bootstrap/affix.js',
            'resources/lib/bootstrap-sass-official/vendor/javascripts/bootstrap/alert.js',
            'resources/lib/bootstrap-sass-official/vendor/javascripts/bootstrap/button.js',
            'resources/lib/bootstrap-sass-official/vendor/javascripts/bootstrap/carousel.js',
            'resources/lib/bootstrap-sass-official/vendor/javascripts/bootstrap/collapse.js',
            'resources/lib/bootstrap-sass-official/vendor/javascripts/bootstrap/dropdown.js',
            'resources/lib/bootstrap-sass-official/vendor/javascripts/bootstrap/modal.js',
            'resources/lib/bootstrap-sass-official/vendor/javascripts/bootstrap/popover.js',
            'resources/lib/bootstrap-sass-official/vendor/javascripts/bootstrap/scrollspy.js',
            'resources/lib/bootstrap-sass-official/vendor/javascripts/bootstrap/tab.js',
            'resources/lib/bootstrap-sass-official/vendor/javascripts/bootstrap/tooltip.js',
            'resources/lib/bootstrap-sass-official/vendor/javascripts/bootstrap/translation.js'
        ])
        .pipe(concat('all.js'))
        .pipe(gulp.dest('public/js'));


    gulp.src('resources/style.scss')
        .pipe(sass())
        .pipe(gulp.dest('public/css'));

    gulp.src('resources/lib/bootstrap-sass/assets/fonts/bootstrap/*')
        .pipe(gulp.dest('public/fonts'));

});