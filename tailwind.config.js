/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        admin: {
          primary: '#4318FF',
          secondary: '#6AD2FF',
          success: '#05CD99',
          danger: '#EE5D50',
          warning: '#FFCE20',
          info: '#4481EB',
          bg: '#F4F7FE',
          heading: '#2B3674',
          body: '#A3AED0',
          gray: {
            100: '#E0E5F2',
            500: '#A3AED0',
            900: '#707EAE',
          }
        }
      }
    },
  },
  plugins: [],
}
