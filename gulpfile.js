/*********************
----------------------
Author: Philipp Rohe
Development: Philipp Rohe
Version: 1.8.0
File: gulpfile.js
Path: Project's root path
Date: 24.02.2020
----------------------
*********************/

// Variables for gulp
const gulp = require('gulp');
// Using SCSS
const sass = require('gulp-sass');
// Concat files
const concat = require('gulp-concat'); 
// Reload browser
const browserSync = require('browser-sync');
// Icons to fonts
const iconfont = require('gulp-iconfont');
const iconfontCss = require('gulp-iconfont-css');
const runTimestamp = Math.round(Date.now()/1000);
// Minify scripts
const minify = require('gulp-minify');
// Minify css
const cssmin = require('gulp-cssmin');
const rename = require('gulp-rename');
const csso = require('gulp-csso');
// Minify images
const imagemin = require('gulp-imagemin');
// Sourcemaps
const sourcemaps = require('gulp-sourcemaps');
// Util
const gutil = require('gulp-util');
// Autoprefixer
const autoprefixer = require('gulp-autoprefixer');
// Plumber
const plumber = require('gulp-plumber');


// Project or Theme variables, need to be changed for every new projects
const theme_path = 'wp-content/themes/'; // Path seen from node_modules
const project_theme_name = 'schooltheme/';
const server_env = 'school.local';
const name_of_script_file = 'main';
const name_of_style_file = 'main';
const myFontName = 'bcFont';

/* Installation
npm i gulp-sass
npm i gulp-concat
npm install browser-sync gulp --save-dev
npm install --save-dev gulp-iconfont gulp-iconfont-css
npm i gulp-minify
npm i gulp-cssmin
npm i gulp-imagemin
npm i gulp-sourcemaps
npm i gulp-util
npm install --save-dev gulp-autoprefixer
npm install gulp-csso --save-dev
npm install --save-dev gulp-plumber
*/

/***********************
 * 
 * TASKS BELONGS HERE
 * 
 * ********************/

// Format SCSS to CSS for all SCSS files (./scss/**/*.scss for all)
function styles() {
    gutil.log(gutil.colors.magenta('Export all SCSS files to CSS files'));
    // Only main.scss in scss folder, because this file already includes
    return gulp.src(theme_path + project_theme_name  + 'src/scss/' + name_of_style_file + '.scss', { allowEmpty: true })
    .pipe(sourcemaps.init())
    .pipe(sass({
        errorLogConsole: true,
        outputStyle: 'compressed',
    }).on('error', sass.logError))
    .pipe(autoprefixer({
        cascade: false
    }))
    .pipe(sourcemaps.write('./../../dist/maps/'))
    .pipe(plumber())
    .pipe(gulp.dest(theme_path + project_theme_name  + 'src/css/'))
    .pipe(browserSync.stream());
}

// Format SCSS to CSS for admin files
function admin_style() {
    gutil.log(gutil.colors.magenta('Export all SCSS files to CSS files for admins'));
    return gulp.src(theme_path + project_theme_name + 'src/scss/admin.scss', { allowEmpty: true })
    .pipe(sass({
        errorLogConsole: true,
        outputStyle: 'compressed',
    }).on('error', sass.logError))
    .pipe(autoprefixer({
        cascade: false
    }))
    .pipe(plumber())
    .pipe(gulp.dest(theme_path + project_theme_name + 'src/css/'))
    .pipe(browserSync.stream());
}

// Minify all images to save space and lower network requests
function minify_images() {
    gutil.log(gutil.colors.magenta('Minify the size off all images'));
    return gulp.src(theme_path + project_theme_name  + 'src/img/**/*', { allowEmpty: true })
    .pipe(imagemin([
        imagemin.gifsicle({interlaced: true}),
        imagemin.mozjpeg({quality: 75, progressive: true}),
        imagemin.optipng({optimizationLevel: 5}),
        imagemin.svgo({
            plugins: [
                {removeViewBox: true},
                {cleanupIDs: false}
            ]
        })
    ]))
    .pipe(plumber())
    .pipe(gulp.dest(theme_path + project_theme_name + 'dist/img/'));
}

