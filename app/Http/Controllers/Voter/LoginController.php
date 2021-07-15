<?php

namespace App\Http\Controllers\Voter;

use App\Http\Controllers\Controller;
use App\Models\Voter;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     */
    protected string $redirectTo = '/vote';

    public function showLoginForm(Request $request): View|RedirectResponse
    {
        if ($request->user('web-voter')) {
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
        ], [
            'legal_accepted.required' => __('Accepting the terms is required.'),
        ]);
    }

    protected function credentials(Request $request): array
    {
        return [
            $this->username() => (string) Str::of($request->input($this->username()))
                ->replace(' ', '')
                ->upper(),
        ];
    }

    public function username(): string
    {
        return 'token';
    }

    protected function guard(): StatefulGuard
    {
        return Auth::guard('web-voter');
    }

    protected function loggedOut(): RedirectResponse
    {
        return redirect()->route('voter.index');
    }

    protected function authenticated(Request $request, Voter $voter): void
    {
        // Set the used at property if not set yet
        if (is_null($voter->used_at)) {
            $voter->used_at = now();
            $voter->save();
        }
    }
}
