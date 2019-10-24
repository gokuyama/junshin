<?php

namespace junshin;

use Illuminate\Database\Eloquent\Model;

class TipoFrequencia extends Model
{
    //nome da tabela
    protected $table = 'tipos_frequencia';

    public $timestamps = false;

    protected $fillable = array('tipos_frequencia_descricao');

    protected $guarded = ['tipo_frequencia_id'];

    protected $primaryKey = 'tipo_frequencia_id';
}