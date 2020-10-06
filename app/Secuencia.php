<?php

namespace parqueos;

use Illuminate\Database\Eloquent\Model;

class Secuencia extends Model
{
    protected $table="secuencias";
    protected $fillable =['nombre_sec','numero_sec', 'created_at', 'updated_at'];

}
