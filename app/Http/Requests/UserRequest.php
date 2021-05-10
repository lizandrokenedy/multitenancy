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
    public function rules($params)
    {
        return [
            'name' => 'required|max:255',
            'email' => 'required|email',
            'password' => ['required_if:alter-password,true', new MinPasswordIf($params, 8, 'senha')],
            'password_confirmation' => 'same:password',
        ];
    }
}
