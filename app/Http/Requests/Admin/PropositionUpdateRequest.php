<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PropositionUpdateRequest extends FormRequest
{
    use ValidatesPropositions;

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string'],
            'order' => ['required', 'integer', 'nullable'],
            'options' => ['required', 'array', 'size:2'],
            'options.horizontal' => ['required', 'array', 'min:1'],
            'options.vertical' => ['required', 'array', 'min:1'],
            'options.*.*' => ['present', 'string'],
            'has_abstain' => ['required', 'boolean'],
            'has_blank' => ['required', 'boolean'],
        ];
    }

    public function prepareForValidation(): void
    {
        $this->merge([
            'options' => [
                'horizontal' => $this->rejectNullEntries(
                    $this->options['horizontal']
                ),
                'vertical' => $this->rejectNullEntries(
                    $this->options['vertical']
                ),
            ],
            'has_abstain' => $this->filled('has_abstain'),
            'has_blank' => $this->filled('has_blank'),
        ]);
    }
}
