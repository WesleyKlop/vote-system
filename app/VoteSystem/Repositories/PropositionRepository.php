<?php

namespace App\VoteSystem\Repositories;

use App\Models\Proposition;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

final class PropositionRepository
{
    public function findOpenWhereUnanswered(
        string $voterId,
        array $includes = ['options']
    ): ?Proposition {
        return Proposition::query()
            ->with($includes)
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
        return Proposition::query()
            ->with($includes)
            ->orderBy('order')
            ->get();
    }

    public function create(
        string $title,
        int $order,
        string $type,
        bool $isOpen = false,
    ): Proposition {
        return Proposition::create([
            'title' => $title,
            'order' => $order,
            'is_open' => $isOpen,
            'type' => $type,
        ]);
    }

    public function update(Proposition $proposition, array $attributes): bool
    {
        return $proposition->update($attributes);
    }

    public function currentProposition(): ?Proposition
    {
        return Proposition::query()
            ->orderBy('order')
            ->where('is_open', true)
            ->first();
    }
}
