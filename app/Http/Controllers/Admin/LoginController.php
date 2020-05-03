<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
    protected string $redirectTo = '/admin/';

    public function username(): string
    {
        return 'name';
    }

    public function showLoginForm(): View
    {
        return view('views.admin.login');
    }

    protected function guard(): SessionGuard
    {
        return Auth::guard('admin');
    }

    protected function loggedOut(Request $request): RedirectResponse
    {
        return redirect()->route('admin.login.show');
    }
}
