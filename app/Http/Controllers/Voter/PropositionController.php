<?php

namespace App\Http\Controllers\Voter;

use App\Http\Controllers\Controller;
use App\Http\Requests\Voter\PropositionSubmitRequest;
use App\Proposition;
use App\PropositionOption;
use App\Voter;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class PropositionController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $proposition = Proposition
            ::whereDoesntHave('voters', function (Builder $query) use ($user) {
                $query->where('voters.id', $user->id);
            })
            ->where('is_open', true)
            ->orderBy('index')
            ->first();

        if (is_null($proposition)) {
            return view('views.voters.empty_state');
        }

        return view('views.voter.show', ['proposition' => $proposition]);
    }

    public function update(PropositionSubmitRequest $request)
    {
        /** @var Voter $user */
        $user = $request->user();
        $proposition = Proposition::findOrFail($request->get('proposition'));

        // Validate that the given option is a valid option for the current proposition
        $selectedAnswer = PropositionOption
            ::where('proposition_id', $proposition->id)
            ->where('id', $request->get('answer'))
            ->first();

        if (is_null($selectedAnswer)) {
            throw new Exception(
                'Proposition id and answer id do not relate to each other. Did you just try to cheat?'
            );
        }

        $user
            ->answers()
            ->create([
                'proposition_id' => $proposition->id,
                'proposition_option_id' => $selectedAnswer->id,
            ]);

        return redirect()->route('proposition.index');
    }
}
