<?php

namespace parqueos;

use Illuminate\Database\Eloquent\Model;

class Vquerytabla extends Model
{
    protected $table="vquery_tablas";
    protected $fillable =['id_query', 'id_crud', 'des_crud', 'table_name', 'condicion', 'valor1', 'valor2'];
}
