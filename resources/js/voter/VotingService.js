import HttpClient from '../shared/HttpClient'

export default class VotingService {
    /**
     * @member {string} #voteRoute
     * @private
     */
    #voteRoute

    /**
     * @member {HttpClient} #httpClient
     */
    #httpClient

    constructor(token, voteRoute) {
        this.#httpClient = new HttpClient(token)
        this.#voteRoute = voteRoute
    }

    /**
     * @param {string} propositionId
     * @param {Object} answers
     * @returns {Promise<boolean>}
     */
    submitAnswers(propositionId, answers) {
        return this.#httpClient.post(
            this.#voteRoute.replace(':id', propositionId),
            { answers },
        )
    }
}
