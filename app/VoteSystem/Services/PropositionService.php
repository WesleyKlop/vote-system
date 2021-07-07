<?php

namespace App\VoteSystem\Services;

use App\Events\PropositionChange;
use App\Models\Proposition;
use App\Models\PropositionOption;
use App\Models\Voter;
use App\VoteSystem\Factories\VoterPropositionOptionFactory;
use App\VoteSystem\Repositories\PropositionRepository;
use App\VoteSystem\Repositories\VoterPropositionOptionRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class PropositionService
{
    public function __construct(
        private PropositionRepository $propositionRepository,
        private VoterPropositionOptionRepository $voterPropositionOptionRepository
    ) {
    }

    public function getNextProposition(Voter $voter): ?Proposition
    {
        return $this->propositionRepository->findOpenWhereUnanswered(
            $voter->id
        );
    }

    public function answerProposition(Voter $voter, Proposition $proposition, Collection $answers): void
    {
        $voterPropositionOptions = VoterPropositionOptionFactory::make(
            $voter,
            $proposition,
            $answers
        );

        $this->voterPropositionOptionRepository->create(
            $voterPropositionOptions
        );
    }

    public function createProposition(array $validated): void
    {
        $options = $this->mapOptions($validated['options']);

        $proposition = $this->propositionRepository->create(
            $validated['title'],
            $validated['order'],
            $this->getPropositionType($options)
        );

        $this->syncPropositionOptions($proposition, $options);
    }

    public function mapOptions(array $options): Collection
    {
        // Create vertical and horizontal options based on given data
        $mapped = collect();
        foreach ($options as $axis => $items) {
            foreach ($items as $id => $option) {
                if (is_null($option)) {
                    continue;
                }
                $model = [
                    'id' => $this->getValidId($id),
                    'axis' => $axis,
                    'option' => $option,
                ];
                $mapped->push($model);
            }
        }

        return $mapped;
    }

    private function getPropositionType(Collection $options): string
    {
        $horizontalOptions = $options->where('axis', 'horizontal')->count();

        return $horizontalOptions > 1 ? 'grid' : 'list';
    }

    private function syncPropositionOptions(Proposition $proposition, Collection $newOptions): void
    {
        $existingOptions = $proposition->options->keyBy('id');
        $newOptions = $newOptions->keyBy('id');

        $deletedOptions = $existingOptions
            ->whereNotIn('id', $newOptions->keys())
            ->pluck('id');
        $createdOptions = $newOptions->whereNotIn(
            'id',
            $existingOptions->keys()
        );
        $updatedOptions = $existingOptions->whereIn('id', $newOptions->keys());

        $proposition
            ->options()
            ->whereIn('id', $deletedOptions)
            ->delete();
        $proposition->options()->createMany($createdOptions->toArray());
        $updatedOptions->each(
            fn (PropositionOption $option) => $option->update(
                $newOptions->get($option->id)
            )
        );
    }

    public function toggleProposition(Proposition $proposition, bool $newState): bool
    {
        $isChanged = $this->propositionRepository->update($proposition, [
            'is_open' => $newState,
        ]);

        if ($isChanged === true) {
            PropositionChange::dispatch($proposition);
        }

        return $isChanged;
    }

    public function updateProposition(Proposition $proposition, array $validated): void
    {
        $options = $this->mapOptions($validated['options']);

        $this->propositionRepository->update($proposition, [
            'title' => $validated['title'],
            'order' => $validated['order'],
            'type' => $this->getPropositionType($options),
        ]);

        $this->syncPropositionOptions($proposition, $options);
    }

    public function propositionHasVoter(Proposition $proposition, Voter $voter): bool
    {
        return $proposition
            ->voters()
            ->where('voters.id', $voter->id)
            ->exists();
    }

    public function getNextPropositionOrder(): int
    {
        return (Proposition::max('order') ?: 0) + 1;
    }

    private function getValidId(int | string $id): string
    {
        if (is_string($id) && Str::isUuid($id)) {
            return $id;
        }

        return Str::uuid()->toString();
    }
}
