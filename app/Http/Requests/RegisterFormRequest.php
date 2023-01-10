<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; //[ *1.変更：default=false ]
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
          //[ *2.追加：Validationルール記述箇所 ]
          'over_name' => ['required','max:10'],
          'under_name' => ['required','max:10'],
          'over_name_kana' => ['required','regex:/^[ア-ン゛゜ァ-ォャ-ョー]+$/u',],
          'under_name_kana' => ['required','regex:/^[ア-ン゛゜ァ-ォャ-ョー]+$/u',],
          'mail_address' => ['required','max:100'],
          'sex' => ['required',],
          'birth_day' => ['required',],
          'role' => ['required',],
          'password' => ['required','min:8','max:20','unique:users'],
        ];
    }

    //[ *3.追加：Validationメッセージを設定（省略可） ]
    //function名は必ず「messages」となる。
    public function massages(){
      return[
        //
        'mail.required'  => '※メール形式で入力してください',
        'birth_day.required' => '※生年月日が未入力です'
      ];
    }
}
