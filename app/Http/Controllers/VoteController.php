<?php

namespace App\Http\Controllers;

use App\Proposition;
use Illuminate\Database\Eloquent\Builder;

class VoteController extends Controller
{
    public function index()
    {
        $proposition = Proposition
            ::whereDoesntHave('voters', function (Builder $query) {
                $query->where('token', session()->get('token'));
            })
            ->orderBy('index')
            ->first();
        return redirect()->route('vote.show', $proposition);
    }

    public function show(Proposition $proposition)
    {
        return view('views.vote.show', ['proposition' => $proposition]);
    }
}
