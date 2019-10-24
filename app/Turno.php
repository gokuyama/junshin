<?php

namespace junshin;

use Illuminate\Database\Eloquent\Model;

class Turno extends Model
{
    //nome da tabela
    protected $table = 'turnos';

    public $timestamps = false;

    protected $fillable = array('turno_descricao');

    protected $guarded = ['turno_id'];

    protected $primaryKey = 'turno_id';
}