// tailwind.config.js
const { colors } = require('tailwindcss/defaultTheme')

module.exports = {
    theme: {
        colors: {
            white: '#ffffff',
            black: '#000',
            primary: `var(--primary-color, ${colors.teal['500']})`,
            accent: `var(--accent-color, ${colors.blue['700']})`,
            gray: colors.gray,
            success: colors.green['600'],
            failure: colors.red['600'],
            warning: colors.yellow['600'],
        },
    },
}
