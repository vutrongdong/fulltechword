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

mix.autoload({
        jQuery: 'jquery',
        $: 'jquery',
        jquery: 'jquery'
    })
    .js('resources/assets/js/app.js', 'public/js')
    .scripts([
        "public/assets/js/detect.js",
        "public/assets/js/fastclick.js",
        "public/assets/js/jquery.slimscroll.js",
        "public/assets/js/jquery.blockUI.js",
        "public/assets/js/waves.js",
        "public/assets/js/wow.min.js",
        "public/assets/js/jquery.nicescroll.js",
        "public/assets/js/jquery.scrollTo.min.js",

        "public/assets/plugins/sweet-alert2/sweetalert2.min.js",

        "public/assets/plugins/notifyjs/js/notify.js",
        "public/assets/plugins/notifications/notify-metro.js",

        "public/assets/plugins/moment/moment.js",
        "public/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js",

        "public/assets/js/jquery.core.js",
        "public/assets/js/jquery.app.js",
    ], 'public/js/site.js')
    .js('resources/assets/js/frontend/v1/site.js', 'public/js/frontend/v1/site.js')
    .scripts([
        'public/js/frontend/v1/site.js'
    ], 'public/js/frontend/v1/site.js')
   .sass('resources/assets/sass/app.scss', 'public/css')
   .sass('resources/assets/sass/frontend/v1.scss', 'public/css/frontend/v1/site.css');
