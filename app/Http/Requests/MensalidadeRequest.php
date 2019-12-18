<?php

namespace junshin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MensalidadeRequest extends FormRequest
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
            'matricula_id' => 'required',
            'mensalidade_valor' => 'required',
            'mensalidade_data_ini' => 'required|date_format:d/m/Y',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute não pode ser vazio.',
            'date_format' => 'O campo Data de Início está incorreto.',
        ];
    }
}