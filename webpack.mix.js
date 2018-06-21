let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */
mix.js('resources/assets/js/app.js', 'public/js')
    .scripts([
        "storage/app/public/assets/js/detect.js",
        "storage/app/public/assets/js/fastclick.js",
        "storage/app/public/assets/js/jquery.slimscroll.js",
        "storage/app/public/assets/js/jquery.blockUI.js",
        "storage/app/public/assets/js/waves.js",
        "storage/app/public/assets/js/wow.min.js",
        "storage/app/public/assets/js/jquery.nicescroll.js",
        "storage/app/public/assets/js/jquery.scrollTo.min.js",

        "storage/app/public/assets/plugins/notifyjs/js/notify.js",
        "storage/app/public/assets/plugins/notifications/notify-metro.js",

        "storage/app/public/assets/plugins/moment/moment.js",
        "storage/app/public/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js",

        "storage/app/public/assets/js/jquery.core.js",
        "storage/app/public/assets/js/jquery.app.js",
    ], 'public/js/site.js')
   .sass('resources/assets/sass/app.scss', 'public/css');
