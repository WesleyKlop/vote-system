<script nonce="{{ csp_nonce('script') }}">
    window.__PUSHER_CONFIG__ = JSON.parse('@json([
    'PUSHER_APP_KEY' => config('broadcasting.connections.pusher.key'),
    'PUSHER_AUTH_ROUTE' => action(\Illuminate\Broadcasting\BroadcastController::class . '@authenticate'),
])')
</script>
