<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
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
    protected string $redirectTo = '/admin/';

    public function username(): string
    {
        return 'name';
    }

    public function showLoginForm(): View
    {
        return view('views.admin.login');
    }

    protected function guard(): StatefulGuard
    {
        return Auth::guard('web-admin');
    }

    protected function loggedOut(): RedirectResponse
    {
        return redirect()->route('admin.login.show');
    }

    protected function authenticated(Request $request, User $user): void
    {
        $user->update([
            'api_token' => Str::random(32),
        ]);
    }
}
