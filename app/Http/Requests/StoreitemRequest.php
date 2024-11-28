<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreitemRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'price'=> 'required|numeric',
            'amount'=> 'required|numeric',
            'purchase_date'=> 'required|date',
            'country_id'=> 'exists:country,id',
            'transaction_id'=> 'exists:transaction,id',
            'user_id'=> 'required|exists:user,id',
            'category_id'=> 'required|exists:category,id',
        ];
    }
}
