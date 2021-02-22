export default class AppError extends Error {}

export class HttpError extends AppError {
    /**
     * @param {Response} response
     * @param {string} key
     * @returns {Promise<HttpError>}
     * @constructor
     */
    static FromResponseJson(response, key = 'message') {
        return response.json().then((json) => {
            return new this(json[key])
        })
    }
}

export class ValidationError extends HttpError {
    #errors = {}
    /**
     * @param {Response} response
     * @returns {Promise<HttpError>}
     * @constructor
     */
    static FromResponse(response) {
        return response.json().then((json) => {
            const instance = new this(json.message)
            instance.#errors = json.errors

            return instance
        })
    }

    /**
     * @returns {Record<string, string[]>}
     */
    get errors() {
        return this.#errors
    }
}
