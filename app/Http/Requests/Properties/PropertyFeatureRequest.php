<?php

namespace App\Http\Requests\Properties;

use App\Rules\ModelBelongsToAuthUserRule;
use Illuminate\Foundation\Http\FormRequest;

class PropertyFeatureRequest extends FormRequest
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
            'property_id' => [
                $this->getMethod() === 'POST' ? 'required' : '',
                'exists:properties,id',
            ],
            'property_size' => ['integer', 'max:100000000', 'gte:' . 0],
            'construction_size' => ['integer', 'max:100000000', 'gte:' . 0],
            'level_count' => ['integer', 'max:100', 'gte:' . 0],
            'room_count' => ['integer', 'max:100', 'gte:' . 0],
            'bathroom_count' => ['integer', 'max:100', 'gte:' . 0],
            'half_bathroom_count' => ['integer', 'max:100', 'gte:' . 0],
        ];
    }
}
