<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IncomeTaxRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'income' => ['nullable', 'numeric', 'required_without:'],
            'yearly_revenue' => ['nullable', 'numeric', 'required_without:income'],
            'payerType' => ['required', 'string'],
            'levy' => ['nullable', 'numeric'],
            'taxpaid' => ['nullable', 'numeric'],
            'yearly_cost' => ['nullable', 'numeric'],
        ];
    }
}
