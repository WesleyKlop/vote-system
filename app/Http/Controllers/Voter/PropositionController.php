<?php

namespace App\Http\Controllers\Voter;

use App\Http\Controllers\Controller;
use App\Proposition;
use Illuminate\Database\Eloquent\Builder;

class PropositionController extends Controller
{
    public function index()
    {
        $proposition = Proposition
            ::whereDoesntHave('voters', function (Builder $query) {
                $query->where('token', session()->get('token'));
            })
            ->orderBy('index')
            ->first();
        return redirect()->route('proposition.show', $proposition);
    }

    public function show(Proposition $proposition)
    {
        return view('views.voter.show', ['proposition' => $proposition]);
    }
}
