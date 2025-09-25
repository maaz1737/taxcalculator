<?php

namespace App\Http\Requests\Fitness;

use Illuminate\Foundation\Http\FormRequest;

class BmrRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'sex'       => ['required', 'in:male,female'],
            'age'       => ['required', 'integer', 'min:13', 'max:120'],
            'weight_kg' => ['required', 'numeric', 'min:20', 'max:400'],
            'height_cm' => ['required', 'numeric', 'min:100', 'max:250'],
        ];
    }
}
