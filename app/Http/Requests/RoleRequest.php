<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
            'permissions' => 'required',
            'description' => 'required',
            'name' => 'required',
        ];
    }


    public function messages()
    {
        return [
            'permissions.required' => 'É necessário selecionar ao menos uma permissão.',
            'description.required' => 'O campo descrição é obrigatório.',
            'name' => 'O campo nome é obrigatório.',
        ];
    }
}
