/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./src/*.{vue,js,ts,jsx,tsx,twig}",
    "./src/**/*.{vue,js,ts,jsx,tsx,twig}",
    "./src/**/**/*.{vue,js,ts,jsx,tsx,twig}",
    "./node_modules/vue-tailwind-datepicker/**/*.js",
  ],
  safelist: [
    {
      pattern: /./,
      variants: ['xs', 'sm', 'md', 'lg', 'xl'], // you can add your variants here
    },
  ],
  theme: {
    extend: {},
  },
  plugins: [
  ]
}
