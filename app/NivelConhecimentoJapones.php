<?php

namespace junshin;

use Illuminate\Database\Eloquent\Model;

class NivelConhecimentoJapones extends Model
{
    //nome da tabela
    protected $table = 'niveis_conhecimento_japones';

    public $timestamps = false;

    protected $fillable = array('nivel_conhecimento_japones_descricao');

    protected $guarded = ['nivel_conhecimento_japones_id'];

    protected $primaryKey = 'nivel_conhecimento_japones_id';
}