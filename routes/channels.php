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

Broadcast::channel('propositions', fn(?Authenticatable $user) => $user instanceof Voter, ['guards' => 'web-voter']);

Broadcast::channel('controls', fn(?Authenticatable $user) => $user instanceof User, ['guards' => 'web-admin']);

Broadcast::channel('results', fn(?Authenticatable $user) => $user instanceof User, ['guards' => 'web-admin']);
