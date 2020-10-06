<?php

namespace parqueos;

use Illuminate\Database\Eloquent\Model;

class Grupomenu extends Model
{
    protected $table="grupos_menu";
    protected $fillable =['grupo','gnombre'];
}
