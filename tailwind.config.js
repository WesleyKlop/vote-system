// tailwind.config.js
const { colors } = require('tailwindcss/defaultTheme')

const getPalette = (color, base = '600') => ({
    light: color['100'],
    default: color[base],
    dark: color['900'],
})

module.exports = {
    purge: [
        './resources/views/**/*.blade.php',
        './resources/svg/**/*.svg',
        './resources/js/**/*.vue',
    ],
    theme: {
        colors: {
            white: '#ffffff',
            black: '#000',
            primary: `var(--primary-color, ${colors.teal['500']})`,
            accent: `var(--accent-color, ${colors.blue['700']})`,
            gray: colors.gray,
            success: getPalette(colors.green),
            failure: getPalette(colors.red),
            warning: getPalette(colors.yellow),
        },
    },
}
