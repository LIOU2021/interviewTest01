<?php

namespace App\Http\Requests;

use App\Rules\TokenTrue;
use Illuminate\Foundation\Http\FormRequest;

class VerifyRequest extends FormRequest
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
            'id'=>'required',
            'token'=>['required',new TokenTrue],
        ];
    }

    public function messages(){
        return[
            'id.required'=>'id必填!',
            'token.required'=>'token必填寫',
        ];
    }
}
