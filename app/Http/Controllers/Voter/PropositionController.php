<?php

namespace App\Http\Controllers\Voter;

use App\Http\Controllers\Controller;
use App\VoteSystem\Services\PropositionService;
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

        return view('views.voter.show', [
            'proposition' => $proposition,
        ]);
    }
}
