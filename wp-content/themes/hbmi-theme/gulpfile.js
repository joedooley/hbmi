'use strict';

var gulp            = require('gulp'),
    connect         = require('gulp-connect'),
    gulpLoadPlugins = require('gulp-load-plugins'),
    cleanhtml       = require('gulp-cleanhtml'),
    dev             = require('gulp-dev'),
    browserSync     = require('browser-sync'),
    plugins         = gulpLoadPlugins(),
    webpack         = require('webpack'),
    ComponentPlugin = require("component-webpack-plugin"),
    info            = require('./package.json'),
    webpackCompiler;


var config = {

  JS: {
    assets: ["assets/js/*.js"],
    build: "dist/js/",
    buildFiles: "dist/js/*.js"
  },

  IMAGES: {
    assets: ["assets/images/raw/*.jpg", "assets/images/raw/*.svg", "!assets/images/raw/*.png"],
    build: "dist/images/",
    png: {
      assets: "assets/images/raw/*.png",
      build: "dist/images/"
    }
  },

  HTML:{
    assets: ['*.php', '**/*.php']
    // build: "./app/"
  },

  // Icons
  ICONS: {
    assets: 'assets/sass/components/icons/svg/*.svg',
    build: 'dist/css/fonts/',
    fontname: 'icons'
  },

  SASS: {
    assets: "/assets/sass/*.scss", "assets/sass/**/*.scss",
    build: "dist/css/"
  }

}


// SERVER ---------------------------------------------------------------------
gulp.task('browser-sync', function() {
  browserSync({
    // server: {
    //   baseDir: "./app/"
    // },
    proxy: "http://hbmi-local.dev/",
    // port: 80,
    browser: "google chrome",
    online: true,
    open: false
  });
});


// SASS -----------------------------------------------------------------------

gulp.task('sass', function () {
  gulp.src( config.SASS.src )
    .pipe( plugins.sourcemaps.init() )
    .pipe( plugins.plumber() )
    .pipe( plugins.sass({
          outputStyle: 'normal',
          debugInfo: false
        }) )
    .pipe( plugins.sourcemaps.write('./', {includeContent: false, sourceRoot: '../../../assets/sass/'}) )
    .pipe( gulp.dest( config.SASS.build ) )
    .pipe( plugins.filter( '**/*.css') ) // Filtering stream to only css files
    .pipe( browserSync.reload({ stream: true }) );
});

gulp.task('sass-build', function () {
  gulp.src( config.SASS.src )
    .pipe( plugins.plumber() )
    .pipe( plugins.sass({
      outputStyle: 'normal',
      // sourceComments: 'map',
      // includePaths : [paths.styles.src]
      // source_map_embed: false
      }) )
    .pipe( plugins.autoprefixer (
      "last 1 versions", "> 10%", "ie 9"
      ))
    .pipe( gulp.dest( config.SASS.build ) )
    .pipe( plugins.filter( '**/*.css') ) // Filtering stream to only css files
    .pipe( browserSync.reload({ stream: true }) );
});

gulp.task('sass-prefixer', function () {
  gulp.src( config.SASS.build + "*.css" )
    .pipe( plugins.autoprefixer (
      "last 1 versions", "> 10%", "ie 9"
      ))
    .pipe( gulp.dest( config.SASS.build ) );
});


// JAVASCRIPT RELOADING -------------------------------------------------------
gulp.task('js', function () {
  return gulp.src( config.JS.buildFiles )
    .pipe( plugins.changed ( config.JS.buildFiles ))
    .pipe( plugins.filter('**/*.js'))
    .pipe( browserSync.reload({ stream: true }) );
    // .pipe( plugins.livereload() );
});


// IMAGE OPTIMIZATION ---------------------------------------------------------
gulp.task('buildPNG', function () {
  gulp.src( config.IMAGES.png.src )
    .pipe( plugins.changed ( config.IMAGES.png.build ))
    .pipe( plugins.tinypng ('XULoaV953mHh7AWWzZKDyDnZpmwr2OeT'))
    .pipe( gulp.dest( config.IMAGES.png.build ) )
    .pipe( browserSync.reload({ stream: true }) );
    // .pipe( plugins.livereload() );
});

gulp.task('buildIMG', function () {
  gulp.src( config.IMAGES.src )
    .pipe( plugins.changed ( config.IMAGES.build ))
    .pipe( plugins.imagemin ({
      progressive: true,
      svgoPlugins: [{removeViewBox: false}]
    }))
    .pipe( gulp.dest( config.IMAGES.build ) )
    .pipe( browserSync.reload({ stream: true }) );
    // .pipe( plugins.livereload() );
});


// HTML TEMPORARIO --------------------------------------------------------------
gulp.task('html', function () {
  return gulp.src( config.HTML.src )
    // .pipe( cleanhtml() )
    // .pipe( dev(true) )
    // .pipe( gulp.dest( config.HTML.build ) )
    .pipe( browserSync.reload({ stream: true }) );
});

// Reload all Browsers
gulp.task('bs-reload', function () {
    browserSync.reload();
});


// ICONS ----------------------------------------------------------------------
// gulp.task('icons', function(){
//   gulp.src([ config.ICONS.src ])
//     .pipe( plugins.iconfontCss({
//       fontName: config.ICONS.fontname,
//       path: './assets/sass/components/icons/_icons-template.scss',
//       targetPath: '../../../assets/sass/components/icons/_icons.scss',
//       fontPath: './assets/fonts/',
//     }))
//     .pipe( plugins.iconfont({
//       fontName: config.ICONS.fontname,
//       fixedWidth: true,
//       appendCodepoints: false
//     }))
//     .pipe(gulp.dest( config.ICONS.build ));
// });

// gulp.task('icons', function(){
//   gulp.src("assets/sass/components/icons/symbol-font-14px.sketch")
//     .pipe( plugins.sketch({
//       export: 'slices',
//       formats: 'svg'
//     }))
//     .pipe( plugins.iconfontCss({
//       fontName: config.ICONS.fontname,
//       path: './assets/assets/sass/components/icons/_icons-template.scss',
//       targetPath: '../../../src/sass/components/icons/_icons.scss',
//       fontPath: './assets/fonts/',
//     }))
//     .pipe( plugins.iconfont({
//       fontName: config.ICONS.fontname
//     }))
//     .pipe(gulp.dest( config.ICONS.build ));
// });



// DEPLOY ---------------------------------------------------------------------
// Runs the deployment script
// Use it after pushing the local repo into the remote repository
// gulp.task('deploy', function () {
// plugins.run('ssh wordpress@wp.webispot.com "cd wordpress/mw-public/themes ; git pull"').exec()
//    // .pipe(gulp.dest('output'))    // Writes "Hello World\n" to output/echo.
// })


// GLOBAL TASKS ---------------------------------------------------------------
gulp.task('watch', function () {
  // gulp.watch( config.HTML.src , [browserSync.reload] );
  gulp.watch( config.HTML.src , ['bs-reload'] );
  gulp.watch( config.JS.src , ["webpack"]);
  gulp.watch( config.JS.buildFiles , ["js"] );
  gulp.watch( config.IMAGES.png.src , ['buildPNG'] );
  gulp.watch( config.SASS.src , ['sass']  );
});

gulp.task('default', ['browser-sync', 'watch']);
gulp.task('dev', ['browser-sync', 'watch']);
gulp.task('build', ['sass-build'] );
gulp.task('server', ['browser-sync'] );



