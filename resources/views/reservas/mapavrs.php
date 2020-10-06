
<style>
     #map {
      height: 100%;
     }
</style>

<div id="map">
             
</div>

<script>
//    var infowindow = null;
    
//    var divMapa = document.getElementById('map');
    function initMap() {
    //************************************************************************** */
    // Localizacion del usuario
    //************************************************************************** */
    var map = document.getElementById('map');
    navigator.geolocation.getCurrentPosition(fn_ok, fn_mal);

    function fn_mal() {
        alert("No se pudo obtener su Localización de su dispositivo ...!!");
        return 
    };

    function fn_ok(rta) {
        // Localizacion del usuario 
        var lat = rta.coords.latitude;
        var lon = rta.coords.longitude;

        var lato = Number(document.getElementById('latitud_origen').value);
        var lono = Number(document.getElementById('longitud_origen').value);
        var latd =  Number(document.getElementById('latitud_parque').value);
        var lond =  Number(document.getElementById('longitud_parque').value);
        var dir_parque = document.getElementById('dir_parque').value;


        gLatLon = new google.maps.LatLng(lato, lono);
        mapholder=document.getElementById('map')
        mapholder.style.height='450px';
        mapholder.style.width='100%';
        var myOptions={
        center:gLatLon,
        zoom:17
        };
        var map=new google.maps.Map(document.getElementById("map"),myOptions);
        var marker=new google.maps.Marker({position:gLatLon,map:map,title:"Su Origen..!!!"});

// Destino
        var dLatLon = new google.maps.LatLng(latd, lond);
        mapholder=document.getElementById('map')
        mapholder.style.height='450px';
        mapholder.style.width='100%';
        var dmyOptions={
        center:dLatLon,
        zoom:17
        };
        var map=new google.maps.Map(document.getElementById("map"),dmyOptions);
        var marker2=new google.maps.Marker({position:dLatLon,map:map,title:"Parqueadero Seleccionado ..!!!"});
/*
        var lato = Number(document.getElementById('latitud_origen').value);
        var lono = Number(document.getElementById('longitud_origen').value);
        var latd =  Number(document.getElementById('latitud_parque').value);
        var lond =  Number(document.getElementById('longitud_parque').value);
        var dir_parque = document.getElementById('dir_parque').value;
*/

        var gLatLon = new google.maps.LatLng(lato, lono);
//        var dLatLon = new google.maps.LatLng(latd, lond);
        var objInformation = {
                address: dir_parque
            }

        var objConfigDR = {
                    map:map,
                    zoom:10,
                    suppressMarkers: true
                }

            var objConfigDS = {
                origin: gLatLon,
                destination: objInformation.address,
                travelMode: google.maps.TravelMode.DRIVING
//                 provideRouteAlternatives: true
            }
        var ds = new google.maps.DirectionsService(); //Obtener coordenadas
        var dr = new google.maps.DirectionsRenderer(objConfigDR); //Traduce coordenadas a la ruta visible

        ds.route(objConfigDS, fnRutear);

        function fnRutear(resultados, status) {
            // Mostrar la ruta entre A y B
            if(status == 'OK'){
                dr.setDirections(resultados);
            } else {
                alert('Error: '+ status);
            }
        }
    }
  }  // fin initMap()

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDXIqdGhFh9mxTOXGHvMJI6V2NmA9Vcwn8&callback=initMap" async defer target="_blank"></script>


