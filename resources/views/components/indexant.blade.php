<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>SIPARWEB</title>

    {!!Html::style('css/main.css')!!}
<!--    {!!Html::style('css/fonts.css')!!} -->
    {!!Html::style('css/bootstrap.min.css')!!}
    {!!Html::style('css/bootstrap-grid.css')!!}
<!--
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/fonts.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap-grid.css">
-->

{!!Html::style('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css')!!}
{!!Html::script('https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js')!!}
{!!Html::script('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js')!!}

<!--
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
-->

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
                <li><a href="{!!URL::to('contactenos')!!}"><span class="glyphicon glyphicon-envelope"> Contactenos</a></li>
                <li><a href="{!!URL::to('nosotros')!!}"><span class="glyphicon glyphicon-envelope">&nbsp;Nosotros</a></li>
<!--                <li><a href="{!!URL::to('registrarse')!!}"><span class="glyphicon glyphicon-ok">&nbsp;Registrarse</a></li> -->
                <li><a href="{!!URL::to('login')!!}"><span class="glyphicon glyphicon-user"></span>&nbsp;Login</a></li>

                <li id="siparweb">SIPARWEB</li>
            </ul>
        </nav>
    </header>

<section id="seccion">
 <!--    <div id="imagen-group">
  <img src="img/parqueos5.jpg" width=1422px; height=450px; class="portada"> 
    </div> -->

<div id = "bloqserv" class="card-center responsive" >
    <div id="vrs" class="row pt-6 container-fluid">
      <div id ="vrs2" class="col-md-6"> 
          <div class="card-header">
            <h3 id="titulo1" style ="width: 600px;">SERVICIOS PRESTADOS</h3>
          </div>
          <form id="product-form" class="card-body">
            <div class="servicios" style ="width: 600px;">
                <h3 id="titulo3">Reserva de Parqueadero</h3>
                <br>
                <h3 id="titulo3">App para tu Movil</h3>
                <br>
                <h3 id="titulo3">Pago con medios Electrónicos</h3>
                <br>
            </div>    
          </form>
      </div>
    </div>
  </div>
  </section>

  <footer id="pie" class="navbar navbar-expand-lg navbar-light bg-primary">
    <div class="col-md-12">  
       <div><h6>CONTÁCTENOS</h6>
          <h6>Teléfonos: (+571) 7590645  -  Cel: 304419138  - E-Mail: oortegon@gmail.com  -  Bogotá Colombia</h6>
       </div>
    </div>
  </footer> 


  {!!Html::script('http://code.jquery.com/jquery-latest.js')!!}
  {!!Html::script('js/menu.js')!!}

</body>
</html>