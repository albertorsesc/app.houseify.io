<?php

namespace App\Http\Requests\Forum\Threads;

use App\Rules\DetectSpamRule;
use Illuminate\Foundation\Http\FormRequest;

class ReplyRequest extends FormRequest
{
    public function __construct () {
        parent::__construct();
    }

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
            'body' => ['required', new DetectSpamRule()],
        ];
    }
}
