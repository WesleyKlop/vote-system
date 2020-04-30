<?php

namespace App\Http\Controllers\Voter;

use App\Http\Controllers\Controller;
use App\Http\Requests\Voter\PropositionSubmitRequest;
use App\Proposition;
use App\PropositionOption;
use App\Voter;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PropositionController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $proposition = Proposition::whereDoesntHave('voters', function (
            Builder $query
        ) use ($user) {
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

    /**
     * @param  PropositionSubmitRequest  $request
     * @return RedirectResponse
     * @throws Exception
     */
    public function update(PropositionSubmitRequest $request)
    {
        /** @var Voter $user */
        $user = $request->user();
        $proposition = Proposition::findOrFail($request->get('proposition'));

        // Get the answers and verify that they all belong to a given proposition
        $submittedAnswers = $request->get('answer');
        $validAnswers = PropositionOption::where(
            'proposition_id',
            $proposition->id
        )
            ->whereIn('id', $submittedAnswers)
            ->get();

        if (
            $validAnswers->count() === 0 ||
            $validAnswers->count() !== count($submittedAnswers)
        ) {
            throw new Exception(
                'Could not find any selected answers. Did you try to cheat?'
            );
        }

        $user->answers()->createMany(
            $validAnswers->map(function (PropositionOption $option) {
                return [
                    'proposition_id' => $option->proposition_id,
                    'proposition_option_id' => $option->id,
                ];
            })
        );

        return redirect()->route('proposition.index');
    }
}
