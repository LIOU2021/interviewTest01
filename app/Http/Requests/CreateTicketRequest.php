<?php

namespace App\Http\Requests;

use App\Rules\TokenTrue;
use Illuminate\Foundation\Http\FormRequest;

class CreateTicketRequest extends FormRequest
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
            'user_id'=>'required',
            'summary'=>'required',
            'description'=>'required',
            'group_id'=>'required',
            'status'=>'required',
            'type'=>'required',
            'severity'=>'required',
            'priority'=>'required',
            'token'=>['required',new TokenTrue],
        ];
    }

    public function messages(){
        return[
            'user_id.required'=>'user_id必填!',
            'summary.required'=>'summary必填!',
            'description.required'=>'description必填!',
            'group_id.required'=>'group_id必填!',
            'status.required'=>'status必填',
            'type.required'=>'type必填',
            'severity.required'=>'severity必填',
            'priority.required'=>'priority必填',
            'token.required'=>'token必填寫',
        ];
    }
}
