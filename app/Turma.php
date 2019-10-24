<?php

namespace junshin;

use Illuminate\Database\Eloquent\Model;

class Turma extends Model
{
    //nome da tabela
    protected $table = 'turmas';

    public $timestamps = false;

    protected $fillable = array('tipo_turma_id', 'turno_id', 'tipo_frequencia_id', 'turma_descricao', 'turma_observacao');

    protected $guarded = ['turma_id'];

    protected $primaryKey = 'turma_id';
}