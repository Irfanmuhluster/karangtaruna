// Konfigurasi
// Initialize modules
// Importing specific gulp API functions lets us write them below as series() instead of gulp.series()
const gulp = require('gulp');
// Importing all the Gulp-related packages we want to use
const sass = require('gulp-sass');
const uglify = require('gulp-uglify');
const minimizecss = require('gulp-minify-css');
const purgecss = require('gulp-purgecss');
// const browserSync =  require('browser-sync').create();
const { src, dest } = require('gulp');

// Task compile scss ke css
function style() {
    return src('resources/scss/*.scss')
        .pipe(sass())
        .pipe(dest('public/themes/frontend/default/css'))
      // .pipe(browserSync.stream());
}

function purge() {
  return gulp
    .src('public/themes/frontend/default/css')
    .pipe( 
      purgecss({
        content: ['resources/views/public/default/*.html']
      })
    )
    .pipe(dest('public/themes/frontend/default/css/'))
}

// function minimizejs() {
//   return src('./js/*.js')
//       .pipe(uglify())
//       .pipe(dest('./dist/'))
      // .pipe(browserSync.stream());
// }

function minimize_css() {
  return src('public/themes/frontend/default/css/*.css')
      .pipe(minimizecss())
      .pipe(dest('public/themes/frontend/default/css/'))
      // .pipe(browserSync.stream());
}

// function watch() {
//     browserSync.init({
//         server: {
//             baseDir: './'
//         }
//     });
//     gulp.watch('./scss/**/*.scss', style);
//     gulp.watch('./*.html').on('change', browserSync.reload);
//     gulp.watch('./js/**/*.js').on('change',  browserSync.reload);
// }

exports.style = style;
exports.purge = purge;
// exports.minimizejs = minimizejs;
exports.minimize_css = minimize_css;
// exports.watch = watch; 