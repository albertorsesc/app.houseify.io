const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
        require('autoprefixer'),
    ]).vue({ version: 2 });


mix.webpackConfig({
    watchOptions: {
        ignored: /node_modules/
    },
    resolve: {
        alias: {
            'vue$': 'node_modules/vue/dist/vue.esm.js' // 'vue/dist/vue.common.js' for webpack 1
        }
    }
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
