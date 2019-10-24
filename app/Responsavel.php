<?php

namespace junshin;

use Illuminate\Database\Eloquent\Model;

class Responsavel extends Model
{
    protected $primaryKey = 'responsavel_id';

    protected $fillable = array('tipo_responsavel_id', 'aluno_id', 'responsavel_nome', 'responsavel_firma', 'responsavel_telefone_firma', 'responsavel_ramal_firma', 'responsavel_celular', 'responsavel_email', 'responsavel_nascionalidade', 'responsavel_data_nascimento', 'responsavel_ordem_geracao', 'responsavel_religiao', 'responsavel_escolaridade_id', 'ativo');

    public $timestamps = false;

    protected $table = 'responsaveis';
}