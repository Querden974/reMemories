/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
      ],
  theme: {
    extend: {
        fontFamily: {
            'madimi': ['Madimi One', 'sans-serif'],
        },
        colors: {
            'primary': '#3CF1A9',
            'background': "#1C1C1D",
            'component': "#808080"
    },
  },
  plugins: [],
}}
