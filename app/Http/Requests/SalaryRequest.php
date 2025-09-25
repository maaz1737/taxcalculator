<?php

namespace App\Http\Requests\Finance;

use Illuminate\Foundation\Http\FormRequest;

class SalaryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'mode'                 => ['required', 'in:gross_to_net,net_to_gross'],
            'pay_frequency'        => ['required', 'in:hourly,weekly,biweekly,semimonthly,monthly,annual'],
            'amount'               => ['required', 'numeric', 'min:0'],
            'hours_per_week'       => ['nullable', 'numeric', 'min:0'],
            'weeks_per_year'       => ['nullable', 'numeric', 'min:1', 'max:54'],
            'country_code'         => ['required', 'string', 'size:2'],
            'region_code'          => ['nullable', 'string', 'max:4'],
            'tax_year'             => ['nullable', 'integer', 'min:2000', 'max:2100'],
            'pretax_deductions'    => ['nullable', 'numeric', 'min:0'],
            'posttax_deductions'   => ['nullable', 'numeric', 'min:0'],
            'employee_insurance'   => ['nullable', 'numeric', 'min:0'],
            'employer_costs'       => ['nullable', 'numeric', 'min:0'],
            'bonuses'              => ['nullable', 'numeric', 'min:0'],
            'other_allowances'     => ['nullable', 'numeric', 'min:0'],
            'include_breakdown'    => ['nullable', 'boolean'],
        ];
    }
}
