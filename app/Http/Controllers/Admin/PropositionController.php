<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PropositionStoreRequest;
use App\VoteSystem\Models\Proposition;
use App\VoteSystem\Models\PropositionOption;
use Illuminate\Http\Request;

class PropositionController extends Controller
{
    public function index()
    {
        return redirect()->route('admin.index');
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
                $options->push(
                    PropositionOption::make([
                        'axis' => $axis,
                        'option' => $option,
                    ])
                );
            }
        }

        $optionCount = $options->countBy(function (PropositionOption $option) {
            return $option->axis;
        });
        $hasMultipleColumns = $optionCount->get('horizontal') > 1;

        $proposition = Proposition::make($request->only(['title', 'order']));
        $proposition->is_open = $request->has('is_open');
        $proposition->type = $hasMultipleColumns ? 'grid' : 'list';

        $proposition->save();
        $proposition->options()->createMany($options->toArray());

        return redirect()->route('admin.propositions.index');
    }

    public function toggle(Request $request, Proposition $proposition)
    {
        $proposition->is_open = $request->get('is_open') === '1';
        $proposition->save();
        return redirect()->route('admin.index');
    }
}
