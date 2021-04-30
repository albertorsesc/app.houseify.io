<?php

namespace App\Http\Requests\Businesses;

use Illuminate\Foundation\Http\FormRequest;

class BusinessRequest extends FormRequest
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
            'name' => $this->getMethod() === 'POST' ? ['required', 'max:150', 'unique:businesses,name'] : [],
            'categories' => ['required', 'array', 'in:' . implode(',', config('houseify.construction_categories'))],
            'email' => ['nullable', 'required_without:phone', 'email', 'max:150'],
            'phone' => ['nullable', 'required_without:email', 'max:50'],
            'site' => ['nullable', 'url', 'max:255'],
            'facebook_profile' => ['nullable', 'url', 'max:255'],
            'linkedin_profile' => ['nullable', 'url', 'max:255'],
        ];
    }
}
