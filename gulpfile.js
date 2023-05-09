import gulp from "gulp";
import gulpSass from "gulp-sass";
import dartSass from "sass";
import cleanCSS from "gulp-clean-css";
import gcmq from "gulp-group-css-media-queries";
import autoPrefixer from "gulp-autoprefixer";
import {deleteAsync} from "del";
import uglify from "gulp-uglify";

const sass = gulpSass(dartSass);

async function styles() {

    return gulp.src("./src/scss/*.scss")
        .pipe(sass().on("error", sass.logError))
        .pipe(gcmq())
        .pipe(autoPrefixer({
			overrideBrowserslist: ["last 2 versions"],
			cascade: false
		}))
        .pipe(cleanCSS({
            level: 2
        }))
        .pipe(gulp.dest("./build/css/"))

}

async function scripts() {

    return gulp.src("./src/js/*.js")
        .pipe(uglify({
            toplevel: true
        }))
        .pipe(gulp.dest("./build/js/"))

}

async function pages() {

    return gulp.src("./src/**/**/*.php")
        .pipe(gulp.dest("./build/"))

}

async function assets() {

    return gulp.src("./src/assets/*")
        .pipe(gulp.dest("./build/assets/"))

}

async function databases() {

    return gulp.src("./src/**/**/*.sql")
        .pipe(gulp.dest("./build"))

}

async function clean() {

    return deleteAsync(["./build/**/**/*.php", "./build/css/", "./build/js/", "./build/components/", "./build/assets/"])

}

async function watch() {

    gulp.watch("./src/**/**/*.php", pages);
    gulp.watch("./src/**/**/*.sql", databases);
    gulp.watch("./src/scss/**/*.scss", styles);
    gulp.watch("./src/js/*.js", scripts);

}

gulp.task("watch", watch);
gulp.task("build", gulp.series(clean, gulp.parallel(pages, styles, scripts, assets, databases)));
gulp.task("dev", gulp.series("build", "watch"));