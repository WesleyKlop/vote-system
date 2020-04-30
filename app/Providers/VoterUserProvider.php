<?php

namespace App\Providers;

use App\VoteSystem\Models\Voter;
use Exception;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;

class VoterUserProvider implements UserProvider
{
    /**
     * @inheritDoc
     */
    public function retrieveById($identifier)
    {
        return Voter::find($identifier);
    }

    /**
     * @inheritDoc
     */
    public function retrieveByToken($identifier, $token)
    {
        throw new Exception('Voter does not support remember-me tokens');
    }

    /**
     * @inheritDoc
     */
    public function updateRememberToken(Authenticatable $user, $token)
    {
        throw new Exception('Voter does not support remember-me tokens');
    }

    /**
     * @inheritDoc
     */
    public function retrieveByCredentials(array $credentials)
    {
        if (!array_key_exists('token', $credentials)) {
            return;
        }
        return Voter::where('token', $credentials['token'])->first();
    }

    /**
     * @inheritDoc
     */
    public function validateCredentials(
        Authenticatable $user,
        array $credentials
    ) {
        $token = $credentials['token'];

        return $token === $user->token;
        // TODO: Implement validateCredentials() method.
    }
}
