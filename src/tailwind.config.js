/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './**/*.{html,php,js}',
  ],
  safelist: [
    /^bg-\[.*\]$/, // Permite todas las clases arbitrarias de color de fondo
  ],
  theme: {
    extend: {},
  },
  plugins: [],
};
