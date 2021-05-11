<?php

namespace App\Http\Requests;

use App\Rules\MinPasswordIf;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
    public function rules($request)
    {
        return [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,id,'.$request->id,
            'password' => ['required_if:alter-password,true', new MinPasswordIf($request->all(), 8, 'senha')],
            'password_confirmation' => 'same:password',
        ];
    }


    public function messages()
    {
        return [
            'required_if' => 'O campo senha é obrigatório quando o campo alterar senha estiver marcado.'
        ];
    }
}
