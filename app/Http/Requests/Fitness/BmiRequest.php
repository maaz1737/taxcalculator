<?php

namespace App\Http\Requests\Fitness;

use Illuminate\Foundation\Http\FormRequest;

class BmiRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'unit'   => ['required', 'in:metric,imperial'],
            'height' => ['required', 'numeric', 'min:40', 'max:260'], // cm or inches
            'weight' => ['required', 'numeric', 'min:20', 'max:400'], // kg or lbs
        ];
    }
}
