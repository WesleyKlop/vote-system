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

    async fetchResults(propositionId) {
        const { data, timestamp } = await this.#httpClient.get(
            this.route('results', propositionId),
        )

        const mappedData = data.reduce((byProposition, current) => {
            byProposition[current.proposition_id] ??= {}
            byProposition[current.proposition_id][
                current.horizontal_option_id
            ] ??= {}
            byProposition[current.proposition_id][current.horizontal_option_id][
                current.vertical_option_id
            ] = current.votes
            return byProposition
        }, {})

        return {
            data: mappedData,
            timestamp,
        }
    }
}
