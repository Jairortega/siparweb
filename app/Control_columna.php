<?php

namespace parqueos;

use Illuminate\Database\Eloquent\Model;

class Control_columna extends Model
{
    protected $table="control_columnas";
    protected $fillable =['table_name', 'column_name', 'column_type', 
    'position', 'col_comment'];
}
