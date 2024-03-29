const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors')

module.exports = {
    purge: [
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
        /*'./public/!**!/!*.html',
        './src/!**!/!*.{js,jsx,ts,tsx,vue}',*/
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter var', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'h-cyan': '#34D399',
                'h-teal': '#47C2F2',
                teal: colors.teal,
                cyan: colors.cyan,
                emerald: colors.emerald,
            }
        },
    },

    variants: {
        extend: {
            opacity: ['disabled'],
            height: ['hover'],
            width: ['hover'],
        },
    },
    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
        require('@tailwindcss/aspect-ratio'),
    ],
};
