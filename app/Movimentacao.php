<?php

namespace junshin;

use Illuminate\Database\Eloquent\Model;

class Movimentacao extends Model
{
    //nome da tabela
    protected $table = 'movimentacoes';

    public $timestamps = false;

    protected $fillable = array('tipo_movimentacao_id', 'movimentacao_data', 'movimentacao_valor', 'movimentacao_observacao');

    protected $guarded = ['movimentacao_id'];

    protected $primaryKey = 'movimentacao_id';
}
