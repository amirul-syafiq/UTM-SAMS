const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    darkMode: "media",
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        "./node_modules/flowbite/**/*.js"

    ],


    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },

            colors: {
                'primary-bg': '#500000',
                'secondary': '#332c2c',
                'primary': '#81163f',
            },
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography'),

              require('flowbite/plugin')

             ],

};
