<?php

namespace junshin;

use Illuminate\Database\Eloquent\Model;

class Pagador extends Model
{
    protected $primaryKey = 'pagador_id';

    protected $fillable = array(
        'responsavel_id', 'pagador_percentual', 'pagador_data_ini date', 'pagador_data_fim date', 'ativo',
        'userid_insert', 'datahora_insert', 'pagador_cpf', 'pagador_rua', 'pagador_numero', 'pagador_complemento',
        'pagador_bairro', 'pagador_cep', 'pagador_cidade', 'pagador_estado'
    );

    public $timestamps = false;

    protected $table = 'pagadores';
}