/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Poppins', 'sans-serif'],
            },
            colors: {
                edvizo: {
                    bg: '#eef3ee',        // The main light background
                    dark: '#2c5a41',      // Dark green text/gradient start
                    light: '#63a37e',     // Light green gradient end
                    card: '#ffffff',
                }
            }
        },
    },
    plugins: [],
}
