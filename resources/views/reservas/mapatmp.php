
    <style>
        #map {
            height: 100%;
        }
    </style>

        <div id="map">
             
        </div>
		
		<script>
        var map;
		
        function initMap() {
            //************************************************************************** */
            // Localizacion del usuario
            //************************************************************************** */
            // var divMapa = document.getElementById('map_canvas');
            navigator.geolocation.getCurrentPosition(fn_ok, fn_mal);

            function fn_mal() {
             alert("No se pudo obtener su Localización de su dispositivo ...!!");
                return 
            };
            var map;
            function fn_ok(rta) {
                // Localizacion del usuario
//                var lat = rta.coords.latitude;
//                var lon = rta.coords.longitude;
               
                var lat = Number(document.getElementById('latitud_parque').value);
                var lon = Number(document.getElementById('longitud_parque').value);
//                  lat = 4.75212;
//                  lon = -74.083023;
//                alert("latitud2: " + lat);
//                alert("longitud2: " + lon);

                var myLatLng = {lat: lat, lng: lon};

                var map = new google.maps.Map(
                    document.getElementById('map'), {
                        center: myLatLng,
                        zoom: 17
                    });

                var marker = new google.maps.Marker({
                    position: myLatLng,
                    map: map,
                    icon: {
                        url: "http://maps.google.com/mapfiles/ms/icons/green-dot.png"
                    },
                    title: "Sitio del Parqueqadero"
                });

            }
    }

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDXIqdGhFh9mxTOXGHvMJI6V2NmA9Vcwn8&callback=initMap" async defer target="_blank"></script>


