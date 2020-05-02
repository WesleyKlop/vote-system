<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PropositionStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required', 'string'],
            'is_open' => ['sometimes', 'accepted'],
            'order' => ['required', 'integer', 'nullable'],
            'options' => ['required', 'array'],
            'options.*' => ['required', 'array'],
            'options.*.*' => ['present', 'nullable', 'string'],
        ];
    }
}
