import gulp from "gulp";
import yargs from "yargs";
import sass from "gulp-sass";
import cleanCSS from "gulp-clean-css";
import autoprefixer from "gulp-autoprefixer";
import gulpif from "gulp-if";
import sourcemaps from "gulp-sourcemaps";
import imagemin from "gulp-imagemin";
import del from "del";
import webpack from "webpack-stream";
import named from "vinyl-named";
import browserSync from "browser-sync";
import zip from "gulp-zip";
import replace from "gulp-replace";
import info from "./package.json";
import wpPot from "gulp-wp-pot";

const server = browserSync.create();
const PROD = yargs.argv.prod;

const paths = {
  styles: {
    src: ["src/assets/scss/bundle.scss"],
    dest: "dist/assets/css"
  },
  images: {
    src: "src/assets/images/**/*.{jpg,jpeg,png,svg,gif}",
    dest: "dist/assets/images"
  },
  scripts: {
    src: ["src/assets/js/bundle.js"],
    dest: "dist/assets/js"
  },
  others: {
    src: [
      "src/assets/**/*",
      "!src/assets/{images,js,scss}",
      "!src/assets/{images,js,scss}/**/*"
    ],
    dest: "dist/assets"
  },
  package: {
    src: [
      "**/*",
      "!.vscode",
      "!node_modules{,/**}",
      "!packaged{,/**}",
      "!src{,/**}",
      "!.babelrc",
      "!.gitignore",
      "!gulpfile.babel.js",
      "!package.json",
      "!package-lock.json"
    ],
    dest: "packaged"
  }
};

export const pot = () => {
  return gulp
    .src("**/*.php")
    .pipe(
      wpPot({
        domain: "_themename",
        package: info.name
      })
    )
    .pipe(gulp.dest(`languages/${info.name}.pot`));
};

export const serve = done => {
  server.init({
    proxy: "http://localhost/starter/"
  });
  done();
};

export const reload = done => {
  server.reload();
  done();
};

export const clean = () => del(["dist"]);

export const styles = () => {
  return gulp
    .src(paths.styles.src)
    .pipe(gulpif(!PROD, sourcemaps.init()))
    .pipe(sass().on("error", sass.logError))
    .pipe(autoprefixer())
    .pipe(gulpif(PROD, cleanCSS({ compatibility: "ie8" })))
    .pipe(gulpif(!PROD, sourcemaps.write()))
    .pipe(gulp.dest(paths.styles.dest))
    .pipe(server.stream());
};

export const images = () => {
  return gulp
    .src(paths.images.src)
    .pipe(gulpif(PROD, imagemin()))
    .pipe(gulp.dest(paths.images.dest));
};

export const scripts = () => {
  return gulp
    .src(paths.scripts.src)
    .pipe(named())
    .pipe(
      webpack({
        module: {
          rules: [
            {
              test: /\.js$/,
              use: {
                loader: "babel-loader",
                options: {
                  presets: ["@babel/preset-env"]
                }
              }
            }
          ]
        },
        output: {
          filename: "[name].js"
        },
        externals: {
          jquery: "jQuery"
        },
        devtool: !PROD ? "inline-source-map" : false,
        mode: PROD ? "production" : "development"
      })
    )
    .pipe(gulp.dest(paths.scripts.dest));
};

export const others = () => {
  return gulp.src(paths.others.src).pipe(gulp.dest(paths.others.dest));
};

export const watch = () => {
  gulp.watch("src/assets/scss/**/*.scss", styles);
  gulp.watch("src/assets/js/**/*.js", gulp.series(scripts, reload));
  gulp.watch("**/*.php", reload);
  gulp.watch(paths.images.src, gulp.series(images, reload));
};

export const compress = () => {
  return gulp
    .src(paths.package.src)
    .pipe(replace("_themename", info.name))
    .pipe(zip(`${info.name}.zip`))
    .pipe(gulp.dest(paths.package.dest));
};

export const dev = gulp.series(
  clean,
  gulp.parallel(styles, scripts, images, others),
  serve,
  watch
);

export const build = gulp.series(
  clean,
  gulp.parallel(styles, scripts, images, others),
  pot
);

export const bundle = gulp.series(build, compress);

export default dev;
