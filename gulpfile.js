const gulp = require("gulp")
const sass = require("gulp-sass")
const concat = require("gulp-concat")
const minify = require("gulp-minify")

sass.compiler = require("node-sass")

const style = () => {
  return gulp.src("./assets/sass/*.scss")
    .pipe(sass().on("error", sass.logError))
    .pipe(concat("style.css"))
    .pipe(gulp.dest("./assets/css"))
}

const styleMinify = () => {
  return gulp.src("./assets/sass/*.scss")
    .pipe(sass({outputStyle: "compressed"}).on("error", sass.logError))
    .pipe(concat("style.min.css"))
    .pipe(gulp.dest("./assets/css"))
}

const jsMinify = () => {
  return gulp.src("./assets/js/script.js")
    .pipe(minify({noSource: true, ext: {min: ".min.js"}}))
    .pipe(gulp.dest("./assets/js"))
}

const watch = () => {
  gulp.watch("./assets/sass/**/*.scss", style)
  gulp.watch("./assets/sass/**/*.scss", styleMinify)
  gulp.watch("./assets/js/script.js", jsMinify)
}

exports.default = watch