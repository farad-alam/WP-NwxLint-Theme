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
    extend: {
      colors: {
        primary: "var(--color-primary)",
        primary_light: "var(--color-primary-light)",
        secondary: "var(--color-secondary)",
        background: "var(--color-bg)",
        hover: "var(--color-hover)",
        text: "var(--color-text)",
      },
    },
  },
  plugins: [],
};


