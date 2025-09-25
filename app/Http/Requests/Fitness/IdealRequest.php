<?php

namespace App\Http\Requests\Fitness;

use Illuminate\Foundation\Http\FormRequest;

class IdealRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'sex'       => ['required', 'in:male,female'],
            'height_cm' => ['required', 'numeric', 'min:120', 'max:250'],
        ];
    }
}
