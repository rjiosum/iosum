const mix = require('laravel-mix');
const del = require('del');

const assetsPath = 'resources/assets/';
const themePath = 'backend/theme01/';

const publicPath = 'public/';

mix.setPublicPath(publicPath);


mix.webpackConfig({
    resolve: {
        extensions: ['.js', '.json', '.jxs', '.vue'],
        alias: {
            '@': path.resolve(__dirname, assetsPath + 'js/')
        }
    },
    output: {
        chunkFilename: themePath + 'js/[id].[chunkhash].js'
    }
});


//backend
mix.js(assetsPath  + 'js/app.js', publicPath + themePath + 'js')
    .sass(assetsPath + 'sass/app.scss', publicPath + themePath + 'css')
    .version();

mix.copyDirectory(assetsPath + 'images', publicPath + themePath + 'images');
