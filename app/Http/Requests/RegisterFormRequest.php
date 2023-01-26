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

    public function getValidatorInstance()
    {
      $old_year = $this->input('old_year');
      $old_month = $this->input('old_month');
      $old_day = $this->input('old_day');
      // 日付を作成(ex. 2020-1-20)
      $birth_day = $old_year . '-' . $old_month . '-' . $old_day;
      // rules()に渡す値を追加でセット
      //     これで、この場で作った変数にもバリデーションを設定できるようになる

      $this->merge([
        'birth_day' => $birth_day,
      ]);
      return parent::getValidatorInstance();
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
          'over_name' => ['required','max:10','string'],
          'under_name' => ['required','max:10','string'],
          'over_name_kana' => ['required','regex:/^[ア-ン゛゜ァ-ォャ-ョー]+$/u',],
          'under_name_kana' => ['required','regex:/^[ア-ン゛゜ァ-ォャ-ョー]+$/u',],
          'mail_address' => ['required','email:filter','max:100'],
          'sex' => ['required','in: 1,2,3'],
          'birth_day' => ['date','after:yesterday'],
          'role' => ['required','in: 1,2,3,4'],
          'password' => ['required','min:8','max:20','unique:users',],
          'password_confirmation' => ['required','min:8','max20','same:password',]
        ];
    }

    //[ *3.追加：Validationメッセージを設定（省略可） ]
    //function名は必ず「messages」となる。
    public function massages(){
      return[
        //
        'over_name.required' => '※性を入力してください',
        'under_name.required' => '※名を入力してください',
        'over_name.max' => '※性を入力してください',
        'under_name.max' => '※名を入力してください',
        'over_name_kana.required' => '※カタカナで入力してください',
        'under_name_kana.required' => '※カタカナで入力してください',
        'over_name_kana.regex' => '※カタカナで入力してください',
        'under_name_kana.regex' => '※カタカナで入力してください',
        'mail_address.required'  => '※メール形式で入力してください',
        'mail_address.email'  => '※メール形式で入力してください',
        'mail_address.max'  => '※メール形式で入力してください',
        'birth_day.date' => '※生年月日が未入力です',
        'birth_day.yesterday' => '※生年月日が未入力です',
        'password.unigue' => '※パスワードが異なります',
        'password.min' => '※パスワードが異なります',
        'password.max' => '※パスワードが異なります',
        'password.required' => '※パスワードが異なります',
      ];
    }
}
