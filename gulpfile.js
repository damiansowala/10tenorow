'use strict';
var gulp = require('gulp'),
    cssnano = require('gulp-cssnano'),
    sass = require('gulp-ruby-sass'),
    sort = require('gulp-sort'),
    runSequence = require('run-sequence'),
    connect = require('gulp-connect-php'),
    sourcemaps = require('gulp-sourcemaps'),
    autoprefixer = require('gulp-autoprefixer'),
    babel = require('gulp-babel'),
    concat = require('gulp-concat'),
    uglify = require('gulp-uglify'),
    react = require('gulp-react'),
    htmlreplace = require('gulp-html-replace'),
    browserSync = require('browser-sync').create();
var supported = [
    'last 5 versions',
    'safari >= 8',
    'ie >= 10',
    'ff >= 20',
    'ios 6',
    'android 4'
];
var build_files = [
    '**',
    '!node_modules',
    '!node_modules/**',
    '!build',
    '!build/**',
    '!src',
    '!src/**',
    '!.git',
    '!.git/**',
    '!package.json',
    '!.gitignore',
    '!gulpfile.js',
    '!.editorconfig',
    '!.jshintrc'
];
// Defining base paths
var basePaths = {
    js: './js/',
    node: './node_modules/',
    dev: './src/',
    css: './css/'
};

gulp.task('block', () =>
    gulp.src('blocks/src/**/*.js')
    .pipe(react())
    .pipe(sourcemaps.init())
    .pipe(babel({
        presets: ['@babel/preset-react']
    }))
    .pipe(concat('blocks.build.js'))
    .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest('blocks/dist/'))
);

gulp.task('browser-sync', function () {
    browserSync.init({
        proxy: "localhost/10tenorow"
    });
});

gulp.task('sass', () =>
    sass('src/sass/style.scss', {
        sourcemap: true
    })
    .pipe(autoprefixer())
    .on('error', sass.logError)
    .pipe(sourcemaps.write())
    .pipe(cssnano({
        autoprefixer: {
            browsers: supported,
            add: true
        }
    }))
    .pipe(sourcemaps.write('maps', {
        includeContent: false,
        sourceRoot: 'src/sass'
    }))
    .pipe(gulp.dest('./'))
    .pipe(browserSync.stream())
);
gulp.task('watch', function () {
    gulp.watch('src/sass/**/*.scss', gulp.series('sass'));
    gulp.watch('blocks/src/**/*.js', gulp.series('block'));
    gulp.watch('**/*.php').on('change', function () {
        browserSync.reload();
    });
});
gulp.task('copy-assets', function () {
    var stream = gulp.src(basePaths.node + 'bootstrap/dist/js/**/*.js')
        .pipe(gulp.dest(basePaths.js + 'bootstrap'));
    gulp.src(basePaths.node + 'bootstrap/dist/css/**/*.css')
        .pipe(gulp.dest(basePaths.css + 'bootstrap'));
    return stream;
});

gulp.task('copyfonts', function () {
    var stream = gulp.src(basePaths.node + '@fortawesome/fontawesome-free/webfonts/**/*.{ttf,woff,woff2,eof,svg}')
        .pipe(gulp.dest('./fonts/fontawesome'));
    gulp.src(basePaths.node + '@fortawesome/fontawesome-free/css/**/*.css')
        .pipe(gulp.dest(basePaths.css + 'fontawesome'));
    return stream;
});
gulp.task('copypopper', function () {
    var stream = gulp.src(basePaths.node + 'popper.js/dist/umd/popper.min.js')
        .pipe(gulp.dest('./js'));
    gulp.src(basePaths.node + 'popper.js/dist/umd/popper.js')
        .pipe(gulp.dest('./js'));
    return stream;
});
gulp.task('owl', function () {
    var stream = gulp.src(basePaths.node + 'owl.carousel/dist/owl.carousel.min.js')
        .pipe(gulp.dest('./js'));
    gulp.src(basePaths.node + 'owl.carousel/dist/assets/owl.carousel.min.css')
        .pipe(gulp.dest('./css'));
    return stream;
});
gulp.task('animate', function () {
    var stream = gulp.src(basePaths.node + 'animate.css/animate.min.css')
        .pipe(gulp.dest('./css'));
    return stream;
});
gulp.task('rellax', function () {
    var stream = gulp.src(basePaths.node + 'rellax/rellax.min.js')
        .pipe(gulp.dest('./js'));
    return stream;
});
gulp.task('wow', function () {
    var stream = gulp.src(basePaths.node + 'wow.js/dist/wow.min.js')
        .pipe(gulp.dest('./js'));
    return stream;
});
gulp.task('simpleParallax', function () {
    var stream = gulp.src(basePaths.node + 'simple-parallax-js/dist/simpleParallax.min.js')
        .pipe(gulp.dest('./js'));
    return stream;
});
gulp.task('fancybox', function () {
    var stream = gulp.src(basePaths.node + '@fancyapps/fancybox/dist/jquery.fancybox.min.js')
        .pipe(gulp.dest('./js'));
    gulp.src(basePaths.node + '@fancyapps/fancybox/dist/jquery.fancybox.min.css')
        .pipe(gulp.dest('./css'));
    return stream;
});
gulp.task('slick', function () {
    var stream = gulp.src(basePaths.node + 'slick-slider/slick/slick.min.js')
        .pipe(gulp.dest('./js'));
    gulp.src(basePaths.node + 'slick-slider/slick/slick.css')
        .pipe(gulp.dest('./css'));
    gulp.src(basePaths.node + 'slick-slider/slick/slick-theme.css')
        .pipe(gulp.dest('./css'));
    return stream;
});
gulp.task('lightbox', function () {
    var stream = gulp.src(basePaths.node + 'lightbox2/dist/js/lightbox.min.js')
        .pipe(gulp.dest('./js'));
    gulp.src(basePaths.node + 'lightbox2/dist/css/lightbox.min.css')
        .pipe(gulp.dest('./css'));
    gulp.src(basePaths.node + 'lightbox2/distimages/*.*')
        .pipe(gulp.dest('./images'));
    return stream;
});
var defl = gulp.parallel(['sass', 'block', 'watch', 'browser-sync']);
var ini = gulp.parallel(['copy-assets', 'copyfonts', 'copypopper', 'animate', 'slick', 'wow', 'simpleParallax',
    'owl', 'rellax', 'lightbox', 'fancybox'
]);
gulp.task(defl);
gulp.task('default', defl);
gulp.task(ini);
gulp.task('init', ini);