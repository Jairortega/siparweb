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
<div class="contenedor">
    <!-- Navigation -->
    <header class="header2">
        <div class="menu_bar">
            <a href="#" class="bt-menu"><span class="glyphicon glyphicon-align-justify"></span>Menu</a>
        </div>
        <nav>
            <ul>
                <li><a href="{!!URL::to('contactenos')!!}"><span class="glyphicon glyphicon-envelope"></span>&nbsp;Administradores</a></li>
                <li><a href="{!!URL::to('nosotros')!!}"><span class="glyphicon glyphicon-thumbs-up"></span>&nbsp;Nosotros</a></li>
                <li><a href="{!!URL::to('login')!!}"><span class="glyphicon glyphicon-user"></span>&nbsp;Login</a></li>
                <li> <span class="siparweb">SIPARWEB</span></li>
<!--                <li id="siparweb">SIPARWEB</li> -->
            </ul>
        </nav>
    </header>


	<div class="contenido">
<!--      <img src="img/parqueos5.jpg" > -->
    </div>
    <div class="sidebar">
       <h3>RESERVAS DE PARQUEADEROS</h3>
       <h4>Desde tu Movil para tu carro - moto o bicicleta</h4>
       <h4>Ubicación de Parqueaderos en la zona de destino</h4>
       <h4>Pago con medios Electrónicos</h4>
    </div>

  <footer class="footer">
       <h4>CONTÁCTENOS</h4>
       <h5>Teléfonos: (+571) 7590645  -  Cel: 304419138  - E-Mail: oortegon@gmail.com  -  Bogotá Colombia</h5>
  </footer> 


  {!!Html::script('http://code.jquery.com/jquery-latest.js')!!}
  {!!Html::script('js/menu.js')!!}

  </div>
</body>
</html>