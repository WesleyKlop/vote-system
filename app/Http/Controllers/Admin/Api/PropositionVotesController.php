<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Models\Proposition;
use App\Models\VoterPropositionOption;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\DB;

class PropositionVotesController extends Controller
{
    public function __invoke(Proposition $proposition): array
    {
        $timestamp = CarbonImmutable::now('Europe/Amsterdam');
        return [
            'data' => $proposition
                ->answers()
                ->where('created_at', '<', $timestamp)
                ->groupBy(['proposition_id', 'horizontal_option_id', 'vertical_option_id'])
                ->select(['proposition_id', 'horizontal_option_id', 'vertical_option_id', DB::raw('count(*) as votes')])
                ->get(),
            'timestamp' => $timestamp,
        ];
    }
}
