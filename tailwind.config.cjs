/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './resources/views/Landingpage.blade.php',  // Menyertakan file HTML, JS, dan Blade di folder resources
    './public/**/*.{html,js}',               // Jika ada file HTML di folder public
  ],
  safelist: [
    'ml-2', 'ml-3', 'ml-4',
    'w-2', 'w-3', 'h-2', 'h-3',
    'bg-red-500', 'bg-yellow-400', 'bg-green-500',
    'rounded-full', 'inline-block'
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
