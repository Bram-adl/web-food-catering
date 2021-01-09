module.exports = {
  purge: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
  ],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {},
  },
  variants: {
    extend: {
      transform: ['hover', 'group-hover'],
      translate: ['hover', 'group-hover'],
      inset: ['hover', 'group-hover'],
      transitionProperty: ['hover', 'group-hover'],
      fontWeight: ['hover', 'group-hover'],
    },
  },
  plugins: [],
}
