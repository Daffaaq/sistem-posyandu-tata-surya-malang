/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './resources/**/*.{html,js,blade.php}',  // Menyertakan file HTML, JS, dan Blade di folder resources
    './public/**/*.{html,js}',               // Jika ada file HTML di folder public
  ],
  theme: {
    extend: {
      colors: {
        primary: '#4CAF50',  // Warna utama
        secondary: '#FF5722', // Warna sekunder
      },
      fontFamily: {
        sans: ['Inter', 'sans-serif'], // Font yang digunakan
      },
      spacing: {
        '72': '18rem',  // Menambahkan ukuran spacing baru
      },
    },
  },
  plugins: [
    require('@tailwindcss/forms'),  // Plugin untuk form
  ],
}
