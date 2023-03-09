<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubcategoryFormRequest extends FormRequest
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
            //
            'sub_category' => ['required','unique:sub_category','max:100'],
        ];
    }
    public function messages(){
        return [
            'sub_category_name.max' => 'サブカテゴリーは100文字以内で入力してください。',
            'sub_category_name.required' => 'サブカテゴリーは必須です',
            'sub_category_name.unique' => 'すでに登録済みのサブカテゴリーです',
        ];
    }
}
