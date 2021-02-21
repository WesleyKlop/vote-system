import Echo from 'laravel-echo'
import Pusher from 'pusher-js'

const client = new Pusher(process.env.MIX_PUSHER_APP_KEY, {
    wsHost: window.location.hostname,
    wsPort: 6001,
    forceTLS: false,
    disableStats: true,
    authEndpoint: '/broadcasting/auth'
})

export default new Echo({
    broadcaster: 'pusher',
    client,
})
