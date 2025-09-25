<?php

namespace App\Http\Requests\Fitness;

use Illuminate\Foundation\Http\FormRequest;

class BodyFatRequest extends FormRequest
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
            'waist_cm'  => ['required', 'numeric', 'min:30', 'max:200'],
            'neck_cm'   => ['required', 'numeric', 'min:20', 'max:70'],
            'hip_cm'    => ['nullable', 'numeric', 'min:40', 'max:200', 'required_if:sex,female'],
        ];
    }
}
