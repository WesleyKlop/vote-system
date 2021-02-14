<?php

namespace App\VoteSystem\Pages\Admin;

use App\Models\Proposition;
use App\Models\PropositionOption;
use App\Models\Voter;
use App\VoteSystem\Helpers\PropositionHelper;
use App\VoteSystem\Pages\AbstractPage;
use Illuminate\Support\Collection;

class DashboardPage extends AbstractPage
{
    protected string $view = 'views.admin.index';
    /**
     * @var Collection<int, Proposition>
     */
    private Collection $propositions;
    /**
     * @var Voter
     */
    private Voter $voterCount;
    private string $welcomeMessage;

    public function __construct(
        Collection $propositions,
        Voter $voterCount,
        string $welcomeMessage
    ) {
        $this->propositions = $propositions;
        $this->voterCount = $voterCount;
        $this->welcomeMessage = $welcomeMessage;
    }

    /**
     * @return string
     */
    public function getWelcomeMessage(): string
    {
        return $this->welcomeMessage;
    }

    public function getUnusedVoterCount(): int
    {
        return $this->voterCount->unused;
    }

    public function getUsedVoterCount(): int
    {
        return $this->voterCount->used;
    }

    public function getTotalVoterCount(): int
    {
        return $this->voterCount->total;
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
