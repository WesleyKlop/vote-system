<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Models\Proposition;
use App\VoteSystem\Repositories\VoterPropositionOptionRepository;
use Illuminate\Http\JsonResponse;

class PropositionVotesController extends Controller
{
    public function __construct(private VoterPropositionOptionRepository $optionRepository)
    {
        parent::__construct();
    }

    public function __invoke(Proposition $proposition): JsonResponse
    {
        $timestamp = microtime(true);
        return response()->json([
            'data' => $this->optionRepository->findVotesBefore($proposition, $timestamp),
            'timestamp' => $timestamp,
        ]);
    }
}
