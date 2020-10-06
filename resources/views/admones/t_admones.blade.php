<?php $retorno = 'home'; ?>
@extends('components.vheadper')
@csrf
@section('content')
@csrf
    <div class="container">
        <!-- APPLICATION -->
        <div id="App" class="row pt-12">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 style="color: #007bff; font-size: 20px; ">ADMINISTRADOR</h4>
                    </div>

                    <div class="row">

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-condensed table-hover">
                                    <thead class="text-primary">
                                        <th>CEDULA</th>
                                        <th>NOMBRE</th>
                                        <th>CORREO</th>
                                        <th>OPCIONES</th>
                                    </thead>
                                    @foreach($admones as $admon)
                                    <tr>
                                        <td>{{ $admon->cc_admon }}</td>
                                        <td>{{ $admon->nom_admon }}</td>
                                        <td>{{ $admon->mail_admon }}</td>
                                        <td>
                                          @foreach($perfiles as $perfil)
                                            <a href="{{ $perfil->consulta }}/{{ $admon->cc_admon }}"><button class="btn btn-primary">Visualizar</button></a>
                                            @if ($perfil->p_modificar == "1")
                                              <a href="{{ $perfil->consulta }}/{{ $admon->cc_admon }}/edit"><button class="btn btn-primary">Editar</button></a>
                                            @endif
                                            @if ($perfil->p_borrar == "1")
                                            <a href="{{ $perfil->consulta }}/destroy/{{ $admon->cc_admon }}" onclick="return confirm('Está seguro de borrarlo? ')"><button class="btn btn-danger">Eliminar</button></a>
                                            @endif
                                          @endforeach
                                        </td>
                                    </tr>
                                    @endforeach
                                </table>
                                {!! $admones->render() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@extends('components.vfootgral')

@endsection