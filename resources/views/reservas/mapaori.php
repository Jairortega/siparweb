
    <style>
        #map {
            height: 100%;
        }
    </style>

        <div id="map">
             
        </div>

<script>
       var sites = <?php print_r(json_encode($vservicios)) ?>;
        console.log(sites);
        var infowindow = null;
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
                var lat = rta.coords.latitude;
                var lon = rta.coords.longitude;
                document.getElementById('latitud_clien').value = lat;
                document.getElementById('longitud_clien').value = lon;
//                document.getElementById('latitud_parque').value = lat;
//                document.getElementById('longitud_parque').value = lon;
                
                var lati = Number(lat);
                var longi = Number(lon);
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
                    title: "Sitio donde se Encuentra"
                });
                setMarkers(map, sites);
            }
    function setMarkers(map, markers) {

    for (var i = 0; i < markers.length; i++) {
        // validar el rango de LAtitud y Longitud (lat y lon)
/*
       if(Number(site.latitud_parque) >= (lati - 0.08) && Number(site.latitud_parque) <= (lati + 0.08))
         { 
            if(Number(site.longitud_parque) >= (longi - 0.08) && Number(site.longitud_parque) <= (longi + 0.08))
              { 
*/
        var site = markers[i];
        var siteLatLng = new google.maps.LatLng(site.latitud_parque, site.longitud_parque);

         tsContent = '<h5 class="text-light bg-dark text-center">' + '<p>ID Parqueadero: ' + site.id_parque + '</h5>' +
        '<p>PARQUEADERO: ' + site.des_parque + '</p>' +
        '<p>DIRECCIÓN: ' + site.dir_parque + '</p>' +
        '<p>TELÉFONO: ' + site.tel_parque + '</p>' +
        '<p>VALOR MINUTO CARRO: ' + site.minutocar + ' COP' + '</p>' +
        '<h5>CUPO DISPONIBLE CARROS: ' + site.dis_cupocar + '</h5>' +
        '<button onclick = "reserva(site.id_parque);" class="btn btn-primary btn-block role="button">Reserva su Parqueadero</button>' +
        '<a href="#" class="btn btn-success btn-block">Ruta más corta hacia el Parqueadero</a>';

        sContent = '<h6 class="text-light bg-dark text-center">' + '<p>Parqueadero Seleccionado ...!!! ' + '</p></h6>';
        id_parque = site.id_parque;
//        alert("ID: " + id_parque);
         infowindow = new google.maps.InfoWindow({content: sContent});

        var titletext = 'PARQUEADERO: ' + site.des_parque + '\n' + 
        ' ID: ' + site.id_parque + '\n' +
        ' DIRECCIÓN: ' + site.dir_parque + '\n' +
        ' TELÉFONO: ' + site.tel_parque + '\n' +
        ' VALOR MINUTO CARRO: ' + site.minutocar + ' COP' + '\n' +
        ' CUPO DISPONIBLE CARROS: ' + site.dis_cupocar + '\n' +
        ' VALOR MINUTO MOTO: ' + site.minutomoto + ' COP' + '\n' +
        ' CUPO DISPONIBLE MOTOS: ' + site.dis_cupomoto + '\n' +
        ' VALOR MINUTO BICICLETA: ' + site.minutobici + ' COP' + '\n' +
        ' CUPO DISPONIBLE BICICLETAS: ' + site.dis_cupobici;
        
        var marker = new google.maps.Marker({
            position: siteLatLng,
            map: map,
            icon: {
               url: "http://maps.google.com/mapfiles/ms/icons/yellow-dot.png"
            },
            title: titletext,
            info: infowindow,
            animation: google.maps.Animation.DROP,
            id: id_parque,
        });

        google.maps.event.addListener(marker, "click", function() {
//           infowindow.setContent(this.info);
        infowindow.open(map, this);
           // Localizacion parqueadero que reservo el usuario
        document.getElementById('latitud_parque').value = this.getPosition().lat();
        document.getElementById('longitud_parque').value = this.getPosition().lng();
        document.getElementById('id_parque').value = this.id;
//        alert("lat: " + this.getPosition().lat());
//        alert("lng: " + this.getPosition().lng());
//        alert("Info: " + this.id);
        document.getElementById('tipo_vehiculo').focus();
//        console.log('Localizacion parqueadero reservado:', site.latitud_parque, site.longitud_parque);
//        console.log('id parqueadero: ', site.id_parque);
        });

//        }
//      }
    }
    }
   
   function reserva(id_parque){
    document.getElementById('latitud_parque').value = site.latitud_parque;
    document.getElementById('longitud_parque').value = site.longitud_parque;
    document.getElementById('id_parque').value = id_parque;
    alert("id: " + id_parque);
    document.getElementById('tipo_vehiculo').focus();
//    return
   }

}

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDXIqdGhFh9mxTOXGHvMJI6V2NmA9Vcwn8&callback=initMap" async defer target="_blank"></script>


