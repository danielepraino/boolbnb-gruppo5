$(document).ready(function() {

  var latUser = GetURLParameter('lat');
  var lonUser = GetURLParameter('lon');
  console.log(latUser);
  console.log(lonUser);
  var flat_filtered_by_radius = [];
  console.log(flat_filtered_by_radius);
  console.log(' ');
  var html = "";

  for (var j = 0; j < flat_filtered_by_radius.length; j++) {
    html = '<img src="https://dummyimage.com/100x100/fff/aaa" alt="">'+
    '<h3 id = "flat_title_'+j+'">Titolo: </h3>'+
    '<small id = "flat_address_'+j+'">Indirizzo: </small>'+
    '<p id = "flat_description_'+j+'">Descrizione: </p>'+
    '<small id = "flat_price_'+j+'">Prezzo: </small>'
    console.log(html);
  }



//funzione che filtra gli appartamenti per il raggio impostato (20km di default)
  $.ajax({
    'url': 'http://127.0.0.1:8000/api/searched_flats',
    'method': 'GET',
    'success': function (flat) {
      for (var i = 0; i < flat.length; i++) {
        var currentLat = flat[i].lat;
        var currentLon = flat[i].lon;
        //console.log(currentLat+" "+currentLon);
        var distanza = distanzaAppartamenti(latUser,lonUser,currentLat,currentLon);

        if (distanza < 100) {
          console.log("Distanza tra appartamenti: "+distanza);
          console.log(flat[i]);
          flat_filtered_by_radius.push(flat[i])
        }
      }
    },
    'error': function () {
      alert('errore');
    }
  });



});


//Funzioni

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
