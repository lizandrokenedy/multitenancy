<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssessmentRequest extends FormRequest
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
            'school_id' => 'required|exists:schools,id',
            'student_id' => 'required|exists:users,id',
            'body_mass' => 'required',
            'height' => 'required',
            'flexibility_id' => 'required',
            'abdominal_resistance_id' => 'required',
        ];
    }


    public function messages()
    {
        return [

            'school_id.required' => 'O campo escola é obrigatório.',
            'school_id.exists' => 'Escola não encontrada.',
            'student_id.required' => 'O campo aluno é obrigatório.',
            'student_id.exists' => 'Aluno não encontrado.',
            'body_mass.required' => 'O campo massa corporal é obrigatório.',
            'height.required' => 'O campo altura é obrigatório.',
            'flexibility_id.required' => 'O campo flexibilidade é obrigatório.',
            'abdominal_resistance_id.required' => 'O campo resistência abdominal é obrigatório.',
        ];
    }
}
