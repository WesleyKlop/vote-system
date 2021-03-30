const colors = require('tailwindcss/colors')

const getPalette = (color, base = 600) => ({
    light: color[100],
    DEFAULT: color[base],
    dark: color[900],
})

module.exports = {
    purge: ['./resources/views/**/*.blade.php', './resources/svg/**/*.svg', './resources/js/**/*.vue'],
    theme: {
        colors: {
            primary: `var(--primary-color, ${colors.teal[500]})`,
            accent: `var(--accent-color, ${colors.blue[700]})`,
            success: getPalette(colors.green),
            failure: getPalette(colors.red),
            warning: getPalette(colors.yellow),
        },
    },
}
