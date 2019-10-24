<?php

namespace junshin;

use Illuminate\Database\Eloquent\Model;

class TipoTurma extends Model
{
    //nome da tabela
    protected $table = 'tipos_turma';

    public $timestamps = false;

    protected $fillable = array('tipo_turma_descricao');

    protected $guarded = ['tipo_turma_id'];

    protected $primaryKey = 'tipo_turma_id';
}