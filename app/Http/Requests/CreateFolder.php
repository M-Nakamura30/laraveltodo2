<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateFolder extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    //リクエストの内容に基づいた権限チェック
    //今回は使わないためにtrue→リクエストを受け付ける
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
            'title' => 'required|max:20',
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'フォルダ名',
        ];
    }
}
