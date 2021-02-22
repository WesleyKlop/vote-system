<?php

namespace App\Http\Controllers\Voter;

use App\Http\Controllers\Controller;
use App\Models\Proposition;
use App\VoteSystem\Services\PropositionService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class PropositionController extends Controller
{
    public function __construct(private PropositionService $propositionService)
    {
        parent::__construct();
    }

    public function index(Request $request): View
    {
        $user = $request->user();
        $proposition = $this->propositionService->getNextProposition($user);

        return $this->show($request, $proposition);
    }

    public function show(Request $request, ?Proposition $proposition): View
    {
        $answeredPropositionIds = $request->user()
            ->answers()
            ->distinct('proposition_id')
            ->get(['proposition_id'])
            ->pluck('proposition_id');

        return view('views.voter.show', [
            'proposition' => $proposition,
            'answeredPropositions' => $answeredPropositionIds
        ]);
    }
}
