<?php

namespace junshin;

use Illuminate\Database\Eloquent\Model;

class NivelEscolaridade extends Model
{
    //nome da tabela
    protected $table = 'niveis_escolaridade';

    public $timestamps = false;

    protected $fillable = array('nivel_escolaridade_descricao');

    protected $guarded = ['nivel_escolaridade_id'];

    protected $primaryKey = 'nivel_escolaridade_id';
}