<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
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
            'school' => 'required',
            'serie' => 'required',
            'class' => 'required',
            'period' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'school.required' => "O campo escola é obrigatório.",
            'serie.required' => "O campo série é obrigatório.",
            'class.required' => "O campo turma é obrigatório.",
            'period.required' => "O campo período é obrigatório.",
        ];
    }
}
