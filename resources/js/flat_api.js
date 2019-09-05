$(document).ready(function() {

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

  var lat = GetURLParameter('lat');
  var lon = GetURLParameter('lon');
  console.log(lat);
  console.log(lon);




  $.ajax({
    'url': 'http://localhost:8000/api/searched_flats',
    'method': 'GET',
    'success': function (flat) {
      console.log(flat);
    },
    'error': function () {
      alert('errore');
    }
  });
});
