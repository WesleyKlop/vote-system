<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

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
        return Auth::guard('admin');
    }

    protected function loggedOut(): RedirectResponse
    {
        return redirect()->route('admin.login.show');
    }
}
