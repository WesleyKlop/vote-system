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
        $proposition->fill($attributes);

        if (isset($attributes['has_abstain'])) {
            $this->syncAbstainOption($proposition, $attributes['has_abstain']);
        }
        if (isset($attributes['has_blank'])) {
            $this->syncBlankOption($proposition, $attributes['has_blank']);
        }

        return $proposition->save();
    }

    public function currentOrFirst(): ?Proposition
    {
        return Proposition::query()
            ->orderByDesc('is_open')
            ->orderBy('order')
            ->first();
    }

    private function syncAbstainOption(Proposition $proposition, bool $hasAbstain): void
    {
        if (! $hasAbstain) {
            $proposition->abstainOption()->delete();
            return;
        }

        $option = $proposition->abstainOption()->updateOrCreate(
            ['option' => 'abstain', 'proposition_id' => $proposition->id],
            ['axis' => $proposition->type === 'list' ? 'vertical' : 'horizontal']
        );
        $proposition->abstain_option_id = $option->id;
    }

    private function syncBlankOption(Proposition $proposition, bool $hasBlank): void
    {
        if (! $hasBlank) {
            $proposition->blankOption()->delete();
            return;
        }

        $option = $proposition->blankOption()->updateOrCreate(
            ['option' => 'blank', 'proposition_id' => $proposition->id],
            ['axis' => $proposition->type === 'list' ? 'vertical' : 'horizontal']
        );
        $proposition->blank_option_id = $option->id;
    }
}
