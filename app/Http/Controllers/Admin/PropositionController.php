<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PropositionStoreRequest;
use App\VoteSystem\Models\Proposition;
use App\VoteSystem\Models\PropositionOption;

class PropositionController extends Controller
{
    public function index()
    {
        $propositions = Proposition::with('options')
            ->orderBy('order')
            ->get();

        return view('views.admin.propositions.index', [
            'propositions' => $propositions,
        ]);
    }

    public function create()
    {
        return view('views.admin.propositions.create');
    }

    public function store(PropositionStoreRequest $request)
    {
        // Create vertical and horizontal options based on given data
        $options = collect();
        foreach ($request->get('options') as $axis => $items) {
            foreach ($items as $option) {
                if (is_null($option)) {
                    continue;
                }
                $options->push(PropositionOption::make([
                    'axis' => $axis,
                    'option' => $option,
                ]));
            }
        }

        $optionCount = $options
            ->countBy(function (PropositionOption $option) {
                return $option->axis;
            });
        $hasMultipleColumns = $optionCount->get('horizontal') > 1;

        $proposition = Proposition::make($request->only([
            'title',
            'order',
        ]));
        $proposition->is_open = $request->has('is_open');
        $proposition->type = $hasMultipleColumns ? 'grid' : 'list';

        $proposition->save();
        $proposition
            ->options()
            ->createMany($options->toArray());

        return redirect()->route('admin.propositions.index');
    }
}
