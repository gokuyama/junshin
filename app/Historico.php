<?php

namespace junshin;

use Illuminate\Database\Eloquent\Model;

class Historico extends Model
{
    protected $primaryKey = 'historico_instituicao_id';

    protected $fillable = array('aluno_id', 'historico_instituicao_nome', 'historico_instituicao_ano', 'historico_instituicao_serie');

    public $timestamps = false;

    protected $table = 'historico_instituicoes';
}