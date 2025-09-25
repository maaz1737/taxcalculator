<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MortgageRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'price'                  => ['required', 'numeric', 'min:0.01'],
            'down_amount'            => ['nullable', 'numeric', 'min:0'],
            'down_percent'           => ['nullable', 'numeric', 'min:0', 'max:100'],
            'years'                  => ['required', 'integer', 'min:1', 'max:50'],
            'apr_percent'            => ['required', 'numeric', 'min:0', 'max:100'],
            'annual_property_tax'    => ['nullable', 'numeric', 'min:0'],   // dollars/year
            'annual_home_insurance'  => ['nullable', 'numeric', 'min:0'],   // dollars/year
            'pmi_percent'            => ['nullable', 'numeric', 'min:0', 'max:5'], // % of original loan per year
            'hoa_monthly'            => ['nullable', 'numeric', 'min:0'],
            'start_date'             => ['nullable', 'date'],               // first due assumed +1 month
        ];
    }

    public function prepareForValidation(): void
    {
        // normalize empty strings → null
        $this->merge([
            'down_amount'           => $this->down_amount === '' ? null : $this->down_amount,
            'down_percent'          => $this->down_percent === '' ? null : $this->down_percent,
            'annual_property_tax'   => $this->annual_property_tax === '' ? null : $this->annual_property_tax,
            'annual_home_insurance' => $this->annual_home_insurance === '' ? null : $this->annual_home_insurance,
            'pmi_percent'           => $this->pmi_percent === '' ? null : $this->pmi_percent,
            'hoa_monthly'           => $this->hoa_monthly === '' ? null : $this->hoa_monthly,
            'start_date'            => $this->start_date === '' ? null : $this->start_date,
        ]);
    }
}
