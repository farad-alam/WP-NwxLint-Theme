/** @type {import('tailwindcss').Config} */
 /** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./*.php",
    "./**/*.php",
    "./src/**/*.{js,jsx,ts,tsx}",
    "./templates/**/*.php",
    "./parts/**/*.php",
    "./inc/**/*.php",
  ],
  theme: {
    extend: {},
  },
  plugins: [],
};
// module.exports = {
//   content: [
//     "./*.php",
//     "./**/*.php",
//     "./src/**/*.{js,jsx,ts,tsx}",
//     "./templates/**/*.php",
//     "./parts/**/*.php",
//     "./inc/**/*.php",
//   ],
//   theme: {
//     extend: {
//       // your custom colors, fonts etc
//     },
//   },
//   plugins: [],
// }

