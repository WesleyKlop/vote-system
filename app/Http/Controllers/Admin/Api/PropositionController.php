<?php


namespace App\Http\Controllers\Admin\Api;

use App\Events\PropositionChange;
use App\Http\Requests\Admin\Api\PropositionUpdateRequest;
use App\Models\Proposition;
use Illuminate\Http\JsonResponse;

class PropositionController
{
    public function update(PropositionUpdateRequest $request, Proposition $proposition): JsonResponse
    {
        $proposition->update($request->validated());
        event(new PropositionChange($proposition));
        return response()->json($proposition);
    }
}
