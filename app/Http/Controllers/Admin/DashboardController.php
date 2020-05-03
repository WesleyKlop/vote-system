<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\VoteSystem\Pages\Admin\DashboardPage;
use App\VoteSystem\Repositories\PropositionRepository;
use App\VoteSystem\Repositories\VoterRepository;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    private PropositionRepository $propositionRepository;
    private VoterRepository $voterRepository;

    public function __construct(
        PropositionRepository $propositionRepository,
        VoterRepository $voterRepository
    ) {
        $this->propositionRepository = $propositionRepository;
        $this->voterRepository = $voterRepository;
    }

    public function index(): View
    {
        $propositions = $this->propositionRepository->findAll([
            'options',
            'answers',
        ]);
        $voterCount = $this->voterRepository->aggregateVoterStatistics();

        return $this->page(new DashboardPage($propositions, $voterCount));
    }
}
