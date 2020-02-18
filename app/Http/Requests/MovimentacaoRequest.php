<?php

namespace junshin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MovimentacaoRequest extends FormRequest
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
            'tipo_movimentacao_id' => 'required',
            'movimentacao_data' => 'required',
            'movimentacao_valor' => 'required',
            'movimentacao_observacao' => 'required|max:45'
        ];
    }

    public function messages()
    {
        return [
            'tipo_movimentacao_id.required' => 'O campo tipos não pode estar vazio.',
            'movimentacao_data.required' => 'O campo data não pode estar vazio.',
            'movimentacao_valor.required' => 'O campo valor não pode estar vazio.',
            'movimentacao_observacao.required' => 'O campo observação não pode estar vazio.',
            'max' => 'O campo :attribute não pode ter mais de :max caracteres.',
        ];
    }
}