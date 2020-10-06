
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
    var divMapa = document.getElementById('map');
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

        lat = document.getElementById('latitud_destino').value;
        lon = document.getElementById('longitud_destino').value;

// lo nuevo
        var gLatLon = new google.maps.LatLng(lat, lon);

        var objConfig = {
            zoom: 17,
            center: gLatLon
        }

        var gMapa = new google.maps.Map(divMapa, objConfig);

        latio = document.getElementById('latitud_destino').value;
        lngio= document.getElementById('longitud_destino').value;

        var map = new google.maps.Map(document.getElementById('map'), {
//                        center: myLatLng,
                center: gLatLon,
                zoom: 17
            });
        var marker = new google.maps.Marker({
            position: gLatLon,
            map: map,
            icon: {
                url: "http://maps.google.com/mapfiles/ms/icons/green-dot.png"
            },
            title: "Sitio de Destino"
        });
        setMarkers(map, sites);
    } // fn_ok()

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

        var mencar = "CUPO DISPONIBLE EN CARROS";
        var menmot = "CUPO DISPONIBLE EN MOTOS";
        var menbic = "CUPO DISPONIBLE EN BICICLETAS";
        if(site.dis_cupocar < 1){
            mencar = "NO HAY CUPO EN CARROS";
        }
        if(site.dis_cupomoto < 1){
            menmot = "NO HAY CUPO EN MOTOS";
        }
        if(site.dis_cupobici < 1){
            menbic = "NO HAY CUPO EN BICICLETAS";
        }

        var titletext = 'PARQUEADERO: ' + site.id_parque + ' - ' + site.des_parque + '\n' + 
        ' DIRECCIÓN: ' + site.dir_parque + '\n' +
        ' TELÉFONO: ' + site.tel_parque + '\n\n' +
        ' VALOR MINUTO CARRO: ' + site.minutocar + ' COP' + '\n' +
          mencar + '\n\n' +
        ' VALOR MINUTO MOTO: ' + site.minutomoto + ' COP' + '\n' +
          menmot + '\n\n' +
        ' VALOR MINUTO BICICLETA: ' + site.minutobici + ' COP' + '\n' +
          menbic;
/*
        ' CUPO DISPONIBLE CARROS: ' + site.dis_cupocar + '\n\n' +
        ' VALOR MINUTO MOTO: ' + site.minutomoto + ' COP' + '\n' +
        ' CUPO DISPONIBLE MOTOS: ' + site.dis_cupomoto + '\n\n' +
        ' VALOR MINUTO BICICLETA: ' + site.minutobici + ' COP' + '\n' +
        ' CUPO DISPONIBLE BICICLETAS: ' + site.dis_cupobici;
*/
        var marker = new google.maps.Marker({
            position: siteLatLng,
            map: map,
            icon: {
               url: "http://maps.google.com/mapfiles/ms/icons/yellow-dot.png"
            },
            title: titletext,
            info: infowindow,
            animation: google.maps.Animation.DROP,
            id: i,
        });

        google.maps.event.addListener(marker, "click", function() {
//           infowindow.setContent(this.info);
        infowindow.open(map, this);
        // Localizacion parqueadero que reservo el usuario
        document.getElementById('latitud_parque').value = this.getPosition().lat();
        document.getElementById('longitud_parque').value = this.getPosition().lng();
//        document.getElementById('id_parque').value = this.id;
        var tvehi = document.getElementById('tipo_vehiculo').value;
        var t = this.id;
        console.log('i: ', t);
        var sitio = markers[t];
        var cupcar = sitio.dis_cupocar;
        var cupmot = sitio.dis_cupomoto;
        var cupbic = sitio.dis_cupobici;
        document.getElementById('id_parque').value = sitio.id_parque;
        console.log('tvehi: ', tvehi);
        console.log('cupcar: ', cupcar);
        console.log('cupmot: ', cupmot);
        console.log('cupbic: ', cupbic);
         if(tvehi == 1 && cupar < 1){
            alert("NO HAY CUPO.....!!!");
            document.getElementById('placa').value = ' ';
            document.getElementById('tipo_vehiculo').focus();
         }
         if(tvehi == 2 && cupmot < 1){
            alert("NO HAY CUPO.....!!!");
            document.getElementById('placa').value = ' ';
            document.getElementById('tipo_vehiculo').focus();
         }
         if(tvehi == 3 && cupbic < 1){
            alert("NO HAY CUPO.....!!!");
            document.getElementById('placa').value = ' ';
            document.getElementById('tipo_vehiculo').focus();
         }

        document.getElementById('placa').focus();
        });

//        } 
//      }
      } // fin FOR
    } //fin setMarkers()
  }  // fin initMap()

/*
   function reserva(id_parque){
    document.getElementById('latitud_parque').value = site.latitud_parque;
    document.getElementById('longitud_parque').value = site.longitud_parque;
    document.getElementById('id_parque').value = id_parque;
    alert("id: " + id_parque);
    document.getElementById('tipo_vehiculo').focus();
//    return
   }
*/


function origenMap(){
    //************************************************************************** */
    // Origen del usuario
    //************************************************************************** */
    // var divMapa = document.getElementById('map_canvas');

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
            // console.log(rta);
/*
            var gLatLon = new google.maps.LatLng(lat, lon);

            var objConfig = {
                zoom: 17,
                center: gLatLon
            }


            var gMapa = new google.maps.Map(divMapa, objConfig);
*/
    var dir_origen = document.getElementById('dir_origen').value;
    var gCoder = new google.maps.Geocoder();

    var objInformation = {
        address: dir_origen
    }

    gCoder.geocode(objInformation, fn_codero);

    function fn_codero(datos) {
        // console.log(datos);
        var coordorigen = datos[0].geometry.location;
        document.getElementById('latitud_origen').value = coordorigen;
        document.getElementById('longitud_origen').value = coordorigen;
        var ltd = document.getElementById('latitud_origen').value;
        var tlon = ltd.length;
        var poce = ltd.indexOf(",");
        var latio = ltd.substring(1, (poce-1));
        var lngio = ltd.substring((poce+2), (tlon-1));
        document.getElementById('latitud_origen').value = latio;
        document.getElementById('longitud_origen').value = lngio;
        }

        latio = document.getElementById('latitud_origen').value;
        lngio= document.getElementById('longitud_origen').value;

        var gLatLon = new google.maps.LatLng(latio, lngio);

        var objConfig = {
            zoom: 17,
            center: gLatLon
        }

    } // fun_ok()
} // origenMap()

function destinoMap(){
    //************************************************************************** */
    // Destino del usuario
    //************************************************************************** */
    // var divMapa = document.getElementById('map_canvas');
    var dir_destino = document.getElementById('dir_destino').value;
    var gCoder = new google.maps.Geocoder();

    var objInformation = {
        address: dir_destino
    }

    gCoder.geocode(objInformation, fn_coderd);

    function fn_coderd(datos) {
        // console.log(datos);
        var coordestino = datos[0].geometry.location;
        document.getElementById('latitud_destino').value = coordestino;
        document.getElementById('longitud_destino').value = coordestino;
        var ltd = document.getElementById('latitud_destino').value;
        var tlon = ltd.length;
        var poce = ltd.indexOf(",");
        var latio = ltd.substring(1, (poce-1));
        var lngio = ltd.substring((poce+2), (tlon-1));
        document.getElementById('latitud_destino').value = latio;
        document.getElementById('longitud_destino').value = lngio;
        }
    }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDXIqdGhFh9mxTOXGHvMJI6V2NmA9Vcwn8&callback=initMap" async defer target="_blank"></script>


