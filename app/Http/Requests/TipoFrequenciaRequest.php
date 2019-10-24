<?php

namespace junshin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TipoFrequenciaRequest extends FormRequest
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
            'tipos_frequencia_descricao' => 'required|max:45'
        ];
    }

    public function messages()
    {
        return [
            //'required' => 'The :attribute field can not be empty.',
            'tipos_frequencia_descricao.required' => 'O :attribute field não pode estar vazio.',

        ];
    }
}
