import HttpClient from '../shared/HttpClient'

export default class PropositionService {
    /**
     * @member {string} #voteRoute
     * @private
     */
    #routes

    /**
     * @member {HttpClient} #httpClient
     */
    #httpClient

    constructor(token, routes) {
        this.#httpClient = new HttpClient(token)
        this.#routes = routes
    }

    route(name, id) {
        return this.#routes[name].replace(':id', id)
    }

    toggleProposition(propositionId, is_open) {
        return this.#httpClient.patch(this.route('update', propositionId), {
            is_open,
        })
    }
}
