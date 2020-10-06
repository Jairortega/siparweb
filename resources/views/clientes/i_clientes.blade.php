@extends('components.vheadgral')
@csrf
@section('content')
        <div class="container">
            <!-- APPLICATION -->
            <div id="App" class="row pt-12">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 style="color: #007bff; font-size: 20px; ">CONTACTENOS (Únicamente para Administradores)</h4>
                        </div>
                        <form id="clien_form" method="post" action="/clientes.i_clientes" class="card-body">
                            @csrf
                            <div class="form-group">
                                {!!Form::label('cc_cliente', 'Cédula: ')!!}
                                {!!Form::number('cc_cliente', null, ['class'=>'form-control','placeholder'=>'Cédula del Cliente'])!!}
<!--                                <input type="number" id="cc_admon" name="cc_admon" placeholder="Cedula" class="form-control"> -->
                                @if ($errors->has('cc_cliente'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('cc_cliente') }}</li>
                                        </ul>
                                    </div>
                                @endif

                                @if(Session::has('message'))
                                <div id="mensaje2" class="alert alert-{{ Session::get('class')}}">{{ Session::get('message')}} </div>
                                @endif

                            </div>
                            <div class="form-group">
                                {!!Form::label('nom_cliente', 'Nombre: ')!!}
                                {!!Form::text('nom_cliente', null, ['class'=>'form-control','placeholder'=>'Nombre del Cliente'])!!}
                                @if ($errors->has('nom_cliente'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('nom_cliente') }}</li>
                                        </ul>
                                    </div>
                                @endif

                            </div>
                            <div class="form-group">
                                {!!Form::label('ape_cliente', 'Apellidos: ')!!}
                                {!!Form::text('ape_cliente', null, ['class'=>'form-control','placeholder'=>'Apellidos del Cliente'])!!}
                                @if ($errors->has('ape_cliente'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('ape_cliente') }}</li>
                                        </ul>
                                    </div>
                                @endif

                            </div>
                            <div class="form-group">
                                {!!Form::label('tel_cliente', 'Teléfono: ')!!}
                                {!!Form::number('tel_cliente', null, ['class'=>'form-control','placeholder'=>'Teléfono del Cliente'])!!}
                                @if ($errors->has('tel_cliente'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('tel_cliente') }}</li>
                                        </ul>
                                    </div>
                                @endif

                            </div>
                            <div class="form-group">
                                {!!Form::label('cel_cliente', 'Celular: ')!!}
                                {!!Form::number('cel_cliente', null, ['class'=>'form-control','placeholder'=>'Celular del Cliente'])!!}
                                @if ($errors->has('cel_cliente'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('cel_cliente') }}</li>
                                        </ul>
                                    </div>
                                @endif

                            </div>

                            <div class="form-group">
                                {!!Form::label('mail_cliente', 'Correo Electrónico: ')!!}
                                {!!Form::text('mail_cliente', null, ['class'=>'form-control','placeholder'=>'Correo Electrónico del Cliente'])!!}
                                @if ($errors->has('mail_cliente'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('mail_cliente') }}</li>
                                        </ul>
                                    </div>
                                @endif

                            </div>
                            <div class="form-group">
                               {!!Form::label('cod_dc_clien', 'Ciudad: ')!!}
                               <select name="cod_dc_clien" id="cod_dc_clien"
                                       class="form-control" style="height: 30px;">

                                @foreach($deptos as $depto)
                                   <option value="{{ $depto->cod_dc }}">
                                           {{ $depto->desc_ciudepto }}
                                    </option>
                                @endforeach
                                </select>
                            </div>
                            <input type="submit" id="enviar_datos" name="enviar_datos" value="Registrar" class="btn btn-primary btn-block">
                        </form>
<!--                        <div id="mensaje2" class="alert alert-info"> </div> -->
                        @if(Session::has('message'))
                        <div id="mensaje2" class="alert alert-{{ Session::get('class')}}">{{ Session::get('message')}} </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

<!--
  <footer id="pie" class="navbar navbar-expand-lg navbar-light bg-primary">
    <div class="col-md-12">  
       <div><h6>CONTÁCTENOS</h6>
          <h6>Teléfonos: (+571) 7590645  -  Cel: 304419138  - E-Mail: oortegon@gmail.com  -  Bogotá Colombia</h6>
       </div>
    </div>
  </footer> 
-->

  {!!Html::script('http://code.jquery.com/jquery-latest.js')!!}
    {!!Html::script('js/menu.js')!!}

<!-- </body>
</html> ->

@endsection