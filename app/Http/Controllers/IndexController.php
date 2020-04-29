<?php

namespace App\Http\Controllers;

use App\Http\Requests\TokenRegisterRequest;

class IndexController extends Controller
{
    public function index()
    {
        return view('views.index');
    }

    public function register(TokenRegisterRequest $tokenRegisterRequest)
    {
        // Token validity is checked by the formrequest rules
        session()->put('token', $tokenRegisterRequest->get('token'));

        return redirect()->route('vote.index');
    }
}
