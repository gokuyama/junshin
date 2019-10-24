<?php

namespace junshin;

use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    protected $primaryKey = 'aluno_id';

    protected $fillable = array(
        'aluno_nome', 'aluno_codigo', 'aluno_data_nascimento', 'aluno_local_nascimento',
        'tipo_documento_id', 'aluno_documento', 'aluno_sexo', 'nivel_escolaridade_id', 'aluno_endereco_rua',
        'aluno_endereco_numero', 'aluno_endereco_complemento', 'aluno_endereco_bairro', 'aluno_endereco_cep', 'aluno_endereco_cidade', 'aluno_endereco_estado',
        'aluno_telefone_fixo', 'aluno_telefone_celular', 'aluno_telefone_recado', 'aluno_religiao',
        'aluno_email', 'aluno_observacao', 'aluno_quantidade_irmaos', 'aluno_ordem_nascimento',
        'aluno_ordem_geracao', 'nivel_conhecimento_japones_id', 'aluno_vacinado', 'aluno_vacinado_observacao'
    );


    public $timestamps = false;
}