<?php

namespace junshin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResponsavelRequest extends FormRequest
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
            'tipo_responsavel_id' => 'required',
            'aluno_id' => 'required',
            'responsavel_nome' => 'required|max:100',
            'responsavel_firma' => 'max:45',
            'responsavel_telefone_firma' => 'max:20',
            'responsavel_ramal_firma' => 'max:10',
            'responsavel_celular' => 'max:20',
            'responsavel_email' => '',
            'responsavel_nascionalidade' => 'max:45',
            'responsavel_data_nascimento' => 'max:45',
            'responsavel_ordem_geracao' => 'max:11',
            'responsavel_religiao' => 'max:45',
            'responsavel_escolaridade_id' => 'max:11',
            'pagador_percentual' => 'max:3',
            'pagador_cpf' => '',
            'pagador_rua' => 'max:45',
            'pagador_numero' => 'max:10',
            'pagador_complemento' => 'max:10',
            'pagador_bairro' => 'max:45',
            'pagador_cep' => 'max:10',
            'pagador_cidade' => 'max:45',
            'pagador_estado' => 'max:2'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute não pode ser vazio.',
            'date_format' => 'O campo Data de Nascimento está incorreto.',
            'email' => 'O e-mail é inválido',
            'max' => 'O campo :attribute não pode ter mais de :max caracteres.',
        ];
    }
}