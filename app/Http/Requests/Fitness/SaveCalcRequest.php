<?php

namespace App\Http\Requests\Fitness;

use Illuminate\Foundation\Http\FormRequest;

class SaveCalcRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'calc_type' => ['required', 'in:bmi,bmr,tdee,body-fat,ideal,macros'],
            'inputs'    => ['required', 'array'],
            'outputs'   => ['required', 'array'],
        ];
    }
}
