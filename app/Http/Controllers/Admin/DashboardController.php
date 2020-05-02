<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\VoteSystem\Models\Proposition;
use App\VoteSystem\Models\Voter;
use App\VoteSystem\Pages\Admin\DashboardPage;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $propositions = Proposition::with(['options', 'answers'])
            ->orderBy('order')
            ->get();
        $voterCount = Voter::count();

        return $this->page(new DashboardPage($propositions, $voterCount));
    }
}
