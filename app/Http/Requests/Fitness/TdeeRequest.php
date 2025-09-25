<?php

namespace App\Http\Requests\Fitness;

use Illuminate\Foundation\Http\FormRequest;

class TdeeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'bmr'      => ['required', 'numeric', 'min:500', 'max:6000'],
            'activity' => ['required', 'in:sedentary,light,moderate,active,very'],
        ];
    }
}
