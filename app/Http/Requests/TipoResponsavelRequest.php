<?php

namespace junshin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TipoResponsavelRequest extends FormRequest
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
            'tipo_responsavel_descricao' => 'required|max:45'
        ];
    }

    public function messages()
    {
        return [
            //'required' => 'The :attribute field can not be empty.',
            'tipo_responsavel_descricao.required' => 'O :attribute field não pode estar vazio.',

        ];
    }
}
