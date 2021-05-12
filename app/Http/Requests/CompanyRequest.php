<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
            'domain' => 'required|max:255|unique:companies,domain,' . $request->id,
        ];
    }


    public function messages()
    {
        return [
            'domain.required' => 'O campo domínio é obrigatório',
            'domain.unique' => 'O campo domínio já está sendo utilizado',
            'domain.max' => 'O campo domínio pode ter no máximo 255 caracteres',
        ];
    }
}
