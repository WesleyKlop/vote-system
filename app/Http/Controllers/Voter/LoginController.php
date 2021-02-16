<?php

namespace App\Http\Controllers\Voter;

use App\Http\Controllers\Controller;
use App\Models\Voter;
use Carbon\CarbonImmutable;
use Illuminate\Contracts\Auth\StatefulGuard;
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

    public function showLoginForm(Request $request): \Illuminate\Contracts\View\View | \Illuminate\Http\RedirectResponse
    {
        if ($request->user('voter')) {
            return redirect()->route('proposition.index');
        }

        return view('views.voter.login', [
            'welcomeMessage' => $this->config->get('welcome_message'),
            'voterLegalRequirements' => $this->config->get(
                'voter_legal_requirements'
            ),
        ]);
    }

    /**
     * Validate the user login request.
     */
    protected function validateLogin(Request $request): void
    {
        $request->validate([
            $this->username() => 'required|string|size:19',
            'legal_accepted' => 'required|accepted',
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

    protected function guard(): StatefulGuard
    {
        return Auth::guard('voter');
    }

    protected function loggedOut(): RedirectResponse
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
