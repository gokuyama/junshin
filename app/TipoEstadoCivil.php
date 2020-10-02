<?php

namespace junshin;

use Illuminate\Database\Eloquent\Model;

class TipoEstadoCivil extends Model
{
    //nome da tabela
    protected $table = 'tipos_estado_civil';

    public $timestamps = false;

    protected $fillable = array('estado_civil_descricao');

    protected $guarded = ['estado_civil_id'];

    protected $primaryKey = 'estado_civil_id';
}
