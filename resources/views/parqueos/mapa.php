
<style>
#map {
      height: 100%;
     }
</style>

<!-- <div id="map">
    
</div>

<script>
function cargarmap(){
var map = document.getElementById('map');
navigator.geolocation.getCurrentPosition(showPosition,showError);
function showPosition(position)
  {
  var lat=Number(position.coords.latitude);
  var lon=Number(position.coords.longitude);
/*
  document.getElementById('latitud_clien').value = lat;
  document.getElementById('longitud_clien').value = lon;
  document.getElementById('latitud_origen').value = lat;
  document.getElementById('longitud_origen').value = lon;
*/

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
function destinoMap(){
    //************************************************************************** */
    // Destino del usuario
    //************************************************************************** */
    var divMapa = document.getElementById('map');
    var dir_parque = document.getElementById('dir_parque').value;
    var gCoder = new google.maps.Geocoder();
    var map = document.getElementById('map');
    var objInformation = {
        address: dir_parque
    }

    gCoder.geocode(objInformation, fn_coderd);

    function fn_coderd(datos) {
        // console.log('DATOS: ' + datos);
        var coordestino = datos[0].geometry.location;
        document.getElementById('latitud_parque').value = coordestino;
        document.getElementById('longitud_parque').value = coordestino;
        var ltd = document.getElementById('latitud_parque').value;
        var tlon = ltd.length;
        var poce = ltd.indexOf(",");
        var latio = ltd.substring(1, (poce-1));
        var lngio = ltd.substring((poce+2), (tlon-1));
        document.getElementById('latitud_parque').value = Number(latio);
        document.getElementById('longitud_parque').value = Number(lngio);

        lat = Number(document.getElementById('latitud_parque').value);
        lon = Number(document.getElementById('longitud_parque').value);

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
        title:"Sitio del Parqueadero ..!!!"});


  } // fin fn_coderd

} // fin destino
    </script> -->
    <!-- <script async defer
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAEneNl2bjgTlCYhKt6v4JObwoliVRkj4A&callback=cargarmap">
</script> -->
<!-- AIzaSyAEneNl2bjgTlCYhKt6v4JObwoliVRkj4A    -->

<div id="map"></div>
    <script>
      // Note: This example requires that you consent to location sharing when
      // prompted by your browser. If you see the error "The Geolocation service
      // failed.", it means you probably did not give permission for the browser to
      // locate you.
      var map, infoWindow;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -34.397, lng: 150.644},
          zoom: 6
        });
        infoWindow = new google.maps.InfoWindow;

        // Try HTML5 geolocation.
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };

            infoWindow.setPosition(pos);
            infoWindow.setContent('Location found.');
            infoWindow.open(map);
            map.setCenter(pos);
          }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
          });
        } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter());
        }
      }

      function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
                              'Error: The Geolocation service failed.' :
                              'Error: Your browser doesn\'t support geolocation.');
        infoWindow.open(map);
      }
    </script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAEneNl2bjgTlCYhKt6v4JObwoliVRkj4A&callback=cargarmap" async defer ></script> -->
<!-- AIzaSyCiyD_WCtkbmewkr68BdzEWGwALQM06Gdw