<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShopEditRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'image_url' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'explanation' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '店舗名は必須項目です。',
            'name.string' => '店舗名は文字列で指定してください。',
            'name.max' => '店舗名は255文字以内で指定してください。',
            'image_url.required' => 'イメージ画像は必須項目です。',
            'image_url.string' => 'イメージ画像は文字列で指定してください。',
            'image_url.max' => 'イメージ画像は255文字以内で指定してください。',
            'location.required' => '所在地は必須項目です。',
            'location.string' => '所在地は文字列で指定してください。',
            'location.max' => '所在地は255文字以内で指定してください。',
            'category.required' => 'カテゴリーは必須項目です。',
            'category.string' => 'カテゴリーは文字列で指定してください。',
            'category.max' => 'カテゴリーは255文字以内で指定してください。',
            'explanation.required' => '店舗説明は必須項目です。',
            'explanation.string' => '店舗説明は文字列で指定してください。',
        ];
    }
}
