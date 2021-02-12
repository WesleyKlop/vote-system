<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ResultExportRequest;
use App\VoteSystem\Exports\ResultsExport;

class ResultExportController extends Controller
{
    public function index(ResultsExport $export, ResultExportRequest $request)
    {
        if ($request->has('proposition_id')) {
            $export->setPropositionId($request->get('proposition_id'));
        }

        return $export;
    }
}
