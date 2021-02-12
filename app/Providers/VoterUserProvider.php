<?php

namespace App\Providers;

use App\VoteSystem\Models\Voter;
use Exception;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;

class VoterUserProvider implements UserProvider
{
    /**
     * {@inheritdoc}
     * @psalm-suppress all
     */
    public function retrieveById($identifier): ?Voter
    {
        return Voter::find($identifier);
    }

    /**
     * {@inheritdoc}
     * @throws Exception
     */
    public function retrieveByToken($identifier, $token)
    {
        throw new Exception('Voter does not support remember-me tokens');
    }

    /**
     * {@inheritdoc}
     * @throws Exception
     */
    public function updateRememberToken(Authenticatable $user, $token)
    {
        throw new Exception('Voter does not support remember-me tokens');
    }

    /**
     * {@inheritdoc}
     */
    public function retrieveByCredentials(array $credentials)
    {
        if (! array_key_exists('token', $credentials)) {
            return null;
        }

        return Voter::where('token', $credentials['token'])->first();
    }

    /**
     * {@inheritdoc}
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
