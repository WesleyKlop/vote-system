<?php

namespace App\Http\Requests\Voter;

use Illuminate\Foundation\Http\FormRequest;

class PropositionVotesSubmitRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return string[][]
     */
    public function rules(): array
    {
        $rules = [
            'answers' => ['required', 'array'],
        ];

        $answerKeyCount = $this->getAnswerKeyCount();

        if (!is_null($answerKeyCount)) {
            $rules['answer'][] = 'size:' . $answerKeyCount;
        }

        return $rules;
    }

    private function getAnswerKeyCount(): ?int
    {
        if (!($proposition = $this->proposition)) {
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
