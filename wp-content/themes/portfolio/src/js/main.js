// Automatically compiles all the files from '/components' using Webpack Mix (https://laravel.com/docs/8.x/mix).

const req = require.context('./components/', true, /\.(js)$/i)
req.keys().map(key => { req(key).default() })