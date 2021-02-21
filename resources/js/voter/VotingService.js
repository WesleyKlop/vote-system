export default class VotingService {
    /**
     * @property {string} #token
     * @private
     */
    #token

    /**
     * @property {string} #voteRoute
     * @private
     */
    #voteRoute

    constructor(token, voteRoute) {
        this.#token = token
        this.#voteRoute = voteRoute
    }

    #getHeaders = () =>
        new Headers({
            Accept: 'application/json',
            Authorization: `Bearer ${this.#token}`,
            'Content-Type': 'application/json',
        })

    /**
     * @param {string} propositionId
     * @param {Object} answers
     * @returns {Promise<*>}
     */
    async submitAnswers(propositionId, answers) {
        const response = await fetch(
            this.#voteRoute.replace(':id', propositionId),
            {
                headers: this.#getHeaders(),
                method: 'POST',
                body: JSON.stringify({ answers }),
            },
        )

        console.log(response)
    }
}
