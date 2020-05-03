<?php

namespace App\Http\Controllers\Voter;

use App\Http\Controllers\Controller;
use App\VoteSystem\Models\Voter;
use Carbon\CarbonImmutable;
use Illuminate\Auth\SessionGuard;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    /**
     * Where to redirect users after login.
     */
    protected string $redirectTo = '/vote';

    /**
     * @param  Request  $request
     * @return View|RedirectResponse
     */
    public function showLoginForm(Request $request): View
    {
        if ($request->user('voter')) {
            return redirect()->route('proposition.index');
        }
        return view('views.voter.login');
    }

    /**
     * Validate the user login request.
     *
     * @param  Request  $request
     * @return void
     *
     */
    protected function validateLogin(Request $request): void
    {
        $request->validate([
            $this->username() => 'required|string',
        ]);
    }

    protected function credentials(Request $request): array
    {
        $token = $request->get($this->username());
        $token = str_replace(' ', '', $token);
        $token = strtoupper($token);

        // Cleanup token
        return [
            'token' => $token,
        ];
    }

    public function username(): string
    {
        return 'token';
    }

    protected function guard(): SessionGuard
    {
        return Auth::guard('voter');
    }

    protected function loggedOut(Request $request): RedirectResponse
    {
        return redirect()->route('voter.index');
    }

    protected function authenticated(Request $request, Voter $voter): void
    {
        // Set the used at property if not set yet
        if (is_null($voter->used_at)) {
            $voter->used_at = CarbonImmutable::now();
            $voter->save();
        }
    }
}
