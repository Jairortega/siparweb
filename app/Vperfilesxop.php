<?php

namespace parqueos;

use Illuminate\Database\Eloquent\Model;

class Vperfilesxop extends Model
{
    protected $table="vperfilesxop";
    protected $fillable =['id_perfil', 'perfil', 'grupo', 'gnombre', 
    'id_opcion', 'opcion', 'p_insertar', 'insertar', 'p_modificar', 
    'name_objeto', 'consulta', 'rep_pdf', 'rep_csv', 'rep_txt',
    'modificar', 'p_borrar', 'borrar', 'r_pdf', 'pdf', 'r_csv', 'csv', 
    'r_txt', 'txt'];
}
