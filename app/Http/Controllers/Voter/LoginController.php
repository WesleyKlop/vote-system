<?php

namespace App\Http\Controllers\Voter;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    /**
     * Where to redirect users after login.
     * @var string
     */
    protected $redirectTo = '/vote';

    /**
     * @return View
     */
    public function showLoginForm(): View
    {
        return view('views.voter.login');
    }

    /**
     * Validate the user login request.
     *
     * @param  Request  $request
     * @return void
     *
     * @throws ValidationException
     */
    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
        ]);
    }

    public function username(): string
    {
        return 'token';
    }

    protected function guard()
    {
        return Auth::guard('voter');
    }
}
