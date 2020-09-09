const mix = require('laravel-mix');
const publicPath = 'public';

mix.setPublicPath(publicPath);

mix.webpackConfig({
    resolve: {
        extensions: ['.js', '.json', '.jxs', '.vue'],
        alias: {
            '@': path.resolve(__dirname, 'resources/assets/js/')
        }
    },
    output:{
        chunkFilename: 'js/[id].[chunkhash].js'
    }
});

//backend
mix.js('resources/assets/js/app.js', publicPath + '/js')
    .sass('resources/assets/sass/app.scss', publicPath + '/css');

mix.copy('resources/assets/images', publicPath + '/images');