<?php

namespace parqueos;

use Illuminate\Database\Eloquent\Model;

class Control_tabla extends Model
{
    protected $table="control_tablas";
    protected $fillable =['table_name', 'n_campos', 'valores'];
}
