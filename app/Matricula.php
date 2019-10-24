<?php

namespace junshin;

use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
    //nome da tabela
    protected $table = 'matriculas';

    public $timestamps = false;

    protected $fillable = array('turma_id', 'aluno_id', 'matricula_data_ini', 'matricula_data_fim');

    protected $guarded = ['matricula_id'];

    protected $primaryKey = 'matricula_id';
}