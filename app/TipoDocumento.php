<?php

namespace junshin;

use Illuminate\Database\Eloquent\Model;

class TipoDocumento extends Model
{
    //nome da tabela
    protected $table = 'tipos_documento';

    public $timestamps = false;

    protected $fillable = array('tipo_documento_descricao');

    protected $guarded = ['tipo_documento_id'];

    protected $primaryKey = 'tipo_documento_id';
}