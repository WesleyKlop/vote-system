<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Proposition;
use Illuminate\Http\Request;

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

    public function store(Request $request)
    {
        dd($request->all());
    }
}
