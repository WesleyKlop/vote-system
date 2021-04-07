import { HttpError, ValidationError } from './errors'

export default class HttpClient {
    #token

    #makeHeaders = () =>
        new Headers({
            Accept: 'application/json',
            Authorization: `Bearer ${this.#token}`,
        })

    constructor(token) {
        this.#token = token
    }

    /**
     * @template {any} T
     * @param method
     * @param url
     * @param contentType
     * @param body
     * @returns {Promise<T|boolean>}
     */
    #request = async (
        method,
        url,
        { contentType = 'application/json' } = {},
        body = null,
    ) => {
        const request = new Request(url, {
            method,
            headers: this.#makeHeaders(),
        })

        if (method !== 'GET' && !!body) {
            request.headers.append('Content-Type', contentType)
            request.body =
                typeof body === 'object' ? JSON.stringify(body) : body
        }

        const response = await fetch(request)

        switch (response.status) {
            case 200:
            case 201:
                return response.json()
            case 204:
                return true
            case 422: // Validation error
                throw await ValidationError.FromResponse(response)
            default:
                throw await HttpError.FromResponseJson(response)
        }
    }

    get(url, params) {
        return this.#request('GET', url, params)
    }

    post(url, body, params) {
        return this.#request('POST', url, params, body)
    }

    patch(url, body, params) {
        return this.#request('PATCH', url, params, body)
    }

    put(url, body, params) {
        return this.#request('PUT', url, params, body)
    }

    delete(url, body, params) {
        return this.#request('DELETE', url, params, body)
    }
}
