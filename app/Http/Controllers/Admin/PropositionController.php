<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PropositionStoreRequest;
use App\Http\Requests\Admin\PropositionUpdateRequest;
use App\VoteSystem\Models\Proposition;
use App\VoteSystem\Services\PropositionService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PropositionController extends Controller
{
    private PropositionService $propositionService;

    public function __construct(PropositionService $propositionService)
    {
        parent::__construct();
        $this->propositionService = $propositionService;
    }

    public function index()
    {
        return redirect()->route('admin.index');
    }

    public function create()
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

    public function update(
        PropositionUpdateRequest $request,
        Proposition $proposition
    ) {
        $this->propositionService->updateProposition(
            $proposition,
            $request->validated()
        );

        return redirect()->route('admin.propositions.index');
    }

    public function store(PropositionStoreRequest $request)
    {
        $this->propositionService->createProposition($request->validated());

        return redirect()->route('admin.propositions.index');
    }

    public function toggle(Request $request, Proposition $proposition)
    {
        $this->propositionService->toggleProposition(
            $proposition,
            $request->get('is_open') === '1'
        );

        return redirect()->route('admin.index');
    }

    public function edit(Proposition $proposition)
    {
        $proposition->load('options');
        $mappedOldOptions = $this->propositionService->mapOptions(
            old('options', [])
        );

        $mappedOldOptions =
            $mappedOldOptions->count() > 0
                ? $mappedOldOptions
                : $proposition->options;

        return view('views.admin.propositions.edit', [
            'proposition' => $proposition,
            'mappedOldOptions' => $mappedOldOptions,
        ]);
    }

    /**
     * @param  Proposition  $proposition
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Proposition $proposition)
    {
        $proposition->delete();

        return redirect()->route('admin.proposition.index');
    }
}
