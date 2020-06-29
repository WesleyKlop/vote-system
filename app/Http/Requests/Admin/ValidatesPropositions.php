<?php


namespace App\Http\Requests\Admin;


trait ValidatesPropositions
{
    protected function rejectNullEntries(array $array): array
    {
        return collect($array)
            ->reject(fn($entry) => is_null($entry))
            ->all();
    }


}
