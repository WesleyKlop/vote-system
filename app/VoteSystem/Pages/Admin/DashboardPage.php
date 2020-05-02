<?php

namespace App\VoteSystem\Pages\Admin;

use App\VoteSystem\Models\Proposition;
use App\VoteSystem\Models\PropositionOption;
use App\VoteSystem\Pages\AbstractPage;
use Illuminate\Support\Collection;

class DashboardPage extends AbstractPage
{
    protected $view = 'views.admin.index';
    /**
     * @var Collection<Proposition>
     */
    private $propositions;
    /**
     * @var int
     */
    private int $voterCount;

    public function __construct(Collection $propositions, int $voterCount)
    {
        $this->propositions = $propositions;
        $this->voterCount = $voterCount;
    }

    /**
     * @return int
     */
    public function getVoterCount(): int
    {
        return $this->voterCount;
    }

    /**
     * @return Collection
     */
    public function getPropositions(): Collection
    {
        return $this->propositions;
    }

    public function getListQuestion(Proposition $proposition): PropositionOption
    {
        return $proposition->horizontalOptions()->first();
    }

    public function getListOptions(Proposition $proposition): Collection
    {
        return $proposition->verticalOptions();
    }

    public function getOptionCount(
        Proposition $proposition,
        PropositionOption $vertical,
        PropositionOption $horizontal = null
    ): int {
        $answers = $proposition->answers->where(
            'vertical_option_id',
            $vertical->id
        );

        if (! is_null($horizontal)) {
            $answers = $answers->where('horizontal_option_id', $horizontal->id);
        }

        return $answers->count();
    }
}
