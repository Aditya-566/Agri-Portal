import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
                heading: ['Sora', 'Outfit', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: '#00B894',
                secondary: '#FF9F1C',
                cream: '#F8F5F0',
                beige: '#EFE7DA',
                clay: '#C97B63',
                charcoal: '#1E1E1E',
                forest: '#4F6F52',
                'sky-grad': '#D6F0FF',
                'sun-grad': '#FFF3D6',
                agri: {
                    primary: '#00B894',
                    green: '#00B894',
                    'green-light': '#02d4ab',
                    leaf: '#4F6F52',
                    beige: '#EFE7DA',
                    brown: '#C97B63',
                    wheat: '#FF9F1C',
                    gold: '#FF9F1C',
                    sky: '#D6F0FF',
                    cream: '#F8F5F0',
                    forest: '#4F6F52',
                }
            }
        },
    },

    plugins: [forms],
};
