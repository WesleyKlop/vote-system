<?php


namespace App\Http\Controllers\Voter;

use App\Http\Controllers\Controller;
use App\Http\Requests\Voter\PropositionVotesSubmitRequest;
use App\Models\Proposition;
use App\VoteSystem\Services\PropositionService;
use Illuminate\Http\Response;

class PropositionVotesController extends Controller
{
    public function __construct(private PropositionService $propositionService)
    {
        parent::__construct();
    }

    public function store(PropositionVotesSubmitRequest $request, Proposition $proposition): Response
    {
        abort_unless(
            $proposition->is_open,
            400,
            trans('The answer for the previous proposition has not been registered as the proposition was already closed')
        );

        abort_if(
            $this->propositionService->propositionHasVoter($proposition, $request->user()),
            400,
            trans('You already answered this proposition')
        );

        $answers = collect($request->get('answers'));

        $this->propositionService->answerProposition(
            $request->user(),
            $proposition,
            $answers
        );

        return response(null, 204);
    }
}