// Make fonts from icons
// SVG to font, name of file: bars.svg, include like this: <span class="icon-bars"></span> in code later
function icons() {
    gutil.log(gutil.colors.magenta('Convert all icons to specific font'));
    return gulp.src([theme_path + project_theme_name + '/dist/img/icons/*.svg'], { allowEmpty: true })
    .pipe(iconfontCss({
        fontName: myFontName,
        path: theme_path + project_theme_name + '/src/templates/_icons.scss/', // The path to the template that will be used to create the SASS/LESS/CSS file
        targetPath: '../../src/scss/parts/icons.scss/', // The path where the file will be generated
        fontPath: '../../dist/fonts/' // The path to the icon font file
      }))
    .pipe(iconfont({
      fontName: myFontName, // required
      prependUnicode: true, // recommended option
      normalize: true,
      formats: ['ttf', 'eot', 'woff', 'woff2', 'svg'], // default, 'woff2' and 'svg' are available
      timestamp: runTimestamp, // recommended to get consistent builds when watching files
    }))
      .on('glyphs', function(glyphs, options) {
        console.log(glyphs, options);
      })
    .pipe(plumber())
    .pipe(gulp.dest(theme_path + project_theme_name + '/dist/fonts/'));
}

// Concat all files from same type and minify them
function concat_scripts() {
    gutil.log(gutil.colors.magenta('Concat all scripts in one file'));
    return gulp.src([
        // theme_path + project_theme_name + 'src/js/vendor/jquery/**/*.js',
        // theme_path + project_theme_name + 'src/js/vendor/bootstrap/**/*.js',
        theme_path + project_theme_name + 'src/js/*.js',
        ],
        { allowEmpty: true }
    )
    .pipe(sourcemaps.init())
    .pipe(concat(name_of_script_file + '.js'))
    .pipe(rename({suffix: '-combined'}))
    .pipe(sourcemaps.write('./../../dist/maps'))
    .pipe(minify())
    .pipe(plumber())
    .pipe(gulp.dest(theme_path + project_theme_name + 'dist/js'));
}

function concat_styles() {
    gutil.log(gutil.colors.magenta('Concat all styles in one file'));
    return gulp.src([
        theme_path + project_theme_name + 'src/css/*.css',
        // theme_path + project_theme_name + 'src/css/vendor/**/*.css',
        ],
        { allowEmpty: true }
    )
    .pipe(concat(name_of_style_file + '.css'))
    .pipe(rename({suffix: '-combined'}))
    .pipe(csso())
    .pipe(cssmin())
    .pipe(rename({suffix: '-min'}))
    .pipe(plumber())
    .pipe(gulp.dest(theme_path + project_theme_name + 'dist/css'));
}

// Live server for live refreshing
function watch() {
    gutil.log(gutil.colors.magenta('Starting gulp files and watching all tasks'));
    browserSync.init({
        proxy: server_env,
    });
    gulp.watch(theme_path + project_theme_name + 'src/scss/**/*.scss', styles);
    gulp.watch(theme_path + project_theme_name + 'src/scss/**/*.scss', browserSync.reload);
    gulp.watch(theme_path + project_theme_name + 'src/scss/admin.scss', admin_style);
    gulp.watch(theme_path + project_theme_name + 'src/css/**/*.css', concat_styles);
    gulp.watch(theme_path + project_theme_name + 'src/js/**/*.js', concat_scripts);
    gulp.watch(theme_path + project_theme_name + 'src/img/**/*.png', minify_images);
    gulp.watch(theme_path + project_theme_name + 'src/img/**/*.jpg', minify_images);
    gulp.watch(theme_path + project_theme_name + 'src/img/icons/*.svg', minify_images);
    gulp.watch(theme_path + project_theme_name + 'src/img/icons/*.svg', icons);
    gulp.watch(theme_path + project_theme_name + '*.html').on('change', browserSync.reload);
    gulp.watch(theme_path + project_theme_name + '*.php').on('change', browserSync.reload);
    gulp.watch(theme_path + project_theme_name + 'parts/*.php').on('change', browserSync.reload);
    gulp.watch(theme_path + project_theme_name + 'inc/**/*.php').on('change', browserSync.reload);
    gulp.watch(theme_path + project_theme_name + 'inc/*.php').on('change', browserSync.reload);
    gulp.watch(theme_path + project_theme_name + 'inc/*.html').on('change', browserSync.reload);
    gulp.watch(theme_path + project_theme_name + 'modules/*.php').on('change', browserSync.reload);
    gulp.watch(theme_path + project_theme_name + 'src/js/**/*.js').on('change', browserSync.reload);
}

// Export all functions and tasks
exports.styles = styles;
exports.admin_style = admin_style;
exports.icons = icons;
exports.concat_scripts = concat_scripts;
exports.concat_styles = concat_styles;
exports.watch = watch;
exports.minify_images = minify_images;

// Default task for gulp
gulp.task('default', function(){
    return styles(), admin_style(), minify_images(), icons(), concat_scripts(), concat_styles(), watch();
});