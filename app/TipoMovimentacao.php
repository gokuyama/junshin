<?php

namespace junshin;

use Illuminate\Database\Eloquent\Model;

class TipoMovimentacao extends Model
{
    //nome da tabela
    protected $table = 'tipos_movimentacao';

    public $timestamps = false;

    protected $fillable = array('tipo_movimentacao', 'tipo_movimentacao_descricao');

    protected $guarded = ['tipo_movimentacao_id'];

    protected $primaryKey = 'tipo_movimentacao_id';
}
