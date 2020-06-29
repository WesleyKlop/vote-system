<?php

namespace App\Http\Requests\Admin;

use App\VoteSystem\Models\AppConfig;
use Illuminate\Foundation\Http\FormRequest;

class AppConfigUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $rules = [];
        $appConfig = AppConfig::dictionary();
        foreach ($appConfig as $name => $value) {
            $rules[$name] = ['present', 'nullable', 'string'];
        }
        return $rules;
    }
}
