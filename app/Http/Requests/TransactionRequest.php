<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
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
            'direction' => 'nullable|in:add,subtract',
            'recurrence' => 'nullable|in:once,daily,monthly,weekly,yearly',
            'amount' => 'nullable|integer|min:0',
            'orderBy' => 'nullable|in:asc,desc',
            'orderMode' => 'nullable|in:day,month,year,full',
        ];
    }
    protected function prepareForValidation()
    {
        $this->merge([
            'recurrence' => strtolower($this->sanitizeString($this->recurrence)),
            'direction' => strtolower($this->sanitizeString($this->direction)),
            'amount' => $this->sanitizeString($this->amount),
            'orderBy' => strtolower($this->sanitizeString($this->orderBy)),
            'orderMode' =>  strtolower($this->sanitizeString($this->orderMode)),
        ]);
    }

    private function sanitizeString($value): ?string
    {
        return is_string($value) ? trim(strip_tags($value)) : $value;
    }
}
