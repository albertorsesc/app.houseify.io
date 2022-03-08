<?php

namespace App\Http\Requests\Businesses;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'max:255'],
            'unit_price' => ['numeric'],
            'in_stock' => ['integer'],
            'storage_unit' => [
                Rule::requiredIf(fn () => request()->get('in_stock') > 0),
                'in:' . implode(',', array_values(config('houseify.storage_units')))
            ]
        ];
    }
}
