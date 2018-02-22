let mix = require('laravel-mix')

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

mix.options({
  processCssUrls: false
})
  .autoload({
    jquery: ['$', 'window.jQuery', 'jQuery', 'jquery'],
    vue: ['vue', 'window.Vue', 'Vue'],
    axios: ['axios', 'window.axios'],
    lodash: ['lodash', 'window._']
  })
  .js('resources/assets/js/app.js', 'public/js')
  // .sass('resources/assets/sass/app.scss', 'public/css')
  .extract(['lodash', 'jquery', 'axios', 'vue'])
  .sourceMaps()
  .browserSync('http://local.rolveinmobiliaria.com/')

// version does not work in hmr mode
if (mix.inProduction()) {
  mix.version()
}
