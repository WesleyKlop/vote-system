<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string[][] options
 */
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
            'options' => ['required', 'array', 'size:2'],
            'options.horizontal' => ['required', 'array', 'min:1'],
            'options.vertical' => ['required', 'array', 'min:1'],
            'options.*.*' => ['present', 'string'],
        ];
    }

    private function rejectNullEntries(array $array): array {
        return collect($array)
            ->reject(fn($entry) => is_null($entry))
            ->all();
    }

    public function prepareForValidation()
    {
        $this->merge([
            'options' => [
                'horizontal' => $this->rejectNullEntries($this->options['horizontal']),
                'vertical' =>$this->rejectNullEntries($this->options['vertical']),
            ],
        ]);
    }
}
