<?php

namespace App\Http\Requests\Voter;

use Illuminate\Foundation\Http\FormRequest;

class PropositionSubmitRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'proposition' => ['required', 'exists:propositions,id'],
            'answer' => ['required', 'array'],
        ];
    }
}
