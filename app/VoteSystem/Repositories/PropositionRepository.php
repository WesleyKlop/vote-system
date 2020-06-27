<?php

namespace App\VoteSystem\Repositories;

use App\VoteSystem\Models\Proposition;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class PropositionRepository
{
    public function findOpenWhereUnanswered(
        string $voterId,
        array $includes = ['options']
    ): ?Proposition {
        return Proposition::with($includes)
            ->whereDoesntHave('voters', function (Builder $query) use (
                $voterId
            ) {
                $query->where('voters.id', $voterId);
            })
            ->open()
            ->orderBy('order')
            ->first();
    }

    public function findAll(array $includes = []): Collection
    {
        return Proposition::with($includes)
            ->orderBy('order')
            ->get();
    }

    public function create(
        string $title,
        int $order,
        bool $is_open,
        string $type
    ): Proposition {
        return Proposition::create([
            'title' => $title,
            'order' => $order,
            'is_open' => $is_open,
            'type' => $type,
        ]);
    }

    public function update(Proposition $proposition, array $attributes): bool
    {
        return $proposition->update($attributes);
    }
}
