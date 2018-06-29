let mix = require("laravel-mix");

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

// mix.js('resources/assets/js/app.js', 'public/js')
//    .sass('resources/assets/sass/app.scss', 'public/css');
mix.styles(
  [
    "public/user/css/iosoverlay.css",
    "public/user/css/bootstrap.css",
    "public/user/css/simple-line-icons.css",
    "public/user/css/font-awesome.min.css",
    "public/user/css/jquery.orgchart.css",
    "public/user/css/bealert.css",
    "public/user/css/toastr.css",
    "public/user/css/bootstrap-datetimepicker.css",
    "public/user/css/engine.css"
  ],
  "public/user/css/user-all.css"
);

mix.scripts(
  [
    "public/user/js/mtopt-3.0-min.js",
    "public/user/js/jquery-3.2.1.min.js",
    "public/user/js/bealert.js",
    "public/user/js/bootstrap.js",
    "public/user/js/iosoverlay.js",
    "public/user/js/jquery.orgchart.js",
    "public/user/js/bootstrap-datetimepicker.js",
    "public/user/js/bootstrap-datetimepicker.zh-cn.js",
    "public/user/js/toastr.js",
    "public/user/js/echarts.common.min.js",
    "public/user/js/spin.min.js",
    "public/user/js/engine.js"
    // "public/user/js/settimeqt.js"
  ],
  "public/user/js/user-all.js"
);
