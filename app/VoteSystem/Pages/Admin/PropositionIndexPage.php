<?php

namespace App\VoteSystem\Pages\Admin;

use App\Models\Proposition;
use App\Models\PropositionOption;
use App\VoteSystem\Domain\VoterStatistics;
use App\VoteSystem\Helpers\PropositionHelper;
use App\VoteSystem\Pages\AbstractPage;
use Illuminate\Support\Collection;

class PropositionIndexPage extends AbstractPage
{
    protected string $view = 'views.admin.propositions.index';

    /**
     * @param Collection<int, Proposition> $propositions
     */
    public function __construct(
        private Collection $propositions,
        private VoterStatistics $voterStatistics,
    ) {
    }

    public function getUnusedVoterCount(): int
    {
        return $this->voterStatistics->unused;
    }

    public function getUsedVoterCount(): int
    {
        return $this->voterStatistics->used;
    }

    public function getTotalVoterCount(): int
    {
        return $this->voterStatistics->total;
    }

    public function getPropositions(): Collection
    {
        return $this->propositions;
    }

    public function getListQuestion(Proposition $proposition): PropositionOption
    {
        return PropositionHelper::getListQuestion($proposition);
    }

    public function getListOptions(Proposition $proposition): Collection
    {
        return PropositionHelper::getListOptions($proposition);
    }

    public function getOptionCount(
        Proposition $proposition,
        PropositionOption $vertical,
        PropositionOption $horizontal = null
    ): int {
        return PropositionHelper::getOptionCount(
            $proposition,
            $vertical,
            $horizontal
        );
    }
}
