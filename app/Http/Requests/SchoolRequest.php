<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SchoolRequest extends FormRequest
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
            'name' => 'required',
            'telephone' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',
            'address' => 'required',
            'district' => 'required',
            'number' => 'required',
            'idmanagers' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo nome é obrigatório.',
            'telephone.required' => 'O campo telefone é obrigatório.',
            'state_id.required' => 'O campo estado é obrigatório.',
            'city_id.required' => 'O campo cidade é obrigatório.',
            'address.required' => 'O campo endereço é obrigatório.',
            'district.required' => 'O campo bairro é obrigatório.',
            'number.required' => 'O campo número é obrigatório.',
            'idmanagers.required' => 'É necessário informar ao menos um gestor.'
        ];
    }
}
