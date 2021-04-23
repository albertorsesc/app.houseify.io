<?php

namespace App\Http\Requests\JobProfiles;

use App\Models\JobProfiles\JobProfile;
use Illuminate\Foundation\Http\FormRequest;

class JobProfileRequest extends FormRequest
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
            'title' => ['required', 'max:100'],
            'skills' => [
                'required',
                'array',
                'in:' . implode(',', collect(config('job-profiles.skills'))->toArray())
            ],
            'email' => ['nullable', 'email', 'max:150'],
            'phone' => ['max:60'],
            'facebook_profile' => ['nullable', 'url', 'max:255'],
            'site' => ['nullable', 'url', 'max:255'],
        ];
    }
}
