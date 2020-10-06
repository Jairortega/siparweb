<?php

namespace parqueos;

use Illuminate\Database\Eloquent\Model;

class Querytabla extends Model
{
    protected $table="query_tablas";
    protected $fillable =['id_query', 'id_crud', 'table_name', 'condicion', 'valor1', 'valor2'];
}
