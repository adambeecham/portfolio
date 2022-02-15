const mix = require('laravel-mix')
const src = `src`
const dist = `dist/`
const url = `http://website.test`

mix
.options({
  processCssUrls: false
})
.webpackConfig({
  module: {
    rules: [{
      test: /\.scss/,
      enforce: "pre",
      loader: 'import-glob-loader'
    }]
  }
})
.js(`${src}/js/main.js`, `${dist}/main.js`)
.sass(`${src}/scss/main.scss`, `/main.css`)
.sass(`${src}/scss/admin.scss`, `/admin.css`)
.copyDirectory(`${src}/images`, `${dist}/images`)
.copyDirectory(`${src}/fonts`, `${dist}/fonts`)
.copyDirectory(`${src}/svg`, `${dist}/svg`)
.setPublicPath(dist)
.version() 

.browserSync({
  proxy: url,
  browser: `Google Chrome`,
  notify: true,
  open: false,
  files: [
    `${dist}/main.css`,
    `${dist}/main.js`,
    `**/*.php`
  ]
})
