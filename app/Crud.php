<?php

namespace parqueos;

use Illuminate\Database\Eloquent\Model;

class Crud extends Model
{
    protected $table="crud";
    protected $fillable =['id_crud', 'des_crud'];
}
