<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'password'=>'required',
            'email'=>'required|email',
        ];
    }

    public function messages()
    {
        return [
            'password.required' => 'password必填寫!',
            'email.required' => 'email必填寫!',
            'email.email'=>'email格式不正確',
        ];
    }
}
