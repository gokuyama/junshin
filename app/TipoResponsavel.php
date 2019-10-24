<?php

namespace junshin;

use Illuminate\Database\Eloquent\Model;

class TipoResponsavel extends Model
{
    //nome da tabela
    protected $table = 'tipos_responsavel';

    public $timestamps = false;

    protected $fillable = array('tipo_responsavel_descricao');

    protected $guarded = ['tipo_responsavel_id'];

    protected $primaryKey = 'tipo_responsavel_id';
}