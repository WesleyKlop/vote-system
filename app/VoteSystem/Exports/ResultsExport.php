<?php

namespace App\VoteSystem\Exports;

use App\VoteSystem\Models\Proposition;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ResultsExport implements WithMultipleSheets, Responsable
{
    use Exportable;

    private string $fileName = 'results.xlsx';
    private ?string $propositionId = null;

    public function sheets(): array
    {
        if ($this->propositionId !== null) {
            return [new PropositionResultExport($this->propositionId)];
        }
        return Proposition::orderBy('order')
            ->get('id')
            ->pluck('id')
            ->map(fn(string $id) => new PropositionResultExport($id))
            ->all();
    }

    public function setPropositionId(string $propositionId): void
    {
        $this->propositionId = $propositionId;
    }
}
