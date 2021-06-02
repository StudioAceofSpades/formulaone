const  gulp               =  require('gulp');
const  sass               =  require('gulp-sass');
const  sourcemaps         =  require('gulp-sourcemaps');
const  autoprefixer       =  require('gulp-autoprefixer');
const  concat             =  require('gulp-concat');
const  replace            =  require('gulp-replace');
const  resource_dir       =  "./public_html/wp-content/themes/premise/";
const  logfile            =  "./public_html/sass.log.txt";
const  source_dir         =  "sourcemaps/";
const  files              =  resource_dir +  "sass/**/*.scss";
const  prodOutput         =  resource_dir;
const  devOutput          =  resource_dir +  "devcss/";
var devOptions = {
    errLogToConsole : true,
    outputStyle     : 'expanded',
    stdout          : false,
    stderr          : false,
};
var prodOptions = {
    outputStyle: 'compressed'
};
function dev() {
    return (
        gulp
            .src(files)
            .pipe(sourcemaps.init())
            .pipe(sass(devOptions).on('error', function(err) {
                done(err);
            }))
            .pipe(autoprefixer())
            .pipe(concat('style.css'))
            .pipe(sourcemaps.write(source_dir))
            .pipe(gulp.dest(devOutput))
    );
}
exports.dev = dev;
function watch() {
    gulp.watch(files, dev);
}
exports.watch = watch;
function prod() {
    return (
        gulp
            .src(files)
            .pipe(sass(prodOptions))
            .pipe(autoprefixer())
            .pipe(concat('style.css'))
            .pipe(replace(/\.\.\//g, './'))
            .pipe(gulp.dest(prodOutput))
    );
}
exports.prod = prod;
