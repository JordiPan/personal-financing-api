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
            'description'=>'min:3|max:500',
            'price'=> 'required|numeric|min:0.01|decimal:0,2',
            'purchase_date'=> 'required|date',
            'country_id'=> 'exists:countries,id',
            'user_id'=> 'required|exists:users,id',
            'category_id'=> 'required|exists:categories,id',
        ];
    }
}
