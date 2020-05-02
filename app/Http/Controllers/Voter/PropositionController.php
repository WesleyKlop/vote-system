<?php

namespace App\Http\Controllers\Voter;

use App\Http\Controllers\Controller;
use App\Http\Requests\Voter\PropositionSubmitRequest;
use App\VoteSystem\Models\Proposition;
use App\VoteSystem\Models\Voter;
use App\VoteSystem\Models\VoterPropositionOption;
use App\VoteSystem\Pages\Voters\PropositionShowPage;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PropositionController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $proposition = Proposition::whereDoesntHave('voters', function (
            Builder $query
        ) use ($user) {
            $query->where('voters.id', $user->id);
        })
            ->open()
            ->orderBy('index')
            ->with('options')
            ->first();

        if (is_null($proposition)) {
            return view('views.voter.empty_state');
        }

        return $this->page(new PropositionShowPage($proposition));
    }

    /**
     * @param  PropositionSubmitRequest  $request
     * @return RedirectResponse
     * @throws Exception
     */
    public function update(PropositionSubmitRequest $request)
    {
        /** @var Voter $user */
        $user = $request->user();
        $proposition = Proposition::findOrFail($request->get('proposition'));

        // Validate that the proposition is still open
        if (! $proposition->is_open) {
            throw new Exception('Proposition is already closed');
        }

        $submittedAnswers = collect($request->get('answer'));

        // Grid option key => value is flipped so we can give an option per row
        if ($proposition->type === 'grid') {
            $submittedAnswers = $submittedAnswers->flip();
        }
        $voterPropositionOptions = $submittedAnswers->map(
            fn(string $vertical, string $horizontal) => [
                'id' => Str::uuid(),
                'voter_id' => $user->id,
                'proposition_id' => $proposition->id,
                'horizontal_option_id' => $horizontal,
                'vertical_option_id' => $vertical,
            ]
        );

        VoterPropositionOption::insert($voterPropositionOptions->toArray());

        return redirect()->route('proposition.index');
    }
}
