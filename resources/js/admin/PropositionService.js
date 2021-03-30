import HttpClient from '../shared/HttpClient'

export default class PropositionService {
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
}
