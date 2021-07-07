<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PropositionUpdateRequest extends FormRequest
{
    use ValidatesPropositions;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required', 'string'],
            'order' => ['required', 'integer', 'nullable'],
            'options' => ['required', 'array', 'size:2'],
            'options.horizontal' => ['required', 'array', 'min:1'],
            'options.vertical' => ['required', 'array', 'min:1'],
            'options.*.*' => ['present', 'string'],
        ];
    }

    public function prepareForValidation()
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
        ]);
    }
}
