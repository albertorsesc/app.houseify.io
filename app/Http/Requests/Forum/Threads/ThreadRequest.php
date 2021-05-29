<?php

namespace App\Http\Requests\Forum\Threads;

use App\Rules\DetectSpamRule;
use Illuminate\Foundation\Http\FormRequest;

class ThreadRequest extends FormRequest
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
            'title' => ['required', 'max:255', new DetectSpamRule()],
            'body' => ['required', new DetectSpamRule()],
            'channel_id' => ['required', 'exists:thread_channels,id']
        ];
    }
}
