<?php


namespace App\Http\Requests\Admin\Api;

use Illuminate\Foundation\Http\FormRequest;

class PropositionUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['sometimes', 'string'],
            'order' => ['sometimes', 'integer', 'nullable'],
            'is_open' => ['sometimes', 'boolean']
        ];
    }
}
