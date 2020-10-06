<?php

namespace parqueos;

use Illuminate\Database\Eloquent\Model;

class Pvariable extends Model
{
    protected $table="pvariables";
    protected $fillable =['id_pv', 'des_pv'];

}
