<?php $retorno = 't_consola'; ?>
@extends('components.vheadper')

@section('content')
@csrf
@foreach($perfiles as $perfil)
<?php
 $insertar = $perfil->p_insertar;
 $modificar = $perfil->p_modificar;
 $borrar = $perfil->p_borrar;
 ?>
@endforeach
<div class="container">
    <!-- APPLICATION -->
    <div id="App" class="row pt-12">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <table>
                        <td><h4 style="color: #007bff; font-size: 20px; ">CONSOLA QUERY</h4></td>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="table-responsive">
                        <table class="table table-striped table-bordered table-condensed table-hover">
                            <thead class="text-primary">
                            @foreach($cabcolumns as $cabcol)
                                <th>{{ $cabcol->column_name }}</th>
                            @endforeach    
                            </thead>
                            @foreach($results as $resul)
                            <tr>
                                @foreach($cabcolumns as $cabcol) 
                                <?php $pp = $cabcol->column_name ?>
                                <td>{{ $resul->$pp }}</td>
                                @endforeach
                            </tr>
                            @endforeach
                                
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@extends('components.vfootgral')

@endsection