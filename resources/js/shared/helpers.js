import { APP_LOCALE } from './constants'

export const formatToken = (token) => token.match(/.{1,4}/g).join(' ')

/**
 * @param {array} array
 * @param {number} chunkSize
 * @return {array[]}
 */
export const chunkArray = (array, chunkSize) =>
    array.reduce((resultArray, item, index) => {
        const chunkIndex = Math.floor(index / chunkSize)

        if (!resultArray[chunkIndex]) {
            resultArray[chunkIndex] = []
        }

        resultArray[chunkIndex].push(item)

        return resultArray
    }, [])

export const formatPercentage = (percentage) => {
    const formatter = new Intl.NumberFormat(APP_LOCALE, {
        style: 'percent',
        minimumFractionDigits: 0,
        maximumFractionDigits: 2,
    })
    return formatter.format(percentage)
}
