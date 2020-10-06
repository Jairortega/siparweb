<?php

namespace parqueos;

use Illuminate\Database\Eloquent\Model;

class Banco extends Model
{
    protected $table="bancos";
    protected $fillable =['cod_bco','banco'];
}
