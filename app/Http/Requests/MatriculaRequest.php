<?php

namespace junshin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MatriculaRequest extends FormRequest
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
            'turma_id' => 'required',
            'aluno_id' => 'required',
            'matricula_data_ini' => 'required|date_format:d/m/Y',
            'mensalidade_valor' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute não pode ser vazio.',
            'date_format' => 'O campo Data de Início está incorreto.'
        ];
    }
}