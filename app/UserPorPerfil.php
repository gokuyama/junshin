<?php

namespace junshin;

use Illuminate\Database\Eloquent\Model;

class UserPorPerfil extends Model
{
    //nome da tabela
    protected $table = 'users_por_perfis';

    public $timestamps = false;

    protected $fillable = array('user_id', 'perfil_id');

    protected $guarded = ['users_por_perfil_id'];

    protected $primaryKey = 'users_por_perfil_id';
}