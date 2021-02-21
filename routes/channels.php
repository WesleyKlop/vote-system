<?php

use App\Models\User;
use App\Models\Voter;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('propositions', function (?Authenticatable $user) {
    return $user instanceof Voter;
}, ['guards' => 'voter']);

Broadcast::channel('results', function (?Authenticatable $user) {
    return $user instanceof User;
}, ['guards' => 'admin']);
