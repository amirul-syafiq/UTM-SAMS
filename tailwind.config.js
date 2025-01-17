const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',

    ],


    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },

            colors: {
                'primary-bg': '#500000',
                'primary': '#81163f',
                'secondary': '#332c2c',
                'tertiary': '#6ab9c9  ',
                'accent-1': '#ff6b6b ',
                'accent-2': '#ffda77',
                'accent-3': '#facf5a ',
                'accent-4': '#31a7f0 ',
                'accent-5': '#5c6878  ',
                'accent-6': '#f2a71b  ',


            },
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography'),


    ],

};
