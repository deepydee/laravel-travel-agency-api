<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GetToursRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'sortBy' => Rule::in(['price']),
            'sortDirection' => Rule::in(['asc', 'desc']),
            'priceFrom' => 'nullable|numeric|gt:0',
            'priceTo' => 'nullable|numeric|gt:0',
            'dateFrom' => 'nullable|date',
            'dateTo' => 'nullable|date',
        ];
    }

    public function messages(): array
    {
        return [
            'sortBy' => "The 'sortBy' parameter accepts only 'price' value",
            'sortDirection.in' => "A 'sortDirection' parameter accepts only 'asc' and 'desc' values",
        ];
    }
}
