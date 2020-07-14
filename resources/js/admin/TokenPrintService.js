import { chunkArray, formatToken } from '../helpers'

/**
 * @property {Window} window
 * @property {string[]} tokens
 */
class TokenPrintService {
    constructor(tokens) {
        this.tokens = tokens
    }

    openWindow() {
        this.window = window.open(
            '',
            'printWindow',
            'status=1,width=350,height=150',
        )
        this.window.addEventListener('afterprint', this.handlePrintFinished)
    }

    print() {
        this.openWindow()
        this.setPrintOptions()
        this.displayTokens()
        this.printTokens()
    }

    setPrintOptions() {
        const style = this.window.document.createElement('style')
        style.innerHTML = `
table {
  font-size: 1rem;
  font-family: Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
  border: 1px solid #333333;
  border-collapse: collapse;
  margin: auto;
}
td {
  border: 1px solid #e2e8f0;
  padding: 0.5rem;
}
`
        this.window.document.head.appendChild(style)
    }

    displayTokens() {
        const { document } = this.window
        const table = document.createElement('table')
        chunkArray(this.tokens, 3).forEach((chunk) => {
            const row = document.createElement('tr')
            chunk.forEach((token) => {
                const col = document.createElement('td')
                col.innerText = formatToken(token)
                row.appendChild(col)
            })
            table.appendChild(row)
        })
        document.body.appendChild(table)
    }

    printTokens() {
        this.window.print()
    }

    handlePrintFinished() {
        this.window.close()
        this.window = null
    }
}

export const printTokens = (tokens) => {
    const service = new TokenPrintService(tokens)
    return service.print()
}
