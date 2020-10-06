<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>SIPARWEB</title>

    {!!Html::style('css/main.css')!!}
    {!!Html::style('css/bootstrap.min.css')!!}
    {!!Html::style('css/bootstrap-grid.css')!!}

{!!Html::style('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css')!!}
{!!Html::script('https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js')!!}
{!!Html::script('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js')!!}


    {!!Html::script('https://code.jquery.com/jquery-1.11.3.min.js')!!}

    <meta name="viewport" content="width-device-width, user-scalable = no, initial-scale = 1.0, maximum-scale = 1.0, minimum-scale = 1.0">

</head>

<body>
    <!-- Navigation -->
    <header>
        <div class="menu_bar">
           <a href="#" class="bt-menu"><span class="glyphicon glyphicon-align-justify"></span>Menu</a>
        </div>
        <nav>
            <ul>
                <li><a href="{!!URL::to('/')!!}"><span class="glyphicon glyphicon-arrow-left">&nbsp;Retornar</a></li>
                <li id="siparweb">SIPARWEB</li>
            </ul>
        </nav>
    </header>

        <div class="container">
            <!-- APPLICATION -->
            <div id="App" class="row pt-12">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 style="color: #007bff; font-size: 20px; ">REGISTRASE (Unicamente para Clientes)</h4>
                        </div>
<!--                        <div id="mensaje" class="alert alert-danger"> </div> -->
                        @if ($errors->any())
                           <div class="alert alert-danger">
                              <ul>
                              @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                              @endforeach
                              </ul>
                           </div>
                        @endif

                        <form id="admon_form" method="post" action="/registrarse" class="card-body">
                            @csrf
                            <div class="form-group">
                                {!!Form::label('cc_usuario', 'Cédula: ')!!}
                                {!!Form::number('cc_usuario', null, ['class'=>'form-control','placeholder'=>'Cédula del Cliente'])!!}
                            </div>
                            <div class="form-group">
                                {!!Form::label('nom_usuario', 'Nombres: ')!!}
                                {!!Form::text('nom_usuario', null, ['class'=>'form-control','placeholder'=>'Nombres del Cliente'])!!}
                            </div>
                            <div class="form-group">
                                {!!Form::label('ape_usuario', 'Apellidos: ')!!}
                                {!!Form::text('ape_usuario', null, ['class'=>'form-control','placeholder'=>'Apellidos del Cliente'])!!}
                            </div>
                            <div class="form-group">
                                {!!Form::label('tel_usuario', 'Teléfono: ')!!}
                                {!!Form::number('tel_usuario', null, ['class'=>'form-control','placeholder'=>'Teléfono del Cliente'])!!}
                            </div>
                            <div class="form-group">
                                {!!Form::label('cel_usuario', 'Celular: ')!!}
                                {!!Form::text('cel_usuario', null, ['class'=>'form-control','placeholder'=>'Celular del Cliente'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('mail_usuario', 'Correo Electrónico: ')!!}
                                {!!Form::text('mail_usuario', null, ['class'=>'form-control','placeholder'=>'Correo Electrónico del Cliente'])!!}
                            </div>
                            <div class="form-group">
                                {!!Form::label('clave_usuario', 'Password: ')!!}
                                {!!Form::password('clave_usuario', null, ['class'=>'form-control','placeholder'=>'Clave del Cliente'])!!}
                            </div>
                            <div class="form-group">
                                {!!Form::label('reclave', 'Confirmar Password: ')!!}
                                {!!Form::password('reclave', null, ['class'=>'form-control','placeholder'=>'Confirmar clave del Cliente'])!!}
                            </div>
                            <div class="form-group">
                                {!!Form::label('pregunta', 'Generación Pregunta: ')!!}
                                {!!Form::text('pregunta', null, ['class'=>'form-control','placeholder'=>'Pregunta por si olvidó la clave'])!!}
                            </div>
                            <div class="form-group">
                                {!!Form::label('respuesta', 'Respuesta a la Pregunta: ')!!}
                                {!!Form::passsword('respuesta', null, ['class'=>'form-control','placeholder'=>'Respuesta a la pregunta'])!!}
                            </div>
                            <div class="form-group">
                                {!!Form::label('conrespuesta', 'Confirmar Respuesta a la Pregunta: ')!!}
                                {!!Form::passsword('conrespuesta', null, ['class'=>'form-control','placeholder'=>'Confirmar respuesta a la pregunta'])!!}
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

</body>
</html>