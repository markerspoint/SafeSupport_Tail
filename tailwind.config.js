/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/views/**/*.blade.php",   // all Blade templates
    "./resources/js/**/*.js",             // JS files (if using JS classes)
    "./resources/js/**/*.vue",            // Vue (optional, not needed for Livewire)
    "./resources/js/**/*.jsx",
    "./resources/js/**/*.ts",
    "./resources/js/**/*.tsx",
  ],
  theme: {
    extend: {
      fontFamily: {
        sans: ['Poppins'],
      },
    },
  },
  plugins: [],
}
