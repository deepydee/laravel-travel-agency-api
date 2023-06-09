<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'sortDirection' => 'nullable|in:asc,desc',
            'priceFrom' => 'nullable|integer|gt:0',
            'priceTo' => 'nullable|integer|gt:0',
            'dateFrom' => 'nullable|date',
            'dateTo' => 'nullable|date',
        ];
    }

    public function messages(): array
    {
        return [
            'sortDirection.in' => 'A sortDirection should be asc or desc',
        ];
    }
}
