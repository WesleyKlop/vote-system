<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\VoteSystem\Repositories\PropositionRepository;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function __construct(
        private readonly PropositionRepository $propositionRepository,
    ) {
        parent::__construct();
    }

    public function index(): View
    {
        $proposition = $this
            ->propositionRepository
            ->currentOrFirst();
        $propositions = $this
            ->propositionRepository
            ->findAll(['options']);

        $routes = [
            "results" => route("api.proposition.votes.show", ":id"),
            "update" => route("api.proposition.update", ":id"),
        ];

        return view('views.admin.index', [
            'welcomeMessage' => $this->config->get('admin_welcome_message'),
            'currentPropositionId' => $proposition?->id,
            'propositions' => $propositions,
            'routes' => $routes,
        ]);
    }
}
