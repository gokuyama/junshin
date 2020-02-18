<?php

namespace junshin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AlunoRequest extends FormRequest
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
            'aluno_nome' => 'required|max:100',
            'aluno_codigo' => 'required|max:45',
            'aluno_data_nascimento' => 'required|date_format:d/m/Y',
            'aluno_local_nascimento' => 'required|max:45',
            'tipo_documento_id' => 'required|max:11',
            'aluno_documento' => 'required|max:45',
            'aluno_sexo' => 'required|max:1',
            'nivel_escolaridade_id' => 'required|max:11',
            'aluno_endereco_rua' => 'required|max:45',
            'aluno_endereco_numero' => 'required|max:10',
            'aluno_endereco_complemento' => 'required|max:10',
            'aluno_endereco_bairro' => 'required|max:45',
            'aluno_endereco_cep' => 'required|max:10',
            'aluno_endereco_cidade' => 'required|max:45',
            'aluno_endereco_estado' => 'required|max:2',
            'aluno_telefone_fixo' => 'max:20',
            'aluno_telefone_celular' => 'max:20',
            'aluno_religiao' => 'max:45',
            'aluno_email' => 'max:45',
            'aluno_observacao' => 'max:255',
            'aluno_quantidade_irmaos' => 'max:11',
            'aluno_ordem_nascimento' => 'max:11',
            'aluno_ordem_geracao' => 'max:11',
            'nivel_conhecimento_japones_id' => 'required|max:11',
            'aluno_vacinado' => 'required|max:11',
            'aluno_vacinado_observacao' => 'max:255',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute não pode ser vazio.',
            'date_format' => 'O campo Data de Nascimento está incorreto.',
            'max' => 'O campo :attribute não pode ter mais de :max caracteres.',
        ];
    }
}