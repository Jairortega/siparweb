<style>
#map {
    height: 100%;
}
</style>

<div id="map">
             
</div>

<script>
function initMap(){
//************************************************************************** */
// Localizacion del usuario
//************************************************************************** */
// var divMapa = document.getElementById('map_canvas');

var divMapa = document.getElementById('map');
navigator.geolocation.getCurrentPosition(fn_ok, fn_mal);
function fn_mal() {
    alert("No se pudo obtener su Localización de su dispositivo ...!!");
        return 
};
function fn_ok(rta) {
var lat = Number(document.getElementById('latitud_parque').value);
var lon = Number(document.getElementById('longitud_parque').value);

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
  var marker=new google.maps.Marker({position:latlon,map:map,title:"Ubicación del Parqueadero ..!!!"});
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
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDXIqdGhFh9mxTOXGHvMJI6V2NmA9Vcwn8&callback=initMap" async defer target="_blank"></script>

