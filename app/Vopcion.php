<?php

namespace parqueos;

use Illuminate\Database\Eloquent\Model;

class Vopcion extends Model
{
    protected $table="vopciones";
    protected $fillable =['grupo','gnombre', 'id_opcion', 'opcion',
'name_objeto', 'consulta', 'rep_pdf', 'rep_csv', 'rep_txt'];
}
