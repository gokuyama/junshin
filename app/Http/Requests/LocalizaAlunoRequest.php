<?php

namespace junshin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LocalizaAlunoRequest extends FormRequest
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
            'aluno_nome_localiza' => 'required|max:100',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute não pode ser vazio.',
        ];
    }
}
