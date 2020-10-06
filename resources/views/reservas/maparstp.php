
<style>
#map {
      height: 100%;
     }
</style>

<div id="map">
    
</div>

<script>
function cargarmap(){
var map = document.getElementById('map');
navigator.geolocation.getCurrentPosition(showPosition,showError);
function showPosition(position)
  {
  var lat=Number(position.coords.latitude);
  var lon=Number(position.coords.longitude);
  document.getElementById('latitud_clien').value = lat;
  document.getElementById('longitud_clien').value = lon;
  document.getElementById('latitud_origen').value = lat;
  document.getElementById('longitud_origen').value = lon;

//  var gLatLon = new google.maps.LatLng(lat, lon);
  latlon=new google.maps.LatLng(lat, lon)
  mapholder=document.getElementById('map')
  mapholder.style.height='450px';
  mapholder.style.width='100%';
  var myOptions={
  center:latlon,
  zoom:17
//  navigationControlOptions:{style:google.maps.NavigationControlStyle.SMALL}
  };
  var map=new google.maps.Map(document.getElementById("map"),myOptions);
  var marker=new google.maps.Marker({position:latlon,map:map,title:"Su Ubicación..!!!"});
  }

function showError(error)
  {
  switch(error.code) 
    {
    case error.PERMISSION_DENIED:
      x.innerHTML="Denegada la peticion de Geolocalización en el navegador.";
      break;
    case error.POSITION_UNAVAILABLE:
      x.innerHTML="La información de la localización no esta disponible.";
      break;
    case error.TIMEOUT:
      x.innerHTML="El tiempo de petición ha expirado.";
      break;
    case error.UNKNOWN_ERROR:
      x.innerHTML="Ha ocurrido un error desconocido.";
      break;
    }
  }
//  setMarkers(map, sites);
} 
</script>

<script>
function origenMap(){
    //************************************************************************** */
    // Origen del usuario
    //************************************************************************** */

    var divMapa = document.getElementById('map');
    navigator.geolocation.getCurrentPosition(fun_ok, fn_malo);
    function fn_malo() {
        alert("No se pudo obtener su Localización de su dispositivo ...!!");
            return 
    };
    function fun_ok(rta) {
        var lat = rta.coords.latitude;
        var lon = rta.coords.longitude;
        document.getElementById('latitud_clien').value = lat;
        document.getElementById('longitud_clien').value = lon;
        document.getElementById('latitud_origen').value = lat;
        document.getElementById('longitud_origen').value = lon;

            // console.log(rta);

            var gLatLon = new google.maps.LatLng(lat, lon);

            var objConfig = {
                zoom: 17,
                center: gLatLon
            }


            var gMapa = new google.maps.Map(divMapa, objConfig);

    } // fun_ok()
} // origenMap()

function destinoMap(){
    //************************************************************************** */
    // Destino del usuario
    //************************************************************************** */
    var divMapa = document.getElementById('map');
    var dir_destino = document.getElementById('dir_destino').value;
    var gCoder = new google.maps.Geocoder();
    var map = document.getElementById('map');
    var objInformation = {
        address: dir_destino
    }

    gCoder.geocode(objInformation, fn_coderd);

    function fn_coderd(datos) {
        // console.log('DATOS: ' + datos);
        var coordestino = datos[0].geometry.location;
        document.getElementById('latitud_destino').value = coordestino;
        document.getElementById('longitud_destino').value = coordestino;
        var ltd = document.getElementById('latitud_destino').value;
        var tlon = ltd.length;
        var poce = ltd.indexOf(",");
        var latio = ltd.substring(1, (poce-1));
        var lngio = ltd.substring((poce+2), (tlon-1));
        document.getElementById('latitud_destino').value = Number(latio);
        document.getElementById('longitud_destino').value = Number(lngio);

        lat = Number(document.getElementById('latitud_destino').value);
        lon = Number(document.getElementById('longitud_destino').value);

        latlon=new google.maps.LatLng(lat, lon)
        mapholder=document.getElementById('map')
        mapholder.style.height='450px';
        mapholder.style.width='100%';
        var myOptions={
        center:latlon,
        zoom:17
      //  navigationControlOptions:{style:google.maps.NavigationControlStyle.SMALL}
        };
        var map=new google.maps.Map(document.getElementById("map"),myOptions);
        var marker=new google.maps.Marker({position:latlon,
        map:map,
        icon: {
                url: "http://maps.google.com/mapfiles/ms/icons/green-dot.png"
            },
        title:"Su Destino..!!!"});


  } // fin fn_coderd

} // fin destino
    </script>

<script>
function fn_parque() {
//      alert("entro a inicio ");
      var lati = document.getElementById('latitud_destino').value;
      var longi = document.getElementById('longitud_destino').value;
/*
      var token=$("#token").val();
      alert("token " + token);
      var archeje = 'D:\vrs\htdocs\laravel\public\..\resources\views\reservas\listapar.php';
//      var archeje = public_path() + '..\resources\views\reservas\listapar.php';

      $.ajax{
      url: archeje,
      headers: {'X-CSRF-TOKEN': token},
      data: { lati:$("#latitud_destino").val(), longi:$("#longitud_destino").val() },
      type: 'POST',
      function(resp_parque){
        alert("id_parque: " + resp_parque);
        $("#id_parque").val(resp_parque);
    //e.preventDefault();
    };
    */
    }
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDXIqdGhFh9mxTOXGHvMJI6V2NmA9Vcwn8&callback=cargarmap" async defer ></script>


