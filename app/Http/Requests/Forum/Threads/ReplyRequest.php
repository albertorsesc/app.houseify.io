<?php

namespace App\Http\Requests\Forum\Threads;

use App\Models\Concerns\SpamDetection\Spam;
use Illuminate\Foundation\Http\FormRequest;

class ReplyRequest extends FormRequest
{
    public function __construct (Spam $spam) {
        parent::__construct();
        $spam->detect($this->body);
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
            'body' => ['required',],
        ];
    }
}
