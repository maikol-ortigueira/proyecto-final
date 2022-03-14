const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
        },
        colors: {
            'primary': {
                100: '#c8d3bf',
                200: '#aebea0',
                300: '#93a982',
                400: '#7a9465',
                500: '#608049',
                600: '#506a3d',
                700: '#405432',
                800: '#323f27',
                900: '#232c1c',
            },
            'secondary': {
                100: '#FFE1B3',
                200: '#FFCE80',
                300: '#FFBA4D',
                400: '#FFA61A',
                500: '#FF9C00',
                600: '#E68C00',
                700: '#CC7D00',
                800: '#B36D00',
                900: '#995E00',
            },
            'default': '#424242'
        }
    },

    plugins: [require('@tailwindcss/forms')],
};
