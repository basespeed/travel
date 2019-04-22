var ThemeName = 'travel';

var gulp             = require('gulp');
var sass             = require('gulp-sass');
var sourcemaps       = require('gulp-sourcemaps');
var autoprefixer     = require('gulp-autoprefixer');
var watch            = require('gulp-watch');
var livereload       = require('gulp-livereload');
var plumber          = require('gulp-plumber');
var sassGlob         = require('gulp-sass-glob');
var uglify           = require('gulp-uglify');
var rename           = require('gulp-rename');
var pump             = require('pump');
var csso             = require('gulp-csso');
var stripCssComments = require('gulp-strip-css-comments');
var concat           = require('gulp-concat');

var sassOptions = {
    sourcemap: true,
    errLogToConsole: true,
    outputStyle: 'expanded'
};

var sassExpandedOptions = {
    sourcemap: false,
    errLogToConsole: false,
    outputStyle: 'expanded'
};

var sassProductionOptions = {
    sourcemap: false,
    errLogToConsole: false,
    outputStyle: 'compressed'
};

var styles = [
    {
        src: './wp-content/themes/'+ThemeName+'/assets/sass/*.scss',
        dest: './wp-content/themes/'+ThemeName+'/assets/css/'
    },
];

gulp.task('scss', function () {
    return styles.map(function (style) {
        return gulp.src(style.src)
            .pipe(sassGlob())
            .pipe(plumber())
            .pipe(sourcemaps.init({ loadMap: true }))
            .pipe(sass(sassOptions))
            .pipe(autoprefixer({ browsers: ['last 10 versions'] }))
            .pipe(sourcemaps.write())
            .pipe(gulp.dest(style.dest))
            .pipe(livereload())
    });
});

gulp.task('scss-expanded', function () {
    return styles.map(function (style) {
        return gulp.src(style.src)
            .pipe(sassGlob())
            .pipe(plumber())
            .pipe(sass(sassExpandedOptions))
            .pipe(autoprefixer({ browsers: ['last 10 versions'] }))
            .pipe(gulp.dest(style.dest))
    });
});

gulp.task('scss-min', function () {
    return styles.map(function (style) {
        return gulp.src(style.src)
            .pipe(sassGlob())
            .pipe(plumber())
            .pipe(sass(sassProductionOptions))
            .pipe(autoprefixer({ browsers: ['last 10 versions'] }))
            .pipe(csso())
            .pipe(stripCssComments({ preserve: false }))
            .pipe(rename({ suffix: '.min' }))
            .pipe(gulp.dest(style.dest))
    });
});

gulp.task('watch', function () {
    livereload.listen();
    return watch(['./wp-content/themes/'+ThemeName+'/assets/sass/**/*.scss'], function () {
        gulp.start('scss');
    });
});

gulp.task('watch-js', function () {
    return watch(['./wp-content/themes/'+ThemeName+'/assets/jss/**/*.js'], function () {
        gulp.start('scripts');
    });
});

var jss = [
    {
        src: './wp-content/themes/'+ThemeName+'/core/inc/assets/jss/js.js',
        dest: './wp-content/themes/'+ThemeName+'/core/inc/assets/jss/'
    },
];

gulp.task('scripts', function() {
    return gulp.src('./wp-content/themes/'+ThemeName+'/core/inc/jss/**/*.js')
        .pipe(concat('js.js'))
        .pipe(gulp.dest('./wp-content/themes/'+ThemeName+'/core/inc/assets/jss/'));
});

gulp.task('compress', function () {
    return jss.map(function (js) {
        pump([
            gulp.src(js.src),
            uglify(),
            rename({ suffix: '.min' }),
            gulp.dest(js.dest)
        ]);
    });
});

gulp.task('default', ['watch', 'watch-js', 'scss', 'scripts']);
gulp.task('compressor', ['scss', 'scss-min', 'scripts', 'compress']);