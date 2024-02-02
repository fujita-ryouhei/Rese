<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends FormRequest
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
            'date' => 'required|date',
            'time' => 'required',
            'number' => 'required|integer',
        ];
    }

    /**
     * カスタムバリデーションメッセージの定義
     *
     * @return array
     */
    public function messages()
    {
        return [
            'date.required' => '日付は必須項目です。',
            'time.required' => '時間は必須項目です。',
            'number.required' => '人数は必須項目です。',
        ];
    }
}
