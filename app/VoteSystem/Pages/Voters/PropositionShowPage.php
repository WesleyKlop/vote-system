<?php

namespace App\VoteSystem\Pages\Voters;

use App\VoteSystem\Models\Proposition;
use App\VoteSystem\Models\PropositionOption;
use App\VoteSystem\Pages\AbstractPage;
use Illuminate\Support\Collection;

class PropositionShowPage extends AbstractPage
{
    protected string $view = 'views.voter.show';
    /**
     * @var Proposition
     */
    private Proposition $proposition;

    public function __construct(Proposition $proposition)
    {
        $this->proposition = $proposition;
    }

    public function getProposition(): Proposition
    {
        return $this->proposition;
    }

    public function isType(string $type): bool
    {
        return $this->proposition->type === $type;
    }

    public function getListQuestion(): PropositionOption
    {
        return $this->proposition->horizontalOptions()->first();
    }

    public function getListOptions(): Collection
    {
        return $this->proposition->verticalOptions();
    }
}
