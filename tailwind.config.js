/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./src/*.{vue,js,ts,jsx,tsx,twig}",
    "./src/**/*.{vue,js,ts,jsx,tsx,twig}",
    "./app/views/admin/**/*.{twig}",
    "./app/views/admin/*.{twig}",
    "./app/views/admin/*.twig",
    "./app/views/admin/*.html",
    "./src/**/**/*.{vue,js,ts,jsx,tsx,twig}",
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
    require('@tailwindcss/typography'),
    require('@tailwindcss/forms'),
    require('@tailwindcss/line-clamp'),
    require('@tailwindcss/aspect-ratio'),
  ]
}
