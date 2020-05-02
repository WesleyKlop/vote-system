<?php

namespace App\VoteSystem\Pages;

abstract class AbstractPage
{
    protected $view;

    public function view(): string
    {
        return $this->view;
    }

    public function attributes(): array
    {
        return [
            'page' => $this,
        ];
    }
}
