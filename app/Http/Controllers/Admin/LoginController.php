<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     * @var string
     */
    protected $redirectTo = '/admin/';

    public function username(): string
    {
        return 'name';
    }

    /**
     * @return View
     */
    public function showLoginForm(): View
    {
        return view('views.admin.login');
    }
}
