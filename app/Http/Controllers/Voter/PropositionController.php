<?php

namespace App\Http\Controllers\Voter;

use App\Http\Controllers\Controller;
use App\Http\Requests\Voter\PropositionSubmitRequest;
use App\Models\Proposition;
use App\Models\Voter;
use App\VoteSystem\Pages\Voters\PropositionShowPage;
use App\VoteSystem\Services\PropositionService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PropositionController extends Controller
{
    public function __construct(private PropositionService $propositionService)
    {
        parent::__construct();
    }

    public function index(Request $request)
    {
        $user = $request->user();
        $proposition = $this->propositionService->getNextProposition($user);

        if (is_null($proposition)) {
            return view('views.voter.empty_state');
        }

        return $this->page(new PropositionShowPage($proposition));
    }

    public function update(PropositionSubmitRequest $request): RedirectResponse
    {
        /** @var Voter $voter */
        $voter = $request->user();
        $proposition = Proposition::findOrFail($request->get('proposition'));

        if (!$proposition->is_open) {
            return redirect()
                ->route('proposition.index')
                ->withErrors([
                    'proposition' =>
                        'The answer for the previous proposition has not been registered as the proposition was already closed.',
                ]);
        }

        if (
            $this->propositionService->propositionHasVoter($proposition, $voter)
        ) {
            throw new Exception('You already answered this proposition');
        }

        $answers = collect($request->get('answer'));

        $this->propositionService->answerProposition(
            $voter,
            $proposition,
            $answers
        );

        return redirect()->route('proposition.index');
    }
}
