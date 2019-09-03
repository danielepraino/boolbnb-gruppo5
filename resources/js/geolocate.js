

$(document).ready(function() {

    // function to geolocate by address
  $('#geolocate_button').click(function() {
    /* Act on the event */
    $('.selectaddress').find('option').remove();
    var address;
        $.ajax({

        url:"https://api.tomtom.com/search/2/geocode/" + $('#address').val() + ".json?key=pRq4S3LGxAaZsWfuGGtYzBdlnBShmypz",
        type: "GET",
        data: {
          // key: ''
        },
        success:function(result){
         for (var i = 0; i < result.results.length; i++) {
           $('.selectaddress').removeClass('hidden');
           $('.selectaddress').append( '<option data-lon="'+result.results[i].position.lon+'" data-lat="'+result.results[i].position.lat+'" value="'+result.results[i].address.freeformAddress+'">'+result.results[i].address.freeformAddress+ '</option>');
         }
         $('.selectaddress').change(function(){
          
           var lon = $('option:selected', this).data('lon');
           var lat = $('option:selected', this).data('lat');
           var addr =$('option:selected', this).val();
           $('#address').val(addr);
           $('#lat').val(lat);
           $('#long').val(lon);
           // inizio mappa

             var maplat = parseFloat($('#lat').val());
             var maplon = parseFloat($('#long').val());

             var map = L.map('map-risposta')
             .setView([maplat, maplon], 13);


             L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
             	attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
             	// zoom: 10,
              // versionNumber: 1,
              // x: maplon,
              // y: maplat,

             }).addTo(map);

             L.marker([maplat, maplon]). bindPopup(addr).openPopup().addTo(map);






           // fine mappa

         });
        },
        error: function(){
        alert('errore');
        }
      });
    });
    //end function to geolocate by address

    //start function to geolocate by coordinates
    $('#rev-geolocate_button').click(function() {
          var la = parseFloat($('#rev-lat').val());
          var lo = parseFloat($('#rev-long').val());

          $.ajax({

          url:"https://api.tomtom.com/search/2/reverseGeocode/" + la +','+ lo + ".json?key=pRq4S3LGxAaZsWfuGGtYzBdlnBShmypz",
          type: "GET",
          data: {
            // key: ''
          },
          success:function(result){
            $('#rev-risposta-txt').text(result.addresses[0].address.freeformAddress)

          },
          error: function(){
          alert('errore');
          }
        });
      });
  });
