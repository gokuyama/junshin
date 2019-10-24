<?php

namespace junshin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MoradorRequest extends FormRequest
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
        'aluno_id'=>'required',
        'morador_nome'=> 'required|max:45',
        'morador_vinculo'=> 'required|max:45',
        'morador_data_nascimento' => 'required|date_format:d/m/Y',
        'morador_sexo' => 'required|max:1'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute não pode ser vazio.',
            'date_format' => 'O campo Data de Nascimento está incorreto.'
        ];
    }
}