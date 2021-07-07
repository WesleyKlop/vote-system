<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Models\Proposition;
use App\VoteSystem\Repositories\VoterPropositionOptionRepository;

class PropositionVotesController extends Controller
{
    public function __construct(private VoterPropositionOptionRepository $optionRepository)
    {
        parent::__construct();
    }

    public function __invoke(Proposition $proposition): array
    {
        $timestamp = microtime(true);
        return [
            'data' => $this->optionRepository->findVotesBefore($proposition, $timestamp),
            'timestamp' => $timestamp,
        ];
    }
}
