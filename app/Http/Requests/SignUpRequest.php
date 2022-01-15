<?php

namespace App\Http\Requests;

use App\Rules\CustomerIdNotExist;
use App\Rules\TokenTrue;
use Illuminate\Foundation\Http\FormRequest;

class SignUpRequest extends FormRequest
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
            'name'=>'required',
            'type'=>'required',
            'password'=>'required',
            'email'=>'required|unique:users,email|email',
            'token'=>[new TokenTrue],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '名稱必填寫!',
            'type.required' => 'type必填寫!',
            'password.required' => 'password必填寫!',
            'email.required' => 'email必填寫!',
            'email.unique' => 'email重複!',
            'email.email'=>'email格式不正確',
        ];
    }
}
