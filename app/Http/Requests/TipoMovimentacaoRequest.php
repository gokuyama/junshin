<?php

namespace junshin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TipoMovimentacaoRequest extends FormRequest
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
            'tipo_movimentacao' => 'required',
            'tipo_movimentacao_descricao' => 'required|max:45'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'The :attribute field can not be empty.',
            'tipo_movimentacao_descricao.required' => 'O campo descrição não pode estar vazio.',

        ];
    }
}
