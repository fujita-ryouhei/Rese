<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShopRatingRequest extends FormRequest
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
            'shop_id' => 'required|exists:shops,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'rating.required' => '評価は必須です。',
            'rating.min' => '評価は1以上で指定してください。',
            'rating.max' => '評価は5以下で指定してください。',
            'comment.string' => 'コメントは文字列で指定してください。',
        ];
    }
}
