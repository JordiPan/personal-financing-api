<?php

namespace App\Http\Requests;

use App\Enums\Recurrence;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StoretransactionRequest extends FormRequest
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
            'description'=>'string|max:500',
            'date'=> 'required|date',
            'active' => 'required|boolean',
            'direction' => 'required|string',
            'total' => 'required|numeric|min:0.01|decimal:0,2',
            'existingItems' => 'sometimes|array',
            'existingItems.*.id' => 'required|integer|exists:items,id',
            'existingItems.*.quantity' => 'required|integer|min:1',
            'existingItems.*.price' => 'required|numeric|min:0.01|decimal:0,2',
            'newItems' => 'sometimes|array',
            'newItems.*.name' => 'required|string|max:255',
            'newItems.*.description' => 'string|max:500',
            'newItems.*.category_id' => 'required|integer|exists:categories,id',
            'newItems.*.price' => 'required|numeric|min:0.01|decimal:0,2',
            'newItems.*.sellable' => 'required|boolean',
            'newItems.*.country_id' => 'required|integer|exists:countries,id',
            'newItems.*.quantity' => 'required|integer|min:1',
            'recurrence' => ['required', new Enum(Recurrence::class)]
        ];
    }
}
