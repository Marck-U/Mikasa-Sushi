'use strict';

const gulp = require('gulp'),
  // postcss = require('gulp-postcss-uncss'),
  cleancss = require('gulp-clean-css'),
  concat = require('gulp-concat'),
  autoprefixer = require('gulp-autoprefixer'),
  uglify = require('gulp-uglify'),
  babel = require('gulp-babel'),
  imagemin = require('gulp-imagemin'),
  pngquant = require('imagemin-pngquant'),
  directorio = {
    public: 'public',
    src: 'src',
    dist: 'dist',
    nm: 'node_modules'
  },
  files = {
    CSS: [
      `${directorio.public}/src/css/materialize.css`,
      `${directorio.nm}/font-awesome/css/font-awesome.min.css`,
      `${directorio.public}/src/css/index-style.css`,
      `${directorio.nm}/animate.css/animate.min.css`,
      `${directorio.nm}/normalize.css/normalize.css`
    ],
    JS: [
      `${directorio.nm}/jquery/dist/jquery.min.js`,
      `${directorio.nm}/materialize-css/dist/js/materialize.min.js`,
      `${directorio.nm}/wowjs/dist/wow.min.js`,
      `${directorio.nm}/jquery-validation/dist/jquery.validate.js`,
      `${directorio.public}/src/js/es5/script.js`
    ],
    Fonts: [`${directorio.nm}/font-awesome/fonts/*.*`],
    minCSS: 'style.min.css',
    minJS: 'script.min.js'
  },
  opts = {
    imagemin: {
      progressive: true,
      use: [pngquant()]
    }
  };

gulp.task('minCss', () => {
  //* Minimizar css en un solo archivo
  gulp
    .src(files.CSS)
    .pipe(concat(files.minCSS))
    .pipe(cleancss())
    .pipe(
      autoprefixer({
        browsers: ['last 5 versions'],
        cascade: false
      })
    )
    .pipe(gulp.dest(`${directorio.public}/dist/css`));
});

gulp.task('minJs', () => {
  //* Minimizar js en un solo archivo
  gulp
    .src(files.JS)
    .pipe(concat(files.minJS))
    .pipe(uglify())
    .pipe(gulp.dest(`${directorio.public}/dist/js`));
});

gulp.task('es6', () => {
  //* Convierte archivos js en es6 en un solo archivo js es5
  gulp
    .src(`${directorio.public}/src/js/es6/*.js`)
    .pipe(concat('script.js'))
    .pipe(
      babel({
        presets: ['env']
      })
    )
    .pipe(gulp.dest(`${directorio.public}/src/js/es5`));
});

gulp.task('img', () => {
  //* Comprime imágenes estátocas
  gulp
    .src(`${directorio.public}/src/img/**/*.+(png|jpeg|jpg|gif)`)
    .pipe(imagemin(opts.imagemin))
    .pipe(gulp.dest(`${directorio.public}/dist/img`));
});
