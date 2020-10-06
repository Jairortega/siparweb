<?php

namespace parqueos;

use Illuminate\Database\Eloquent\Model;

class Opcion extends Model
{
    protected $table="opciones";
    protected $fillable =['grupo','id_opcion', 'opcion', 'name_objeto', 
    'consulta', 'rep_pdf', 'rep_csv', 'rep_txt'];

}
