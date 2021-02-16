<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\VoteSystem\Pages\Admin\DashboardPage;
use App\VoteSystem\Repositories\PropositionRepository;
use App\VoteSystem\Repositories\VoterRepository;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function __construct(
        private PropositionRepository $propositionRepository,
        private VoterRepository $voterRepository
    ) {
        parent::__construct();
    }

    public function index(): View
    {
        $propositions = $this->propositionRepository->findAll([
            'options',
            'answers',
        ]);
        $voterCount = $this->voterRepository->aggregateVoterStatistics();
        $welcomeMessage = $this->config->get('admin_welcome_message');

        return $this->page(
            new DashboardPage($propositions, $voterCount, $welcomeMessage)
        );
    }
}
