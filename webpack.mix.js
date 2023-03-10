let mix = require('webpack-mix');

mix
.js('assets/src/alertify/alertify.min.js', 'assets/dist/')
.js('assets/src/app.js', 'assets/dist/')
.copy('assets/src/alertify/alertify.min.css', 'assets/dist/')
.copy('assets/tailwind.min.css', 'assets/dist/');


mix.webpackConfig({
    output:{
        chunkFilename:'assets/dist/vuejs_code_split/[name].js',
    }
})
