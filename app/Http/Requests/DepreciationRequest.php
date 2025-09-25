<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepreciationRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'cost'             => ['required', 'numeric', 'min:0.01'],
            'salvage_value'    => ['nullable', 'numeric', 'min:0'],
            'life_years'       => ['required', 'integer', 'min:1', 'max:60'],
            'method'           => ['required', 'in:straight_line,double_declining,sum_of_years_digits'],
            // DDB options
            'ddb_switch_to_sl' => ['nullable', 'boolean'],   // switch to straight-line when it becomes higher
            // Output precision
            'round'            => ['nullable', 'integer', 'min:0', 'max:4'],
        ];
    }

    public function prepareForValidation(): void
    {
        $x = fn($v) => ($v === '' ? null : $v);
        $this->merge([
            'salvage_value'    => $x($this->salvage_value) ?? 0,
            'ddb_switch_to_sl' => filter_var($this->ddb_switch_to_sl, FILTER_VALIDATE_BOOLEAN),
            'round'            => $x($this->round) ?? 2,
        ]);
    }
}
