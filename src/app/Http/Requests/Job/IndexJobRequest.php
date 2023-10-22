<?php

namespace App\Http\Requests\Job;

use Illuminate\Foundation\Http\FormRequest;

class IndexJobRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'filters.name' => ['nullable', 'string'],
            'filters.salary' => ['nullable', 'numeric'],
            'filters.type' => ['nullable', 'in:clt,legal_person,freelancer'],
            'filters.active' => ['nullable', 'boolean'],
        ];
    }
}
