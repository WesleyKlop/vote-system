<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PropositionStoreRequest;
use App\Http\Requests\Admin\PropositionUpdateRequest;
use App\Models\Proposition;
use App\VoteSystem\Pages\Admin\PropositionIndexPage;
use App\VoteSystem\Repositories\PropositionRepository;
use App\VoteSystem\Repositories\VoterRepository;
use App\VoteSystem\Services\PropositionService;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class PropositionController extends Controller
{
    public function __construct(
        private PropositionService $propositionService,
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
        $voterStatistics = $this->voterRepository->aggregateVoterStatistics();

        return $this->page(new PropositionIndexPage($propositions, $voterStatistics));
    }

    public function create(): View
    {
        $nextPropositionOrder = $this->propositionService->getNextPropositionOrder();
        $mappedOldOptions = $this->propositionService
            ->mapOptions(old('options', []))
            ->all();

        return view('views.admin.propositions.create', [
            'nextPropositionOrder' => $nextPropositionOrder,
            'mappedOldOptions' => $mappedOldOptions,
        ]);
    }

    public function update(PropositionUpdateRequest $request, Proposition $proposition): RedirectResponse
    {
        $this->propositionService->updateProposition(
            $proposition,
            $request->validated()
        );

        return redirect()->route('admin.propositions.index');
    }

    public function store(PropositionStoreRequest $request): RedirectResponse
    {
        $this->propositionService->createProposition($request->validated());

        return redirect()->route('admin.propositions.index');
    }

    public function edit(Proposition $proposition): View
    {
        $proposition->load('options');
        $mappedOldOptions = $this->propositionService->mapOptions(
            old('options', [])
        );

        $mappedOldOptions = $mappedOldOptions->count() > 0
            ? $mappedOldOptions
            : $proposition->options;

        return view('views.admin.propositions.edit', [
            'proposition' => $proposition,
            'mappedOldOptions' => $mappedOldOptions,
        ]);
    }

    /**
     * @throws Exception
     */
    public function destroy(Proposition $proposition): RedirectResponse
    {
        $proposition->delete();

        return redirect()->back();
    }
}
