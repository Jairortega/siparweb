<?php

namespace parqueos;

use Illuminate\Database\Eloquent\Model;

class Opcperfil extends Model
{
    protected $table="opciones_xperfiles";
    protected $fillable =['id_perfil','grupo', 'id_opcion', 'opcion',
               'name_objeto', 'consultar', 'p_insertar',
               'p_modificar', 'p_borrar', 'rep_pdf', 'rep_csv', 'rep_txt', 
               'r_pdf', 'r_csv', 'r_txt'];

}
