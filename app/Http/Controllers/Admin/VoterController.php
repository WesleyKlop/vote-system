<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TokenGenerateRequest;
use App\Voter;
use App\VoteSystem\Helpers\TokenHelper;
use Illuminate\Support\Str;

class VoterController extends Controller
{
    public function index()
    {
        $voters = Voter::all();

        return view('views.admin.voters.index', ['voters' => $voters]);
    }

    public function update(TokenGenerateRequest $request)
    {
        // Delete all existing tokens, which as a side effect deletes all answers given by a token
        Voter::query()->delete();

        $tokens = TokenHelper::generateTokens($request->get('amount'));
        $tokens = collect($tokens)
            ->transform(function (string $token) {
                return [
                    'token' => $token,
                    'id' => Str::uuid(),
                ];
            })
            ->all();

        Voter::insert($tokens);

        return redirect()->back();
    }
}
