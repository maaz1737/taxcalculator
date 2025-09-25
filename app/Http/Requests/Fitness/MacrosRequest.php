<?php

namespace App\Http\Requests\Fitness;

use Illuminate\Contracts\Validation\Validator;

use Illuminate\Foundation\Http\FormRequest;

class MacrosRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'calories'    => ['required', 'integer', 'min:800', 'max:10000'],
            'carb_pct'    => ['required', 'numeric', 'min:0', 'max:100'],
            'protein_pct' => ['required', 'numeric', 'min:0', 'max:100'],
            'fat_pct'     => ['required', 'numeric', 'min:0', 'max:100'],
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $v) {
            // If base rules failed, don't run the sum check
            if ($v->errors()->isNotEmpty()) {
                return;
            }

            // Read inputs safely and cast to float
            $c = (float) $this->input('carb_pct', 0);
            $p = (float) $this->input('protein_pct', 0);
            $f = (float) $this->input('fat_pct', 0);

            $sum = $c + $p + $f;

            // Allow tiny floating point drift, e.g., 99.999 ~ 100.001
            $epsilon = 0.5; // adjust if you want stricter/looser tolerance

            if (abs($sum - 100.0) > $epsilon) {
                // Attach error to a single field to avoid 3 duplicate messages
                $v->errors()->add('fat_pct', 'Carbs + Protein + Fat must sum to 100%.');
            }
        });
    }
}
