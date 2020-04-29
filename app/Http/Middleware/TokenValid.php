<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TokenValid
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /** @var string|null $token */
        $token = session()->get('token', null);

        if (is_null($token)) {
            return redirect()->route('index');
        }

        return $next($request);
    }
}
