<?php

namespace App\Http\Requests;

use App\Rules\CustomerIdNotExist;
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
            'customer_id'=>['required',new CustomerIdNotExist],
            'type'=>'required',
            'password'=>'required',
            'email'=>'required|unique:users,email|email',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '名稱必填寫!',
            'customer_id.required' => 'customer_id必填寫!',
            'type.required' => 'type必填寫!',
            'password.required' => 'password必填寫!',
            'email.required' => 'email必填寫!',
            'email.unique' => 'email重複!',
            'email.email'=>'email格式不正確',
        ];
    }
}
