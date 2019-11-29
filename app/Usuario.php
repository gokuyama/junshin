<?php

namespace junshin;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    //nome da tabela
    protected $table = 'users';

    public $timestamps = false;

    protected $fillable = array('id', 'name', 'email', 'password', 'username');

    protected $guarded = ['id'];

    protected $primaryKey = 'id';
}