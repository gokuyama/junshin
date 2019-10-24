<?php

namespace junshin;

use Illuminate\Database\Eloquent\Model;

class Mensalidade extends Model
{
    protected $primaryKey = 'mensalidade_id';

    protected $fillable = array('matricula_id', 'mensalidade_data_ini', 'mensalidade_data_fim', 'mensalidade_valor');

    public $timestamps = false;

    protected $table = 'mensalidades';
}