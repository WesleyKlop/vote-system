<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Proposition;

class PropositionController extends Controller
{
    public function index()
    {
        $propositions = Proposition
            ::with('options')
            ->orderBy('order')
            ->get();

        return view('views.admin.propositions.index', [
            'propositions' => $propositions,
        ]);
    }
}
