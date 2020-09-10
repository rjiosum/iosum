const _ = require('lodash');
const jsonFile = require('jsonfile');
const mix = require('laravel-mix');

const assetsPath = 'resources/assets/';
const themePath = '/backend/theme01/';
const publicPath = 'public/backend/theme01/';

const mixManifest = publicPath + '/mix-manifest.json';

mix.setPublicPath(publicPath);
mix.setResourceRoot('../');

mix.webpackConfig({
    resolve: {
        extensions: ['.js', '.json', '.jxs', '.vue'],
        alias: {
            '@': path.resolve(__dirname, assetsPath + 'js/')
        }
    },
    output: {
        publicPath : themePath,
        chunkFilename: 'js/chunks/[id].[chunkhash].js'
    }
});


mix.js(assetsPath  + 'js/app.js', publicPath + 'js')
    .sass(assetsPath + 'sass/app.scss', publicPath + 'css')
    .version();

mix.copyDirectory(assetsPath + 'images', publicPath + 'images');

mix.then(() => {
    jsonFile.readFile(mixManifest, (err, obj) => {
        const newJson = {};
        _.forIn(obj, (value, key) => {
            const newKey = _.trimEnd(themePath, '/') + key;
            newJson[newKey] = value
        });
        jsonFile.writeFile(mixManifest, newJson, { spaces: 4 }, (err) => {
            if (err) console.error(err)
        });
    });
});