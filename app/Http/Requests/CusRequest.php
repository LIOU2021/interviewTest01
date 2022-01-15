<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CusRequest extends FormRequest
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
            'name'=>'required|unique:customers,name',
        ];
    }

    public function messages(){
        return [
            'name.required' => '名稱必填寫!',
            'name.unique' => '名稱重複!',
        ];
    }
}
