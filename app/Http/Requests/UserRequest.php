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
            'email' => 'required|email|unique:users,email,'.$request->id,
            'password' => ['required_if:alter-password,true', new MinPasswordIf($request->all(), 8, 'senha')],
            'password_confirmation' => 'same:password',
            'role_id' => 'required_if:admin,false',
        ];
    }


    public function messages()
    {
        return [
            'password.required_if' => 'O campo senha é obrigatório quando o campo alterar senha estiver marcado.',
            'role_id.required_if' => 'O campo perfil é obrigatório.'
        ];
    }
}
