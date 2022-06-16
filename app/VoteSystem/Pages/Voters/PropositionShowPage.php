<?php

namespace App\VoteSystem\Pages\Voters;

use App\Models\Proposition;
use App\Models\PropositionOption;
use App\VoteSystem\Pages\AbstractPage;
use Illuminate\Support\Collection;

class PropositionShowPage extends AbstractPage
{
    protected string $view = 'views.voter.show';

    public function __construct(private readonly Proposition $proposition)
    {
    }

    public function getProposition(): Proposition
    {
        return $this->proposition;
    }

    public function isType(string $type): bool
    {
        return $this->proposition->type === $type;
    }

    public function getListQuestion(): ?PropositionOption
    {
        return $this->proposition->horizontalOptions()->first();
    }

    public function getListOptions(): Collection
    {
        return $this->proposition->verticalOptions();
    }
}
