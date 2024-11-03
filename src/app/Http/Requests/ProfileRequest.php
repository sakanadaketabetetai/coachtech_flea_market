<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'post_code' => ['required', 'regex:/^[0-9]{1,3}-[0-9]{1,4}/', 'max:8'],
            'address' => ['required', 'string', 'max:255'],
            'building' => ['string', 'max:255']
        ];
    }

    public function messages(){
        return [
            'name.required' => '名前を入力してください',
            'name.string' => '名前は文字形式で入力してください',
            'name.max' => '名前は255文字以内で入力してください',
            'post_code.required' => '郵便番号を入力してください',
            'post_code.regex' => '郵便番号はハイフン付きで入力してください',
            'post_code.max' => '郵便番号は255文字以内で入力してください',
            'address.required' => '住所を入力してください',
            'address.string' => '住所は文字形式で入力してください',
            'address.max' => '住所は255文字以内で入力してください',
            'building.string' => '建物名は文字形式で入力してください',
            'building.max' => '建物名は255文字以内で入力してください',
        ];


    }
}
