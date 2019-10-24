<?php

namespace junshin;

use Illuminate\Database\Eloquent\Model;

class Morador extends Model
{
    protected $primaryKey = 'morador_id';

    protected $fillable = array('aluno_id', 'morador_nome', 'morador_vinculo', 'morador_data_nascimento', 'morador_sexo');

    public $timestamps = false;

    protected $table = 'moradores';
}