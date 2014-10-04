var gulp = require('gulp');
var sass = require('gulp-ruby-sass');
var autoprefixer = require('gulp-autoprefixer');
var minifycss = require('gulp-minify-css');
var rename = require('gulp-rename');
var less = require('gulp-less');

gulp.task('sass', function() {
  return gulp.src('./assets/*.scss')
    .pipe(sass({noCache: true}))
    .pipe(autoprefixer('last 5 version'))
    .pipe(gulp.dest('./assets/css'))
    .pipe(rename({suffix: '.min'}))
    .pipe(minifycss())
    .pipe(gulp.dest('./assets/css'))
});

gulp.task('less',function(){
	return gulp.src('./assets/vendor/weather-icons/weather-icons/weather-icons.less')
	.pipe(less())
	.pipe(gulp.dest('./assets/css'));
})	

gulp.task('minify',function(){
	return gulp.src('./assets/css/*.css')
	.pipe(rename({suffix: '.min'}))
    .pipe(minifycss())
    .pipe(gulp.dest('./assets/css'))
});

gulp.task('default',['sass'],function(){
	gulp.watch('assets/*.scss', ['sass']);
});