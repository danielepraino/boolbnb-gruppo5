$(document).ready(function() {
  var latUser = GetURLParameter('lat');
  var lonUser = GetURLParameter('lon');
  var raggioUser = GetURLParameter('radius');
  console.log(latUser);
  console.log(lonUser);


  $(".services input").click(function() {
    if ($(this).val() == '0') {
      $(this).val('1')
    }else {
      $(this).val('0')
    }
  });


  //slider raggio
    var radius;
    var radiusFilter;

    $( "#radius_range" ).slider({
      range: "max",
      min: 20,
      max: 150,
      value: 20,
      step: 10,
      stop: function (event, ui) {
        $( "#maximum_radius" ).val( ui.value );
        radius = $( "#maximum_radius" ).val();
        //console.log(radius);
        var radiusFilter = filterByRadius(radius);
        console.log(radiusFilter);
      }
    });
    $( "#maximum_radius" ).val( $( "#radius_range" ).slider( "value" ) );


  //slider stanze
    $( "#room_range" ).slider({
      range: "max",
      min: 1,
      max: 10,
      value: 1,
      stop: function( event, ui ) {
        $( "#maximum_room" ).val( ui.value );
        filter_data();
      }
    });
    $( "#maximum_room" ).val( $( "#room_range" ).slider( "value" ) );


  //slider posti letto
    $( "#bed_range" ).slider({
      range: "max",
      min: 2,
      max: 20,
      value: 2,
      stop: function( event, ui ) {
        $( "#maximum_bed" ).val( ui.value );
        filter_data();
      }
    });
    $( "#maximum_bed" ).val( $( "#bed_range" ).slider( "value" ) );

    //al click delle checkbox filtra i dati in base
    //alla checkbox cliccata
    $('.filter_checkbox').click(function() {
      filter_data();
    });


  //Funzioni


  //funzione che filtra gli appartamenti per il raggio impostato (20km di default)
  //da modificare
  //http://127.0.0.1:8000
  function filterByRadius(radius) {
    var flat_filtered_by_radius = [];
    var distanze =  [];

    $.ajax({
      'url': 'http://127.0.0.1:8000/api/searched_flats',
      'method': 'GET',
      'success': function (flat) {
        for (var i = 0; i < flat.length; i++) {
          var currentLat = flat[i].lat;
          var currentLon = flat[i].lon;
          var distanza = distanzaAppartamenti(latUser,lonUser,currentLat,currentLon);

          if(distanza < radius ) {
            flat_filtered_by_radius.push(flat[i])
          }
        }
      },
      'error': function () {
        alert('errore');
      }
    });
    return flat_filtered_by_radius
  }

  //funziona che filtra i data in base ai servizi selezionati
  //tramite ajax in post
  function filter_data(){

      var url = $('#filter-form').data('route');
      var room = $('#maximum_room').val();
      var bed = $('#maximum_bed').val();
      var wifi = get_filter('wifi');
      var parking = get_filter('parking');
      var pool = get_filter('pool');
      var concierge = get_filter('concierge');
      var sauna = get_filter('sauna');
      var sea_view = get_filter('sea_view');

      $.ajax({
          url: url,
          method:"POST",
          data:{room:room, bed:bed[0], wifi:wifi[0], parking:parking[0], pool:pool[0], concierge:concierge[0], sauna:sauna[0], sea_view:sea_view[0]},
          success:function(data){
            console.log(data);
          },
          'error': function (error) {
            console.log(error);
          }
      });

  };

  //funzione per ricavare i filtri selezionati
  function get_filter(type_of_service){
    var filter = [];
    $('.'+type_of_service+':checked').each(function(){
        filter.push($(this).val());
    });

      return filter;
    };


  console.log(get_filter('wifi'));



  // funzione per estrarre i parametri dall'url
  function GetURLParameter(sParam){
    var sPageURL = window.location.search.substring(1);
    var sURLVariables = sPageURL.split('&');
    for (var i = 0; i < sURLVariables.length; i++){
        var sParameterName = sURLVariables[i].split('=');
        if (sParameterName[0] == sParam){
            return sParameterName[1];
        }
    }
  };

  // Convert Degress to Radians
  function deg2Rad( deg ) {
    return deg * Math.PI / 180;
  }

  // Get Distance between two lat/lng points using the Haversine function
  function distanzaAppartamenti(lat1,lon1,lat2,lon2)
  {
      var R = 6372.8; // Earth Radius in Kilometers

      var dLat = deg2Rad(lat2-lat1);
      var dLon = deg2Rad(lon2-lon1);
      var a = Math.sin(dLat/2) * Math.sin(dLat/2) + Math.cos(deg2Rad(lat1)) * Math.cos(deg2Rad(lat2)) * Math.sin(dLon/2) * Math.sin(dLon/2);
      var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
      var d = R * c;

      // Return Distance in Kilometers
      return d;
  }
});
