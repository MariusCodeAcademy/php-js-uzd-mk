/** @type {import('tailwindcss').Config} */
// eslint-disable-next-line no-undef
module.exports = {
  content: ['./index.html', './src/**/*.vue'],
  theme: {
    extend: {
      container: {
        center: true,
        padding: '2rem'
      }
    }
  },
  plugins: []
}
