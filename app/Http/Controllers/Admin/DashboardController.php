<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\VoteSystem\Models\Proposition;
use App\VoteSystem\Pages\Admin\DashboardPage;

class DashboardController extends Controller
{
    public function index()
    {
        $propositions = Proposition
            ::with(['options', 'answers'])
            ->orderBy('order')
            ->get();

        return $this->page(new DashboardPage($propositions));
    }
}
