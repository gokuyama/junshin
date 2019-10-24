<?php

namespace junshin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TurmaRequest extends FormRequest
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
            'tipo_turma_id' => 'required',
            'turno_id' => 'required',
            'tipo_frequencia_id' => 'required',
            'turma_descricao' => 'required|max:45',
            'turma_observacao' => 'max:255',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute não pode ser vazio.',
        ];
    }
}