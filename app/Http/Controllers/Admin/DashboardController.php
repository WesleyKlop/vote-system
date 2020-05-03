<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\VoteSystem\Models\Proposition;
use App\VoteSystem\Models\Voter;
use App\VoteSystem\Pages\Admin\DashboardPage;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(): View
    {
        $propositions = Proposition::with(['options', 'answers'])
            ->orderBy('order')
            ->get();
        $voterCount = Voter::first([
            DB::raw('count(*) as total'),
            DB::raw('count(used_at) AS used'),
            DB::raw('count(*) - count(used_at) as unused'),
        ]);

        return $this->page(new DashboardPage($propositions, $voterCount));
    }
}
