<?php

namespace App\Http\Requests\Properties;

use Illuminate\Foundation\Http\FormRequest;

class PropertyRequest extends FormRequest
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
            'property_category_id' => ['required', 'exists:property_categories,id'],
            'business_type' => ['required', 'in:' . implode(',', \App\Models\Properties\Concerns\BusinessType::all())],
            'title' => ['required', 'max:50'],
            'price' => ['required', 'integer', 'max:100000000', 'gt:' . 0]
        ];
    }
}
