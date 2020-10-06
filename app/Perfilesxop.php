<?php

namespace parqueos;

use Illuminate\Database\Eloquent\Model;

class Perfilesxop extends Model
{
    protected $table="perfiles_xopcion";
    protected $fillable =['id_perfil', 'id_opcion', 'p_insertar', 
    'p_modificar', 'p_borrar', 'r_pdf', 'r_csv', 'r_txt'];
}
