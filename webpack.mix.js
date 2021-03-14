const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
        require('autoprefixer'),
    ]).vue();

mix.copy('node_modules/sweetalert2/src/sweetalert2.scss', 'public/css/sweetalert2.css')
mix.copy('node_modules/vue-multiselect/dist/vue-multiselect.min.css', 'public/css/vue-multiselect.min.css')

mix.webpackConfig({
    watchOptions: {
        ignored: /node_modules/
    },
    output: {
        chunkFilename: 'js/chunks/[name].js?id=[chunkhash]',
    },
    resolve: {
        /*alias: {
            '@c': path.resolve('resources/js/components'),
        }*/
    }
    /*resolve: {
        alias: {
            'vue$': 'node_modules/vue/dist/vue' // 'vue/dist/vue.common.js' for webpack 1
        }
    }*/
})

// Algolia Error: Module not found: Error: Can't resolve 'vue-server-renderer/basic'
mix.webpackConfig({
    externals: {
        'vue-server-renderer/basic': 'vue-server-renderer/basic'
    },
})

mix.browserSync({
    proxy: 'http://localhost:8000',
    open: false,
    snippetOptions: {
        rule: {
            match: /<\/body>/i,
            fn: function (snippet, match) {
                return snippet + match;
            }
        }
    }
});

if (mix.inProduction()) {
    mix.version();
}
