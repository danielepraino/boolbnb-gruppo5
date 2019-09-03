/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});

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
           $('#getmap').click(function() {
             var maplat = parseFloat($('#lat').val());
             var maplon = parseFloat($('#long').val());

             var map = L.map('map-risposta', {
                 center: [0, -0.09],
                 zoom: 1
             });


             L.tileLayer("https://api.tomtom.com/map/1/staticimage?layer=basic&style=main&format=png&width=512&height=512&center={lo},{la}&zoom={zoom}&view=Unified&key=pRq4S3LGxAaZsWfuGGtYzBdlnBShmypz", {
             	attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
             	zoom: 0,
              versionNumber: 1,
              lo: maplon,
              la: maplat,

             }).addTo(map);

           });


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
