/**
 *
 * Gulpfile setup
 *
 * @since 1.0.0
 * @authors Andrew Carl
 * @package andrewcarl-theme
 */

 // Project configuration
 const package   = require('./package.json');
 const project 	= package.name; // Project name, used for build zip.
 const url 		= 'andrewcarl.test'; // Local Development URL for BrowserSync. Change as-needed.
 const bower     = './assets/bower_components/'; // Not truly using this yet, more or less playing right now. TO-DO Place in Dev branch
 const deployDir = `./deploy/${package.name}-${package.version}`; // Files that you want to package into a zip go here
 const deployInclude 	= [
     // include common file types
     '**/*.php',
     '**/*.html',
     '**/*.css',
     '**/*.js',
     '**/*.svg',
     '**/*.ttf',
     '**/*.otf',
     '**/*.eot',
     '**/*.woff',
     '**/*.woff2',
     '**/*.png',
     '**/*.jpg',
     '**/*.mp4',
 
     // include specific files and folders
     'screenshot.png',
 
     // exclude files and folders
     '!node_modules/**/*',
     '!assets/bower_components/**/*',
     '!style.css.map',
     '!assets/js/custom/*',
     '!assets/css/patrials/*',
     '!gulpfile.js',
     '!deploy/**/*'
 ];
 
 
 // Load plugins
 const { series, src, dest, watch } = require('gulp');
 const browserSync       = require('browser-sync').create(); // Asynchronous browser loading on .scss file changes
 const autoprefixer      = require('gulp-autoprefixer'); // Autoprefixing magic
 const minifycss         = require('gulp-clean-css');
 const filter            = require('gulp-filter');
 const uglify            = require('gulp-uglify');
 const imagemin          = require('gulp-imagemin');
 const newer             = require('gulp-newer');
 const rename            = require('gulp-rename');
 const concat            = require('gulp-concat');
 const notify            = require('gulp-notify');
 const cmq               = require('gulp-group-css-media-queries');
 const unSequence        = require('run-sequence');
 const sass              = require('gulp-sass');
 const plugins           = require('gulp-load-plugins')({ camelize: true });
 const ignore            = require('gulp-ignore'); // Helps with ignoring files and directories in our run tasks
 const rimraf            = require('gulp-rimraf'); // Helps with removing files and directories in our run tasks
 const zip               = require('gulp-zip'); // Using to zip up our packaged theme into a tasty zip file that can be installed in WordPress!
 const plumber           = require('gulp-plumber'); // Helps prevent stream crashing on errors
 const cache             = require('gulp-cache');
 const sourcemaps        = require('gulp-sourcemaps');
 
 /**
  * Browser Sync
  *
  * Asynchronous browser syncing of assets across multiple devices!! Watches for changes to js, image and php files
  * Although, I think this is redundant, since we have a watch task that does this already.
 */
 // gulp.task('browser-sync', function() {
 // 	let files = [
 //         '**/*.php',
 //         '**/*.{png,jpg,gif}'
 //     ];
 // 	browserSync.init({
 
 // 		// Read here http://www.browsersync.io/docs/options/
 // 		proxy: url
 
 // 		// port: 8080,
 
 // 		// Tunnel the Browsersync server through a random Public URL
 // 		// tunnel: true,
 
 // 		// Attempt to use the URL "http://my-private-site.localtunnel.me"
 // 		// tunnel: "ppress",
 
 // 		// Inject CSS changes
 // 		// injectChanges: true
 //     });
     
 //     // gulp.watch(files).on('change', browserSync.reload());
 // });
 
 /**
  * Styles
  *
  * Looking at src/sass and compiling the files into Expanded format, Autoprefixing and sending the files to the build folder
  *
  * Sass output styles: https://web-design-weekly.com/2014/06/15/different-sass-output-styles/
 */
 function scss() {
     return src('./assets/scss/**/*.scss')
         .pipe(plumber())
         .pipe(sourcemaps.init())
         .pipe(sass({
             errLogToConsole: true,
             //outputStyle: 'compressed',
             outputStyle: 'compact',
             // outputStyle: 'nested',
             // outputStyle: 'expanded',
             precision: 10
         }))
         .pipe(sourcemaps.write({includeContent: false}))
         .pipe(sourcemaps.init({loadMaps: true}))
         .pipe(autoprefixer('last 2 version', '> 1%', 'safari 5', 'ie 8', 'ie 9', 'opera 12.1', 'ios 6', 'android 4'))
         .pipe(sourcemaps.write('.'))
         .pipe(plumber.stop())
         .pipe(dest('./assets/css'))
         .pipe(filter('**/*.css')) // Filtering stream to only css files
         .pipe(cmq()) // Combines Media Queries
         .pipe(rename({ suffix: '.min' }))
         .pipe(minifycss({ compatibility: 'ie8' }))
         .pipe(dest('./assets/css'))
         .pipe(notify({ message: 'Styles task complete', onLast: true }));
 };
 
 function clean() {
     return src(deployDir, {allowEmpty: true})
         .pipe(rimraf())
         .pipe(notify({ message: 'Clear deploy directory complete', onLast: true }));
 }
 
 function copy() {
     return src(deployInclude)
         .pipe(dest(deployDir))
         .pipe(notify({ message: 'Copy task complete', onLast: true}));
 }
 
 function develop() {
     series(scss);
     watch('./assets/**/*.scss', { ignoreInitial: false }, function(cb) {
         scss();
         cb();
     });
 }
 
 exports.default = develop;
 exports.develop = develop;
 
 exports.deploy = series(scss, clean, copy);