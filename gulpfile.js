import gulp from "gulp";
import concat from "gulp-concat";
import gulpSass from "gulp-sass";
import dartSass from "sass";
import cleanCSS from "gulp-clean-css";
import gcmq from "gulp-group-css-media-queries";
import autoPrefixer from "gulp-autoprefixer";
import {deleteAsync} from "del";
import uglify from "gulp-uglify";
import transform from "gulp-es6-module-jstransform";
import babel from "gulp-babel";
import imagemin from "gulp-imagemin";

const sass = gulpSass(dartSass);

async function styles() {

    return gulp.src("./src/scss/style.scss")
        .pipe(sass().on("error", sass.logError))
        .pipe(gcmq())
        .pipe(autoPrefixer({
			overrideBrowserslist: ["last 2 versions"],
			cascade: false
		}))
        .pipe(cleanCSS({
            level: 2
        }))
        .pipe(concat("style.css"))
        .pipe(gulp.dest("./build/css/"))

}

async function scripts() {

    return gulp.src("./src/js/script.js")
        .pipe(babel({
            presets: ["@babel/env"]
        }))
        .pipe(transform())
        .pipe(uglify({
            toplevel: true
        }))
        .pipe(concat("script.js"))
        .pipe(gulp.dest("./build/js/"))

}

async function htmls() {

    return gulp.src("./src/*.html")
        .pipe(gulp.dest("./build/"))

}

async function img() {

    return gulp.src("./src/img/*")
        .pipe(imagemin())
        .pipe(gulp.dest("./build/img/"))

}

async function clean() {

    return deleteAsync(["./build/*.html", "./build/css/", "./build/js/"])

}

async function watch() {

    gulp.watch("./src/*.html", htmls);
    gulp.watch("./src/scss/**/*.scss", styles);
    gulp.watch("./src/js/script.js", scripts);

}

gulp.task("watch", watch);
gulp.task("build", gulp.series(clean, gulp.parallel(htmls, styles, scripts, img)));
gulp.task("dev", gulp.series("build", "watch"));