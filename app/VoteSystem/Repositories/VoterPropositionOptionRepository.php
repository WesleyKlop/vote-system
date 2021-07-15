<?php

namespace App\VoteSystem\Repositories;

use App\Events\VoterVoted;
use App\Models\Proposition;
use App\Models\VoterPropositionOption;
use Exception;
use Illuminate\Database\MySqlConnection;
use Illuminate\Database\PostgresConnection;
use Illuminate\Database\Query\Expression;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class VoterPropositionOptionRepository
{
    private function getTimestampExpression(string $column): Expression
    {
        if (DB::connection() instanceof PostgresConnection) {
            return DB::raw("EXTRACT(EPOCH FROM \"$column\")");
        } elseif (DB::connection() instanceof MySqlConnection) {
            return DB::raw("UNIX_TIMESTAMP(\"$column\")");
        }

        throw new Exception("Invalid database driver");
    }

    public function create(Collection $voterPropositionOptions): bool
    {
        DB::beginTransaction();
        $success = $voterPropositionOptions
            ->map(fn (VoterPropositionOption $option) => $option->save())
            ->every(fn (bool $result) => $result === true);

        if ($success === true) {
            event(new VoterVoted($voterPropositionOptions->values()));
        }

        DB::commit();
        return $success;
    }

    public function findVotesBefore(Proposition $proposition, float $before): Collection
    {
        return $proposition
            ->answers()
            ->where($this->getTimestampExpression('created_at'), '<', $before)
            ->groupBy(['proposition_id', 'horizontal_option_id', 'vertical_option_id'])
            ->select(['proposition_id', 'horizontal_option_id', 'vertical_option_id', DB::raw('count(*) as votes')])
            ->get();
    }
}
