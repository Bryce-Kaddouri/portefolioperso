/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ['./**/*.{html,js}', './node_modules/tw-elements/dist/js/**/*.js'],

  daisyui: {
    themes: [
      {
        mytheme: {



          "primary": "#570DF8",



          "secondary": "#F000B8",



          "accent": "#37CDBE",



          "neutral": "#3D4451",



          "base-100": "#FFFFFF",



          "info": "#3ABFF8",



          "success": "#36D399",



          "warning": "#FBBD23",



          "error": "#F87272",
        },
      },
    ],
  },

  // theme: {
  //   extend: {
  //     colors: {
  //       // Using modern `rgb`
  //       primary: 'rgb(var(--color-primary) / <alpha-value>)',
  //       secondary: 'rgb(var(--color-secondary) / <alpha-value>)',
  //     }
  //   },
  // },
  plugins: [require('tw-elements/dist/plugin'), require('daisyui'), f],
}
