<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendEmailRequest extends FormRequest
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
            'subject' => 'required|string|max:255',
            'content' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'subject.required' => '件名は必須です。',
            'subject.string' => '件名は文字列で入力してください。',
            'subject.max' => '件名は:255文字以内で入力してください。',
            'content.required' => '用件は必須です。',
            'content.string' => '用件は文字列で入力してください。',
        ];
    }
}
