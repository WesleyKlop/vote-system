<?php

namespace App\Http\Requests\Voter;

use App\Models\Proposition;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class PropositionSubmitRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return string[][]
     */
    public function rules(): array
    {
        $rules = [
            'proposition' => ['required', 'uuid', 'exists:propositions,id'],
            'answer' => ['required', 'array'],
        ];

        $answerKeyCount = $this->getAnswerKeyCount();

        if (!is_null($answerKeyCount)) {
            $rules['answer'][] = 'size:' . $answerKeyCount;
        }

        return $rules;
    }

    private function findProposition(): ?Proposition
    {
        $propositionId = $this->request->get('proposition');
        if (!$propositionId || !Str::isUuid($propositionId)) {
            return null;
        }

        return Proposition::find($propositionId);
    }

    private function getAnswerKeyCount(): ?int
    {
        if (!($proposition = $this->findProposition())) {
            return null;
        }

        return $proposition
            ->options()
            ->where(
                'axis',
                $proposition->type === 'grid' ? 'vertical' : 'horizontal'
            )
            ->count();
    }
}
