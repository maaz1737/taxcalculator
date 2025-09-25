<?php

namespace App\Http\Requests\Finance;

use Illuminate\Foundation\Http\FormRequest;

class RentAffordabilityRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Gate/Policy if needed
    }

    public function rules(): array
    {
        return [
            'monthly_income'         => ['required', 'numeric', 'min:0'],
            'income_is_gross'        => ['sometimes', 'boolean'],
            'monthly_debts'          => ['sometimes', 'numeric', 'min:0'],
            'rule'                   => ['required', 'in:30_percent,dti_36,custom_percent'],
            'custom_percent'         => ['nullable', 'numeric', 'min:0', 'max:100', 'required_if:rule,custom_percent'],
            'utilities_monthly'      => ['nullable', 'numeric', 'min:0'],
            'insurance_monthly'      => ['nullable', 'numeric', 'min:0'],
            'target_savings_percent' => ['nullable', 'numeric', 'min:0', 'max:100'],
            'show_ranges'            => ['sometimes', 'boolean'],
        ];
    }
}
