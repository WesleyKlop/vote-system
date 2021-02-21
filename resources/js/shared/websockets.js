import Echo from 'laravel-echo'
import Pusher from 'pusher-js'

/**
 * @type {null|Echo} instance
 */
let instance = null

/**
 * @returns {Echo}
 */
const getConnection = () => {
    if (!instance) {
        instance = new Echo({
            broadcaster: 'pusher',
            client: new Pusher(process.env.MIX_PUSHER_APP_KEY, {
                wsHost: window.location.hostname,
                wsPort: 6001,
                forceTLS: false,
                disableStats: true,
                authEndpoint: '/broadcasting/auth',
            }),
        })
    }
    return instance
}

export default getConnection
