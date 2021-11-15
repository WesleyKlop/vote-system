<?php

namespace App\Http\Middleware;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param Request $request
     */
    protected function redirectTo($request, array $guards = []): ?string
    {
        if (!$request->expectsJson()) {
            return route([
                'web-voter' => 'voter.index',
                'web-admin' => 'admin.login.show'
            ][$guards[0] ?? 'web-admin']);
        }
        return null;
    }

    protected function unauthenticated($request, array $guards)
    {
        throw new AuthenticationException(
            'Unauthenticated.',
            $guards,
            $this->redirectTo($request, $guards)
        );
    }
}
