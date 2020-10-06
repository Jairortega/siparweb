<?php

namespace parqueos;

use Illuminate\Database\Eloquent\Model;

class Grupoparqueo extends Model
{
    protected $table="grupo_parqueos";
    protected $fillable =['cod_gr_parque','cc_user', 'des_gr_parque'];
}
