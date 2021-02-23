<?php


namespace App\VoteSystem\Domain;

final class VoterStatistics
{
    public function __construct(public int $total, public int $used, public int $unused, )
    {
    }

    public static function fromArray(array $stats): VoterStatistics
    {
        return new self(
            $stats['total'],
            $stats['used'],
            $stats['unused'],
        );
    }
}
