<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TokenGenerateRequest;
use App\Models\Voter;
use App\VoteSystem\Helpers\TokenHelper;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\LazyCollection;
use Illuminate\Support\Str;

class VoterController extends Controller
{
    public function index(): View
    {
        $voters = Voter::query()
            ->orderBy('id')
            ->get();

        return view('views.admin.voters.index', ['voters' => $voters]);
    }

    /**
     * @throws Exception
     */
    public function update(TokenGenerateRequest $request): RedirectResponse
    {
        // Delete all existing tokens, which as a side effect deletes all answers given by a token
        Voter::query()->delete();

        $tokens = TokenHelper::generateTokens($request->get('amount'));
        $tokens = LazyCollection::make($tokens)
            ->map(function (string $token) {
                return [
                    'token' => $token,
                    'id' => Str::uuid(),
                ];
            })
            ->all();

        Voter::insert($tokens);

        return redirect()->back();
    }

    /**
     * @throws Exception
     */
    public function destroy(Voter $voter): RedirectResponse
    {
        $voter->delete();

        return redirect()->back();
    }
}
