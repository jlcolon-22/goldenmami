/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./resources/**/*.blade.php",
  "./resources/**/*.js",
  "./resources/**/*.vue",],
  theme: {
    extend: {
        fontFamily: {
            futura: ['futura', 'sans-serif'],
            inter: ['Inter', 'sans-serif','Raleway', 'sans-serif']
          },
          keyframes: {
            menuleft: {
              '0%': { transform: 'translateX(-70%)' },
              '10%': { transform: 'translateX(-60%)' },
              '20%': { transform: 'translateX(-50%)' },
              '30%': { transform: 'translateX(-40%)' },
              '40%': { transform: 'translateX(-30%)' },
              '50%': { transform: 'translateX(-20%)' },
              '60%': { transform: 'translateX(-10%)' },
              '100%': { transform: 'translateX(0%)' },

            },
            menuright: {
                '0%': { transform: 'translateX(70%)' },
                '10%': { transform: 'translateX(60%)' },
                '20%': { transform: 'translateX(50%)' },
                '30%': { transform: 'translateX(40%)' },
                '40%': { transform: 'translateX(30%)' },
                '50%': { transform: 'translateX(20%)' },
                '60%': { transform: 'translateX(10%)' },
                '100%': { transform: 'translateX(0%)' },

              },
              typing: {
                from: { width: "0" },
                to: { width: "14ch" }
              },
              opacityUp: {
                from: { opacity: "0",transform: 'translateY(2rem)' },
                to: { opacity: "1" }
              },
              opacity: {
                from: { opacity: "0" },
                to: { opacity: "1" }
              }
          },
          animation: {
            'menuleft': 'menuleft 1s ease-out  ',
            'menuright': 'menuright 1s ease-out  ',
            'type': 'typing 2s steps(14)',
            'opacity': 'opacity .5s ease-in-out',
            'opacityUp': 'opacityUp 1s ease-in-out',
          },
          screens:{
            // '2xl': {'max': '1535px'},
            // // => @media (max-width: 1535px) { ... }

            // 'xl': {'max': '1279px'},
            // // => @media (max-width: 1279px) { ... }

            // 'lg': {'max': '1023px'},
            // // => @media (max-width: 1023px) { ... }

            // 'md': {'max': '767px'},
            // // => @media (max-width: 767px) { ... }

            // 'sm': {'max': '639px'},
            // => @media (max-width: 639px) { ... }
            'xs':{'min': '200px'},
            // => @media (max-width: 639px) { ... }
          }
    },
  },
  plugins: [],
}

