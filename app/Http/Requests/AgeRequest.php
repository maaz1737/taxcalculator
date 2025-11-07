<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AgeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'dob_day' => 'required|integer|min:1|max:31',
            'dob_month' => 'required|integer|min:1|max:12',
            'dob_year' => 'required|integer|min:1900|max:' . now()->year,
            'till_day' => 'nullable|integer|min:1|max:31',
            'till_month' => 'nullable|integer|min:1|max:12',
            'till_year' => 'nullable|integer|min:1900|max:' . now()->year,
        ];
    }

    public function messages(): array
    {
        return [
            // DOB fields
            'dob_day.required' => 'Please enter your birth day.',
            'dob_day.integer' => 'The birth day must be a number.',
            'dob_day.min' => 'The birth day must be at least 1.',
            'dob_day.max' => 'The birth day cannot be more than 31.',

            'dob_month.required' => 'Please select your birth month.',
            'dob_month.integer' => 'The birth month must be a number.',
            'dob_month.min' => 'The birth month must be at least 1.',
            'dob_month.max' => 'The birth month cannot be more than 12.',

            'dob_year.required' => 'Please enter your birth year.',
            'dob_year.integer' => 'The birth year must be a number.',
            'dob_year.min' => 'The birth year must be at least 1900.',
            'dob_year.max' => 'The birth year cannot be in the future.',

            // Till date fields (optional)
            'till_day.integer' => 'The till day must be a number.',
            'till_day.min' => 'The till day must be at least 1.',
            'till_day.max' => 'The till day cannot be more than 31.',

            'till_month.integer' => 'The till month must be a number.',
            'till_month.min' => 'The till month must be at least 1.',
            'till_month.max' => 'The till month cannot be more than 12.',

            'till_year.integer' => 'The till year must be a number.',
            'till_year.min' => 'The till year must be at least 1900.',
            'till_year.max' => 'The till year cannot be in the future.',
        ];
    }
}
