import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
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
                eucalyptus: {
                    50: '#f2f6f3',
                    100: '#e1eae4',
                    200: '#c3d5c9',
                    300: '#9dbaa0',
                    400: '#697c70',
                    500: '#485c52',
                    600: '#384940',
                    700: '#2c3b34',
                    800: '#222e28',
                    900: '#1a241f',
                },
                plaster: '#f4f3ee',
                soot: '#202b26',
            },
        },
    },

    plugins: [forms, typography],
};
