<?php

namespace App\VoteSystem\Exports;

use App\Models\VoterPropositionOption;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\WithTitle;

class PropositionResultExport implements
    FromQuery,
    WithTitle,
    ShouldAutoSize,
    WithMapping,
    WithStrictNullComparison,
    WithHeadings
{
    public function __construct(private readonly string $propositionId)
    {
    }

    /**
     * @return Builder<VoterPropositionOption>
     */
    public function query(): Builder
    {
        return VoterPropositionOption::with(
            'voter',
            'proposition',
            'horizontalOption',
            'verticalOption'
        )
            ->select('voter_proposition_options.*')
            ->leftJoin('voters', 'voters.id', '=', 'voter_id')
            ->orderBy('voters.token')
            ->orderBy('horizontal_option_id')
            ->where('proposition_id', $this->propositionId);
    }

    public function title(): string
    {
        return Str::substr($this->propositionId, 0, 31);
    }

    /**
     * @param VoterPropositionOption $row
     */
    public function map($row): array
    {
        return [
            $row->proposition->title,
            $row->voter->token,
            $row->horizontalOption->option,
            $row->verticalOption->option,
        ];
    }

    public function headings(): array
    {
        return ['Proposition', 'Token', 'Horizontal', 'Vertical'];
    }
}
