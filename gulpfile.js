const gulp = require("gulp");
const browserSync = require("browser-sync").create();

function watch(done) {
  browserSync.init({
    proxy: "http://localhost/wordpress/",
  });
  gulp.watch("./**/*.css").on("change", browserSync.reload);
  gulp.watch("js/*.js").on("change", browserSync.reload);
  gulp.watch("./**/*.php").on("change", browserSync.reload);

  done();
}

exports.watch = watch;
