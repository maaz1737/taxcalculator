<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RentRequest extends FormRequest
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
            'inputs_echo.monthly_income' => ['required', 'numeric', 'min:2'],
        ];
    }

    public function messages(): array
    {
        return [
            'inputs_echo.monthly_income.required' => 'Monthly income is required.',
            'inputs_echo.monthly_income.numeric'  => 'Monthly income must be a number.',
            'inputs_echo.monthly_income.min'      => 'Monthly income must be at least 2.',
        ];
    }

    public function attributes(): array
    {
        return [
            'inputs_echo.monthly_income' => 'monthly income',
        ];
    }
}
