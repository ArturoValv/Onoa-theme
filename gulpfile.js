const { src, dest, watch, parallel } = require("gulp");
const sass = require("gulp-sass")(require("sass"));
const autoprefixer = require("autoprefixer");
const postcss = require("gulp-postcss");
const sourcemaps = require("gulp-sourcemaps");
const cssnano = require("cssnano");
const terser = require("gulp-terser-js");

const paths = {
  scss: "./assets/scss/**/*.scss",
  scss_blocks: "./blocks/**/*.scss",
  js: "./assets/js/**/*.js",
};

// css es una función que se puede llamar automaticamente
function css() {
  return src(paths.scss)
    .pipe(sourcemaps.init())
    .pipe(sass())
    .pipe(postcss([autoprefixer(), cssnano()]))
    .pipe(sourcemaps.write("."))
    .pipe(dest("build/css"));
}

function css_blocks() {
  return src(paths.scss_blocks)
    .pipe(sourcemaps.init())
    .pipe(sass())
    .pipe(postcss([autoprefixer(), cssnano()]))
    .pipe(sourcemaps.write("."))
    .pipe(dest("blocks"));
}

function javascript() {
  return src(paths.js)
    .pipe(terser())
    .pipe(sourcemaps.write("."))
    .pipe(dest("build/js"));
}

function watchArchivos() {
  watch(paths.scss, css);
  watch(paths.scss_blocks, css_blocks);
  watch(paths.js, javascript);
}

exports.css = css;
exports.css_blocks = css_blocks;
exports.watchArchivos = watchArchivos;
exports.default = parallel(css, css_blocks, javascript, watchArchivos);
exports.build = parallel(css, css_blocks, javascript, watchArchivos);