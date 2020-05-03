<?php

namespace App\Http\Controllers\Voter;

use App\Http\Controllers\Controller;
use App\Http\Requests\Voter\PropositionSubmitRequest;
use App\VoteSystem\Models\Proposition;
use App\VoteSystem\Models\Voter;
use App\VoteSystem\Pages\Voters\PropositionShowPage;
use App\VoteSystem\Services\PropositionService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PropositionController extends Controller
{
    private PropositionService $propositionService;

    public function __construct(PropositionService $propositionService)
    {
        $this->propositionService = $propositionService;
    }

    public function index(Request $request)
    {
        $user = $request->user();
        $proposition = $this
            ->propositionService
            ->getNextProposition($user->id);

        if (is_null($proposition)) {
            return view('views.voter.empty_state');
        }

        return $this->page(new PropositionShowPage($proposition));
    }

    /**
     * @param  PropositionSubmitRequest  $request
     * @return RedirectResponse
     * @throws Exception
     */
    public function update(PropositionSubmitRequest $request)
    {
        /** @var Voter $voter */
        $voter = $request->user();
        $proposition = Proposition::findOrFail($request->get('proposition'));

        // Validate that the proposition is still open
        if (! $proposition->is_open) {
            throw new Exception('Proposition is already closed');
        }

        $answers = collect($request->get('answer'));

        $this
            ->propositionService
            ->answerProposition($voter, $proposition, $answers);

        return redirect()->route('proposition.index');
    }
}
