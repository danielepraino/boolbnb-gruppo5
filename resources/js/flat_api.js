$(document).ready(function() {
  var latUser = GetURLParameter('lat');
  var lonUser = GetURLParameter('lon');
  var raggioUser = GetURLParameter('radius');
  console.log(latUser);
  console.log(lonUser);
  var flat_filtered_by_radius = [];

  console.log(flat_filtered_by_radius);
  console.log(' ');

  $(".services input").click(function() {
    if ($(this).val() == '0') {
      $(this).val('1')
    }else {
      $(this).val('0')
    }
    //alert($(this).val());

    // if ($(this).val() == '1') {
    //   alert('ok' + $(this).attr('name'))
    // }
  });


  //filtro wifi
  filterByService("wifi");
  //filtro parcheggio
  filterByService("parking");
  //filtro pool
  filterByService("pool");
  //filtro concierge
  filterByService("concierge");
  //filtro sauna
  filterByService("sauna");
  //filtro sea_view
  filterByService("sea_view");


//funzione che filtra gli appartamenti per il raggio impostato (20km di default)
  $.ajax({
    'url': 'http://localhost:8000/api/searched_flats',
    'method': 'GET',
    'success': function (flat) {
      for (var i = 0; i < flat.length; i++) {
        var currentLat = flat[i].lat;
        var currentLon = flat[i].lon;
        //console.log(currentLat+" "+currentLon);
        var distanza = distanzaAppartamenti(latUser,lonUser,currentLat,currentLon);

        if (distanza < raggioUser) {
          // console.log("Distanza tra appartamenti: "+distanza);
          // console.log(flat[i]);
          flat_filtered_by_radius.push(flat[i])
        }
      }
    },
    'error': function () {
      alert('errore');
    }
  });

  //Funzioni

  //funzione ajax per i servizi
  function filterByService(type_of_service) {
    $(".services input[name = '"+type_of_service+"']").click(function () {
      if ($(this).val() == 1) {
        alert('1')
        $.ajax({
          'url': 'http://127.0.0.1:8000/api/'+type_of_service+'_service',
          'method': 'GET',
          'success': function (service) {
            console.log(type_of_service+": ");
            console.log(service);
            for (var i = 0; i < service.length; i++) {
              for (var j = 0; j < flat_filtered_by_radius.length; j++) {
                if(service[i]['flat_id'] == flat_filtered_by_radius[j]['id']) {
                  console.log(type_of_service+' filter: ');
                  console.log(service[i]);
                  console.log('flat filtered by '+type_of_service+':');
                  console.log(flat_filtered_by_radius[j]);
                }
              }
            }
          },
          'error': function () {
            alert('errore');
          }
        });
      }else {
        alert('0')
        console.log(flat_filtered_by_radius);
      }
    });
  }

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
